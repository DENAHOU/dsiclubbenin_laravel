@extends('layouts.app-shell-entite')

@section('title', 'Portail Entreprise')

@section('content')

<style>
    :root {
        --dsi-blue: #094281;
        --dsi-blue-dark: #0a2b5c;
        --company-accent: #29963a;
        --light-bg: #f4f7fc;
        --ink: #0e1a2b;
        --muted-ink: #5c6b81;
        --border-color: #e5eaf2;
    }

    .cockpit-header {
        background: linear-gradient(135deg, #0a2b5c 0%, #29963a 100%);
        color: white;
        padding: 1rem;
        border-radius: 0 0 20px 20px;
    }

    .cockpit-title {
        font-size: 2rem;
        font-weight: 800;
        margin: 0 0 0.5rem 0;
    }

    .cockpit-subtitle {
        font-size: 0.95rem;
        opacity: 0.9;
    }

    .cockpit-main {
        padding: 2rem;
    }

    .kpi-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .kpi-card {
        background: white;
        padding: 1.5rem;
        border-radius: 16px;
        border: 1px solid var(--border-color);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .kpi-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
    }

    .kpi-card .card-icon {
        font-size: 1.5rem;
        color: var(--company-accent);
    }

    .kpi-card .card-value {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--dsi-blue-dark);
        margin: 0.75rem 0 0.5rem 0;
    }

    .kpi-card .card-label {
        color: var(--muted-ink);
        font-weight: 500;
        font-size: 0.9rem;
    }

    .main-panel {
        background: white;
        border-radius: 16px;
        border: 1px solid var(--border-color);
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    }

    .panel-title {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: var(--dsi-blue-dark);
        border-bottom: 3px solid var(--company-accent);
        padding-bottom: 0.75rem;
    }

    .opportunity-feed .feed-item {
        display: flex;
        gap: 1.5rem;
        padding: 1.25rem 0;
    }

    .opportunity-feed .feed-item:not(:last-child) {
        border-bottom: 1px solid var(--border-color);
    }

    .feed-icon {
        font-size: 1.5rem;
        color: var(--company-accent);
        min-width: 30px;
    }

    .feed-title {
        font-weight: 600;
        text-decoration: none;
        color: var(--ink);
    }

    .feed-title:hover {
        color: var(--company-accent);
    }

    .feed-desc {
        font-size: 0.9rem;
        color: var(--muted-ink);
        margin: 0.25rem 0 0 0;
    }

    .company-info-section {
        background: white;
        border-radius: 16px;
        border: 1px solid var(--border-color);
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        margin-top: 2rem;
    }

    .company-info-section h3 {
        color: var(--dsi-blue-dark);
        margin-bottom: 1rem;
        font-weight: 700;
    }

    .info-row {
        display: grid;
        grid-template-columns: auto 1fr;
        gap: 1rem;
        margin-bottom: 0.75rem;
    }

    .info-label {
        color: var(--muted-ink);
        font-weight: 600;
    }

    .info-value {
        color: var(--ink);
    }
</style>

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <header class="cockpit-header">
        <h1 class="cockpit-title"><i class="fas fa-building me-3"></i>{{ $company->company_name }}</h1>
        <p class="cockpit-subtitle mb-0">Bienvenue au tableau de bord de votre entreprise </p>
    </header>

    <main class="cockpit-main">
        <!-- KPIs Row -->
        <div class="kpi-grid">
            <div class="kpi-card">
                <div class="d-flex justify-content-between align-items-start">
                    <span class="card-label">Cotisations Payées</span>
                    <i class="fas fa-check-circle card-icon"></i>
                </div>
                <div class="card-value">{{ $stats['paid'] ?? 0 }}</div>
            </div>

            <div class="kpi-card">
                <div class="d-flex justify-content-between align-items-start">
                    <span class="card-label">Cotisations Manquantes</span>
                    <i class="fas fa-clock card-icon"></i>
                </div>
                <div class="card-value">{{ $stats['pending'] ?? 0 }}
                    @if($stats['pending'] > 0)
                        <a href="{{ route('membership.pay') }}" class="btn btn-sm btn-success mt-2 w-100">
                            <i class="fas fa-credit-card me-1"></i> Payer maintenant
                        </a>
                    @endif
                </div>

            </div>

            <div class="kpi-card">
                <div class="d-flex justify-content-between align-items-start">
                    <span class="card-label">Dernière Échéance</span>
                    <i class="fas fa-calendar-check card-icon"></i>
                </div>
                <div class="card-value" style="font-size: 1.5rem;">{{ $stats['lastDueDate'] }}</div>
            </div>

            <div class="kpi-card">
                <div class="d-flex justify-content-between align-items-start">
                    <span class="card-label">Prochaine Échéance</span>
                    <i class="fas fa-calendar-alt card-icon"></i>
                </div>
                <div class="card-value" style="font-size: 1.5rem;">{{ $stats['nextDueDate'] }}</div>
            </div>
        </div>

        <!-- Company Info Section -->
        <div class="company-info-section">
            <h3><i class="fas fa-info-circle me-2"></i>Informations de l'Entreprise</h3>
            <div class="info-row">
                <span class="info-label">Type d'entité:</span>
                <span class="info-value">Entreprise Partenaire</span>
            </div>
            <div class="info-row">
                <span class="info-label">Slogan:</span>
                <span class="info-value">{{ $company->slogan ?? 'Non défini' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Secteur d'activité:</span>
                <span class="info-value">{{ $company->sector ?? 'Non défini' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Email:</span>
                <span class="info-value">{{ $company->email ?? 'Non défini' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Téléphone:</span>
                <span class="info-value">{{ $company->phone ?? 'Non défini' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Adresse:</span>
                <span class="info-value">{{ $company->address ?? 'Non défini' }}</span>
            </div>
        </div>

    </main>
@endsection
