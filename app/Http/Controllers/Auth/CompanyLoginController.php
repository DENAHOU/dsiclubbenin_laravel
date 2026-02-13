<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CompanyLoginController extends Controller
{
    /**
     * Affiche la page de connexion
     */
    public function create(): View
    {
        return view('auth.login-company');
    }

    /**
     * Connexion Entreprise
     */
    public function store(Request $request): RedirectResponse
    {
        // Validation
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Tentative de connexion via le garde "company"
        if (Auth::guard('company')->attempt($credentials, $request->boolean('remember'))) {

            $request->session()->regenerate();


            // Accès accordé
            return redirect()->route('company.dashboard')
                ->with('success', 'Connexion réussie. Bienvenue !');
        }

        return back()->withErrors([
            'email' => 'Les informations fournies sont incorrectes.',
        ])->onlyInput('email');
    }
}
