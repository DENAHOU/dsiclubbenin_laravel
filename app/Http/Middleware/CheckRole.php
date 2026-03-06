<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        switch ($role) {

            case 'admin':
                if (
                    $user->role === 'admin' ||  // Super Admin
                    $user->is_admin == 1        // Admin ajouté
                ) {
                    return $next($request);
                }
                break;

            case 'tresor':
                if ($user->is_tresor == 1) {
                    return $next($request);
                }
                break;

            case 'membre':
                // Tout utilisateur connecté peut accéder à son espace membre
                return $next($request);
        }

        return $this->redirectToDashboard($user);
    }

    /**
     * Redirection intelligente
     */
    private function redirectToDashboard($user)
    {
        if ($user->is_admin == 1) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->is_tresor == 1) {
            return redirect()->route('tresor.dashboard');
        }

        // Sinon dashboard principal selon role
        $routes = [
            'company' => 'company.dashboard',
            'college' => 'college.dashboard',
            'administration' => 'administration.dashboard',
            'candidat' => 'candidat.dashboard',
            'recruter' => 'recruter.dashboard',
            'partner' => 'partner.dashboard',
            'esn' => 'esn.dashboard',
            'membre' => 'dashboard',
        ];

        $routeName = $routes[$user->role] ?? 'dashboard';

        return redirect()->route($routeName);
    }
}