<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComingSoonController extends Controller
{
    /**
     * Affiche la page "Coming Soon" de la plateforme de gestion des compétences.
     */
    public function competences()
    {
        // Tu pourrais plus tard récupérer une date de lancement depuis la base de données ici
        $launchDate = now()->addDays(30); // Exemple symbolique

        return view('coming-soon-competences', compact('launchDate'));

    }
}
