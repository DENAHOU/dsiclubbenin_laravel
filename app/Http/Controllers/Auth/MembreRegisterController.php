<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdhesionPending;



class MembreRegisterController extends Controller
{
    /**
     * Affiche le formulaire d'adhésion pour les membres DSI.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request): View
    {
        $type = $request->query('type', 'individuel'); // valeur par défaut
        return view('auth.membre-register', compact('type'));
    }

    /**
     * Traite une nouvelle demande d'adhésion.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // --- ÉTAPE 1 : VALIDATION ---
        $request->validate([
            'lastname' => ['required','string','max:255'],
            'firstname' => ['required','string','max:255'],
            'username' => ['required','string','max:255','unique:users'],
            'email' => ['required','string','email','max:255','unique:users'],
            'sexe' => ['required','string','in:M,F'],
            'phone' => ['required','string','max:20'],
            'birthday' => ['required','date'],
            'medias_id' => ['required','image','mimes:jpeg,png,jpg,gif','max:2048'],

            'employer_contact' => ['required','string','max:255'],
            'type_members' => ['required','string'],
            'current_position' => ['required','string'],
            'current_employer' => ['required','string','max:255'],
            'sector' => ['required','string'],
            'sector_other' => ['nullable','required_if:sector,Autre','string','max:255'],
            'area_of_expertise' => ['required','string','max:255'],
            'initial_training' => ['required','string','max:255'],
            'category_of_service' => ['required','string'],
            'category_other' => ['nullable','required_if:category_of_service,Autre','string'],

            'password' => ['required','confirmed', Rules\Password::defaults()],
            'description' => ['nullable','string'],
        ]);

        // --- ÉTAPE 2 : UPLOAD PHOTO ---
        $photoPath = $request->file('medias_id')->store('photos', 'public');

        // valeurs finales
        $sector = $request->sector === 'Autre' ? $request->sector_other : $request->sector;
        $category = $request->category_of_service === 'Autre' ? $request->category_other : $request->category_of_service;

        // --- ÉTAPE 3 : CRÉATION DU MEMBRE ---
        $user = User::create([
            'name' => $request->firstname.' '.$request->lastname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),

            'role' => 'membre',

            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'photo_path' => $photoPath,
            'sexe' => $request->sexe,
            'phone' => $request->phone,
            'birthday' => $request->birthday,

            'employer_contact' => $request->employer_contact,
            'type_members' => $request->type_members,
            'current_position' => $request->current_position,
            'current_employer' => $request->current_employer,

            'sector' => $sector,
            'area_of_expertise' => $request->area_of_expertise,
            'initial_training' => $request->initial_training,
            'category_of_service' => $category,
            'description' => $request->description,

            // 👉 NOUVEAUX CHAMPS
            'status' => 'pending',
            'is_paid' => false,
        ]);

        // --- ÉTAPE 4 : ENVOI EMAIL ACCUSÉ DE RÉCEPTION ---
        Mail::to($user->email)->send(
            new AdhesionPending($user->name, 'user')
        );

        // --- ÉTAPE 5 : PAS de connexion automatique ---
        // Auth::login($user);  ← SUPPRIMÉ

        // --- ÉTAPE 6 : REDIRECTION ---
        return redirect()->route('home')
            ->with('success', 'Votre demande d’adhésion a été soumise et est en cours de validation.');
    }

}
