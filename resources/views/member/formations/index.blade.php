@extends('layouts.app-shell')

@section('title', 'Formations Disponibles')

<style>
    .formation-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border: none;
        overflow: hidden;
    }
    
    .formation-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(9, 66, 129, 0.15);
    }
    
    .formation-image {
        height: 220px;
        object-fit: cover;
        background: linear-gradient(135deg, #f4f7fc 0%, #e5eaf2 100%);
    }
    
    .status-badge {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
    }
    
    .category-badge {
        background-color: rgba(9, 66, 129, 0.1);
        color: var(--dsi-blue);
        font-size: 0.75rem;
        font-weight: 500;
    }
</style>

@section('content')
    <div class="container-fluid py-4">
        <!-- En-tête -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h2 class="mb-1">
                            <i class="fas fa-book text-primary me-2"></i>
                            Formations Disponibles
                        </h2>
                        <p class="text-muted mb-0">Découvrez nos formations pour développer vos compétences</p>
                    </div>
                    
                    <div class="text-end">
                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                            {{ $formations->count() }} formation{{ $formations->count() > 1 ? 's' : '' }} disponible{{ $formations->count() > 1 ? 's' : '' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Liste des formations -->
        @if($formations->count() > 0)
            <div class="row g-4">
                @foreach($formations as $formation)
                    <div class="col-lg-4 col-md-6">
                        <div class="card formation-card h-100">
                            <!-- Image -->
                            @if($formation->image || $formation->video_url)
                                @if($formation->image)
                                    @php
                                        $imagePath = $formation->image;
                                        // Essayer différents chemins possibles
                                        if (!str_starts_with($imagePath, 'http') && !str_starts_with($imagePath, '/')) {
                                            if (file_exists(public_path('storage/' . $imagePath))) {
                                                $imagePath = asset('storage/' . $imagePath);
                                            } elseif (file_exists(public_path('images/' . $imagePath))) {
                                                $imagePath = asset('images/' . $imagePath);
                                            } elseif (file_exists(public_path('img/' . $imagePath))) {
                                                $imagePath = asset('img/' . $imagePath);
                                            } else {
                                                $imagePath = asset($imagePath);
                                            }
                                        }
                                    @endphp
                                    <img src="{{ $imagePath }}" 
                                         class="card-img-top formation-image" 
                                         alt="{{ $formation->titre }}"
                                         onerror="this.src='{{ asset('img/avatar-default.svg') }}'">
                                @elseif($formation->video_url)
                                    <div class="card-img-top formation-image d-flex align-items-center justify-content-center">
                                        <i class="fas fa-play-circle fa-3x text-primary"></i>
                                    </div>
                                @endif
                            @else
                                <div class="card-img-top formation-image d-flex align-items-center justify-content-center">
                                    <i class="fas fa-book fa-3x text-muted"></i>
                                </div>
                            @endif
                            
                            <div class="card-body d-flex flex-column">
                                <!-- Badges -->
                                <div class="mb-3">
                                    @if($formation->categoryFormation)
                                        <span class="badge category-badge me-2">
                                            {{ $formation->categoryFormation->nom }}
                                        </span>
                                    @endif
                                    
                                    <span class="status-badge 
                                        {{ $formation->status == 'actif' ? 'bg-success' : 'bg-secondary' }} text-white">
                                        {{ ucfirst($formation->status) }}
                                    </span>
                                </div>
                                
                                <!-- Titre et description -->
                                <h5 class="card-title fw-bold">{{ $formation->titre }}</h5>
                                <p class="card-text text-muted flex-grow-1">
                                    {{ \Illuminate\Support\Str::limit($formation->description, 120) }}
                                </p>
                                
                                <!-- Informations supplémentaires -->
                                <div class="mb-3">
                                    @if($formation->date_debut)
                                        <small class="text-muted d-block">
                                            <i class="fas fa-calendar me-1"></i>
                                            Début : {{ $formation->date_debut->format('d F Y') }}
                                        </small>
                                    @endif
                                    
                                    @if($formation->lieu)
                                        <small class="text-muted d-block">
                                            <i class="fas fa-map-marker-alt me-1"></i>
                                            {{ $formation->lieu }}
                                        </small>
                                    @endif
                                    
                                    @if($formation->prix_en_ligne || $formation->prix_presentiel)
                                        <small class="text-muted d-block">
                                            <i class="fas fa-tag me-1"></i>
                                            @if($formation->prix_en_ligne)
                                                En ligne : {{ number_format($formation->prix_en_ligne, 0, ',', ' ') }} FCFA
                                            @endif
                                            @if($formation->prix_en_ligne && $formation->prix_presentiel) | @endif
                                            @if($formation->prix_presentiel)
                                                Présentiel : {{ number_format($formation->prix_presentiel, 0, ',', ' ') }} FCFA
                                            @endif
                                        </small>
                                    @endif
                                </div>
                                
                                <!-- Boutons d'action -->
                                <div class="mt-auto d-flex gap-2">
                                    <a href="{{ route('member.formations.show', $formation->id) }}" 
                                       class="btn btn-outline-primary btn-sm flex-grow-1">
                                        <i class="fas fa-eye me-1"></i>
                                        Détails
                                    </a>
                                    
                                    @if($formation->lien_inscription_en_ligne || $formation->lien_inscription_presentiel)
                                        <a href="{{ $formation->lien_inscription_en_ligne ?: $formation->lien_inscription_presentiel }}" 
                                           class="btn btn-primary btn-sm" 
                                           target="_blank">
                                            <i class="fas fa-external-link-alt me-1"></i>
                                            S'inscrire
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-book fa-4x text-muted mb-4"></i>
                <h3 class="text-muted mb-3">Aucune formation disponible</h3>
                <p class="text-muted">Revenez bientôt pour découvrir nos nouvelles formations !</p>
            </div>
        @endif
    </div>
@endsection
