<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EsnDashboardController extends Controller
{


    /**
     * Affiche le tableau de bord de l'ESN.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Récupère l'utilisateur ESN actuellement connecté
        $esn = Auth::guard('esn')->user();

        // Envoie les infos à la vue
        return view('esn.dashboard', compact('esn'));
    }
}
