@extends('layouts.app-shell-partner')

@section('content')
<div class="container-fluid">
    
    {{-- Alertes dynamiques (succès, erreur, etc.) --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Statistiques et Aperçus Rapides --}}
    <div class="row g-4 mb-5">
        <div class="col-md-6 col-lg-3">
            <div class="card shadow-sm border-0 h-100 animate__animated animate__fadeInUp">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title text-muted mb-0">Statut du Partenariat</h5>
                        <i class="fas fa-clipboard-check text-dsi-blue fa-2x"></i>
                    </div>
                    <p class="card-text fs-4 fw-bold text-dsi-green">Actif</p>
                    <small class="text-muted">Depuis le {{ Auth::guard('partner')->user()->created_at->format('d/m/Y') }}</small>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card shadow-sm border-0 h-100 animate__animated animate__fadeInUp animate__delay-0-1s">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title text-muted mb-0">Compétences Enregistrées</h5>
                        <i class="fas fa-cubes text-dsi-blue fa-2x"></i>
                    </div>
                    {{-- Supposons que vous ayez une relation pour les compétences dans le modèle Partner --}}
                    {{-- <p class="card-text fs-4 fw-bold text-dsi-blue">{{ Auth::guard('partner')->user()->skills->count() ?? 0 }}</p>
                    <small class="text-muted">Dernière mise à jour : {{ Auth::guard('partner')->user()->updated_at->format('d/m/Y') }}</small> --}}
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card shadow-sm border-0 h-100 animate__animated animate__fadeInUp animate__delay-0-2s">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title text-muted mb-0">Documents Partagés</h5>
                        <i class="fas fa-file-alt text-dsi-blue fa-2x"></i>
                    </div>
                     {{-- Supposons que vous ayez une relation pour les documents dans le modèle Partner --}}
                    <p class="card-text fs-4 fw-bold text-dsi-blue"></p>
                    <small class="text-muted">Documents importants</small>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card shadow-sm border-0 h-100 animate__animated animate__fadeInUp animate__delay-0-3s">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title text-muted mb-0">Prochains Événements</h5>
                        <i class="fas fa-calendar-alt text-dsi-blue fa-2x"></i>
                    </div>
                    {{-- Ici vous afficherez le nombre d'événements à venir --}}
                    <p class="card-text fs-4 fw-bold text-dsi-blue">3</p>
                    <small class="text-muted">À ne pas manquer !</small>
                </div>
            </div>
        </div>
    </div>

    {{-- Section Actions Rapides --}}
    <h3 class="mb-4 text-dsi-blue fw-bold">Actions Rapides</h3>
    <div class="row g-4 mb-5">
        <div class="col-lg-4 col-md-6">
            <div class="card action-card border-0 shadow-sm animate__animated animate__zoomIn">
                <div class="card-body text-center">
                    <i class="fas fa-user-edit fa-3x text-dsi-green mb-3"></i>
                    <h5 class="card-title fw-bold">Mettre à Jour Mon Profil</h5>
                    <p class="card-text text-muted">Gardez vos informations à jour pour ne rien manquer.</p>
                    <a href="{{ route('partner.profile.edit') }}" class="btn btn-primary btn-sm btn-action">Accéder <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card action-card border-0 shadow-sm animate__animated animate__zoomIn animate__delay-0-1s">
                <div class="card-body text-center">
                    <i class="fas fa-file-upload fa-3x text-dsi-green mb-3"></i>
                    <h5 class="card-title fw-bold">Gérer Mes Documents</h5>
                    <p class="card-text text-muted">Consultez et téléchargez vos documents clés.</p>
                    <a href="{{ route('partner.documents.index') }}" class="btn btn-primary btn-sm btn-action">Accéder <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card action-card border-0 shadow-sm animate__animated animate__zoomIn animate__delay-0-2s">
                <div class="card-body text-center">
                    <i class="fas fa-brain fa-3x text-dsi-green mb-3"></i>
                    <h5 class="card-title fw-bold">Mes Compétences</h5>
                    <p class="card-text text-muted">Définissez et mettez à jour votre expertise.</p>
                    <a href="#" class="btn btn-primary btn-sm btn-action">Accéder <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </div>

    {{-- Section des dernières activités ou actualités --}}
    <h3 class="mb-4 text-dsi-blue fw-bold">Dernières Activités & Annonces</h3>
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4 h-100 animate__animated animate__fadeInLeft">
                <h4 class="card-title fw-bold text-dsi-blue mb-4">Actualités du Club</h4>
                <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-1 fw-bold text-ink">Nouvel appel à projets "Innovation Numérique"</p>
                            <small class="text-muted">Il y a 2 jours</small>
                        </div>
                        <i class="fas fa-arrow-right text-dsi-green"></i>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-1 fw-bold text-ink">Rappel : Soirée de Gala DSI le 15 Septembre</p>
                            <small class="text-muted">Il y a 1 semaine</small>
                        </div>
                        <i class="fas fa-arrow-right text-dsi-green"></i>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-1 fw-bold text-ink">Bilan du trimestre : Forte croissance du réseau !</p>
                            <small class="text-muted">Il y a 3 semaines</small>
                        </div>
                        <i class="fas fa-arrow-right text-dsi-green"></i>
                    </a>
                </div>
                <div class="text-center mt-4">
                    <a href="#" class="btn btn-outline-secondary btn-sm">Voir toutes les actualités</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-4 h-100 animate__animated animate__fadeInRight">
                <h4 class="card-title fw-bold text-dsi-blue mb-4">Ressources Utiles</h4>
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <a href="#" class="text-decoration-none text-ink d-flex align-items-center fw-medium">
                            <i class="fas fa-book-open me-2 text-dsi-green"></i> Guide du Partenaire 2024
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="text-decoration-none text-ink d-flex align-items-center fw-medium">
                            <i class="fas fa-headset me-2 text-dsi-green"></i> Support Technique
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="text-decoration-none text-ink d-flex align-items-center fw-medium">
                            <i class="fas fa-users me-2 text-dsi-green"></i> Forum Communautaire
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>
@endsection

@push('styles')
{{-- Animate.css pour des animations subtiles (facultatif mais donne un bel effet) --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<style>
    /* Styles spécifiques au tableau de bord */
    .text-dsi-blue { color: var(--dsi-blue); }
    .text-dsi-green { color: var(--dsi-green); }
    .btn-primary { background-color: var(--dsi-blue); border-color: var(--dsi-blue); }
    .btn-primary:hover { background-color: #063261; border-color: #063261; }
    .card {
        border-radius: 15px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    .action-card .card-body {
        padding: 2.5rem 1.5rem;
    }
    .action-card i {
        color: var(--dsi-green);
        transition: transform 0.3s ease;
    }
    .action-card:hover i {
        transform: scale(1.1);
    }
    .list-group-item {
        border-color: #e5eaf2;
        padding-top: 1rem;
        padding-bottom: 1rem;
    }
    .list-group-item:last-child {
        border-bottom: none;
    }
    .list-group-item:hover {
        background-color: var(--light-bg);
    }
    .list-group-item .fa-arrow-right {
        opacity: 0;
        transform: translateX(-5px);
        transition: opacity 0.3s ease, transform 0.3s ease;
    }
    .list-group-item:hover .fa-arrow-right {
        opacity: 1;
        transform: translateX(0);
    }
</style>
@endpush
