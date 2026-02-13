<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EsnProfileController extends Controller
{

    public function show()
    {
        $esn = Auth::guard('esn')->user();
        return view('esn.profile.show', compact('esn')); // Vous devrez créer cette vue
    }

    /**
     * Affiche le formulaire d'édition du profil de l'ESN.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $esn = Auth::guard('esn')->user();
        return view('esn.profile.edit', compact('esn')); // Vous devrez créer cette vue
    }

    /**
     * Met à jour le profil de l'ESN.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $esn = Auth::guard('esn')->user();

        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'professional_email' => 'required|email|max:255|unique:esns,professional_email,' . $esn->id,
            'professional_phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'legal_form' => 'nullable|string|max:255',
            'website_url' => 'nullable|url|max:255',
            'activity_domain' => 'nullable|string|max:255',
            'creation_date' => 'nullable|date',
            'experience_years' => 'nullable|string|max:255',
            'staff_count' => 'nullable|string|max:255',
            'turnover' => 'nullable|string|max:255',
            'esn_type' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'promoter_name' => 'nullable|string|max:255',
            'civility' => 'nullable|string|max:50',
            // 'logo_path' => 'nullable|image|max:2048', // Si vous permettez l'upload de logo
            // 'trade_register_path' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Si vous permettez l'upload du registre de commerce
        ]);

        $esn->update($validatedData);

        // Gérer l'upload du logo et du registre de commerce si vous les avez dans le formulaire
        // if ($request->hasFile('logo_path')) {
        //     $esn->update(['logo_path' => $request->file('logo_path')->store('esn/logos', 'public')]);
        // }
        // if ($request->hasFile('trade_register_path')) {
        //     $esn->update(['trade_register_path' => $request->file('trade_register_path')->store('esn/trade_registers', 'public')]);
        // }


        return redirect()->route('esn.profile.show')->with('success', 'Votre profil a été mis à jour avec succès.');
    }

    // Méthode pour la déconnexion
    public function logout(Request $request)
    {
        Auth::guard('esn')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // Rediriger vers la page d'accueil ou de connexion
    }
}
