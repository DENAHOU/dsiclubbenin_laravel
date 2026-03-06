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
use Illuminate\Validation\Rules\Password;



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
     public function store(Request $request)
    {
        // Validation côté serveur
        $request->validate([
            // ETAPE 1: Info perso
            'firstname' => ['required', 'string', 'max:255'],
            'lastname'  => ['required', 'string', 'max:255'],
            'sexe'      => ['required', 'in:M,F'],
            'birthday'  => ['required', 'date'],
            'medias_id' => ['required', 'image', 'max:5120'], // max 5 Mo
            'description' => ['nullable', 'string'],

            // ETAPE 2: Info pro
            'current_employer' => ['required', 'string', 'max:255'],
            'employer_contact' => ['required', 'string', 'max:255'],
            'current_position' => ['required', 'string', 'max:255'],
            'sector'           => ['required', 'string'],
            'sector_other'     => ['nullable', 'string', 'max:255'],
            'category_of_service' => ['required', 'string'],
            'category_other'      => ['nullable', 'string', 'max:255'],
            'area_of_expertise'   => ['required', 'string', 'max:255'],
            'initial_training'    => ['required', 'string', 'max:255'],

            // ETAPE 3: Compte
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()],
            'type_members' => ['required', 'in:individuel,entite'],
        ]);

        // Gestion upload photo
        if ($request->hasFile('medias_id')) {
            $photoPath = $request->file('medias_id')->store('photos_membres', 'public');
        } else {
            $photoPath = null;
        }

        // Création du membre
        $name = $request->firstname . ' ' . $request->lastname;
        $user = User::create([
                'name' => $name,
            'firstname' => $request->firstname,
            'lastname'  => $request->lastname,
            'sexe'      => $request->sexe,
            'birthday'  => $request->birthday,
            'photo_path'=> $photoPath,
            'description' => $request->description,
            'current_employer' => $request->current_employer,
            'employer_contact' => $request->employer_contact,
            'current_position' => $request->current_position,
            'sector'           => $request->sector,
            'sector_other'     => $request->sector_other,
            'category_of_service' => $request->category_of_service,
            'category_other'      => $request->category_other,
            'area_of_expertise'   => $request->area_of_expertise,
            'initial_training'    => $request->initial_training,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'type_members' => $request->type_members,
            'role' => 'membre', // par défaut
        ]);

         Mail::to($user->email)->send(new AdhesionPending($user->name, 'user'));

        return redirect()->route('home')->with('success', 'Votre demande d\'adhésion a été soumise avec succès. Vous recevrez un email de confirmation une fois que votre compte aura été validé par l\'administrateur.');
    }
}













