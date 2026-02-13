<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Carbon\Carbon;

class CollegeDashboardController extends Controller
{
    public function index(): View
    {
        // Récupère l'entité "Collège IT" connectée via le garde 'college'
        $college = Auth::guard('college')->user();

        // Récupère les stats de cotisation
        $subscriptionStats = $this->getSubscriptionStats($college);
            $userType = 'college';

        return view('college/dashboard', [
            'college' => $college,
            'subscriptionStats' => $subscriptionStats,
            'userType' => $userType,
        ]);
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
     * Affiche le profil complet du college.
     */
    public function show($id): View
    {
        $college = Auth::guard('college')->user();

        // Vérifier que l'utilisateur ne visualise que son propre profil
        if ($college->id != $id) {
            abort(403, 'Accès non autorisé');
        }

        return view('college.profil', compact('college'));
    }

    /**
     * Affiche la page d'édition du college.
     */
    public function edit($id): View
    {
        $college = Auth::guard('college')->user();

        // Vérifier que l'utilisateur ne modifie que ses propres informations
        if ($college->id != $id) {
            abort(403, 'Accès non autorisé');
        }

        return view('college.edit', compact('college'));
    }

    /**
     * Met à jour les informations du college.
     */
    public function update(Request $request, $id)
    {
        $college = Auth::guard('college')->user();

        // Vérifier que l'utilisateur ne modifie que ses propres informations
        if ($college->id != $id) {
            abort(403, 'Accès non autorisé');
        }

        // Validation des données
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'slogan' => 'required|string|max:255',
            'description' => 'nullable|string',
            'website_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'contact_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'expertise_tags' => 'nullable|string',
            'main_innovation' => 'nullable|string',
            'logo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        // Gérer l'upload du logo
        if ($request->hasFile('logo_path')) {
            // Supprimer l'ancien logo s'il existe
            if ($college->logo_path) {
                Storage::delete('public/' . $college->logo_path);
            }

            // Stocker le nouveau logo
            $path = $request->file('logo_path')->store('college-logos', 'public');
            $validated['logo_path'] = $path;
        }

        // Mettre à jour les informations
        $college->update($validated);

        // Rediriger avec message de succès
        return redirect()->route('college.profil', $college->id)
            ->with('success', 'Vos informations ont été mises à jour avec succès.');
    }

    /**
     * Affiche la page des paramètres du compte.
     */
    public function settings($id): View
    {
        $college = Auth::guard('college')->user();

        // Vérifier que l'utilisateur ne visualise que ses propres paramètres
        if ($college->id != $id) {
            abort(403, 'Accès non autorisé');
        }

        return view('college.settings', compact('college'));
    }

    /**
     * Met à jour le mot de passe du college.
     */
    public function updatePassword(Request $request, $id)
    {
        $college = Auth::guard('college')->user();

        // Vérifier que l'utilisateur ne modifie que son propre mot de passe
        if ($college->id != $id) {
            abort(403, 'Accès non autorisé');
        }

        // Validation des données
        $validated = $request->validate([
            'current_password' => [
                'required',
                function ($attribute, $value, $fail) use ($college) {
                    if (!Hash::check($value, $college->password)) {
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
        $college->update([
            'password' => Hash::make($validated['password']),
        ]);

        // Rediriger avec message de succès
        return redirect()->route('college.settings', $college->id)
            ->with('success', 'Votre mot de passe a été changé avec succès.');
    }

    /**
     * Supprime définitivement le compte du college.
     */
    public function deleteAccount(Request $request, $id)
    {
        $college = Auth::guard('college')->user();

        // Vérifier que l'utilisateur ne supprime que son propre compte
        if ($college->id != $id) {
            abort(403, 'Accès non autorisé');
        }

        // Supprimer le logo s'il existe
        if ($college->logo_path) {
            Storage::delete('public/' . $college->logo_path);
        }

        // Supprimer le compte et toutes les données associées
        $college->delete();

        // Déconnecter l'utilisateur
        Auth::guard('college')->logout();

        // Invalider la session
        $request->session()->invalidate();

        // Régénérer le token CSRF
        $request->session()->regenerateToken();

        // Rediriger vers la page d'accueil
        return redirect('/')
            ->with('success', 'Votre compte a été supprimé définitivement.');
    }
}

