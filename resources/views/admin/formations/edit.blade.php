@extends('layouts.app-shell-superadmin')

@section('title', 'Modifier la Formation')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold mb-0">Modifier la Formation</h1>
            <p class="text-muted">{{ $formation->titre }}</p>
        </div>
        <a href="{{ route('admin.formations.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Annuler
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.formations.update', $formation->id) }}" method="POST" enctype="multipart/form-data" class="row g-3">
                @csrf
                @method('PUT')
                
                <!-- Colonne Principale -->
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre *</label>
                        <input type="text" name="titre" id="titre" class="form-control" value="{{ old('titre', $formation->titre) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description *</label>
                        <textarea name="description" id="description" class="form-control" rows="8" required>{{ old('description', $formation->description) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="lieu" class="form-label">Lieu (Location DB)</label>
                            <input type="text" name="lieu" id="lieu" class="form-control" value="{{ old('lieu', $formation->location) }}">
                        </div>
                        <div class="col-md-6">
                            <label for="lien_formation" class="form-label">Lien (Online URL DB)</label>
                            <input type="url" name="lien_formation" id="lien_formation" class="form-control" value="{{ old('lien_formation', $formation->online_url) }}">
                        </div>
                    </div>
                </div>

                <!-- Colonne Latérale -->
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="status" class="form-label">Statut</label>
                        <select name="status" id="status" class="form-select">
                            <option value="draft" @selected(old('status', $formation->status) == 'draft')>Brouillon</option>
                            <option value="published" @selected(old('status', $formation->status) == 'published')>Publiée</option>
                            <option value="archived" @selected(old('status', $formation->status) == 'archived')>Archivée</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="type_formation" class="form-label">Type *</label>
                        <select name="type_formation" id="type_formation" class="form-select" required>
                            {{-- On compare avec 'presentiel' car c'est ce qui est stocké en DB (Enum) --}}
                            <option value="en_presentiel" @selected(old('type_formation', $formation->type_formation) == 'presentiel')>En Présentiel</option>
                            <option value="en_ligne" @selected(old('type_formation', $formation->type_formation) == 'en_ligne')>En Ligne</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="categorie_formation_id" class="form-label">Catégorie *</label>
                        <select name="categorie_formation_id" id="categorie_formation_id" class="form-select" required>
                            <option value="">Choisir...</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" @selected(old('categorie_formation_id', $formation->categorie_formation_id) == $cat->id)>
                                    {{ $cat->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="start_date" class="form-label">Date de début *</label>
                        <input type="datetime-local" name="start_date" id="start_date" class="form-control" 
                               value="{{ old('start_date', $formation->start_date ? \Carbon\Carbon::parse($formation->start_date)->format('Y-m-d\TH:i') : '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="date_fin" class="form-label">Date de fin *</label>
                        <input type="datetime-local" name="date_fin" id="date_fin" class="form-control" 
                               value="{{ old('date_fin', $formation->end_date ? \Carbon\Carbon::parse($formation->end_date)->format('Y-m-d\TH:i') : '') }}" required>
                    </div>

                    {{-- On affiche le prix unique de la DB dans les deux champs selon le type --}}
                    <div class="mb-3">
                        <label for="prix_presentiel" class="form-label">Prix (Présentiel)</label>
                        <input type="number" name="prix_presentiel" id="prix_presentiel" class="form-control" 
                               value="{{ old('prix_presentiel', $formation->type_formation == 'presentiel' ? $formation->price : 0) }}">
                    </div>

                    <div class="mb-3">
                        <label for="prix_en_ligne" class="form-label">Prix (En Ligne)</label>
                        <input type="number" name="prix_en_ligne" id="prix_en_ligne" class="form-control" 
                               value="{{ old('prix_en_ligne', $formation->type_formation == 'en_ligne' ? $formation->price : 0) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label d-block">Image actuelle</label>
                        @if($formation->image_path)
                            <img src="{{ asset('storage/' . $formation->image_path) }}" class="img-thumbnail mb-2" style="max-height: 100px;">
                        @endif
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                </div>

                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary px-4">Mettre à jour la Formation</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
