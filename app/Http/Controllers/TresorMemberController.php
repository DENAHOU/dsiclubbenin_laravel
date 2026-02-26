<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class TresorMemberController extends Controller
{
    /**
     * Affiche la liste des membres pour le trésorier
     */
    public function index(Request $request)
    {
        $query = User::query();
        
        // Filtrer par rôle (membre par défaut)
        $query->where('role', 'membre');
        
        // Filtre de recherche
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%");
            });
        }
        
        // Filtre par statut de paiement
        if ($request->filled('status')) {
            if ($request->status === 'paid') {
                $query->where('is_paid', 1);
            } elseif ($request->status === 'unpaid') {
                $query->where('is_paid', 0);
            }
        }
        
        // Filtre par rôle
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }
        
        $members = $query->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return view('tresor.members.index', compact('members'));
    }
    
    /**
     * Affiche les membres inactifs
     */
    public function inactive()
    {
        $inactiveMembers = User::where('role', 'membre')
            ->where('is_paid', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return view('tresor.members.inactive', compact('inactiveMembers'));
    }
    
    /**
     * Affiche les détails d'un membre (AJAX)
     */
    public function show($id)
    {
        $member = User::with(['cotisations' => function($query) {
                $query->orderBy('created_at', 'desc');
            }])
            ->findOrFail($id);
            
        return view('tresor.members.show', compact('member'))->render();
    }
}
