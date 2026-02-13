<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Cotisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Mail\InvoicePaidMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Notification;


class CotisationController extends Controller
{
    const MONTH_PRICE = 5000;

    /** Page effectuer un paiement */
    public function pay()
    {
        $user = Auth::user();

        $lastPayment = Cotisation::where('user_id', $user->id)
            ->where('status', 'paid')
            ->latest()
            ->first();

        return view('member.cotisations.pay', compact('user', 'lastPayment'));
    }

    /** Page de confirmation du paiement */
    public function confirm(Request $request)
    {
        $request->validate([
            'number_of_months' => 'required|integer|min:1',
            'amount' => 'required|integer|min:5000',
        ]);

        $user = Auth::user();
        $months = $request->number_of_months;
        $amount = $request->amount;

        return view('member.cotisations.confirm', compact('user', 'months', 'amount'));
    }

    /** Calcul montant */
    public function calculate(Request $request)
    {
        $request->validate([
            'number_of_months' => 'required|integer|min:1'
        ]);

        $months = $request->number_of_months;
        $amount = $months * self::MONTH_PRICE;

        return response()->json([
            'months' => $months,
            'amount' => $amount
        ]);
    }

    /** Enregistrement avant paiement */
    public function process(Request $request)
    {
        $request->validate([
            'number_of_months' => 'required|integer|min:1',
            'amount' => 'required|integer|min:5000',
        ]);

        $cotisation = Cotisation::create([
            'user_id' => auth()->id(),
            'months' => $request->number_of_months,
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        return response()->json([
            'amount' => $cotisation->amount,
            'cotisation_id' => $cotisation->id,
        ]);
    }


    /** CALLBACK KKIAPAY */
public function notify(Request $request)
{
    $transactionId = $request->input('transaction_id');
    $cotisationId  = $request->input('cotisation_id');

    if (!$cotisationId) {
        return redirect()->route('dashboard')
            ->with('error', '❌ Cotisation introuvable');
    }

    $cotisation = Cotisation::findOrFail($cotisationId);

    if ($cotisation->status === 'paid') {
        return redirect()->route('dashboard')
            ->with('info', 'ℹ️ Cotisation déjà payée');
    }

    // ✅ Marquer payée
    $cotisation->update([
        'status' => 'paid',
        'payment_reference' => $transactionId,
    ]);

    $user = $cotisation->user;

    // 📄 Génération facture
    Storage::disk('public')->makeDirectory('invoices');

    $invoiceNumber = 'INV-' . now()->format('Ymd') . '-' . $cotisation->id;

    $pdf = Pdf::loadView('pdf.invoice', [
        'user' => $user,
        'payment' => $cotisation,
        'invoiceNumber' => $invoiceNumber,
    ]);

    $path = "invoices/{$invoiceNumber}.pdf";
    Storage::disk('public')->put($path, $pdf->output());

    // ✅ Sauvegarde chemin facture
    $cotisation->update([
        'invoice_path' => $path,
    ]);

    // 🔔 Notification
    Notification::create([
        'user_id' => $user->id,
        'title' => 'Facture disponible',
        'message' => 'Votre paiement de ' .
            number_format($cotisation->amount, 0, ',', ' ') .
            ' FCFA a été confirmé.',
        'type' => 'payment',
        'action_url' => route('member.cotisations.invoice', $cotisation->id),
    ]);

    return redirect()->route('dashboard')
        ->with('success', '✅ Paiement réussi. Facture disponible dans vos notifications.');
}



    /** Affichage/Téléchargement d'une facture */
    public function invoice(Cotisation $cotisation)
    {
        // Vérifier que l'utilisateur ne peut voir que ses propres factures
        if ($cotisation->user_id !== auth()->id()) {
            abort(403, 'Accès non autorisé');
        }

        \Log::info('📥 Tentative téléchargement facture', [
            'cotisation_id' => $cotisation->id,
            'invoice_path' => $cotisation->invoice_path,
            'path_exists' => $cotisation->invoice_path ? Storage::disk('public')->exists($cotisation->invoice_path) : false,
            'full_path' => storage_path('app/public/' . $cotisation->invoice_path),
        ]);

        // Si pas de facture générée
        if (!$cotisation->invoice_path) {
            return redirect()->back()->with('error', '❌ Pas de facture enregistrée pour cette cotisation');
        }

        if (!Storage::disk('public')->exists($cotisation->invoice_path)) {
            \Log::error('❌ Fichier facture manquant', [
                'path' => $cotisation->invoice_path,
                'full_path' => storage_path('app/public/' . $cotisation->invoice_path),
            ]);
            return redirect()->back()->with('error', '❌ Facture non trouvée sur le serveur');
        }

        // Télécharger le PDF
        return Storage::disk('public')->download(
            $cotisation->invoice_path,
            'Facture-' . $cotisation->id . '.pdf'
        );
    }

    /** Historique des paiements */
    public function history()
    {
        $user = auth()->user();

        $payments = Cotisation::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $totalPaid = $payments->where('status', 'paid')->sum('amount');

        return view('member.cotisations.history', compact(
            'payments',
            'totalPaid'
        ));
    }

}
