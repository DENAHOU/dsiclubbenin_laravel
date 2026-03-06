<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use App\Models\CategoryFormation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // À ajouter en haut de votre fichier



class FormationController extends Controller
{
    public function index()
    {
        $formations = Formation::with('categoryFormation')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.formations.index', compact('formations'));
    }

    public function create()
    {
        $categories = CategoryFormation::orderBy('nom')->get();
        return view('admin.formations.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // 1. Validation adaptée aux noms des champs du formulaire (create.blade.php)
        $request->validate([
            'titre'                    => 'required|string|max:255',
            'categorie_formation_id'   => 'required|exists:categories_formations,id',
            'description'              => 'required|string',
            'type_formation'           => 'required|in:en_presentiel,en_ligne',
            'start_date'               => 'required|date',
            'date_fin'                 => 'required|date|after_or_equal:start_date',
            'status'                   => 'required|in:draft,published,archived',
            'lieu'                     => 'nullable|string|required_if:type_formation,en_presentiel',
            'lien_formation'           => 'nullable|url|required_if:type_formation,en_ligne',
            'prix_presentiel'          => 'nullable|numeric|min:0',
            'prix_en_ligne'            => 'nullable|numeric|min:0',
            'image'                    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. Mapping manuel pour correspondre à la Migration (Base de données)
        $data = [
            'titre'                  => $request->titre,
            'description'            => $request->description,
            'categorie_formation_id' => $request->categorie_formation_id,
            'start_date'             => $request->start_date,
            'end_date'               => $request->date_fin,
            'status'                 => $request->status,
            'location'               => $request->lieu,             // lieu -> location
            'online_url'             => $request->lien_formation,   // lien_formation -> online_url
        ];

        // Adaptation de l'ENUM (la migration attend 'presentiel' sans le 'en_')
        $data['type_formation'] = ($request->type_formation === 'en_presentiel') ? 'presentiel' : 'en_ligne';

        // Adaptation du PRIX (la migration n'a qu'une seule colonne 'price')
        $data['price'] = ($request->type_formation === 'en_presentiel')
            ? ($request->prix_presentiel ?? 0)
            : ($request->prix_en_ligne ?? 0);

        // 3. Gestion de l'Image (image -> image_path)
        if ($request->hasFile('image')) {
            // Sauvegarde dans storage/app/public/formations
            $path = $request->file('image')->store('formations', 'public');
            $data['image_path'] = $path;
        }

        // 4. Création en base de données
        Formation::create($data);

        return redirect()->route('admin.formations.index')
            ->with('success', 'Formation créée avec succès');
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
        $formation = Formation::findOrFail($id);

        // 1. Validation alignée sur le formulaire et la migration
        $request->validate([
            'titre'                    => 'required|string|max:255',
            'categorie_formation_id'   => 'required|exists:categories_formations,id',
            'description'              => 'required|string',
            'type_formation'           => 'required|in:en_presentiel,en_ligne',
            'start_date'               => 'required|date',
            'date_fin'                 => 'required|date|after_or_equal:start_date',
            'status'                   => 'required|in:draft,published,archived',
            'lieu'                     => 'nullable|string|required_if:type_formation,en_presentiel',
            'lien_formation'           => 'nullable|url|required_if:type_formation,en_ligne',
            'prix_presentiel'          => 'nullable|numeric|min:0',
            'prix_en_ligne'            => 'nullable|numeric|min:0',
            'image'                    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. Préparation des données (Mapping vers les colonnes de la DB)
        $data = [
            'titre'                  => $request->titre,
            'description'            => $request->description,
            'categorie_formation_id' => $request->categorie_formation_id,
            'start_date'             => $request->start_date,
            'end_date'               => $request->date_fin,
            'status'                 => $request->status,
            'location'               => $request->lieu,
            'online_url'             => $request->lien_formation,
            'type_formation'         => ($request->type_formation === 'en_presentiel') ? 'presentiel' : 'en_ligne',
            'price'                  => ($request->type_formation === 'en_presentiel') 
                                        ? ($request->prix_presentiel ?? 0) 
                                        : ($request->prix_en_ligne ?? 0),
        ];

        // 3. Gestion de l'image (Suppression de l'ancienne et stockage de la nouvelle)
        if ($request->hasFile('image')) {
            // Supprimer l'ancien fichier s'il existe physiquement
            if ($formation->image_path) {
                Storage::disk('public')->delete($formation->image_path);
            }

            // Stocker la nouvelle image
            $data['image_path'] = $request->file('image')->store('formations', 'public');
        }

        // 4. Mise à jour en base de données
        $formation->update($data);

        return redirect()->route('admin.formations.index')
        ->with('success', 'Formation mise à jour avec succès');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $formation = Formation::findOrFail($id);

        // Supprimer l'image du dossier storage si elle existe
        if ($formation->image_path) {
            Storage::disk('public')->delete($formation->image_path);
        }

        // Supprimer la formation de la base de données
        $formation->delete();

        return redirect()->route('admin.formations.index')
            ->with('success', 'Formation supprimée avec succès.');
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




