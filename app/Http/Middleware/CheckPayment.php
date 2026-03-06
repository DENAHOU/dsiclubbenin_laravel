<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Payment;

class CheckPayment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // 🔹 Si l'utilisateur a déjà payé via is_paid, on le laisse passer
        if ((int)$user->is_paid === 1) {
            return $next($request);
        }

        // 🔹 Vérifier la table payments pour les nouveaux utilisateurs
        $payment = Payment::where('payable_id', $user->id)
            ->where('payable_type', get_class($user))
            ->first();

        if (!$payment) {
            return redirect()->route('payments.checkout')
                ->with('warning', 'Vous devez effectuer votre paiement de cotisation pour accéder à cette ressource.');
        }

        // 🔹 Si le paiement existe mais n'est pas complété ou approuvé
        if (!in_array($payment->status, ['completed', 'approved'])) {
            return redirect()->route('payments.checkout')
                ->with('warning', 'Votre paiement n\'est pas encore complété. Veuillez finir votre paiement.');
        }

        // 🔹 Tout est ok, continuer
        return $next($request);
    }
}