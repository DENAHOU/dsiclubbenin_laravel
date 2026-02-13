<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureIsPaid
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!$user->is_paid) {
            return redirect()->route('payments.checkout')
                ->with('warning', "Veuillez régler votre adhésion avant d'accéder à votre espace.");
        }

        return $next($request);
    }
}
