<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\College;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use App\Mail\AdhesionPending;

class CollegeRegisterController extends Controller
{
    public function create()
    {
        return view('auth.register-college_it');
    }

    public function store(Request $request)
    {
        // Validation
        $validatedData = $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'logo_path' => ['required', 'image', 'max:2048'],
            'slogan' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'expertise_tags' => ['required', 'string'],
            'main_innovation' => ['required', 'string'],
            'contact_name' => ['required', 'string', 'max:255'],
            'target_profiles' => ['nullable', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:colleges'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Upload logo
        $logoPath = $request->file('logo_path')->store('college_logos', 'public');

        // Création du collège
        $college = College::create([
            'company_name' => $validatedData['company_name'],
            'logo_path' => $logoPath,
            'slogan' => $validatedData['slogan'],
            'description' => $validatedData['description'],
            'website_url' => $request->website_url,
            'linkedin_url' => $request->linkedin_url,
            'expertise_tags' => $validatedData['expertise_tags'],
            'main_innovation' => $validatedData['main_innovation'],
            'target_profiles' => $request->target_profiles,
            'contact_name' => $validatedData['contact_name'],

            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),

            // Ajout des champs adhésion
            'status' => 'pending',
            'is_paid' => false,
        ]);

        // Envoi du mail
        Mail::to($college->email)->send(
            new AdhesionPending($college->company_name, 'college')
        );

        return redirect()->route('home')
            ->with('success', 'Votre demande d’adhésion au Collège IT a été enregistrée. Elle est en cours de validation.');
    }
}
