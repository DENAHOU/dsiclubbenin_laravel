<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\Cotisation;
use App\Models\Formation;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Affiche le tableau de bord de l'utilisateur connecté.
     */

    public function index()
    {
        $user = auth()->user();

        // 🔹 Date d'adhésion
        $dateAdhesion = Carbon::parse($user->created_at);

        // 🔹 Nombre total de mois depuis l'adhésion
        $moisEcoules = $dateAdhesion->diffInMonths(now()) + 1;

        // 🔹 Cotisations PAYÉES
        $cotisationsPayees = Cotisation::where('user_id', $user->id)
            ->where('status', 'paid')
            ->get();

        // 🔹 Montant total cotisé
        $montantCotise = $cotisationsPayees->sum('amount');

        // 🔹 Vérifier si c'est un nouvel adhérent (moins de 3 mois)
        $estNouveauAdherent = $dateAdhesion->diffInMonths(now()) < 3;

        if ($estNouveauAdherent) {
            // 🔹 NOUVELLE LOGIQUE - Pour les nouveaux adhérents
            // Mois dus = nombre de mois non payés depuis l'adhésion
            $moisDus = max(0, $moisEcoules - intval($montantCotise / 5000));
            $moisDus = intval($moisDus);

            // Mois payés = montant cotisé / 5000
            $moisPayes = intval($montantCotise / 5000);

            // Mois ajoutés = nombre de mois payés de plus (excédent)
            $moisAjoutes = max(0, $moisPayes - $moisEcoules);
        } else {
            // 🔹 ANCIENNE LOGIQUE - Pour les membres existants
            // Mois payés = montant cotisé / 5000
            $moisPayes = intval($montantCotise / 5000);

            // Mois ajoutés - si le montant cotisé dépasse 350000, calculer l'excédent
            $montantTotalRequis = 350000;
            if ($montantCotise > $montantTotalRequis) {
                $montantExcedent = $montantCotise - $montantTotalRequis;
                $moisAjoutes = intval($montantExcedent / 5000);
            } else {
                $moisAjoutes = 0;
            }

            // Mois dus - basé sur le montant restant pour atteindre 350000
            $montantRestant = max(0, $montantTotalRequis - $montantCotise);
            $moisDus = intval($montantRestant / 5000);
        }

        // 🔹 Dernier paiement
        $lastPayment = $cotisationsPayees->sortByDesc('created_at')->first();

        // 🔹 Prochaine échéance
        if ($lastPayment) {
            $prochaineEcheance = Carbon::parse($lastPayment->created_at)
                ->addMonth()
                ->format('d/m/Y');
        } else {
            $prochaineEcheance = $dateAdhesion->addMonth()->format('d/m/Y');
        }

        // 🔹 Formations disponibles
        $formations = Formation::with('categoryFormation')
            ->orderBy('start_date', 'desc')
            ->get();

        return view('dashboard', compact(
            'moisPayes',
            'moisDus',
            'moisAjoutes',
            'estNouveauAdherent',
            'lastPayment',
            'prochaineEcheance',
            'formations'
        ));
    }

    /**
     * SIMULATION : Calcule le pourcentage de complétion du profil.
     */
    private function calculateProfileStrength($user): int
    {
        $totalFields = 5; // Nombre de champs importants qu'on vérifie
        $completedFields = 0;

        if (!empty($user->phone)) $completedFields++;
        if (!empty($user->current_position)) $completedFields++;
        if (!empty($user->area_of_expertise)) $completedFields++;
        if (!empty($user->photo_path)) $completedFields++;
        if (!empty($user->description)) $completedFields++;

        if ($totalFields === 0) return 100;

        return intval(($completedFields / $totalFields) * 100);
    }
}
