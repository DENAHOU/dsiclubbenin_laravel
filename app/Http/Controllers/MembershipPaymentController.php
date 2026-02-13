<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MembershipPayment;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class MembershipPaymentController extends Controller
{
    public function pay()
    {
        if (auth('company')->check()) {
            $entity = auth('company')->user();
            $type = 'company';
        } elseif (auth('administration')->check()) {
            $entity = auth('administration')->user();
            $type = 'administration';
        } elseif (auth('college')->check()) {
            $entity = auth('college')->user();
            $type = 'college';
        } else {
            abort(403);
        }

        $config = config("membership.$type");

        return view('membership.pay', [
            'entity' => $entity,
            'type' => $type,
            'amount' => $config['amount'],
            'label' => $config['label'],
            'layout' => $config['layout'],
        ]);
    }

    public function process(Request $request)
    {
        try {
            // Déterminer quel type d'utilisateur est authentifié
            if (auth('company')->check()) {
                $entity = auth('company')->user();
                $type = 'company';
            } elseif (auth('administration')->check()) {
                $entity = auth('administration')->user();
                $type = 'administration';
            } elseif (auth('college')->check()) {
                $entity = auth('college')->user();
                $type = 'college';
            } else {
                return response()->json(['error' => 'Non authentifié'], 403);
            }

            \Log::info('Creating payment for', ['type' => $type, 'entity_id' => $entity->id]);

            $config = config("membership.$type");

            if (!$config) {
                return response()->json(['error' => "Config membership.$type not found"], 400);
            }

            if (!isset($config['amount'])) {
                return response()->json(['error' => "Amount not configured for $type"], 400);
            }

            \Log::info('Creating payment with amount', ['amount' => $config['amount']]);

            // ✅ Utiliser la relation polymorphique correctement
            $payment = $entity->membershipPayments()->create([
                'amount' => $config['amount'],
                'status' => 'pending',
            ]);

            \Log::info('Payment created successfully', ['payment_id' => $payment->id]);

            return response()->json([
                'payment_id' => $payment->id,
                'amount' => $payment->amount,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error creating payment', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function notify(Request $request)
    {
        \Log::info('KKIAPAY CALLBACK', $request->all());

        $transactionId = $request->input('transaction_id');

        if (!$transactionId) {
            abort(400, 'Transaction manquante');
        }

        // 📌 LE PAYMENT_ID EST PASSÉ EN PARAMÈTRE URL
        $paymentId = $request->input('payment_id');

        if (!$paymentId) {
            \Log::error('Payment ID missing from URL', [
                'all_params' => $request->all(),
            ]);
            abort(400, 'Payment ID manquant - contactez support');
        }

        try {
            $payment = MembershipPayment::findOrFail($paymentId);
        } catch (\Exception $e) {
            \Log::error('Payment not found', ['payment_id' => $paymentId]);
            abort(404, 'Paiement non trouvé');
        }

        // ✅ Récupérer l'entité via la relation polymorphique
        $entity = $payment->payable;

        if (!$entity) {
            \Log::error('Entity not found for payment', ['payment_id' => $paymentId]);
            abort(404, 'Entité non trouvée');
        }

        // Si déjà payé, rediriger vers le dashboard
        if ($payment->status === 'paid') {
            \Log::info('Payment already marked as paid', ['payment_id' => $paymentId]);
            return $this->redirectToDashboard($payment->payable_type);
        }

        // Mettre à jour le paiement
        $payment->update([
            'status' => 'paid',
            'transaction_reference' => $transactionId,
        ]);

        // 📄 FACTURE
        try {
            \Log::info('Generating invoice for payment', ['payment_id' => $payment->id]);

            $pdf = Pdf::loadView('pdf.membership_invoice', [
                'entity' => $entity,
                'payment' => $payment,
            ]);

            Storage::disk('public')->makeDirectory('invoices');
            $path = 'invoices/membership_'.$payment->id.'.pdf';

            Storage::disk('public')->put($path, $pdf->output());

            \Log::info('Invoice generated successfully', ['path' => $path]);

            $payment->update([
                'invoice_path' => $path,
            ]);

            \Log::info('Invoice path updated in database', ['invoice_path' => $path]);
        } catch (\Exception $e) {
            \Log::error('Invoice generation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            // Continue même si la facture échoue
        }

        return $this->redirectToDashboard($payment->payable_type)
            ->with('success', 'Cotisation payée avec succès. Facture disponible.');
    }

    /**
     * Rediriger vers le bon dashboard selon le type d'entité
     */
    private function redirectToDashboard($entityType)
    {
        $type = strtolower(class_basename($entityType));

        return match ($type) {
            'company' => redirect()->route('company.dashboard'),
            'college' => redirect()->route('college.dashboard'),
            'administration' => redirect()->route('administration.dahbord'),
            default => redirect()->route('dashboard'),
        };
    }

    /**
     * Afficher l'historique des paiements de l'entité connectée
     */
    public function history()
    {
        // Déterminer quel type d'utilisateur est authentifié
        if (auth('company')->check()) {
            $entity = auth('company')->user();
            $type = 'company';
            $layout = config('membership.company.layout');
        } elseif (auth('administration')->check()) {
            $entity = auth('administration')->user();
            $type = 'administration';
            $layout = config('membership.administration.layout');
        } elseif (auth('college')->check()) {
            $entity = auth('college')->user();
            $type = 'college';
            $layout = config('membership.college.layout');
        } else {
            abort(403);
        }

        // Récupérer les paiements de l'entité
        $payments = $entity->membershipPayments()
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('membership.history', [
            'payments' => $payments,
            'entity' => $entity,
            'type' => $type,
            'layout' => $layout,
        ]);
    }

    /**
     * Télécharger la facture PDF
     */
    public function downloadInvoice($paymentId)
    {
        // Vérifier que le paiement appartient à l'entité connectée
        if (auth('company')->check()) {
            $entity = auth('company')->user();
        } elseif (auth('administration')->check()) {
            $entity = auth('administration')->user();
        } elseif (auth('college')->check()) {
            $entity = auth('college')->user();
        } else {
            abort(403);
        }

        $payment = $entity->membershipPayments()
            ->where('id', $paymentId)
            ->firstOrFail();

        if (!$payment->invoice_path || !Storage::disk('public')->exists($payment->invoice_path)) {
            abort(404, 'Facture non disponible');
        }

        return Storage::disk('public')->download($payment->invoice_path, "facture-{$payment->id}.pdf");
    }
}




