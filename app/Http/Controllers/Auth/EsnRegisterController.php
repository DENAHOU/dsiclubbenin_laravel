<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Esn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class EsnRegisterController extends Controller
{
    /**
     * Affiche la vue du formulaire d'inscription ESN.
     */
    public function create()
    {
        return view('auth.register-esn');
    }

    /**
     * Traite la soumission du formulaire d'inscription.
     */
    public function store(Request $request)
    {
        // 1. Validation de toutes les données du formulaire
        $validatedData = $request->validate([
            'NomPromotteur' => ['required', 'string', 'max:255'],
            'Civilite' => ['required', 'string'],
            'NomEntreprise' => ['required', 'string', 'max:255', 'unique:esns,company_name'],
            'Email' => ['required', 'email', 'max:255', 'unique:esns,email'],
            'PhonePro' => ['required', 'string', 'max:20'],
            'Emplacement' => ['required', 'string', 'max:255'],
            'FormeJuridique' => ['required', 'string'],
            'Url' => ['required', 'url'],
            'DomaineActivite' => ['required', 'string', 'max:255'],
            'DateCreation' => ['required', 'date'],
            'AnneeExperience' => ['required', 'string'],
            'NombrePersonnel' => ['required', 'string'],
            'ChiffreAffaire' => ['required', 'string'],
            'TypeEsn' => ['required', 'string'],
            'description' => ['required', 'string'],
            'RegistreCommerce' => ['required', 'file', 'mimes:pdf,jpg,png', 'max:5120'], // 5MB max
            'LogoEntreprise' => ['required', 'image', 'max:2048'], // 2MB max
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 2. Gestion des uploads de fichiers
        $tradeRegisterPath = $request->file('RegistreCommerce')->store('esn/trade_registers', 'public');
        $logoPath = $request->file('LogoEntreprise')->store('esn/logos', 'public');
        // N'oubliez pas de lancer 'php artisan storage:link' une seule fois dans votre projet

        // 3. Création de l'ESN dans la base de données
        $esn = Esn::create([
            'promoter_name' => $validatedData['NomPromotteur'],
            'civility' => $validatedData['Civilite'],
            'company_name' => $validatedData['NomEntreprise'],
            'email' => $validatedData['Email'],
            'professional_phone' => $validatedData['PhonePro'],
            'location' => $validatedData['Emplacement'],
            'legal_form' => $validatedData['FormeJuridique'],
            'website_url' => $validatedData['Url'],
            'activity_domain' => $validatedData['DomaineActivite'],
            'creation_date' => $validatedData['DateCreation'],
            'experience_years' => $validatedData['AnneeExperience'],
            'staff_count' => $validatedData['NombrePersonnel'],
            'turnover' => $validatedData['ChiffreAffaire'],
            'esn_type' => $validatedData['TypeEsn'],
            'description' => $validatedData['description'],
            'trade_register_path' => $tradeRegisterPath,
            'logo_path' => $logoPath,
            'password' => $validatedData['password'], // Le cast 'hashed' dans le modèle s'occupe du cryptage
        ]);

        // 4. Redirection avec un message de succès
        return redirect()->route('home')->with('success', 'Votre ESN a été enregistrée avec succès ! Votre demande sera examinée par nos administrateurs.');
    }
}
