@extends('layouts.app-shell')

@section('title', 'Mon Cockpit Stratégique')

<style>
    :root {
        --dsi-blue: #094281;
        --dsi-green: #29963a;
        --dsi-gold: #ffc107;
        --dsi-red: #ef4444;
        --light-bg: #f4f7fc;
        --border-color: #e5eaf2;
        --ink: #0e1a2b;
        --muted-ink: #5c6b81;
    }

    .app-dock-wrapper {
        background: white;
        border-radius: 16px;
        padding: 0.5rem;
        box-shadow: 0 4px 10px -2px rgba(9, 66, 129, 0.06);
        border: 1px solid var(--border-color);
        margin-top: 1.5rem;
    }
    .app-dock {
        display: flex;
        justify-content: space-around;
        align-items: center;
        flex-wrap: wrap;
        gap: 1.5rem;
    }
    .app-icon {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none;
        color: var(--muted-ink);
        transition: transform 0.2s ease;
        position: relative;
    }
    .app-icon:hover {
        transform: translateY(-5px);
        color: var(--dsi-blue);
    }
    .app-icon .icon-bg {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        background-color: var(--light-bg);
        display: grid;
        place-items: center;
        font-size: 1.8rem;
        margin-bottom: 0.5rem;
        transition: all 0.2s ease;
    }
    .app-icon:hover .icon-bg {
        background-color: var(--dsi-blue);
        color: white;
    }
    .app-icon .app-label {
        font-size: 0.85rem;
    }
    .notification-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background-color: var(--dsi-red);
        color: white;
        font-size: 0.75rem;
        font-weight: 700;
        display: grid;
        place-items: center;
        border: 2px solid white;
    }
    .main-content { padding: 2rem; }
    .widget {
        background: white; border-radius: 16px;
        box-shadow: 0 4px 10px -2px rgba(9, 66, 129, 0.06);
        border: 1px solid var(--border-color);
        display: flex; flex-direction: column; height: 100%;
    }
    .widget-header { padding: 1rem 1.5rem; border-bottom: 1px solid var(--border-color); flex-shrink: 0; }
    .widget-title { font-size: 1.1rem; font-weight: 700; color: var(--ink); margin: 0; display: flex; align-items: center; gap: 0.75rem; }
    .widget-body { padding: 1.5rem; flex-grow: 1; display: flex; flex-direction: column; }

    /* Styles spécifiques */
    .progress-circle { width: 130px; height: 130px; border-radius: 50%; display: grid; place-items: center; margin: 0 auto; }
    .progress-value { font-size: 2.2rem; font-weight: 800; }
    .upcoming-event-widget { background: linear-gradient(135deg, var(--dsi-blue) 0%, #0a2b5c 100%); color: white; border: none; }
    .upcoming-event-widget .eyebrow { color: var(--dsi-green); font-weight: 600; }
    .upcoming-event-widget .event-title { font-size: 2rem; font-weight: 800; }
    .btn-register { background: var(--dsi-green); color: white; font-weight: 700; border: none; }

    /* Widget Microsoft 365 */
    .microsoft-widget {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 10px -2px rgba(9, 66, 129, 0.06);
        border: 1px solid var(--border-color);
        overflow: hidden;
    }

    .microsoft-widget-header {
        background: linear-gradient(135deg, #0078d4, #106ebe);
        color: white;
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .microsoft-widget-title {
        font-size: 1.2rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .btn-sync {
        background: rgba(255,255,255,0.2);
        color: white;
        border: 1px solid rgba(255,255,255,0.4);
        padding: 0.5rem 1rem;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.2s;
    }

    .btn-sync:hover {
        background: rgba(255,255,255,0.3);
    }

    .microsoft-widget-body {
        padding: 1.5rem;
    }

    .event-item {
        padding: 1rem;
        border-left: 4px solid var(--dsi-blue);
        background: var(--light-bg);
        margin-bottom: 0.75rem;
        border-radius: 4px;
        transition: all 0.2s;
    }

    .event-item:hover {
        transform: translateX(4px);
        box-shadow: 0 2px 8px rgba(9, 66, 129, 0.1);
    }

    .event-time {
        font-size: 0.85rem;
        color: var(--dsi-blue);
        font-weight: 700;
        margin-bottom: 0.25rem;
    }

    .event-subject {
        font-size: 1rem;
        font-weight: 600;
        color: var(--ink);
        margin-bottom: 0.25rem;
    }

    .event-organizer {
        font-size: 0.85rem;
        color: var(--muted-ink);
    }

    .no-events {
        text-align: center;
        color: var(--muted-ink);
        padding: 2rem;
    }

    .tool-widget .widget-body {
        text-align: center;
        justify-content: space-between;
    }
    .tool-widget .tool-icon {
        font-size: 3rem;
        color: var(--dsi-blue);
    }
    .tool-widget a.btn {
        font-weight: 600;
    }

    .user-dropdown a {
    color: #2c3e50;
}

.user-dropdown a:hover {
    color: #0d6efd;
}

.user-dropdown .dropdown-menu {
    border-radius: 12px;
    min-width: 240px;
}

.user-dropdown img {
    object-fit: cover;
    border: 2px solid #e9ecef;
}

.dropdown-item {
    font-weight: 500;
}

.dropdown-item:hover {
    background-color: #f4f6f9;
}


/* ===== MINI STATS ===== */
.mini-stat{
    border-radius:16px;
    overflow:hidden;
    border:1px solid var(--border);
    box-shadow:0 4px 14px rgba(0,0,0,.05);
    transition:.25s;
}

.mini-stat:hover{
    transform:translateY(-5px);
}

.mini-stat-header{
    padding:1rem;
    color:white;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.mini-stat-header i{
    font-size:1.6rem;
    opacity:.85;
}

.mini-stat-body{
    padding:1.25rem;
    background:white;
}

.mini-stat-value{
    font-size:1.6rem;
    font-weight:800;
    color:var(--text);
}

@media (max-width: 768px) {

    .app-dock {
        justify-content: center;
        gap: 1rem;
    }

    .app-icon .icon-bg {
        width: 50px;
        height: 50px;
        font-size: 1.4rem;
    }

    .app-icon .app-label {
        font-size: 0.8rem;
        text-align: center;
    }

    .app-dock-wrapper {
        padding: 0.8rem;
    }
}


/* COLORS */
.bg-primary{background:linear-gradient(135deg,#094281,#0b5ed7);}
.bg-success{background:linear-gradient(135deg,#29963a,#22c55e);}
.bg-warning{background:linear-gradient(135deg,#f59e0b,#fbbf24);}
.bg-danger{background:linear-gradient(135deg,#dc2626,#ef4444);}

</style>


@section('content')
    <div class="main-content">

    

        <div class="row align-items-center mb-3">
            <!-- Dock d'applications à gauche -->
            <div class="col-md-8">
                <div class="app-dock-wrapper">
                    <div class="app-dock">
                        <!-- Paiement & Factures -->
                        <a href="{{ route('member.cotisations.history') }}" class="app-icon">
                            <div class="icon-bg"><i class="fas fa-file-invoice-dollar"></i></div>
                            <span class="app-label">Cotisations</span>
                        </a>
                        <!-- Documents SharePoint -->
                        <a href="#" class="app-icon">
                            <div class="icon-bg"><i class="fab fa-windows"></i></div>
                            <span class="app-label">SharePoint</span>
                        </a>
                        <!-- Réunions Teams -->
                        <a href="#" class="app-icon">
                            <div class="icon-bg"><i class="fab fa-microsoft"></i></div>
                            <span class="app-label">Teams</span>
                        </a>
                        {{-- <!-- Calendrier Microsoft -->
                        @if(Auth::user()->microsoft_token)
                        <a href="{{ route('microsoft.calendar') }}" class="app-icon">
                            <div class="icon-bg"><i class="fas fa-calendar"></i></div>
                            <span class="app-label">Calendrier</span>
                        </a>
                        @endif --}}
                        <!-- Notifications -->
                        @php
                            use App\Models\Notification;

                            $unread = Notification::where('user_id', auth()->id())
                                ->where('is_read', false)
                                ->count();
                        @endphp
                        <a href="{{ route('member.notifications') }}" class="app-icon">
                            <div class="icon-bg"><i class="fas fa-bell"></i></div>
                            <span class="app-label">Notifications</span>

                            @if($unread > 0)
                                <span class="notification-badge">{{ $unread }}</span>
                            @endif
                        </a>
                    </div>
                </div>
            </div>

            <!-- Profil utilisateur à droite -->
            <div class="col-md-4">
                <div class="dropdown user-dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none"
                    id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">

                        <img src="{{ Auth::user()->photo_path ? asset('storage/' . Auth::user()->photo_path) : asset('img/avatar-default.svg') }}" 
                             class="rounded-circle me-3" 
                             width="60"
                             height="60"
                             alt="Photo de profil"
                             onerror="this.src='{{ asset('img/avatar-default.svg') }}'">

                        <div>
                            <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                            <small class="text-muted">{{ Auth::user()->email }}</small>
                        </div>
                        
                        <i class="fas fa-chevron-down ms-2 small"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li class="px-3 py-2 text-muted small">
                            Connecté en tant que<br>
                            <strong>{{ Auth::user()->email }}</strong>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <a class="dropdown-item" href="{{ route('member.profile.show') }}">
                                <i class="fas fa-user me-2"></i> Mon profil
                            </a>
                        </li>

                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fas fa-sign-out-alt me-2"></i> Se déconnecter
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        
        <div class="row g-4">
                <!-- ===== MINI STATS ===== -->
                <div class="row g-4 mt-2">

                    <!-- INDICATEUR TYPE ADHÉRENT -->
                    <div class="col-xl-3 col-md-6">
                        <div class="mini-stat">
                            <div class="mini-stat-header {{ $estNouveauAdherent ? 'bg-primary' : 'bg-primary' }}">
                                <span>{{ $estNouveauAdherent ? 'Nouvel adhérent' : 'Membre existant' }}</span>
                                <i class="fa {{ $estNouveauAdherent ? 'fa-star' : 'fa-user' }}"></i>
                            </div>
                            <div class="mini-stat-body">
                                <div class="mini-stat-value text-muted small">
                                    {{ $estNouveauAdherent ? 'Cotisation mensuelle' : 'Cotisation mensuelle' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="mini-stat">
                            <div class="mini-stat-header bg-success">
                                <span>Mois payés</span>
                                <i class="fa fa-check-circle"></i>
                            </div>
                            <div class="mini-stat-body">
                                <div class="mini-stat-value">{{ $moisPayes }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- CARTE MOIS AJOUTÉS -->
                    <div class="col-xl-3 col-md-6">
                        <div class="mini-stat">
                            <div class="mini-stat-header bg-warning">
                                <span>Mois ajoutés</span>
                                <i class="fa fa-plus-circle"></i>
                            </div>
                            <div class="mini-stat-body">
                                <div class="mini-stat-value">{{ $moisAjoutes }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="mini-stat">
                            <div class="mini-stat-header bg-danger">
                                <span>Mois dus</span>
                                <i class="fa fa-exclamation-circle"></i>
                            </div>
                            <div class="mini-stat-body d-flex justify-content-between align-items-center">
                                <div class="mini-stat-value">
                                    {{ $moisDus }}
                                </div>

                                @if($moisDus > 0)
                                    <a href="{{ route('member.cotisations.pay') }}" class="btn btn-success btn-sm">
                                        Payer
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="mini-stat">
                            <div class="mini-stat-header bg-primary">
                                <span>Dernier paiement</span>
                                <i class="fa fa-calendar-check"></i>
                            </div>
                            <div class="mini-stat-body">
                                <div class="mini-stat-value">
                                    {{ $lastPayment ? $lastPayment->created_at->format('d/m/Y') : 'Aucun' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="mini-stat">
                            <div class="mini-stat-header bg-warning">
                                <span>Prochaine échéance</span>
                                <i class="fa fa-line-chart"></i>
                            </div>
                            <div class="mini-stat-body">
                                <div class="mini-stat-value">{{ $prochaineEcheance }}</div>
                            </div>
                        </div>
                    </div>

            </div>

        </div>

        {{-- <!-- Widget Calendrier Microsoft 365 (si SSO) -->
        {{-- @if(Auth::user()->microsoft_token)
        <div class="row g-4 mt-2">
            <div class="col-lg-8">
                <div class="microsoft-widget">
                    <div class="microsoft-widget-header">
                        <h3 class="microsoft-widget-title">
                            <i class="fas fa-calendar"></i> Calendrier Microsoft 365
                        </h3>
                        <button type="button" class="btn-sync" id="btn-refresh-calendar" onclick="refreshCalendar()">
                            <i class="fas fa-sync-alt"></i> Actualiser
                        </button>
                    </div>
                    <div class="microsoft-widget-body">
                        @php
                            $upcomingEvents = Auth::user()->microsoftCalendars()
                                ->where('start_time', '>=', now())
                                ->orderBy('start_time', 'asc')
                                ->limit(5)
                                ->get();
                        @endphp

                        @if($upcomingEvents->isEmpty())
                            <div class="no-events">
                                <i class="fas fa-inbox fa-2x mb-2" style="color: var(--muted-ink);"></i><br>
                                Pas d'événements prévu
                            </div>
                        @else
                            @foreach($upcomingEvents as $event)
                            <div class="event-item">
                                <div class="event-time">
                                    <i class="fas fa-clock"></i>
                                    {{ $event->start_time->format('d/m/Y H:i') }}
                                </div>
                                <div class="event-subject">{{ $event->subject }}</div>
                                @if($event->organizer_name)
                                <div class="event-organizer">
                                    <i class="fas fa-user"></i> {{ $event->organizer_name }}
                                </div>
                                @endif
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- Stats Sync Microsoft -->
            <div class="col-lg-4">
                <div class="microsoft-widget">
                    <div class="microsoft-widget-header">
                        <h3 class="microsoft-widget-title">
                            <i class="fas fa-sync"></i> État de synchronisation
                        </h3>
                    </div>
                    <div class="microsoft-widget-body">
                        <div class="mini-stat mb-2">
                            <div class="mini-stat-header bg-primary">
                                <span>Événements</span>
                                <i class="fa fa-calendar-alt"></i>
                            </div>
                            <div class="mini-stat-body">
                                <div class="mini-stat-value">{{ Auth::user()->microsoftCalendars()->count() }}</div>
                            </div>
                        </div>

                        <div class="mini-stat mb-2">
                            <div class="mini-stat-header bg-success">
                                <span>Documents</span>
                                <i class="fa fa-file"></i>
                            </div>
                            <div class="mini-stat-body">
                                <div class="mini-stat-value">{{ Auth::user()->microsoftDocuments()->count() }}</div>
                            </div>
                        </div>

                        <div class="mini-stat">
                            <div class="mini-stat-header bg-warning">
                                <span>Réunions Teams</span>
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="mini-stat-body">
                                <div class="mini-stat-value">{{ Auth::user()->microsoftMeetings()->count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif --}} --}}
    </div>
@endsection



@push('scripts')
<script>
    document.querySelectorAll('.progress-circle').forEach(circle => {
        const progress = circle.dataset.progress;
        circle.style.background = `
            radial-gradient(closest-side, white 79%, transparent 80% 100%),
            conic-gradient(var(--dsi-green) ${progress}%, var(--light-bg) 0)
        `;
    });

    document.addEventListener('click', function(e) {
        let sidebar = document.querySelector('.sidebar');
        if (!sidebar) return;
        if (!sidebar.contains(e.target) && !e.target.closest('.mobile-toggle')) {
            sidebar.classList.remove('show');
        }
    });


</script>
@endpush
