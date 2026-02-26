<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cotisation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\PaymentReminder;



class TresorCotisationController extends Controller
{
    /**
     * Affiche la liste des cotisations
     */
    public function index(Request $request)
    {
        $query = Cotisation::with('user');
        
        // Filtre par statut
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filtre par membre
        if ($request->filled('member_id')) {
            $query->where('user_id', $request->member_id);
        }
        
        $cotisations = $query->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return view('tresor.cotisations.index', compact('cotisations'));
    }
    
   /**
     * Formulaire création cotisation
     */
    public function create(Request $request)
    {
        $member = null;
        if ($request->filled('member_id')) {
            $member = User::findOrFail($request->member_id);
        }
        
        $members = User::where('role', 'membre')
            ->orderBy('name')
            ->get();
            
        return view('tresor.cotisations.create', compact('members', 'member'));
    }

    /**
     * Enregistrement cotisation + génération facture
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'months' => 'required|integer|min:1',
            'created_at' => 'required|date',
        ]);

        // Vérifie si le membre a déjà payé ce mois pour éviter doublons
        if(Cotisation::where('user_id', $request->user_id)
            ->where('months', $request->months)
            ->exists()) {
            return back()->with('error', 'Ce membre a déjà payé pour ce mois.');
        }

        $user = User::findOrFail($request->user_id);

        // Génération référence pour trésorier
        $paymentReference = 'COT-' . Str::upper(Str::random(8));

        // Création cotisation
        $cotisation = Cotisation::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'months' => $request->months,
            'created_at' => $request->created_at,
            'status' => 'paid',
            'payment_reference' => $paymentReference,
        ]);

        // 📄 Génération facture PDF (même logique que les membres)
        Storage::disk('public')->makeDirectory('invoices');

        $invoiceNumber = 'INV-' . now()->format('Ymd') . '-' . $cotisation->id;

        $pdf = Pdf::loadView('pdf.invoice', [
            'user' => $user,
            'payment' => $cotisation,
            'invoiceNumber' => $invoiceNumber,
        ]);

        $path = "invoices/{$invoiceNumber}.pdf";
        Storage::disk('public')->put($path, $pdf->output());

        // Sauvegarde chemin facture
        $cotisation->update([
            'invoice_path' => $path,
        ]);

        return redirect()
            ->route('tresor.cotisations.index')
            ->with('success', 'Cotisation enregistrée et facture générée avec succès !');
    }
    
    /**
     * Affiche la page de relance
     */
    public function reminder()
    {
        $unpaidMembers = User::where('role', 'membre')
            ->where('is_paid', 1)
            ->with(['cotisations' => function($query) {
                $query->where('status', 'paid')
                    ->orderBy('created_at', 'desc');
            }])
            ->get()
            ->map(function($user) {
                $lastPayment = $user->cotisations->first();
                $monthsLate = $lastPayment ? 
                    max(0, now()->diffInMonths($lastPayment->created_at) - $lastPayment->months) : 
                    now()->diffInMonths($user->created_at);
                    
                $user->months_late = $monthsLate;
                return $user;
            })
            ->where('months_late', '>', 0);
            
        return view('tresor.cotisations.reminder', compact('unpaidMembers'));
    }
    
    /**
     * Envoie une relance
     */
public function sendReminder(Request $request)
{
    $request->validate([
        'member_id' => 'required|exists:users,id'
    ]);

    $member = User::findOrFail($request->member_id);

    // Envoi du mail
    try {
        Mail::to($member->email)->send(new PaymentReminder($member));

        return response()->json([
            'success' => true,
            'message' => 'Relance envoyée par mail avec succès !'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Erreur lors de l\'envoi du mail : ' . $e->getMessage()
        ]);
    }
}

    
    /**
     * Affiche les cotisations personnelles du trésorier
     */
    public function personal()
    {
        $user = auth()->user();
        $cotisations = Cotisation::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return view('tresor.cotisations.personal', compact('cotisations'));
    }
}
