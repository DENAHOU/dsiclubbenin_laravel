<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\CategoryFormation;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formations = Formation::with('categoryFormation')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.formations.index', compact('formations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CategoryFormation::orderBy('nom')->get();
        return view('admin.formations.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'categorie_formation_id' => 'required|exists:categories_formations,id',
            'description' => 'required|string',
            'type_formation' => 'required|string|in:presentiel,en_ligne',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'date_cloture_inscription' => 'required|date|before_or_equal:date_debut',
            'lieu' => 'nullable|string|required_if:type_formation,presentiel',
            'lien_formation' => 'nullable|string|url',
            'lien_inscription_en_ligne' => 'nullable|string|url',
            'lien_inscription_presentiel' => 'nullable|string|url',
            'prix_en_ligne' => 'nullable|numeric|min:0',
            'prix_presentiel' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url' => 'nullable|string|url',
            'status' => 'required|string|in:actif,inactif',
        ]);

        $data = $request->all();
        
        // Gérer l'upload de l'image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/formations'), $imageName);
            $data['image'] = $imageName;
        }

        Formation::create($data);
        return redirect()->route('admin.formations.index')->with('success', 'Formation créée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $formation = Formation::findOrFail($id);
        $categories = CategoryFormation::orderBy('nom')->get();
        return view('admin.formations.edit', compact('formation', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'categorie_formation_id' => 'required|exists:categories_formations,id',
            'description' => 'required|string',
            'type_formation' => 'required|string|in:presentiel,en_ligne',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'date_cloture_inscription' => 'required|date|before_or_equal:date_debut',
            'lieu' => 'nullable|string|required_if:type_formation,presentiel',
            'lien_formation' => 'nullable|string|url',
            'lien_inscription_en_ligne' => 'nullable|string|url',
            'lien_inscription_presentiel' => 'nullable|string|url',
            'prix_en_ligne' => 'nullable|numeric|min:0',
            'prix_presentiel' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url' => 'nullable|string|url',
            'status' => 'required|string|in:actif,inactif',
        ]);

        $data = $request->all();
        
        $formation = Formation::findOrFail($id);
        
        // Gérer l'upload de l'image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($formation->image && file_exists(public_path('storage/formations/' . $formation->image))) {
                unlink(public_path('storage/formations/' . $formation->image));
            }
            
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/formations'), $imageName);
            $data['image'] = $imageName;
        }

        $formation->update($data);
        return redirect()->route('admin.formations.index')->with('success', 'Formation mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $formation = Formation::findOrFail($id);
        $formation->delete();
        return redirect()->route('admin.formations.index')->with('success', 'Formation supprimée avec succès');
    }

    /**
     * Display formation categories management page.
     */
    public function categories()
    {
        $categories = CategoryFormation::orderBy('nom')->paginate(10);
        return view('admin.formations.categories', compact('categories'));
    }

    /**
     * Store a new formation category.
     */
    public function categoriesStore(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        CategoryFormation::create($request->all());
        return redirect()->route('admin.formations.categories')->with('success', 'Catégorie créée avec succès');
    }

    /**
     * Delete a formation category.
     */
    public function categoriesDelete(string $id)
    {
        $category = CategoryFormation::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.formations.categories')->with('success', 'Catégorie supprimée avec succès');
    }
}
