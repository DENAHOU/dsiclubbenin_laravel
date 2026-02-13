<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules;
use App\Mail\AdhesionPending;

class CompanyRegisterController extends Controller
{
    public function create(Request $request)
    {
        $membershipType = $request->query('type', 'entite');
        return view('auth.membre-register-entreprise', [
            'membershipType' => $membershipType
        ]);
    }

    public function store(Request $request)
    {
        // 1️⃣ VALIDATION
        $validatedData = $request->validate([
            // Entreprise
            'company_name' => ['required', 'string', 'max:255'],
            'ifu' => ['nullable', 'string', 'max:255'],
            'company_address' => ['required', 'string', 'max:255'],
            'company_phone' => ['required', 'string', 'max:20'],
            'sector' => ['required', 'string'],
            'sector_other' => ['nullable', 'required_if:sector,Autre', 'string', 'max:255'],
            'category_of_service' => ['required', 'string'],
            'category_other' => ['nullable', 'required_if:category_of_service,Autre', 'string', 'max:255'],
            'type_members' => ['required', 'string'],
            'chiffre_affaire' => ['nullable', 'string'],
            'company_logo' => ['required', 'image', 'max:2048'],

            // Contact
            'contact_name' => ['required', 'string', 'max:255'],
            'contact_position' => ['required', 'string', 'max:255'],
            'contact_phone' => ['required', 'string', 'max:20'],

            // Compte
            'username' => ['required', 'string', 'max:255', 'unique:companies'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:companies'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 2️⃣ SI "AUTRE" ALORS ON PREND LES VALEURS PERSONNALISÉES
        $sectorToStore = ($request->sector === 'Autre') ? $request->sector_other : $request->sector;
        $categoryToStore = ($request->category_of_service === 'Autre') ? $request->category_other : $request->category_of_service;

        // 3️⃣ UPLOAD LOGO
        $logoPath = $request->file('company_logo')->store('company_logos', 'public');

        // 4️⃣ CREATION DE L’ENTREPRISE
        $company = Company::create([
            // Infos entreprise
            'name' => $validatedData['company_name'],
            'ifu' => $request->ifu,
            'address' => $validatedData['company_address'],
            'phone' => $validatedData['company_phone'],
            'sector' => $sectorToStore,
            'service_category' => $categoryToStore,
            'membership_type' => $validatedData['type_members'],
            'turnover' => $request->chiffre_affaire,
            'logo_path' => $logoPath,

            // Contact interne
            'contact_name' => $validatedData['contact_name'],
            'contact_position' => $request->contact_position,
            'contact_phone' => $request->contact_phone,

            // Authentification
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),

            // Champs d’adhésion
            'status' => 'pending',   // demande en attente
            'is_paid' => false,      // pas encore payé
        ]);

        event(new Registered($company));

        // 5️⃣ ENVOI DU MAIL “VOTRE DEMANDE EST EN COURS DE VALIDATION”
        Mail::to($company->email)->send(
            new AdhesionPending($company->name, 'company')
        );

        // 6️⃣ PAS DE LOGIN ICI !
        // Auth::login($company);  ❌ NE PAS CONNECTER

        // 7️⃣ REDIRECTION
        return redirect()->route('home')->with(
            'success',
            'Votre demande d’adhésion entreprise a été reçue. Nous vous contacterons après validation.'
        );
    }
}
