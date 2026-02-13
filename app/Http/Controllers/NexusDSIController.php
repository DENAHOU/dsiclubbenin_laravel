<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NexusDSIController extends Controller
{
    /**
     * Affiche la page "Bientôt disponible" du NexusDSI Hub.
     */
    public function comingSoon()
    {
        return view('coming-soon');
    }


}
