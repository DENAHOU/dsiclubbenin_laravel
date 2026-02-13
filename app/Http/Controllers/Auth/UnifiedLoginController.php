<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UnifiedLoginController extends Controller
{
    /**
     * Affiche le formulaire de connexion unifié
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Traite la tentative de connexion pour tous les types d'utilisateurs
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        // Utiliser uniquement le guard web avec la table users
        if (Auth::guard('web')->attempt($credentials, $remember)) {

            $request->session()->regenerate();

            // Récupérer l'utilisateur connecté
            $user = Auth::user();
            
            // Rediriger selon le rôle
            return $this->redirectToDashboard($user->role);
        }

        // Si la connexion a échoué
        return back()
            ->withInput($request->only('email', 'remember'))
            ->with('error', 'Les identifiants fournis sont incorrects.');
    }

    /**
     * Redirige vers le dashboard approprié selon le rôle
     */
    private function redirectToDashboard(string $role): RedirectResponse
    {
        $routeName = match($role) {
            'admin' => 'admin.dashboard',
            'company' => 'company.dashboard',
            'college' => 'college.dashboard',
            'administration' => 'administration.dashboard',
            'candidat' => 'candidat.dashboard',
            'recruter' => 'recruter.dashboard',
            'partner' => 'partner.dashboard',
            'esn' => 'esn.dashboard',
            default => 'dashboard', // membre par défaut
        };
        
        return redirect()->intended(route($routeName));
    }

    /**
     * Déconnexion unifiée
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Utiliser uniquement le guard web
        Auth::guard('web')->logout();

        // Détruire complètement la session
        $request->session()->invalidate();
        
        // Régénérer le token CSRF pour sécurité
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('success', 'Vous avez été déconnecté avec succès.');
    }
}
