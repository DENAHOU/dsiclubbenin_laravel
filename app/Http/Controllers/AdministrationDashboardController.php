<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Carbon\Carbon;

class AdministrationDashboardController extends Controller
{
    /**
     * Affiche le tableau de bord de l'administration.
     */
    public function index(): View
    {
        // Récupère l'administration connectée
        $administration = Auth::guard('administration')->user();

        // Récupère les stats de cotisation
        $subscriptionStats = $this->getSubscriptionStats($administration);
        $userType = 'administration';

        return view(
            'administration.dahbord', 
            compact(
                'administration',
                'subscriptionStats',
                'userType'
            )
        );
    }

    /**
     * Récupère les statistiques de cotisation
     */
    private function getSubscriptionStats($entity)
    {
        // Cotisations payées
        $paidPayments = $entity->membershipPayments()
            ->where('status', 'paid')
            ->get();

        $paidCount = $paidPayments->count();

        // Dernière échéance (dernière cotisation payée)
        $lastPayment = $paidPayments->sortByDesc('created_at')->first();
        $lastDueDate = $lastPayment ? $lastPayment->created_at : null;

        // Prochaine échéance (1 an après la dernière)
        $nextDueDate = $lastDueDate ? $lastDueDate->addYear() : null;

        // Cotisations dues/en attente
        $pendingPayments = $entity->membershipPayments()
            ->where('status', 'pending')
            ->get();

        $pendingCount = $pendingPayments->count();

        // Vérifier si en retard (prochaine échéance < aujourd'hui)
        $isOverdue = $nextDueDate && $nextDueDate->isPast();

        return [
            'paidCount' => $paidCount,
            'pendingCount' => $pendingCount,
            'lastDueDate' => $lastDueDate,
            'nextDueDate' => $nextDueDate,
            'isOverdue' => $isOverdue,
            'daysUntilDue' => $nextDueDate ? $nextDueDate->diffInDays(Carbon::now()) : null,
        ];
    }

    /**
     * Affiche le profil complet de l'administration.
     */
    public function show($id): View
    {
        $administration = Auth::guard('administration')->user();

        // Vérifier que l'utilisateur ne visualise que son propre profil
        if ($administration->id != $id) {
            abort(403, 'Accès non autorisé');
        }

        return view('administration.profil', compact('administration'));
    }

    /**
     * Affiche la page d'édition des informations de l'administration.
     */
    public function edit($id): View
    {
        $administration = Auth::guard('administration')->user();

        // Vérifier que l'utilisateur ne modifie que ses propres informations
        if ($administration->id != $id) {
            abort(403, 'Accès non autorisé');
        }

        return view('administration.edit', compact('administration'));
    }

    /**
     * Met à jour les informations de l'administration.
     */
    public function update(Request $request, $id)
    {
        $administration = Auth::guard('administration')->user();

        // Vérifier que l'utilisateur ne modifie que ses propres informations
        if ($administration->id != $id) {
            abort(403, 'Accès non autorisé');
        }

        // Validation des données
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'entity_type' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'website_url' => 'nullable|url',
            'contact_name' => 'required|string|max:255',
            'contact_position' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:20',
        ], [
            'name.required' => 'Le nom de l\'administration est obligatoire.',
            'entity_type.required' => 'Le type d\'entité est obligatoire.',
            'address.required' => 'L\'adresse est obligatoire.',
            'contact_name.required' => 'Le nom du contact est obligatoire.',
            'contact_position.required' => 'Le poste du contact est obligatoire.',
            'contact_email.required' => 'L\'email du contact est obligatoire.',
            'contact_email.email' => 'L\'email du contact doit être valide.',
            'contact_phone.required' => 'Le téléphone du contact est obligatoire.',
            'website_url.url' => 'L\'URL du site web doit être valide.',
        ]);

        // Mettre à jour les informations
        $administration->update($validated);

        // Rediriger avec message de succès
        return redirect()->route('administration.dashboard')
            ->with('success', 'Vos informations ont été mises à jour avec succès.');
    }

    /**
     * Affiche la page des paramètres du compte.
     */
    public function settings($id): View
    {
        $administration = Auth::guard('administration')->user();

        // Vérifier que l'utilisateur ne visualise que ses propres paramètres
        if ($administration->id != $id) {
            abort(403, 'Accès non autorisé');
        }

        return view('administration.settings', compact('administration'));
    }

    /**
     * Met à jour le mot de passe de l'administration.
     */
    public function updatePassword(Request $request, $id)
    {
        $administration = Auth::guard('administration')->user();

        // Vérifier que l'utilisateur ne modifie que son propre mot de passe
        if ($administration->id != $id) {
            abort(403, 'Accès non autorisé');
        }

        // Validation des données
        $validated = $request->validate([
            'current_password' => [
                'required',
                function ($attribute, $value, $fail) use ($administration) {
                    if (!Hash::check($value, $administration->password)) {
                        $fail('Le mot de passe actuel est incorrect.');
                    }
                },
            ],
            'password' => 'required|string|min:8|confirmed',
        ], [
            'current_password.required' => 'Le mot de passe actuel est obligatoire.',
            'password.required' => 'Le nouveau mot de passe est obligatoire.',
            'password.min' => 'Le nouveau mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
        ]);

        // Mettre à jour le mot de passe
        $administration->update([
            'password' => Hash::make($validated['password']),
        ]);

        // Rediriger avec message de succès
        return redirect()->route('administration.settings', $administration->id)
            ->with('success', 'Votre mot de passe a été changé avec succès.');
    }

    /**
     * Supprime définitivement le compte de l'administration.
     */
    public function deleteAccount(Request $request, $id)
    {
        $administration = Auth::guard('administration')->user();

        // Vérifier que l'utilisateur ne supprime que son propre compte
        if ($administration->id != $id) {
            abort(403, 'Accès non autorisé');
        }

        // Supprimer le compte et toutes les données associées
        $administration->delete();

        // Déconnecter l'utilisateur de tous les gardes
        Auth::guard('administration')->logout();

        // Invalider la session
        $request->session()->invalidate();

        // Régénérer le token CSRF
        $request->session()->regenerateToken();

        // Rediriger vers la page d'accueil avec message de confirmation
        return redirect('/')
            ->with('success', 'Votre compte a été supprimé définitivement.');
    }
}
