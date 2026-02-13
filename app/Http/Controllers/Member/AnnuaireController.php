<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cotisation;
use Illuminate\View\View;
use Illuminate\Http\Request;

class AnnuaireController extends Controller
{
    /**
     * Vérifie si l'utilisateur peut accéder à l'annuaire
     */
    private function peutAccederAnnuaire($user): bool
    {
        // Calculer les mois dus pour l'utilisateur
        $montantCotise = Cotisation::where('user_id', $user->id)
            ->where('status', 'paid')
            ->sum('amount');
        
        $montantTotalRequis = 350000;
        $montantRestant = max(0, $montantTotalRequis - $montantCotise);
        $moisDus = intval($montantRestant / 5000);
        
        return $moisDus === 0; // Accès si aucun mois dû
    }

    /**
     * Affiche l'annuaire des membres
     */
    public function membres(Request $request): View
    {
        // Récupérer les filtres
        $type = $request->get('type', 'all');
        $search = $request->get('search', '');

        // Collection pour tous les membres
        $allMembers = collect();

        // Récupérer les utilisateurs
        if ($type === 'all' || $type === 'users') {
            $usersQuery = \App\Models\User::query();
            
            if ($search) {
                $usersQuery->where(function ($q) use ($search) {
                    $q->where('firstname', 'like', "%{$search}%")
                      ->orWhere('lastname', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%")
                      ->orWhere('name', 'like', "%{$search}%");
                });
            }
            
            $users = $usersQuery->get()->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => trim(($user->name ?? '') . ' ' . ($user->firstname ?? '') . ' ' . ($user->lastname ?? '')),
                    'firstname' => $user->firstname ?? '',
                    'lastname' => $user->lastname ?? '',
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'photo_path' => $user->photo_path,
                    'type' => 'user',
                    'type_display' => 'Membre',
                    'current_employer' => $user->current_employer,
                    'sector' => $user->sector,
                ];
            });
            $allMembers = $allMembers->concat($users);
        }

        // Récupérer les entreprises
        if ($type === 'all' || $type === 'company') {
            $companiesQuery = \App\Models\Company::query();
            
            if ($search) {
                $companiesQuery->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%")
                      ->orWhere('contact_name', 'like', "%{$search}%");
                });
            }
            
            $companies = $companiesQuery->get()->map(function ($company) {
                return [
                    'id' => $company->id,
                    'name' => $company->name,
                    'firstname' => $company->contact_name,
                    'lastname' => '',
                    'email' => $company->email,
                    'phone' => $company->phone,
                    'photo_path' => $company->logo_path,
                    'type' => 'company',
                    'type_display' => 'Entreprise',
                    'current_employer' => $company->name,
                    'sector' => $company->sector,
                ];
            });
            $allMembers = $allMembers->concat($companies);
        }

        // Récupérer les collèges IT
        if ($type === 'all' || $type === 'college') {
            $collegesQuery = \App\Models\College::query();
            
            if ($search) {
                $collegesQuery->where(function ($q) use ($search) {
                    $q->where('company_name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('contact_name', 'like', "%{$search}%");
                });
            }
            
            $colleges = $collegesQuery->get()->map(function ($college) {
                return [
                    'id' => $college->id,
                    'name' => $college->company_name,
                    'firstname' => $college->contact_name,
                    'lastname' => '',
                    'email' => $college->email,
                    'phone' => null,
                    'photo_path' => $college->logo_path,
                    'type' => 'college',
                    'type_display' => 'Collège IT',
                    'current_employer' => $college->company_name,
                    'sector' => 'Éducation/Formation',
                ];
            });
            $allMembers = $allMembers->concat($colleges);
        }

        // Récupérer les administrations publiques
        if ($type === 'all' || $type === 'administration') {
            $adminQuery = \App\Models\Administration::query();
            
            if ($search) {
                $adminQuery->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('contact_phone', 'like', "%{$search}%")
                      ->orWhere('contact_name', 'like', "%{$search}%");
                });
            }
            
            $administrations = $adminQuery->get()->map(function ($admin) {
                return [
                    'id' => $admin->id,
                    'name' => $admin->name,
                    'firstname' => $admin->contact_name,
                    'lastname' => '',
                    'email' => $admin->email,
                    'phone' => $admin->contact_phone,
                    'photo_path' => $admin->logo_path ?? null,
                    'type' => 'administration',
                    'type_display' => 'Administration',
                    'current_employer' => $admin->name,
                    'sector' => 'Service Public',
                ];
            });
            $allMembers = $allMembers->concat($administrations);
        }

        // Trier par nom
        $allMembers = $allMembers->sortBy('name');

        // Paginer manuellement
        $page = request()->get('page', 1);
        $perPage = 12;
        $total = $allMembers->count();
        $membres = new \Illuminate\Pagination\LengthAwarePaginator(
            $allMembers->forPage($page, $perPage),
            $total,
            $perPage,
            $page,
            ['path' => request()->url(), 'pageName' => 'page']
        );

        // Compter les membres par type
        $stats = [
            'total' => \App\Models\User::count() 
                     + \App\Models\Company::count() 
                     + \App\Models\College::count() 
                     + \App\Models\Administration::count(),
            'users' => \App\Models\User::count(),
            'company' => \App\Models\Company::count(),
            'college' => \App\Models\College::count(),
            'administration' => \App\Models\Administration::count(),
        ];

        return view('member.annuaire.membres', compact('membres', 'stats', 'type', 'search'));
    }

    /**
     * Affiche l'annuaire des partenaires
     */
    public function partenaires(Request $request): View
    {
        // Récupérer les filtres
        $type = $request->get('type', 'all');
        $search = $request->get('search', '');

        try {
            // Récupérer tous les types de partenaires disponibles
            $partnerTypes = \App\Models\PartnerType::pluck('name', 'id')->toArray();

            // Construire la requête pour les partenaires
            $query = \App\Models\Partner::query();

            // Filtrer par type de partenaire
            if ($type !== 'all') {
                $query->where('partner_type_id', $type);
            }

            // Filtrer par recherche
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('company_name', 'like', "%{$search}%")
                      ->orWhere('domain', 'like', "%{$search}%")
                      ->orWhere('specialty', 'like', "%{$search}%")
                      ->orWhere('manager_name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%")
                      ->orWhere('website_url', 'like', "%{$search}%");
                });
            }

            // Paginer les résultats
            $partenaires = $query->orderBy('company_name')->paginate(12);

            // Compter les partenaires par type
            $stats = [
                'total' => \App\Models\Partner::count(),
                'types' => \App\Models\Partner::select('partner_type_id', \DB::raw('count(*) as count'))
                    ->groupBy('partner_type_id')
                    ->pluck('count', 'partner_type_id')
                    ->toArray(),
            ];

            return view('member.annuaire.partenaires', compact('partenaires', 'stats', 'type', 'search', 'partnerTypes'));
            
        } catch (\Exception $e) {
            // En cas d'erreur, afficher un message d'erreur
            return view('member.annuaire.partenaires', [
                'partenaires' => collect(),
                'stats' => ['total' => 0, 'types' => []],
                'type' => $type,
                'search' => $search,
                'partnerTypes' => [],
                'error' => 'Une erreur est survenue lors du chargement des partenaires: ' . $e->getMessage()
            ]);
        }
    }
}
