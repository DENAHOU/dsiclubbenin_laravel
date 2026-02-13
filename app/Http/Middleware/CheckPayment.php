<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Payment;
use Carbon\Carbon;

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

        // Vérifier si l'utilisateur a un paiement valide et complété
        $payment = Payment::where('payable_id', $user->id)
            ->where('payable_type', get_class($user))
            ->first();

        // Si pas de paiement trouvé, rediriger vers la page de paiement
        if (!$payment) {
            return redirect()->route('payments.checkout')
                ->with('warning', 'Vous devez effectuer votre paiement de cotisation pour accéder à cette ressource.');
        }

        // Si le paiement existe mais n'est pas complété, rediriger vers le paiement
        if ($payment->status !== 'completed' && $payment->status !== 'approved') {
            return redirect()->route('payments.checkout')
                ->with('warning', 'Votre paiement n\'est pas encore complété. Veuillez finir votre paiement.');
        }

        // Si le paiement est valide et complété, continuer
        return $next($request);
    }
}
