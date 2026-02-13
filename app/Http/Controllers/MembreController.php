<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MembreController extends Controller
{
    // Affiche la page Espace Membre
    public function espace()
    {
        return view('membre.espace'); // la vue ressemblera à resources/views/membre/espace.blade.php
    }

    // Affiche la page Devenir Membre (inscription)
    public function inscription()
    {
        return view('membre.inscription'); // la vue ressemblera à resources/views/membre/inscription.blade.php
    }
}
