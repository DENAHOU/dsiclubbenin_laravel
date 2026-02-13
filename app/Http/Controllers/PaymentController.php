<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\User;
use App\Models\College;
use App\Models\Company;
use App\Models\Administration;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentReceipt;
use Kkiapay\Kkiapay;


class PaymentController extends Controller
{
    /**
     * Affiche la page de checkout
     */
    public function checkout()
    {
        $user = Auth::user();
        $amount = 10000; // montant en FCFA (ou adapter)
        $publicKey = config('services.kkiapay.public_key');
        $sandbox = config('services.kkiapay.sandbox') ? 'true' : 'false';

        return view('payments.checkout', compact('user', 'amount', 'publicKey', 'sandbox'));
    }

    /**
     * Endpoint de notification / verification côté serveur (webhook ou callback client)
     */
    public function notify(Request $request)
    {
        $kkiapay = new Kkiapay(
            config('services.kkiapay.public_key'),
            config('services.kkiapay.private_key'),
            config('services.kkiapay.secret'),
            config('services.kkiapay.sandbox')
        );

        $payload = $request->all();
        Log::info('Kkiapay notify payload', $payload);

        // Récupérer référence/transaction
        $reference = $payload['reference'] ?? $payload['transaction_id'] ?? $payload['id'] ?? null;
        if (!$reference) {
            return response()->json(['error' => 'No reference provided'], 400);
        }

        try {
            // Récupération des détails de la transaction
            $transaction = $kkiapay->verifyTransaction($reference);

            // Vérification du statut
            if ($transaction->status === 'SUCCESS') {

                $user = null;
                if(User::where('email', (json_decode($transaction->state)->email))->exists()){
                    $user = User::where('email', (json_decode($transaction->state)->email))->first();
                }
                elseif(College::where('email', (json_decode($transaction->state)->email))->exists()){
                    $user = College::where('email', (json_decode($transaction->state)->email))->first();
                }
                elseif(Company::where('email', (json_decode($transaction->state)->email))->exists()){
                    $user = Company::where('email', (json_decode($transaction->state)->email))->first();
                }
                elseif(Administration::where('email', (json_decode($transaction->state)->email))->exists()){
                    $user = Administration::where('email', (json_decode($transaction->state)->email))->first();
                }

                // Créer l'enregistrement de paiement
                $payment = Payment::create([
                    'payable_type' => get_class($user),
                    'payable_id' => $user->id,
                    'transaction_id' => $reference,
                    'amount' => is_numeric($transaction->amount) ? ($transaction->amount / ( $this->kkiapayAmountIsInCents() ? 100 : 1 )) : null,
                    'currency' => strtoupper($transaction->currency ?? 'XOF'),
                    'payment_method' => 'kkiapay',
                    'status' => 'completed',
                    'start_date' => Carbon::now(),
                    'end_date' => Carbon::now()->addYear(),
                    'meta' => json_encode($transaction),
                ]);

                // Marquer l'utilisateur payé - CORRECTION IMPORTANTE
                $user->is_paid = true;
                $user->payment_reference = $reference;
                $user->save();

                // Envoyer reçu si possible (ne bloque pas la réponse)
                try {
                    if (filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
                        Mail::to($user->email)->send(new PaymentReceipt($payment));
                    }
                } catch (\Throwable $e) {
                    Log::error('Mail receipt failed: ' . $e->getMessage());
                }

                // Rediriger vers le dashboard approprié selon le type d'utilisateur
                if ($user instanceof User) {
                    return redirect()->route('dashboard')->with('success', 'Paiement effectué avec succès !');
                } elseif ($user instanceof College) {
                    return redirect()->route('college.dashboard')->with('success', 'Paiement effectué avec succès !');
                } elseif ($user instanceof Company) {
                    return redirect()->route('company.dashboard')->with('success', 'Paiement effectué avec succès !');
                } elseif ($user instanceof Administration) {
                    return redirect()->route('administration.dahbord')->with('success', 'Paiement effectué avec succès !');
                } else {
                    return redirect()->route('dashboard')->with('success', 'Paiement effectué avec succès !');
                }
            } else {
                // Statuts possibles : PENDING, FAILED
                return response()->json(['message' => 'Paiement non effectif : ' . $transaction->status]);
            }
        } catch (\Throwable $e) {
            Log::error('Kkiapay verify exception: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json(['error' => 'Exception when verifying', 'message' => $e->getMessage()], 500);
        }
    }


    public function webhook(Request $request)
    {
        return $this->notify($request);
    }

    /**
     * Page de succès (front redirect après paiement) :
     * tente d'identifier l'utilisateur via query param (email) et le connecte ensuite.
     */
    public function success(Request $request)
    {
        $email = $request->query('email');
        $reference = $request->query('reference');

        dd('Payment success redirect', $request->all());

        $user = null;
        if ($email) {
            $user = User::where('email', $email)->first()
                ?? College::where('email', $email)->first()
                ?? Company::where('email', $email)->first()
                ?? Administration::where('email', $email)->first();
        }

        // Si pas trouvé via email mais référence fournie, tenter via Payment
        if (!$user && $reference) {
            $payment = Payment::where('transaction_id', $reference)->first();
            if ($payment) {
                $user = ($payment->payable_type && $payment->payable_id)
                    ? ($payment->payable_type)::find($payment->payable_id)
                    : null;
            }
        }

        if (!$user) {
            return redirect()->route('login')->with('error', 'Utilisateur introuvable');
        }

        // Connecter selon le type (guards)
        if ($user instanceof College) {
            Auth::guard('college')->login($user);
            return redirect()->intended(route('college.dashboard'));
        }

        if ($user instanceof Company) {
            Auth::guard('company')->login($user);
            return redirect()->intended(route('company.dashboard'));
        }

        if ($user instanceof Administration) {
            Auth::guard('administration')->login($user);
            return redirect()->intended(route('administration.dashboard'));
        }

        // Utilisateur individuel
        Auth::login($user);
        return redirect()->intended(route('dashboard'));
    }


    /**
     * Helper : déterminer si Kkiapay renvoie amount en cents (adapter si nécessaire).
     */
    protected function kkiapayAmountIsInCents(): bool
    {
        // Changez en true si l'API renvoie en cents
        return true;
    }
}
