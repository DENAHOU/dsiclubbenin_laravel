<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DSIStoriesController extends Controller
{
    public function temoignages()
    {
        // Envoie la vue pour la page des témoignages
        return view('dsistories.temoignages');
    }

    public function interviews()
    {
        // Envoie la vue pour la page des interviews
        return view('dsistories.interviews');
    }
}
