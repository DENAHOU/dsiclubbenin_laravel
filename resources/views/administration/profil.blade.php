@extends('layouts.app-shell-admin')

@section('title', 'Mon Profil - Administration Publique')

<style>
    :root {
        --dsi-blue: #094281;
        --dsi-green: #29963a;
        --light-bg: #f4f7fc;
        --ink: #0e1a2b;
        --muted-ink: #5c6b81;
        --border-color: #e5eaf2;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--light-bg);
    }

    .navbar {
        background: linear-gradient(180deg, #f6f7f8 0%, #fafcfc 100%);
        width: 100%;
    }

    .profile-container {
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        max-width: 1000px;
        margin: 0 auto;
        overflow: hidden;
    }

    .profile-header {
        background: linear-gradient(135deg, #094281 0%, #29963a 100%);
        padding: 1.5rem 2rem;
        text-align: center;
        color: white;
    }

    .profile-picture {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid white;
        margin-bottom: 0.75rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .profile-header h2 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }

    .profile-header p {
        font-size: 0.95rem;
        opacity: 0.9;
    }

    .profile-content {
        padding: 3rem 2rem;
    }

    .info-section {
        margin-bottom: 3rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid var(--border-color);
    }

    .info-section:last-of-type {
        border-bottom: none;
    }

    .section-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--dsi-blue);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .section-title i {
        color: var(--dsi-green);
        font-size: 1.5rem;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
    }

    .info-item {
        background-color: var(--light-bg);
        padding: 1.5rem;
        border-radius: 8px;
        border-left: 4px solid var(--dsi-green);
    }

    .info-label {
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        color: var(--muted-ink);
        margin-bottom: 0.5rem;
        letter-spacing: 0.5px;
    }

    .info-value {
        font-size: 1rem;
        color: var(--ink);
        font-weight: 500;
        word-break: break-word;
    }

    .info-value.link {
        color: var(--dsi-blue);
        text-decoration: none;
    }

    .info-value.link:hover {
        text-decoration: underline;
    }

    .button-container {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid var(--border-color);
    }

    .btn-edit {
        background: linear-gradient(95deg, var(--dsi-blue), var(--dsi-green));
        color: white;
        border: none;
        padding: 0.85rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-edit:hover {
        opacity: 0.9;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(9, 66, 129, 0.2);
        color: white;
    }

    .btn-back {
        background-color: transparent;
        color: var(--dsi-blue);
        border: 2px solid var(--dsi-blue);
        padding: 0.85rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-back:hover {
        background-color: var(--dsi-blue);
        color: white;
    }

    .empty-value {
        color: var(--muted-ink);
        font-style: italic;
    }
</style>

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light sticky-top" style="background: linear-gradient(180deg, #f6f7f8 0%, #fafcfc 100%); box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <div class="container-fluid px-4">
            <a class="fw-bold" href="#" style="color: #094281; font-size: 1.3rem; text-decoration: none; font-weight: bold;">
                <i class="fas fa-briefcase me-2" style="color: #094281;"></i> Club DSI - Mon Profil
            </a>
        </div>
    </nav>

    <div class="container-fluid mt-4 mb-4">
        <div class="profile-container">

            {{-- En-tête du profil --}}
            <div class="profile-header">
                <img src="{{ Auth::guard('administration')->user()->logo_path ? asset('storage/' . Auth::guard('administration')->user()->logo_path) : asset('img/logo-dsi.png') }}" alt="Logo" class="profile-picture">
                <h2>{{ $administration->name }}</h2>
                <p>{{ $administration->entity_type }}</p>
            </div>

            {{-- Contenu du profil --}}
            <div class="profile-content">

                {{-- Section Informations Générales --}}
                <div class="info-section">
                    <div class="section-title">
                        <i class="fas fa-building"></i>
                        Informations Générales
                    </div>

                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Nom de l'Administration</div>
                            <div class="info-value">{{ $administration->name }}</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Type d'Entité</div>
                            <div class="info-value">{{ $administration->entity_type }}</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Adresse</div>
                            <div class="info-value">{{ $administration->address ?? 'Non spécifiée' }}</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Site Web</div>
                            <div class="info-value">
                                @if($administration->website_url)
                                    <a href="{{ $administration->website_url }}" target="_blank" class="link">
                                        {{ $administration->website_url }}
                                        <i class="fas fa-external-link-alt" style="font-size: 0.8rem;"></i>
                                    </a>
                                @else
                                    <span class="empty-value">Non spécifié</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Section Informations de Contact --}}
                <div class="info-section">
                    <div class="section-title">
                        <i class="fas fa-user-tie"></i>
                        Informations de Contact
                    </div>

                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Nom du Contact</div>
                            <div class="info-value">{{ $administration->contact_name ?? 'Non spécifié' }}</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Poste</div>
                            <div class="info-value">{{ $administration->contact_position ?? 'Non spécifié' }}</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Email de Contact</div>
                            <div class="info-value">
                                @if($administration->contact_email)
                                    <a href="mailto:{{ $administration->contact_email }}" class="link">
                                        {{ $administration->contact_email }}
                                    </a>
                                @else
                                    <span class="empty-value">Non spécifié</span>
                                @endif
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Téléphone de Contact</div>
                            <div class="info-value">
                                @if($administration->contact_phone)
                                    <a href="tel:{{ $administration->contact_phone }}" class="link">
                                        {{ $administration->contact_phone }}
                                    </a>
                                @else
                                    <span class="empty-value">Non spécifié</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Section Informations de Compte --}}
                <div class="info-section">
                    <div class="section-title">
                        <i class="fas fa-lock"></i>
                        Informations du Compte
                    </div>

                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Email du Compte</div>
                            <div class="info-value">{{ $administration->email }}</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Date d'Inscription</div>
                            <div class="info-value">{{ $administration->created_at->format('d/m/Y') }}</div>
                        </div>
                    </div>
                </div>

                {{-- Boutons d'Action --}}
                <div class="button-container">
                    <a href="{{ route('administration.dahbord') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i> Retour au Tableau de Bord
                    </a>
                    <a href="{{ route('administration.edit', $administration->id) }}" class="btn-edit">
                        <i class="fas fa-edit"></i> Modifier Mon Profil
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
