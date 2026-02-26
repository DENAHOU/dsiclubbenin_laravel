<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        
        if ($user->role !== $role) {
            // Rediriger vers le dashboard approprié selon le rôle
            return $this->redirectToDashboard($user->role);
        }

        return $next($request);
    }

    /**
     * Redirige vers le dashboard approprié selon le rôle
     */
    private function redirectToDashboard(string $role)
    {
        $routes = [
            'admin' => 'admin.dashboard',
            'tresor' => 'tresor.dashboard',
            'company' => 'company.dashboard',
            'college' => 'college.dashboard',
            'administration' => 'administration.dashboard',
            'candidat' => 'candidat.dashboard',
            'recruter' => 'recruter.dashboard',
            'partner' => 'partner.dashboard',
            'esn' => 'esn.dashboard',
            'membre' => 'dashboard',
        ];

        $routeName = $routes[$role] ?? 'dashboard';
        
        return redirect()->route($routeName);
    }
}
