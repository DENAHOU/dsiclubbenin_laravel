<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Gère la redirection si l'utilisateur est déjà connecté.
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // 🔁 Redirection personnalisée selon le type d'utilisateur connecté
                return match ($guard) {
                    'company' => redirect()->route('company.dashboard'),
                    'college' => redirect()->route('college/dashboard'),
                    'administration' => redirect()->route('administration.dashboard'),
                    'esn' => redirect()->route('esn.dashboard'),
                    'recruter' => redirect()->route('recruter.dashboard'),
                    'partner' => redirect()->route('partner.dashboard'),
                    default => redirect()->route('dashboard'), // pour les membres DSI classiques
                };
            }
        }

        return $next($request);
    }
}
