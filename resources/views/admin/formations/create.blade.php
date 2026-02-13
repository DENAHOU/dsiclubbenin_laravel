@extends('layouts.app-shell-superadmin')

@section('content')
<div class="admin-header">
    <h1>Ajouter une Formation</h1>
    <a href="{{ route('admin.formations.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Retour
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.formations.store') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label for="titre" class="form-label">Titre</label>
                <input type="text" class="form-control @error('titre') is-invalid @enderror" 
                       id="titre" name="titre" value="{{ old('titre') }}" required>
                @error('titre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="categorie_formation_id" class="form-label">Catégorie</label>
                <select class="form-select @error('categorie_formation_id') is-invalid @enderror" 
                        id="categorie_formation_id" name="categorie_formation_id" required>
                    <option value="">Sélectionner une catégorie</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('categorie_formation_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->nom }}
                        </option>
                    @endforeach
                </select>
                @error('categorie_formation_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type_formation" class="form-label">Type de formation</label>
                <select class="form-select @error('type_formation') is-invalid @enderror" 
                        id="type_formation" name="type_formation" required>
                    <option value="">Sélectionner un type</option>
                    <option value="presentiel" {{ old('type_formation') == 'presentiel' ? 'selected' : '' }}>Présentiel</option>
                    <option value="en_ligne" {{ old('type_formation') == 'en_ligne' ? 'selected' : '' }}>En ligne</option>
                </select>
                @error('type_formation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="date_debut" class="form-label">Date de début</label>
                        <input type="date" class="form-control @error('date_debut') is-invalid @enderror" 
                               id="date_debut" name="date_debut" value="{{ old('date_debut') }}" required>
                        @error('date_debut')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="date_fin" class="form-label">Date de fin</label>
                        <input type="date" class="form-control @error('date_fin') is-invalid @enderror" 
                               id="date_fin" name="date_fin" value="{{ old('date_fin') }}" required>
                        @error('date_fin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="date_cloture_inscription" class="form-label">Date de clôture d'inscription</label>
                        <input type="date" class="form-control @error('date_cloture_inscription') is-invalid @enderror" 
                               id="date_cloture_inscription" name="date_cloture_inscription" value="{{ old('date_cloture_inscription') }}" required>
                        @error('date_cloture_inscription')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="lieu" class="form-label">Lieu</label>
                <input type="text" class="form-control @error('lieu') is-invalid @enderror" 
                       id="lieu" name="lieu" value="{{ old('lieu') }}" 
                       placeholder="Obligatoire si présentiel">
                @error('lieu')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="lien_formation" class="form-label">Lien de la formation</label>
                <input type="url" class="form-control @error('lien_formation') is-invalid @enderror" 
                       id="lien_formation" name="lien_formation" value="{{ old('lien_formation') }}" 
                       placeholder="Lien vers la page de la formation">
                @error('lien_formation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Section Inscriptions -->
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-user-plus me-2"></i>Liens d'inscription</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-primary mb-3">Inscription en ligne</h6>
                            
                            <div class="mb-3">
                                <label for="lien_inscription_en_ligne" class="form-label">Lien d'inscription en ligne</label>
                                <input type="url" class="form-control @error('lien_inscription_en_ligne') is-invalid @enderror" 
                                       id="lien_inscription_en_ligne" name="lien_inscription_en_ligne" value="{{ old('lien_inscription_en_ligne') }}" 
                                       placeholder="https://example.com/inscription">
                                @error('lien_inscription_en_ligne')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="prix_en_ligne" class="form-label">Prix en ligne (FCFA)</label>
                                <input type="number" step="0.01" class="form-control @error('prix_en_ligne') is-invalid @enderror" 
                                       id="prix_en_ligne" name="prix_en_ligne" value="{{ old('prix_en_ligne') }}" 
                                       placeholder="0">
                                @error('prix_en_ligne')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <h6 class="text-success mb-3">Inscription présentiel</h6>
                            
                            <div class="mb-3">
                                <label for="lien_inscription_presentiel" class="form-label">Lien d'inscription présentiel</label>
                                <input type="url" class="form-control @error('lien_inscription_presentiel') is-invalid @enderror" 
                                       id="lien_inscription_presentiel" name="lien_inscription_presentiel" value="{{ old('lien_inscription_presentiel') }}" 
                                       placeholder="https://example.com/inscription">
                                @error('lien_inscription_presentiel')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="prix_presentiel" class="form-label">Prix présentiel (FCFA)</label>
                                <input type="number" step="0.01" class="form-control @error('prix_presentiel') is-invalid @enderror" 
                                       id="prix_presentiel" name="prix_presentiel" value="{{ old('prix_presentiel') }}" 
                                       placeholder="0">
                                @error('prix_presentiel')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Média</label>
                <div class="row">
                    <div class="col-md-6">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                               id="image" name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="video_url" class="form-label">URL de la vidéo</label>
                        <input type="url" class="form-control @error('video_url') is-invalid @enderror" 
                               id="video_url" name="video_url" value="{{ old('video_url') }}" 
                               placeholder="https://youtube.com/watch?v=...">
                        @error('video_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <small class="text-muted">Choisissez soit une image soit une vidéo (pas les deux)</small>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Statut</label>
                <select class="form-select @error('status') is-invalid @enderror" 
                        id="status" name="status" required>
                    <option value="">Sélectionner un statut</option>
                    <option value="actif" {{ old('status') == 'actif' ? 'selected' : '' }}>Actif</option>
                    <option value="inactif" {{ old('status') == 'inactif' ? 'selected' : '' }}>Inactif</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Enregistrer
                </button>
                <a href="{{ route('admin.formations.index') }}" class="btn btn-secondary">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
