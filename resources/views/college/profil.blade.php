@extends('layouts.app-shell-college')

@section('title', 'Profil du College - Club DSI')

<style>
    :root {
        --dsi-blue: #094281;
        --dsi-green: #29963a;
        --light-bg: #f4f7fc;
        --ink: #0e1a2b;
        --muted-ink: #5c6b81;
        --border-color: #e5eaf2;
    }

    body { font-family: 'Inter', sans-serif; background-color: var(--light-bg); }

    .profile-header {
        background: linear-gradient(135deg, #094281 0%, #29963a 100%);
        color: white;
        padding: 3rem 2rem;
        border-radius: 0 0 20px 20px;
    }

    .profile-header h1 {
        font-size: 2.5rem;
        font-weight: 800;
        margin: 0;
    }

    .profile-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 2rem;
    }

    .profile-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .profile-cover {
        position: relative;
        margin: -5rem auto 2rem;
        width: fit-content;
    }

    .profile-picture {
        width: 180px;
        height: 180px;
        border-radius: 50%;
        object-fit: cover;
        border: 6px solid white;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .profile-info {
        text-align: center;
        margin-bottom: 2rem;
    }

    .profile-name {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 0.5rem;
    }

    .profile-entity {
        color: var(--dsi-green);
        font-weight: 600;
        font-size: 1.1rem;
    }

    .section-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--dsi-blue);
        margin-bottom: 1.5rem;
        border-bottom: 3px solid var(--dsi-green);
        padding-bottom: 0.75rem;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .info-item {
        padding: 1.5rem;
        background: var(--light-bg);
        border-radius: 12px;
        border-left: 4px solid var(--dsi-green);
    }

    .info-label {
        font-weight: 600;
        color: var(--muted-ink);
        font-size: 0.9rem;
        text-transform: uppercase;
        margin-bottom: 0.5rem;
    }

    .info-value {
        color: var(--ink);
        font-size: 1.1rem;
        word-break: break-word;
    }

    .info-value a {
        color: var(--dsi-blue);
        text-decoration: none;
    }

    .info-value a:hover {
        text-decoration: underline;
    }

    .badge-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-top: 1rem;
    }

    .badge-tag {
        background: linear-gradient(95deg, var(--dsi-blue), var(--dsi-green));
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .button-group {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        margin-top: 2rem;
        justify-content: center;
    }

    .btn-edit {
        background: linear-gradient(95deg, var(--dsi-blue), var(--dsi-green));
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-edit:hover {
        opacity: 0.9;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(9, 66, 129, 0.2);
        color: white;
    }

    .btn-back {
        background: transparent;
        color: var(--muted-ink);
        border: 1px solid var(--border-color);
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-back:hover {
        background: var(--light-bg);
        color: var(--ink);
        border-color: var(--muted-ink);
    }

    .empty-state {
        text-align: center;
        padding: 2rem;
        color: var(--muted-ink);
    }

    .empty-state i {
        font-size: 3rem;
        color: var(--border-color);
        margin-bottom: 1rem;
    }
</style>

@section('content')
<div class="profile-header">
    <div style="text-align: center;">
        <h1><i class="fas fa-id-card me-3"></i>Profil du College</h1>
    </div>
</div>

<div class="profile-container">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="profile-card">
        <div class="profile-cover">
            @if($college->logo_path)
                <img src="{{ asset('storage/' . $college->logo_path) }}" alt="Logo" class="profile-picture">
            @else
                <div class="profile-picture" style="background: linear-gradient(135deg, #094281, #29963a); display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-building" style="font-size: 4rem; color: white;"></i>
                </div>
            @endif
        </div>

        <div class="profile-info">
            <div class="profile-name">{{ $college->company_name }}</div>
            <div class="profile-entity">College IT</div>
            @if($college->slogan)
                <div style="color: var(--muted-ink); font-size: 1.1rem; margin-top: 0.75rem; font-style: italic;">
                    "{{ $college->slogan }}"
                </div>
            @endif
        </div>

        <div class="button-group">
            <a href="{{ route('college.edit', $college->id) }}" class="btn-edit">
                <i class="fas fa-edit"></i> Modifier mon profil
            </a>
            <a href="{{ route('college.dashboard') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Retour au dashboard
            </a>
        </div>
    </div>

    <!-- Informations Générales -->
    <div class="profile-card">
        <h2 class="section-title">
            <i class="fas fa-information-circle me-2" style="color: var(--dsi-green);"></i> Informations Générales
        </h2>

        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Description</div>
                <div class="info-value">
                    {{ $college->description ?? 'Non spécifiée' }}
                </div>
            </div>

            <div class="info-item">
                <div class="info-label">Site Web</div>
                <div class="info-value">
                    @if($college->website_url)
                        <a href="{{ $college->website_url }}" target="_blank">
                            {{ $college->website_url }} <i class="fas fa-external-link-alt ms-1"></i>
                        </a>
                    @else
                        Non spécifié
                    @endif
                </div>
            </div>

            <div class="info-item">
                <div class="info-label">LinkedIn</div>
                <div class="info-value">
                    @if($college->linkedin_url)
                        <a href="{{ $college->linkedin_url }}" target="_blank">
                            Voir le profil <i class="fab fa-linkedin ms-1"></i>
                        </a>
                    @else
                        Non spécifié
                    @endif
                </div>
            </div>

            <div class="info-item">
                <div class="info-label">Email</div>
                <div class="info-value">
                    <a href="mailto:{{ $college->email }}">{{ $college->email }}</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact -->
    <div class="profile-card">
        <h2 class="section-title">
            <i class="fas fa-user-tie me-2" style="color: var(--dsi-green);"></i> Informations de Contact
        </h2>

        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Nom du Contact</div>
                <div class="info-value">{{ $college->contact_name ?? 'Non spécifié' }}</div>
            </div>
        </div>
    </div>

    <!-- Domaines d'Excellence -->
    @if($college->expertise_tags)
    <div class="profile-card">
        <h2 class="section-title">
            <i class="fas fa-star me-2" style="color: var(--dsi-green);"></i> Domaines d'Excellence
        </h2>

        <div class="badge-tags">
            @foreach(explode(',', $college->expertise_tags) as $tag)
                <span class="badge-tag">{{ trim($tag) }}</span>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Innovation Principale -->
    @if($college->main_innovation)
    <div class="profile-card">
        <h2 class="section-title">
            <i class="fas fa-lightbulb me-2" style="color: var(--dsi-green);"></i> Innovation Principale
        </h2>

        <div class="info-item">
            <div class="info-value">{{ $college->main_innovation }}</div>
        </div>
    </div>
    @endif

    <!-- Types de Contribution -->
    @if($college->contribution_types)
    <div class="profile-card">
        <h2 class="section-title">
            <i class="fas fa-handshake me-2" style="color: var(--dsi-green);"></i> Types de Contribution
        </h2>

        <div class="badge-tags">
            @foreach(is_array($college->contribution_types) ? $college->contribution_types : explode(',', $college->contribution_types) as $contribution)
                <span class="badge-tag">{{ trim($contribution) }}</span>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Besoins en Formation -->
    @if($college->training_needs)
    <div class="profile-card">
        <h2 class="section-title">
            <i class="fas fa-graduation-cap me-2" style="color: var(--dsi-green);"></i> Besoins en Formation
        </h2>

        <div class="badge-tags">
            @foreach(is_array($college->training_needs) ? $college->training_needs : explode(',', $college->training_needs) as $need)
                <span class="badge-tag">{{ trim($need) }}</span>
            @endforeach
        </div>
    </div>
    @endif

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
