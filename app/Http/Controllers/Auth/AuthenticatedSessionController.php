<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Affiche le formulaire de login personnalisé
     */
    public function create(): View
    {
        return view('auth.login-member');
    }

    /**
     * Processus de connexion
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Vérifie les identifiants
        $request->authenticate();

        // Sinon accès normal
        return redirect()->intended(route('dashboard'));
    }

    /**
     * Logout
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
