<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Pour accéder à l'utilisateur connecté

class PartnerDashboardController extends Controller
{
    /**
     * Affiche le tableau de bord principal du partenaire.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Récupère l'utilisateur partenaire actuellement authentifié
        $partner = Auth::guard('partner')->user();

        // Ici, vous pouvez récupérer des données spécifiques pour le tableau de bord
        // Par exemple, le nombre de compétences, de documents, les prochains événements, etc.
        // Assurez-vous d'avoir les relations définies dans votre modèle Partner.

        // Exemple si vous avez des relations 'skills' et 'documents' dans le modèle Partner:
        // $skillsCount = $partner->skills->count();
        // $documentsCount = $partner->documents->count();
        // $upcomingEventsCount = 0; // Logique à implémenter pour les événements

        return view('partner.dashboard', [
            'partner' => $partner,
            // 'skillsCount' => $skillsCount,
            // 'documentsCount' => $documentsCount,
            // 'upcomingEventsCount' => $upcomingEventsCount,
        ]);
    }
}
