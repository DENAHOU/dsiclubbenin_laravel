<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cotisation;

class TresorReportController extends Controller
{
    private $monthlyAmount = 5000; // montant cotisation mensuelle


    /**
     * Rapport résumé des cotisations
     */
    public function summary()
    {
        $totalMembers = User::where('role', 'membre')->count();

        // Membres ayant payé au moins une fois
        $paidMembers = Cotisation::where('status', 'paid')
            ->distinct('user_id')
            ->count('user_id');

        // Membres en retard
        $lateMembersCollection = $this->getLateMembers();
        $lateMembers = $lateMembersCollection->count();

        $totalRevenue = Cotisation::where('status', 'paid')->sum('amount');

        $thisMonthRevenue = Cotisation::where('status', 'paid')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('amount');

        $recentPayments = Cotisation::with('user')
            ->where('status', 'paid')
            ->latest()
            ->limit(10)
            ->get();

        return view('tresor.reports.summary', compact(
            'totalMembers',
            'paidMembers',
            'lateMembers',
            'totalRevenue',
            'thisMonthRevenue',
            'recentPayments'
        ));
    }


    /**
     * Rapport des recettes
     */
    public function revenue()
    {
        $monthlyRevenue = Cotisation::selectRaw(
                'YEAR(created_at) as year, MONTH(created_at) as month, SUM(amount) as total'
            )
            ->where('status', 'paid')
            ->groupBy('year', 'month')
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->limit(12)
            ->get();

        return view('tresor.reports.revenue', compact('monthlyRevenue'));
    }


    /**
     * Rapport des dettes
     */
    public function debt()
    {
        $debtMembers = $this->getLateMembers();

        $totalDebt = $debtMembers->sum('estimated_debt');

        return view('tresor.reports.debt', compact('debtMembers', 'totalDebt'));
    }


    /**
     * Méthode privée : récupérer les membres en retard
     */
private function getLateMembers()
{
    $members = User::where('role', 'membre')
        ->with(['cotisations' => function ($query) {
            $query->where('status', 'paid')->latest();
        }])
        ->get();

    return $members->map(function ($user) {

        $dateAdhesion = \Carbon\Carbon::parse($user->created_at);

        // Nombre total de mois depuis l'adhésion
        $moisEcoules = $dateAdhesion->diffInMonths(now()) + 1;

        // Cotisations payées
        $cotisationsPayees = $user->cotisations;

        $montantCotise = $cotisationsPayees->sum('amount');

        $estNouveauAdherent = $dateAdhesion->diffInMonths(now()) < 3;

        if ($estNouveauAdherent) {
            // Nouveaux adhérents
            $moisPayes = intval($montantCotise / 5000);
            $moisDus = max(0, $moisEcoules - $moisPayes);
            $moisAjoutes = max(0, $moisPayes - $moisEcoules);
        } else {
            // Anciens adhérents
            $moisPayes = intval($montantCotise / 5000);

            $montantTotalRequis = 350000;
            if ($montantCotise > $montantTotalRequis) {
                $montantExcedent = $montantCotise - $montantTotalRequis;
                $moisAjoutes = intval($montantExcedent / 5000);
            } else {
                $moisAjoutes = 0;
            }

            $montantRestant = max(0, $montantTotalRequis - $montantCotise);
            $moisDus = intval($montantRestant / 5000);
        }

        // Dernier paiement
        $lastPayment = $cotisationsPayees->sortByDesc('created_at')->first();

        // Prochaine échéance
        $prochaineEcheance = $lastPayment
            ? \Carbon\Carbon::parse($lastPayment->created_at)->addMonth()->format('d/m/Y')
            : $dateAdhesion->addMonth()->format('d/m/Y');

        // On injecte les infos dans l'objet user
        $user->months_late = $moisDus;
        $user->estimated_debt = $moisDus * 5000;
        $user->last_payment_date = $lastPayment ? $lastPayment->created_at->format('d/m/Y') : null;
        $user->next_due_date = $prochaineEcheance;
        $user->months_paid = $moisPayes;
        $user->months_added = $moisAjoutes;

        return $user;
    })
    ->where('months_late', '>', 0)
    ->sortByDesc('months_late')
    ->values();
}

}
