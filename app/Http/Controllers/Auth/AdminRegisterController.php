<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Administration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use App\Mail\AdhesionPending;

class AdminRegisterController extends Controller
{
    public function create()
    {
        return view('auth.register-admin');
    }

    public function store(Request $request)
    {
        // Validation
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'entity_type' => ['required', 'string'],
            'address' => ['required', 'string'],
            'website_url' => ['nullable', 'url'],
            'logo_path' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'contact_name' => ['required', 'string', 'max:255'],
            'contact_position' => ['required', 'string', 'max:255'],
            'contact_email' => ['required', 'email'],
            'contact_phone' => ['required', 'string'],
            'main_project' => ['required', 'string'],
            'tech_challenges' => ['nullable', 'string'],
            'searched_expertise' => ['nullable', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:administrations,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Upload du logo
        $logoPath = $request->file('logo_path')->store('admin_logos', 'public');

        // Création de l'administration
        $administration = Administration::create([
            'name' => $validatedData['name'],
            'entity_type' => $validatedData['entity_type'],
            'address' => $validatedData['address'],
            'website_url' => $validatedData['website_url'],
            'logo_path' => $logoPath,
            'contact_name' => $validatedData['contact_name'],
            'contact_position' => $validatedData['contact_position'],
            'contact_email' => $validatedData['contact_email'],
            'contact_phone' => $validatedData['contact_phone'],
            'main_project' => $validatedData['main_project'],
            'tech_challenges' => $validatedData['tech_challenges'],
            'searched_expertise' => $validatedData['searched_expertise'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']), // important !

            // Ajout des champs adhésion
            'status' => 'pending',
            'is_paid' => false,
        ]);

        // Envoi du mail
        Mail::to($administration->email)->send(
            new AdhesionPending($administration->name, 'administration')
        );

        return redirect()->route('home')
            ->with('success', 'Votre demande d’adhésion a été enregistrée et est en cours de validation.');
    }
}
