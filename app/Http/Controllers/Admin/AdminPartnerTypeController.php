<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PartnerType;
use Illuminate\Http\Request;

class AdminPartnerTypeController extends Controller
{
    // 📄 Liste des types
    public function index()
    {
        $types = PartnerType::latest()->get();
        return view('admin.partners.types.index', compact('types'));
    }

    // ➕ Formulaire création
    public function create()
    {
        return view('admin.partners.types.create');
    }

    // 💾 Enregistrement
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        PartnerType::create($request->only('name'));

        return redirect()
            ->route('admin.partners.types')
            ->with('success', '✅ Type de partenaire ajouté avec succès');
    }

    // ✏️ Formulaire édition
    public function edit($id)
    {
        $type = PartnerType::findOrFail($id);
        return view('admin.partners.types.edit', compact('type'));
    }

    // 🔄 Mise à jour
    public function update(Request $request, $id)
    {
        $type = PartnerType::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $type->update($request->only('name', 'description'));

        return redirect()
            ->route('admin.partners.types')
            ->with('success', '✅ Type modifié avec succès');
    }

    // 🗑️ Suppression
    public function destroy($id)
    {
        PartnerType::findOrFail($id)->delete();

        return redirect()
            ->route('admin.partners.types')
            ->with('success', '🗑️ Type supprimé');
    }
}
