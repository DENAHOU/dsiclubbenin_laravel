<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Cotisation;

class TresorDashboardController extends Controller
{
    /**
     * Affiche le tableau de bord du trésorier
     */
    public function index()
    {
        // Statistiques générales
        $totalMembers = User::where('role', 'membre')->count();
        
        $totalPaid = User::where('role', 'membre')
            ->where('is_paid', 1)
            ->count();
            
        $totalUnpaid = User::where('role', 'membre')
            ->where('is_paid', 0)
            ->count();
            
        $totalRevenue = Cotisation::where('status', 'paid')
            ->sum('amount');

        // Paiements récents
        $recentPayments = Cotisation::with('user')
            ->where('status', 'paid')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Membres en retard
        $lateMembers = User::where('role', 'membre')
            ->where('is_paid', 0)
            ->with(['cotisations' => function($query) {
                $query->where('status', 'paid')
                    ->orderBy('created_at', 'desc');
            }])
            ->get()
            ->map(function($user) {
                $lastPayment = $user->cotisations->first();
                $monthsLate = $lastPayment ? 
                    max(0, now()->diffInMonths($lastPayment->created_at) - $lastPayment->months) : 
                    now()->diffInMonths($user->created_at);
                    
                $user->months_late = $monthsLate;
                return $user;
            })
            ->where('months_late', '>', 0)
            ->take(5);

        return view('tresor.dashboard', compact(
            'totalMembers',
            'totalPaid', 
            'totalUnpaid',
            'totalRevenue',
            'recentPayments',
            'lateMembers'
        ));
    }

    /**
     * Affiche le profil du trésorier
     */
    public function profile()
    {
        $user = auth()->user();
        return view('tresor.profile', compact('user'));
    }
}
