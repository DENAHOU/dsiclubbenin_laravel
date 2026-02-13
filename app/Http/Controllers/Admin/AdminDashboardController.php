<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use App\Models\Administration;
use App\Models\College;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web,role:admin'); // Sécurise toutes les pages admin
    }

    public function index()
    {
        // Statistiques basiques
        $totalUsers = User::count();
        $totalCompanies = Company::count();
        $totalAdministrations = Administration::count();
        $totalColleges = College::count();

        // Pending
        $pendingUsers = User::where('status', 'pending')->count();
        $pendingCompanies = Company::where('status', 'pending')->count();
        $pendingAdministrations = Administration::where('status', 'pending')->count();
        $pendingColleges = College::where('status', 'pending')->count();

        $pendingTotal = $pendingUsers + $pendingCompanies + $pendingAdministrations + $pendingColleges;

        // Derniers pending
        $recentPending = $this->gatherPending(12);

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalCompanies',
            'totalAdministrations',
            'totalColleges',
            'pendingTotal',
            'recentPending'
        ));
    }

    /**
     * Récupère et "normalise" les enregistrements pending des différents modèles.
     * Retourne une Collection d'items: id, name, email, type, created_at
     */
    public function gatherPending($limit = 50)
    {
        // Étape 1 : récupérer pending pour chaque type
        $users = \App\Models\User::where('status', 'pending')->take($limit)->get();
        $companies = \App\Models\Company::where('status', 'pending')->take($limit)->get();
        $administrations = \App\Models\Administration::where('status', 'pending')->take($limit)->get();
        $colleges = \App\Models\College::where('status', 'pending')->take($limit)->get();

        // Étape 2 : normaliser (tout renvoyer dans un même tableau)
        $pending = collect();

        foreach ($users as $u) {
            $pending->push([
                'id' => $u->id,
                'name' => $u->name,
                'email' => $u->email,
                'type' => 'user',
                'created_at' => $u->created_at
            ]);
        }

        foreach ($companies as $c) {
            $pending->push([
                'id' => $c->id,
                'name' => $c->name ?? $c->company_name,
                'email' => $c->email,
                'type' => 'company',
                'created_at' => $c->created_at
            ]);
        }

        foreach ($administrations as $a) {
            $pending->push([
                'id' => $a->id,
                'name' => $a->name,
                'email' => $a->email,
                'type' => 'administration',
                'created_at' => $a->created_at
            ]);
        }

        foreach ($colleges as $c) {
            $pending->push([
                'id' => $c->id,
                'name' => $c->name ?? $c->company_name,
                'email' => $c->email,
                'type' => 'college',
                'created_at' => $c->created_at
            ]);
        }

        // Étape 3 : trier par date
        return $pending->sortByDesc('created_at')->take($limit);
    }

}
