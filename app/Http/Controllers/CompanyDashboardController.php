<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class CompanyDashboardController extends Controller
{
    /**
     * Display the company dashboard with subscription statistics.
     */
    public function index()
    {
        $company = Auth::guard('company')->user();

        if (!$company) {
            return redirect()->route('login');
        }

        $stats = $this->getSubscriptionStats($company);
        $userType = 'company';

        return view('company.dashbord', [
            'company' => $company,
            'stats' => $stats,
            'userType' => $userType,
        ]);
    }

    /**
     * Display the company profile.
     */
    public function show($id)
    {
        $company = Company::findOrFail($id);

        // Ensure the authenticated user is the owner
        if (Auth::guard('company')->id() !== $company->id) {
            abort(403);
        }

        return view('company.profil', [
            'company' => $company,
        ]);
    }

    /**
     * Show the edit form for the company profile.
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);

        // Ensure the authenticated user is the owner
        if (Auth::guard('company')->id() !== $company->id) {
            abort(403);
        }

        return view('company.edit', [
            'company' => $company,
        ]);
    }

    /**
     * Update the company profile.
     */
    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        // Ensure the authenticated user is the owner
        if (Auth::guard('company')->id() !== $company->id) {
            abort(403);
        }

        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'slogan' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'sector' => 'nullable|string|max:255',
            'website' => 'nullable|url',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'contact_principal_name' => 'nullable|string|max:255',
            'contact_principal_position' => 'nullable|string|max:255',
            'contact_principal_email' => 'nullable|email|max:255',
            'contact_principal_phone' => 'nullable|string|max:20',
            'domains_of_excellence' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if it exists
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }

            // Store new logo
            $logoPath = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $logoPath;
        }

        $company->update($validated);

        return redirect()
            ->route('company.profil', $company->id)
            ->with('success', 'Profil mis à jour avec succès!');
    }

    /**
     * Display the settings page.
     */
    public function settings($id)
    {
        $company = Company::findOrFail($id);

        // Ensure the authenticated user is the owner
        if (Auth::guard('company')->id() !== $company->id) {
            abort(403);
        }

        return view('company.settings', [
            'company' => $company,
        ]);
    }

    /**
     * Update the company password.
     */
    public function updatePassword(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        // Ensure the authenticated user is the owner
        if (Auth::guard('company')->id() !== $company->id) {
            abort(403);
        }

        $validated = $request->validate([
            'current_password' => [
                'required',
                function ($attribute, $value, $fail) use ($company) {
                    if (!Hash::check($value, $company->password)) {
                        $fail('Le mot de passe actuel est incorrect.');
                    }
                },
            ],
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        $company->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route('company.settings', $company->id)
            ->with('success', 'Mot de passe mis à jour avec succès!');
    }

    /**
     * Delete the company account.
     */
    public function deleteAccount(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        // Ensure the authenticated user is the owner
        if (Auth::guard('company')->id() !== $company->id) {
            abort(403);
        }

        // Delete logo if it exists
        if ($company->logo) {
            Storage::disk('public')->delete($company->logo);
        }

        // Delete the company
        $company->delete();

        // Log out the user
        Auth::guard('company')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('message', 'Votre compte a été supprimé avec succès.');
    }

    /**
     * Get subscription statistics for the company.
     */
    private function getSubscriptionStats($company)
    {
        $payments = $company->membershipPayments()
            ->with('payable')
            ->get();

        $paid = $payments->where('status', 'paid')->count();
        $pending = $payments->where('status', 'pending')->count();

        $lastDue = $payments
            ->where('status', 'paid')
            ->sortByDesc('due_date')
            ->first();

        $nextDue = $payments
            ->where('status', 'pending')
            ->sortBy('due_date')
            ->first();

        $overdue = $payments
            ->where('status', 'pending')
            ->filter(function ($payment) {
                return Carbon::parse($payment->due_date)->isPast();
            })
            ->count();

        return [
            'paid' => $paid,
            'pending' => $pending,
            'lastDueDate' => $lastDue?->due_date ? Carbon::parse($lastDue->due_date)->format('d/m/Y') : 'N/A',
            'nextDueDate' => $nextDue?->due_date ? Carbon::parse($nextDue->due_date)->format('d/m/Y') : 'N/A',
            'overdue' => $overdue,
        ];
    }
}
