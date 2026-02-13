<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Member\AnnuaireController;
use App\Http\Controllers\Member\MemberFormationController;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Formation;
use App\Models\User;
use App\Models\Company;
use App\Models\College;
use App\Models\Administration;
use App\Models\Partner;

class SharedResourceController extends Controller
{
    protected $annuaireController;
    protected $formationController;

    public function __construct()
    {
        $this->annuaireController = new AnnuaireController();
        $this->formationController = new MemberFormationController();
    }

    /**
     * Affiche le dashboard unifié avec les trois sections
     */
    public function dashboard(Request $request): View
    {
        // Récupérer les données récentes pour chaque section
        $recentFormations = Formation::orderBy('created_at', 'desc')->take(10)->get();
        
        // Récupérer les membres récents (tous types confondus)
        $recentMembers = collect();
        
        // Ajouter les utilisateurs
        $users = User::orderBy('created_at', 'desc')->take(3)->get();
        foreach ($users as $user) {
            $recentMembers->push([
                'name' => trim(($user->name ?? '') . ' ' . ($user->firstname ?? '') . ' ' . ($user->lastname ?? '')),
                'type' => $user->type_members ?? 'user',
                'type_display' => $this->getTypeDisplay($user->type_members ?? 'user'),
                'email' => $user->email,
            ]);
        }
        
        // Ajouter les entreprises
        $companies = Company::orderBy('created_at', 'desc')->take(2)->get();
        foreach ($companies as $company) {
            $recentMembers->push([
                'name' => $company->name,
                'type' => 'company',
                'type_display' => 'Entreprise',
                'email' => $company->email,
            ]);
        }
        
        // Ajouter les collèges
        $colleges = College::orderBy('created_at', 'desc')->take(2)->get();
        foreach ($colleges as $college) {
            $recentMembers->push([
                'name' => $college->company_name,
                'type' => 'college',
                'type_display' => 'Collège IT',
                'email' => $college->email,
            ]);
        }
        
        // Ajouter les administrations
        $administrations = Administration::orderBy('created_at', 'desc')->take(2)->get();
        foreach ($administrations as $admin) {
            $recentMembers->push([
                'name' => $admin->name,
                'type' => 'administration',
                'type_display' => 'Administration',
                'email' => $admin->email,
            ]);
        }
        
        // Récupérer les partenaires récents
        $recentPartners = Partner::orderBy('created_at', 'desc')->take(10)->get();

        // Déterminer le type d'utilisateur pour les routes
        $userType = $this->getUserType($request);

        return view('components.unified-dashboard', compact(
            'recentFormations',
            'recentMembers', 
            'recentPartners',
            'userType'
        ));
    }

    /**
     * Affiche les formations disponibles pour l'espace partagé
     */
    public function formations(Request $request): View
    {
        // Déterminer le type d'utilisateur
        $userType = $this->getUserType($request);
        
        // ACCÈS UNIFIÉ : Tous les types d'utilisateurs ont accès aux formations
        
        // Utiliser le contrôleur existant mais retourner une vue partagée
        $formationController = new MemberFormationController();
        $response = $formationController->index($request);
        
        // Si c'est une vue, la modifier pour utiliser le bon layout
        if ($response instanceof View) {
            $data = $response->getData();
            return view('shared.formations', array_merge($data, ['userType' => $userType]));
        }
        
        return $response;
    }

    /**
     * Affiche une formation spécifique
     */
    public function showFormation(Request $request, $id): View
    {
        $userType = $this->getUserType($request);
        
        // ACCÈS UNIFIÉ : Tous les types d'utilisateurs ont accès aux détails des formations

        $formationController = new MemberFormationController();
        $response = $formationController->show($request, $id);
        
        if ($response instanceof View) {
            $data = $response->getData();
            return view('shared.formation-details', array_merge($data, ['userType' => $userType]));
        }
        
        return $response;
    }

    /**
     * Affiche l'annuaire des membres pour l'espace partagé
     */
    public function annuaireMembres(Request $request): View
    {
        $userType = $this->getUserType($request);
        
        // ACCÈS UNIFIÉ : Tous les types d'utilisateurs ont accès à l'annuaire
        // Plus de vérifications complexes de cotisation pour l'instant
        
        $annuaireController = new AnnuaireController();
        $response = $annuaireController->membres($request);
        
        if ($response instanceof View) {
            $data = $response->getData();
            
            // S'assurer que les données sont bien transmises
            if (!isset($data['membres'])) {
                // Si le contrôleur retourne une vue d'erreur, créer des données vides
                $data = [
                    'membres' => collect(),
                    'stats' => ['total' => 0],
                    'type' => 'all',
                    'search' => $request->get('search', '')
                ];
            }
            
            return view('shared.annuaire-membres', array_merge($data, ['userType' => $userType]));
        }
        
        return $response;
    }

    /**
     * Affiche l'annuaire des partenaires pour l'espace partagé
     */
    public function annuairePartenaires(Request $request): View
    {
        $userType = $this->getUserType($request);
        
        // ACCÈS UNIFIÉ : Tous les types d'utilisateurs ont accès à l'annuaire des partenaires
        
        $annuaireController = new AnnuaireController();
        $response = $annuaireController->partenaires($request);
        
        if ($response instanceof View) {
            $data = $response->getData();
            
            // S'assurer que les données sont bien transmises
            if (!isset($data['partenaires'])) {
                $data = [
                    'partenaires' => collect(),
                    'stats' => ['total' => 0],
                    'type' => 'all',
                    'search' => $request->get('search', ''),
                    'partnerTypes' => []
                ];
            }
            
            return view('shared.annuaire-partenaires', array_merge($data, ['userType' => $userType]));
        }
        
        return $response;
    }

    /**
     * Détermine le type d'affichage pour un type de membre
     */
    private function getTypeDisplay($type): string
    {
        switch ($type) {
            case 'company':
                return 'Entreprise';
            case 'college':
                return 'Collège IT';
            case 'administration':
                return 'Administration';
            default:
                return 'Membre';
        }
    }

    /**
     * Détermine le type d'utilisateur connecté pour les routes
     */
    private function getUserType(Request $request): string
    {
        if (auth()->guard('company')->check()) {
            return 'company';
        } elseif (auth()->guard('college')->check()) {
            return 'college';
        } elseif (auth()->guard('administration')->check()) {
            return 'administration';
        } else {
            return 'member';
        }
    }

    /**
     * Vérifie si l'utilisateur peut accéder aux formations
     */
    private function canAccessFormations(Request $request): bool
    {
        $userType = $this->getUserType($request);
        
        switch ($userType) {
            case 'company':
                return $this->isCompanyUpToDate();
            case 'college':
                return $this->isCollegeUpToDate();
            case 'administration':
                return $this->isAdministrationUpToDate();
            default:
                return true; // Les membres réguliers ont accès par défaut
        }
    }

    /**
     * Vérifie si l'utilisateur peut accéder aux annuaires
     */
    private function canAccessAnnuaire(Request $request): bool
    {
        $userType = $this->getUserType($request);
        
        switch ($userType) {
            case 'company':
                return $this->isCompanyUpToDate();
            case 'college':
                return $this->isCollegeUpToDate();
            case 'administration':
                return $this->isAdministrationUpToDate();
            default:
                return true; // Les membres réguliers ont accès par défaut
        }
    }

    /**
     * Vérifie si l'entreprise est à jour dans ses cotisations (150000/an)
     */
    private function isCompanyUpToDate(): bool
    {
        $company = auth()->guard('company')->user();
        if (!$company) return false;

        // Vérifier si la dernière cotisation payée date de moins d'un an
        $lastPayment = $company->membershipPayments()
            ->where('status', 'paid')
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$lastPayment) return false;

        // Vérifier si le paiement date de moins d'un an
        $oneYearAgo = now()->subYear();
        return $lastPayment->created_at->greaterThan($oneYearAgo);
    }

    /**
     * Vérifie si le collège est à jour dans ses cotisations (100000/an)
     */
    private function isCollegeUpToDate(): bool
    {
        $college = auth()->guard('college')->user();
        if (!$college) return false;

        $lastPayment = $college->membershipPayments()
            ->where('status', 'paid')
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$lastPayment) return false;

        $oneYearAgo = now()->subYear();
        return $lastPayment->created_at->greaterThan($oneYearAgo);
    }

    /**
     * Vérifie si l'administration est à jour dans ses cotisations (100000/an)
     */
    private function isAdministrationUpToDate(): bool
    {
        $administration = auth()->guard('administration')->user();
        if (!$administration) return false;

        $lastPayment = $administration->membershipPayments()
            ->where('status', 'paid')
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$lastPayment) return false;

        $oneYearAgo = now()->subYear();
        return $lastPayment->created_at->greaterThan($oneYearAgo);
    }
}
