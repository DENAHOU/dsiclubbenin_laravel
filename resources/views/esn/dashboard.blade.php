@extends('layouts.app-shell-esn')

@section('title', 'Tableau de Bord ESN')

@section('content')

    {{-- Message de bienvenue personnalisé --}}
    <div class="alert-custom success" role="alert">
        <i class="fas fa-check-circle"></i>
        Bienvenue sur votre Tableau de Bord, **{{ $esn->company_name }}** ! Accédez rapidement à vos informations clés.
        <a href="{{ route('esn.profile.show') }}" class="alert-link">Voir mon profil ESN <i class="fas fa-arrow-right ms-2"></i></a>
    </div>

    {{-- Annonces défilantes (conservées car elles sont informatives et dynamiques) --}}
    <div class="scrolling-announcement">
        <span class="content">
            <i class="fas fa-bullhorn me-2"></i> Annonce importante : Le prochain événement "Tech Connect" aura lieu le 15 Octobre. Inscrivez-vous dès maintenant !
            <span style="margin: 0 40px;"></span>
            <i class="fas fa-star me-2"></i> Nouveauté : Découvrez les dernières ressources ajoutées à la bibliothèque du Club DSI.
        </span>
    </div>

    {{-- Section des Informations Clés de l'ESN (inspirée de l'ancien code, design amélioré) --}}
    <div class="row">
        {{-- Card: Date de Création --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card blue">
                <div class="icon-wrapper">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="content">
                    <div class="label">Date de Création</div>
                    <div class="value">
                        {{ $esn->creation_date ? $esn->creation_date->format('d M Y') : 'N/A' }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Card: Type d'Entreprise --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card green">
                <div class="icon-wrapper">
                    <i class="fas fa-building"></i>
                </div>
                <div class="content">
                    <div class="label">Type d'Entreprise</div>
                    <div class="value">
                         {{ $esn->esn_type ?? 'Non spécifié' }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Card: Revenu Annuel --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card purple">
                <div class="icon-wrapper">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="content">
                    <div class="label">Chiffre d'Affaires</div> {{-- Renommé pour correspondre à 'turnover' --}}
                    <div class="value">
                        {{ $esn->turnover ?? 'N/A' }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Card: Années d'Expérience --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card orange">
                <div class="icon-wrapper">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="content">
                    <div class="label">Années d'Expérience</div>
                    <div class="value">
                        {{ $esn->experience_years ?? 'N/A' }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Section des Actions Rapides (exemple, vous pouvez en ajouter d'autres) --}}
    <div class="card-modern">
        <div class="card-header-modern">
            <h2 class="card-title-modern">Actions Rapides</h2>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <a href="{{ route('esn.profile.edit') }}" class="btn btn-primary-modern w-100"><i class="fas fa-edit me-2"></i> Mettre à jour mon profil</a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="#" class="btn btn-outline-secondary-modern w-100"><i class="fas fa-comments me-2"></i> Accéder à la messagerie</a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="#" class="btn btn-outline-secondary-modern w-100"><i class="fas fa-bell me-2"></i> Voir les notifications</a>
            </div>
        </div>
    </div>

    {{-- Section des Dernières Annonces ou Nouvelles du Club DSI (Tableau Moderne) --}}
    <div class="card-modern">
        <div class="card-header-modern">
            <h2 class="card-title-modern">Dernières Annonces du Club DSI</h2>
            <a href="#" class="btn btn-outline-secondary-modern btn-sm">Voir tout <i class="fas fa-arrow-right ms-2"></i></a>
        </div>
        <div class="table-responsive">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Exemple de données, à remplacer par une boucle @foreach de vos données réelles --}}
                    <tr>
                        <td>Assemblée Générale Extraordinaire</td>
                        <td>10/09/2024</td>
                        <td><span class="badge bg-success">Publié</span></td>
                        <td><a href="#" class="btn btn-sm btn-primary-modern">Détails</a></td>
                    </tr>
                    <tr>
                        <td>Appel à Projets DSI Innovation</td>
                        <td>01/09/2024</td>
                        <td><span class="badge bg-info text-dark">En cours</span></td>
                        <td><a href="#" class="btn btn-sm btn-primary-modern">Détails</a></td>
                    </tr>
                     <tr>
                        <td>Webinar: Cybersécurité pour PME</td>
                        <td>25/08/2024</td>
                        <td><span class="badge bg-secondary">Archivé</span></td>
                        <td><a href="#" class="btn btn-sm btn-outline-secondary-modern">Consulter</a></td>
                    </tr>
                    {{-- Fin de l'exemple --}}
                </tbody>
            </table>
        </div>
    </div>



@endsection
