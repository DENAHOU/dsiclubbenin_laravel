@extends('layouts.app-shell-superadmin')

@section('title', 'Ajouter une Formation')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold mb-0">Créer une Nouvelle Formation</h1>
            <p class="text-muted">Remplissez les détails ci-dessous.</p>
        </div>
        <a href="{{ route('admin.formations.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Retour à la liste
        </a>
    </div>

    {{-- Affichage des erreurs globales --}}
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
            <form action="{{ route('admin.formations.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                @csrf

                <!-- Colonne Principale -->
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre de la formation *</label>
                        <input type="text" name="titre" id="titre" class="form-control @error('titre') is-invalid @enderror" value="{{ old('titre') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description complète *</label>
                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="8" required>{{ old('description') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="lieu" class="form-label">Lieu (si présentiel)</label>
                            <input type="text" name="lieu" id="lieu" class="form-control" value="{{ old('lieu') }}">
                        </div>
                        <div class="col-md-6">
                            <label for="lien_formation" class="form-label">Lien de la formation (si en ligne)</label>
                            <input type="url" name="lien_formation" id="lien_formation" class="form-control" value="{{ old('lien_formation') }}">
                        </div>
                    </div>
                </div>

                <!-- Colonne Latérale -->
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="status" class="form-label">Statut</label>
                        <select name="status" id="status" class="form-select">
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Brouillon</option>
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Publiée</option>
                            <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archivée</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="type_formation" class="form-label">Type de formation *</label>
                        <select name="type_formation" id="type_formation" class="form-select" required>
                            <option value="en_presentiel" {{ old('type_formation') == 'en_presentiel' ? 'selected' : '' }}>En Présentiel</option>
                            <option value="en_ligne" {{ old('type_formation') == 'en_ligne' ? 'selected' : '' }}>En Ligne</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="categorie_formation_id" class="form-label">Catégorie *</label>
                        <select name="categorie_formation_id" id="categorie_formation_id" class="form-select" required>
                            <option value="" disabled selected>Choisir...</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('categorie_formation_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- NOTE: registration_deadline n'est pas dans votre migration, mais validé dans le controller --}}
                    <div class="mb-3">
                        <label for="date_cloture_inscription" class="form-label">Clôture inscriptions *</label>
                        <input type="datetime-local" name="date_cloture_inscription" id="date_cloture_inscription" class="form-control" value="{{ old('date_cloture_inscription') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="start_date" class="form-label">Date de début *</label>
                        <input type="datetime-local" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="date_fin" class="form-label">Date de fin *</label>
                        <input type="datetime-local" name="date_fin" id="date_fin" class="form-control" value="{{ old('date_fin') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="prix_presentiel" class="form-label">Prix (Présentiel)</label>
                        <input type="number" name="prix_presentiel" id="prix_presentiel" class="form-control" value="{{ old('prix_presentiel', 0) }}">
                    </div>

                    <div class="mb-3">
                        <label for="prix_en_ligne" class="form-label">Prix (En Ligne)</label>
                        <input type="number" name="prix_en_ligne" id="prix_en_ligne" class="form-control" value="{{ old('prix_en_ligne', 0) }}">
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image d'illustration</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                </div>

                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary px-4">Enregistrer la Formation</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
