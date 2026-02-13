<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PartnerProfileController extends Controller
{
    /**
     * Affiche le formulaire d'édition du profil du partenaire.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $partner = Auth::guard('partner')->user();
        return view('partner.profile.edit', compact('partner'));
    }

    /**
     * Met à jour les informations générales du profil du partenaire.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $partner = Auth::guard('partner')->user();

        $validatedData = $request->validate([
            'type_partner' => ['required', 'string'],
            'reason_social' => ['required', 'string', 'max:255'],
            'domain' => ['required', 'string', 'max:255'],
            'specialty' => ['required', 'string', 'max:255'],
            'name_responsability' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:partners,email,' . $partner->id], // Unique sauf pour l'ID actuel
            'phone' => ['required', 'string', 'max:20'],
            'url' => ['required', 'url'],
            'country' => ['required', 'string'],
            'address' => ['required', 'string'],
            'motivation' => ['required', 'string'],
            'medias' => ['nullable', 'image', 'max:2048'], // Logo est optionnel lors de la mise à jour
        ]);

        if ($request->hasFile('medias')) {
            // Supprimer l'ancien logo si nécessaire
            // Storage::disk('public')->delete($partner->logo_path);
            $validatedData['logo_path'] = $request->file('medias')->store('partner_logos', 'public');
        }

        $partner->update([
            'partner_type' => $validatedData['type_partner'],
            'company_name' => $validatedData['reason_social'],
            'domain' => $validatedData['domain'],
            'specialty' => $validatedData['specialty'],
            'manager_name' => $validatedData['name_responsability'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'website_url' => $validatedData['url'],
            'country' => $validatedData['country'],
            'address' => $validatedData['address'],
            'motivation' => $validatedData['motivation'],
            'logo_path' => $validatedData['logo_path'] ?? $partner->logo_path, // Conserve l'ancien si pas de nouveau
        ]);

        return redirect()->route('partner.profile.edit')->with('success', 'Votre profil a été mis à jour avec succès !');
    }

    /**
     * Met à jour le mot de passe du partenaire.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updatePassword(Request $request)
    {
        $partner = Auth::guard('partner')->user();

        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Vérifier si l'ancien mot de passe est correct
        if (!Hash::check($request->current_password, $partner->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['L\'ancien mot de passe est incorrect.'],
            ]);
        }

        // Mettre à jour le mot de passe
        $partner->update([
            'password' => $request->password, // Sera haché automatiquement grâce au $casts dans le modèle
        ]);

        return redirect()->route('partner.profile.edit')->with('success', 'Votre mot de passe a été mis à jour avec succès !');
    }
}
