@extends('layouts.app-shell-college')

@section('title', 'Tableau de Bord - College IT')

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
        .navbar { background: linear-gradient(180deg, #f6f7f8 0%, #fafcfc 100%); width: 100%;}
        .navbar-brand { font-weight: 800; color: white !important; }

        .content-area {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            width: 1000px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .card-dsi {
            border: none;
            border-radius: 12px;
            box-shadow: 0 8px 25px -10px rgba(11, 63, 122, 0.1);
            transition: all 0.3s ease;
        }
        .card-dsi:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px -10px rgba(11, 63, 122, 0.15);
        }
        .card-header-dsi {
            background-color: var(--dsi-blue);
            color: white;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            padding: 1rem 1.5rem;
            font-weight: 600;
        }
        .btn-dsi-primary {
            background: linear-gradient(95deg, var(--dsi-blue), var(--dsi-green));
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-dsi-primary:hover {
            opacity: 0.9;
            color: white;
        }
        .profile-picture {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--dsi-green);
        }
    </style>

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light sticky-top" style="background: linear-gradient(180deg, #f6f7f8 0%, #fafcfc 100%); box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <div class="container-fluid px-4">
            <!-- Navbar Brand -->
            <a class="fw-bold" href="#" style="color: #094281; font-size: 1.3rem; text-decoration: none; font-weight: bold;">
                <i class="fas fa-briefcase me-2" style="color: #094281;"></i> Club DSI - College IT
            </a>
        </div>
    </nav>

    <div class="container-fluid mt-4">
        <div class="row">
            <!-- Main Content -->
            <div class="col-md-9">
            
                <div class="content-area">
                    <h2 class="mb-4" style="color: #094281; font-weight: 700;">Statistiques de Cotisation</h2>

                    <!-- STATISTIQUES DE COTISATION -->
                    <div class="row g-4 mb-4">
                        <!-- Card 1: Cotisation Payée -->
                        <div class="col-md-6 col-lg-3">
                            <div class="card card-dsi h-100">
                                <div class="card-body text-center">
                                    <div style="font-size: 2.5rem; color: #28a745; margin-bottom: 10px;">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <h6 class="card-title text-muted">Cotisations Payées</h6>
                                    <div style="font-size: 2.5rem; font-weight: bold; color: #28a745;">
                                        {{ $subscriptionStats['paidCount'] }}
                                    </div>
                                    <p class="text-muted small mt-2">Paiements effectués</p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2: Cotisation Due -->
                        <div class="col-md-6 col-lg-3">
                            <div class="card card-dsi h-100">
                                <div class="card-body text-center">
                                    <div style="font-size: 2.5rem; color: {{ $subscriptionStats['isOverdue'] ? '#dc3545' : '#ffc107' }}; margin-bottom: 10px;">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <h6 class="card-title text-muted">
                                        {{ $subscriptionStats['isOverdue'] ? 'Cotisation en Retard' : 'Cotisations Dues' }}
                                    </h6>
                                    <div style="font-size: 2.5rem; font-weight: bold; color: {{ $subscriptionStats['isOverdue'] ? '#dc3545' : '#ffc107' }};">
                                        {{ $subscriptionStats['pendingCount'] }}
                                    </div>
                                    <p class="text-muted small mt-2">
                                        @if($subscriptionStats['isOverdue'])
                                            ⚠️ Paiement en retard!
                                        @else
                                            En attente de paiement
                                        @endif
                                    </p>
                                    @if($subscriptionStats['pendingCount'] > 0)
                                        <a href="{{ route('membership.pay') }}" class="btn btn-sm btn-success mt-2 w-100">
                                            <i class="fas fa-credit-card me-1"></i> Payer maintenant
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Card 3: Dernière Échéance -->
                        <div class="col-md-6 col-lg-3">
                            <div class="card card-dsi h-100">
                                <div class="card-body text-center">
                                    <div style="font-size: 2.5rem; color: #094281; margin-bottom: 10px;">
                                        <i class="fas fa-calendar-check"></i>
                                    </div>
                                    <h6 class="card-title text-muted">Dernière Échéance</h6>
                                    @if($subscriptionStats['lastDueDate'])
                                        <div style="font-size: 1.3rem; font-weight: bold; color: #094281;">
                                            {{ $subscriptionStats['lastDueDate']->format('d/m/Y') }}
                                        </div>
                                        <p class="text-muted small mt-2">
                                            {{ $subscriptionStats['lastDueDate']->diffForHumans() }}
                                        </p>
                                    @else
                                        <div style="font-size: 1rem; color: #999;">
                                            Aucun paiement
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Card 4: Prochaine Échéance -->
                        <div class="col-md-6 col-lg-3">
                            <div class="card card-dsi h-100">
                                <div class="card-body text-center">
                                    <div style="font-size: 2.5rem; color: #17a2b8; margin-bottom: 10px;">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <h6 class="card-title text-muted">Prochaine Échéance</h6>
                                    @if($subscriptionStats['nextDueDate'])
                                        <div style="font-size: 1.3rem; font-weight: bold; color: #17a2b8;">
                                            {{ $subscriptionStats['nextDueDate']->format('d/m/Y') }}
                                        </div>
                                        <p class="text-muted small mt-2">
                                            @if($subscriptionStats['isOverdue'])
                                                <span class="badge bg-danger">EN RETARD</span>
                                            @else
                                                <span class="badge bg-info">{{ $subscriptionStats['daysUntilDue'] }} jours restants</span>
                                            @endif
                                        </p>
                                    @else
                                        <div style="font-size: 1rem; color: #999;">
                                            À définir
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- INFORMATION DU COLLEGE --}}
                    <div class="card-header-dsi">
                            <i class="fas fa-info-circle me-2"></i> Informations du College
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Nom :</strong> {{ $college->company_name }}</p>
                                    <p><strong>Slogan :</strong> {{ $college->slogan }}</p>
                                    <p><strong>Description :</strong> {{ $college->description }}</p>
                                    <p><strong>Site Web :</strong>
                                        @if($college->website_url)
                                            <a href="{{ $college->website_url }}" target="_blank">{{ $college->website_url }}</a>
                                        @else
                                            Non spécifié
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Contact :</strong> {{ $college->contact_name }}</p>
                                    <p><strong>Email :</strong> {{ $college->email }}</p>
                                    <p><strong>Domaines d'Excellence :</strong> {{ $college->expertise_tags }}</p>
                                    <p><strong>LinkedIn :</strong>
                                        @if($college->linkedin_url)
                                            <a href="{{ $college->linkedin_url }}" target="_blank">Voir le profil</a>
                                        @else
                                            Non spécifié
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="text-end mt-3">
                                <a href="{{ route('college.edit', $college->id) }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-edit me-2"></i> Modifier mes informations
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
