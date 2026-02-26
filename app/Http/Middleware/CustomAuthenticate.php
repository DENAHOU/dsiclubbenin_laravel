<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class CustomAuthenticate extends Middleware
{
    /**
     * Obtenez l'URI vers laquelle l'utilisateur doit être redirigé lorsqu'il n'est pas authentifié.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) { 
            // Ajoutez cette condition pour ignorer les routes Microsoft
            if ($request->routeIs('login.microsoft.redirect') || $request->routeIs('auth/microsoft/callback')) {
                 return null; // Ne redirige pas, permet à la requête de continuer
            }

            // Autrement, redirige vers la page de connexion par défaut si non authentifié
            // Utilisez la route nommée 'login.member' car c'est celle que vous utilisez
            return route('login.member');
        }

        return null;
    }
}
