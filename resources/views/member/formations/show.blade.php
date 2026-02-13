@extends('layouts.app-shell')

@section('title', 'Détails de la formation')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Accueil</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('member.formations.index') }}">Formations</a>
                    </li>
                    <li class="breadcrumb-item active">{{ $formation->titre }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
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
                         class="card-img-top" 
                         style="height: 400px; object-fit: cover;"
                         alt="{{ $formation->titre }}"
                         onerror="this.src='{{ asset('img/avatar-default.svg') }}'">
                @else
                    <div class="card-img-top d-flex align-items-center justify-content-center bg-light" 
                         style="height: 400px;">
                        <i class="fas fa-book fa-5x text-muted"></i>
                    </div>
                @endif
                
                <div class="card-body">
                    <div class="mb-3">
                        @if($formation->categoryFormation)
                            <span class="badge bg-primary bg-opacity-10 text-primary me-2">
                                {{ $formation->categoryFormation->nom }}
                            </span>
                        @endif
                        
                        <span class="badge {{ $formation->status == 'actif' ? 'bg-success' : 'bg-secondary' }}">
                            {{ $formation->status }}
                        </span>
                    </div>
                    
                    <h1 class="card-title h2 mb-4">{{ $formation->titre }}</h1>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p class="mb-2">
                                <strong><i class="fas fa-calendar me-2"></i>Date de début :</strong>
                                {{ $formation->date_debut ? $formation->date_debut->format('d/m/Y') : 'Date à définir' }}
                            </p>
                            <p class="mb-2">
                                <strong><i class="fas fa-clock me-2"></i>Durée :</strong>
                                {{ $formation->duree ?? 'Non spécifiée' }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2">
                                <strong><i class="fas fa-map-marker-alt me-2"></i>Lieu :</strong>
                                {{ $formation->lieu ?? 'En ligne' }}
                            </p>
                            <p class="mb-2">
                                <strong><i class="fas fa-tag me-2"></i>Prix :</strong>
                                {{ $formation->prix ? number_format($formation->prix, 0, ',', ' ') . ' FCFA' : 'Gratuit' }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h4>Description</h4>
                        <div class="text-muted">
                            {!! nl2br(e($formation->description)) !!}
                        </div>
                    </div>
                    
                    @if($formation->objectifs)
                        <div class="mb-4">
                            <h4>Objectifs</h4>
                            <div class="text-muted">
                                {!! nl2br(e($formation->objectifs)) !!}
                            </div>
                        </div>
                    @endif
                    
                    @if($formation->prerequis)
                        <div class="mb-4">
                            <h4>Prérequis</h4>
                            <div class="text-muted">
                                {!! nl2br(e($formation->prerequis)) !!}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title mb-4">Inscription</h5>
                    
                    @if($formation->lien_inscription_en_ligne || $formation->lien_inscription_presentiel)
                        <div class="d-grid gap-2">
                            @if($formation->lien_inscription_en_ligne)
                                <a href="{{ $formation->lien_inscription_en_ligne }}" 
                                   class="btn btn-primary" 
                                   target="_blank">
                                    <i class="fas fa-laptop me-2"></i>
                                    S'inscrire en ligne
                                </a>
                            @endif
                            
                            @if($formation->lien_inscription_presentiel)
                                <a href="{{ $formation->lien_inscription_presentiel }}" 
                                   class="btn btn-outline-primary" 
                                   target="_blank">
                                    <i class="fas fa-users me-2"></i>
                                    S'inscrire en présentiel
                                </a>
                            @endif
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Les inscriptions ne sont pas encore ouvertes pour cette formation.
                        </div>
                    @endif
                    
                    <hr>
                    
                    <div class="small text-muted">
                        <p class="mb-2">
                            <strong>Contact :</strong><br>
                            {{ $formation->contact ?? 'contact@club-dsi.com' }}
                        </p>
                        
                        @if($formation->date_fin)
                            <p class="mb-0">
                                <strong>Date de fin :</strong><br>
                                {{ $formation->date_fin->format('d/m/Y') }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="card shadow-sm border-0 mt-3">
                <div class="card-body">
                    <h6 class="card-title mb-3">Partager cette formation</h6>
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-outline-primary" onclick="shareOnFacebook()">
                            <i class="fab fa-facebook-f"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-info" onclick="shareOnTwitter()">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-success" onclick="shareOnWhatsApp()">
                            <i class="fab fa-whatsapp"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-secondary" onclick="copyLink()">
                            <i class="fas fa-link"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function shareOnFacebook() {
    window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(window.location.href)}`, '_blank');
}

function shareOnTwitter() {
    window.open(`https://twitter.com/intent/tweet?text=${encodeURIComponent(document.title)}&url=${encodeURIComponent(window.location.href)}`, '_blank');
}

function shareOnWhatsApp() {
    window.open(`https://wa.me/?text=${encodeURIComponent(document.title + ' ' + window.location.href)}`, '_blank');
}

function copyLink() {
    navigator.clipboard.writeText(window.location.href);
    alert('Lien copié dans le presse-papiers !');
}
</script>

@endsection
