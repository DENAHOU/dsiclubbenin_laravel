<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CollegeLoginController extends Controller
{
    public function create(): View
    {
        return view('auth.login-college');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validation normale
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Tentative de connexion via le garde "college"
        if (Auth::guard('college')->attempt($credentials, $request->boolean('remember'))) {

            $request->session()->regenerate();

            $user = Auth::guard('college')->user();

            // Paiement OK → accès espace Collège IT
            return redirect()->route('college.dashboard')
                ->with('success', 'Bienvenue sur votre tableau de bord Collège IT !');
        }

        return back()->withErrors([
            'email' => 'Identifiants incorrects.'
        ])->onlyInput('email');
    }
}
