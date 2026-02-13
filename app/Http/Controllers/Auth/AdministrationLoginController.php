<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdministrationLoginController extends Controller
{
    /**
     * Affiche la page du formulaire de connexion pour les Administrations.
     */
    public function create(): View
    {
        return view('auth.login-administration');
    }

    /**
     * Gère la tentative de connexion pour une Administration.
     */
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // On utilise le garde 'administration'
        if (Auth::guard('administration')->attempt($credentials, $request->boolean('remember'))) {

            $request->session()->regenerate();

            // Récupère l'utilisateur authentifié via le garde administration
            $user = Auth::guard('administration')->user();


            // Redirection vers l'URL intended ou dashboard
            return redirect()->intended(route('administration.dahbord'));
        }

        return back()->withErrors([
            'email' => 'Les informations fournies ne correspondent pas à nos enregistrements.',
        ])->onlyInput('email');
    }
}
