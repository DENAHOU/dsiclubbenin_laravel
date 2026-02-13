<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partner;
use App\Models\PartnerFormule;
use App\Mail\PartnerPendingMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\PartnerApprovedMail;
use App\Mail\PartnerRejectedMail;
use App\Models\PressPartner;


class AdminPartnerController extends Controller
{
    /* ===================== PARTENAIRES ===================== */


    public function index()
    {
        $partners = Partner::with(['PartnerType', 'PartnerFormule'])
            ->orderBy('created_at', 'asc')
            ->get();

        return view('admin.partners.index', compact('partners'));
    }


    public function create()
    {
        return view('admin.partners.create');
    }

     public function show($id)
    {
        $partner = Partner::with(['partnerType', 'partnerFormule'])->findOrFail($id);

        return view('admin.partners.show', compact('partner'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
        ]);

        Partner::create($request->all());

        return redirect()
            ->route('admin.partners.index')
            ->with('success', '✅ Partenaire ajouté avec succès');
    }

    public function edit($id)
    {
        $partner = Partner::with(['partnerType', 'partnerFormule'])->findOrFail($id);

        return view('admin.partners.edit', compact('partner'));
    }


    public function update(Request $request, Partner $partner)
    {
        $validated = $request->validate([
            'company_name'        => 'required|string|max:255',
            'domain'              => 'required|string|max:255',
            'manager_name'        => 'required|string|max:255',
            'phone'               => 'required|string|max:20',
            'type'                => 'required|string',
            'formule'             => 'required|string',
            'status'              => 'required|in:pending,approved,rejected',
        ]);

        $partner->update($validated);

        return redirect()
            ->route('admin.partners.index')
            ->with('success', '✏️ Partenaire mis à jour');
    }


    public function destroy($id)
    {
        Partner::findOrFail($id)->delete();

        return back()->with('success', 'Partenaire supprimé.');
    }



    /* ===================== FORMULES PARTENAIRES ===================== */

    public function formules()
    {
        $formules = PartnerFormule::latest()->get();
        return view('admin.partners.formules.index', compact('formules'));
    }

    public function createFormule()
    {
        return view('admin.partners.formules.create');
    }

    public function storeFormule(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        PartnerFormule::create($request->all());

        return redirect()
            ->route('admin.partners.formules')
            ->with('success', '✅ Formule ajoutée avec succès');
    }


    // Modifier formules
    public function editFormule($id)
    {
        $formule = PartnerFormule::findOrFail($id);
        return view('admin.partners.formules.edit', compact('formule'));
    }

    // MIS A JOUR formules
    public function updateFormule(Request $request, $id)
    {
        $formule = PartnerFormule::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'amount' => 'required|numeric',
            'description' => 'nullable',
        ]);

        $formule->update($request->all());

        return redirect()
            ->route('admin.partners.formules')
            ->with('success', '✏️ Formule mise à jour');
    }

    // Supprimer formules
    public function destroyFormule($id)
    {
        PartnerFormule::findOrFail($id)->delete();

        return back()->with('success', '🗑️ Formule supprimée');
    }

    /* ===================== GESTION INSCRIPTIONS PARTENAIRES ===================== */
    public function pending()
    {
        Mail::to($partner->email)->send(new PartnerPendingMail($partner));

        $partners = Partner::where('status', 'pending')->latest()->get();
        return view('admin.partners.pending', compact('partners'));
    }
    public function approve(Partner $partner)
    {
        $partner->update([
            'status' => 'approved',
        ]);

        if ($partner->email) {
            Mail::to($partner->email)->send(
                new PartnerApprovedMail($partner)
            );
        }

        return redirect()
            ->route('admin.partners.index')
            ->with('success', '✅ Partenaire approuvé');
    }

    public function reject(Partner $partner)
    {
        $partner->update([
            'status' => 'rejected',
        ]);

        if ($partner->email) {
            Mail::to($partner->email)->send(
                new PartnerRejectedMail($partner)
            );
        }

        return redirect()
            ->route('admin.partners.index')
            ->with('success', '✅ Partenaire rejeté');
    }

    // PARTENAIRE PRESSE
    public function press()
    {
        $pressPartners = PressPartner::latest()->get();
        return view('admin.partners.press.index', compact('pressPartners'));
    }

    public function createPress()
    {
        return view('admin.partners.press.create');
    }

public function storePress(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'website' => 'nullable|url',
        'logo' => 'nullable|image|max:2048',
        'description' => 'nullable|string',
    ]);

    if ($request->hasFile('logo')) {
        $validated['logo'] = $request->file('logo')->store('press_partners', 'public');
    }

    PressPartner::create($validated);

    return redirect()
        ->route('admin.partners.press')
        ->with('success', '📰 Partenaire presse ajouté avec succès');
}


    public function editPress($id)
    {
        $pressPartner = PressPartner::findOrFail($id);
        return view('admin.partners.press.edit', compact('pressPartner'));
    }

    public function updatePress(Request $request, $id)
    {
        $partner = PressPartner::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'website' => 'nullable|url',
            'logo' => 'nullable|image|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('logo')) {
            if ($partner->logo) {
                Storage::disk('public')->delete($partner->logo);
            }
            $data['logo'] = $request->file('logo')->store('press_partners', 'public');
        }

        $partner->update($data);

        return redirect()->route('admin.partners.press')
            ->with('success', '✏️ Partenaire presse mis à jour');
    }

    public function destroyPress($id)
    {
        $partner = PressPartner::findOrFail($id);

        if ($partner->logo) {
            Storage::disk('public')->delete($partner->logo);
        }

        $partner->delete();

        return back()->with('success', '🗑️ Partenaire presse supprimé');
    }

}

