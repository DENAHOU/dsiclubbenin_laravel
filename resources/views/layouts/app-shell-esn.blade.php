<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club DSI Bénin - Espace ESN - @yield('title', 'Tableau de Bord')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    <!-- Votre Favicon -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}"> {{-- Assurez-vous d'avoir un favicon.png dans public/img --}}

    <!-- Styles globaux et spécifiques ESN -->
    <style>
        :root {
            --dsi-blue: #094281;
            --dsi-blue-light: #1a56a6;
            --dsi-green: #29963a;
            --dsi-green-light: #4CAF50; /* Light variant for accents */
            --light-bg: #f4f7fc;
            --dark-bg: #0e1a2b;
            --ink: #0e1a2b;
            --muted-ink: #5c6b81;
            --border-color: #e5eaf2;
            --sidebar-gradient-start: #0f2b57;
            --sidebar-gradient-end: #083063;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            margin: 0;
            color: var(--ink);
            overflow-x: hidden; /* Empêche le défilement horizontal global */
        }
        .app-shell {
            display: grid;
            grid-template-columns: 260px 1fr;
            min-height: 100vh;
        }

        /* --- SIDEBAR --- */
        .sidebar {
            background: linear-gradient(180deg, var(--sidebar-gradient-start) 0%, var(--sidebar-gradient-end) 100%);
            color: white;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        .sidebar .brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 2rem;
            justify-content: center;
        }
        .sidebar .brand img {
            height: 90px;
            object-fit: contain;
        }
        .sidebar .brand-name {
            font-weight: 700;
            font-size: 1.3rem;
            color: white;
            text-decoration: none;
            display: none;
        }

        .esn-profile-card {
            background-color: rgba(255,255,255,0.08);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 2rem;
            text-align: center;
            box-shadow: inset 0 0 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        .esn-profile-card:hover {
            background-color: rgba(255,255,255,0.15);
        }
        .esn-profile-card .profile-picture {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--dsi-green-light);
            margin-bottom: 0.75rem;
            box-shadow: 0 0 0 2px rgba(255,255,255,0.2);
        }
        .esn-profile-card h5 {
            color: white;
            margin-bottom: 0.25rem;
            font-weight: 600;
            font-size: 1.1rem;
        }
        .esn-profile-card p {
            color: rgba(255,255,255,0.7);
            font-size: 0.85rem;
            margin-bottom: 0;
        }

        .sidebar-nav { list-style: none; padding: 0; margin: 0; }
        .sidebar-nav .nav-title {
            font-size: 0.8rem;
            text-transform: uppercase;
            color: rgba(255,255,255,0.4);
            padding: 0 0.75rem;
            margin: 1.5rem 0 0.5rem 0;
            font-weight: 600;
        }
        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.85rem;
            border-radius: 10px;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
            margin-bottom: 0.3rem;
        }
        .sidebar-nav .nav-link:hover {
            background: rgba(255,255,255,0.15);
            color: white;
            transform: translateX(5px);
        }
        .sidebar-nav .nav-link.active {
            background: var(--dsi-green);
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(0, 128, 0, 0.3);
        }
        .sidebar-nav .nav-link i { width: 20px; text-align: center; font-size: 1.1rem; }

        .sidebar-footer {
            margin-top: auto;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        /* --- HEADER (Topbar) --- */
        .topbar {
            background-color: white;
            padding: 1rem 2rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            z-index: 1000;
            position: sticky;
            top: 0;
        }
        .topbar .logo-topbar {
             display: none;
        }
        .topbar .page-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--ink);
            margin: 0;
        }
        .topbar .profile-dropdown {
            position: relative;
        }
        .topbar .profile-dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 0.5rem 0.75rem;
            border-radius: 8px;
            transition: background-color 0.2s ease;
        }
        .topbar .profile-dropdown-toggle:hover {
            background-color: var(--light-bg);
        }
        .topbar .profile-picture-sm {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--dsi-blue-light);
        }
        .topbar .user-name {
            font-weight: 600;
            color: var(--ink);
        }
        .topbar .dropdown-menu {
            position: absolute;
            right: 0;
            background-color: white;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            min-width: 180px;
            z-index: 10;
            padding: 0.5rem 0;
            display: none;
        }
        .topbar .dropdown-menu.show {
            display: block;
        }
        .topbar .dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.75rem 1rem;
            color: var(--ink);
            text-decoration: none;
            transition: background-color 0.2s ease, color 0.2s ease;
        }
        .topbar .dropdown-item:hover {
            background-color: var(--light-bg);
            color: var(--dsi-blue);
        }
        .topbar .dropdown-item i {
            color: var(--muted-ink);
        }
        .topbar .dropdown-item:hover i {
            color: var(--dsi-blue);
        }

        /* --- MAIN CONTENT --- */
        .main-wrapper {
            display: flex;
            flex-direction: column;
        }
        .main-content {
            flex-grow: 1;
            padding: 2rem;
            /* overflow-y: auto; -- laissé en place si besoin, mais overflow-x: hidden sur body est plus global */
            /* Ajout d'une largeur maximale pour le contenu principal */
            max-width: 100%; /* S'assure que le contenu n'est jamais plus large que son parent */
            box-sizing: border-box; /* Inclut le padding et border dans la largeur totale */
        }
        .content-container { /* Nouvelle classe pour un conteneur qui centre et limite la largeur */
            max-width: 1200px; /* Adaptez cette valeur à ce qui vous semble le mieux */
            margin: 0 auto; /* Centre le conteneur */
            padding: 0 15px; /* Petit padding horizontal pour ne pas coller aux bords sur les grands écrans */
            box-sizing: border-box;
        }
        .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin-bottom: 1.5rem;
        }
        .breadcrumb-item {
            font-size: 0.9rem;
        }
        .breadcrumb-item a {
            color: var(--muted-ink);
            text-decoration: none;
        }
        .breadcrumb-item.active {
            color: var(--dsi-blue);
            font-weight: 500;
        }

        /* Cards pour les statistiques */
        .stat-card {
            background-color: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
        }
        .stat-card .icon-wrapper {
            background-color: var(--dsi-blue-light);
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-right: 1rem;
        }
        .stat-card.green .icon-wrapper { background-color: var(--dsi-green); }
        .stat-card.orange .icon-wrapper { background-color: #FFA726; }
        .stat-card.purple .icon-wrapper { background-color: #8C52FF; }

        .stat-card .content {
            flex-grow: 1;
        }
        .stat-card .label {
            font-size: 0.9rem;
            color: var(--muted-ink);
            margin-bottom: 0.3rem;
        }
        .stat-card .value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--ink);
        }

        /* Widgets/Sections */
        .card-modern {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        .card-modern .card-header-modern {
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card-modern .card-title-modern {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--ink);
            margin: 0;
        }

        .alert-custom {
            padding: 1rem 1.5rem;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
            font-weight: 500;
            font-size: 1rem;
        }
        .alert-custom.success {
            background-color: #E6F7ED;
            color: var(--dsi-green);
            border: 1px solid var(--dsi-green);
        }
        .alert-custom.success i {
            font-size: 1.5rem;
        }
        .alert-custom .alert-link {
            font-weight: 600;
            text-decoration: none;
            color: inherit;
            margin-left: auto;
        }
        .alert-custom .alert-link:hover {
            text-decoration: underline;
        }

        /* Animations de défilement pour les annonces */
        .scrolling-announcement {
            background-color: #FFF3E0;
            color: #E65100;
            padding: 0.75rem 1.5rem;
            margin-bottom: 2rem;
            border-radius: 10px;
            overflow: hidden; /* **Clé pour empêcher le parent de déborder** */
            white-space: nowrap;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: relative; /* Nécessaire pour positionner l'enfant défilant */
        }
        .scrolling-announcement .content {
            display: inline-block;
            padding-left: 100%;
            animation: scroll-text 30s linear infinite;
            font-weight: 500;
            position: absolute; /* Permet le défilement sans affecter la largeur du parent */
            top: 50%;
            left: 0; /* Important pour que l'animation démarre de la gauche */
            transform: translateY(-50%); /* Centrage vertical */
            white-space: nowrap; /* Assure que le texte reste sur une ligne */
        }
        @keyframes scroll-text {
            from { transform: translateX(0%) translateY(-50%); } /* Ajusté pour le centrage */
            to { transform: translateX(-100%) translateY(-50%); } /* Ajusté pour le centrage */
        }


        /* Table moderne */
        .table-modern {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 0.75rem;
        }
        .table-modern th, .table-modern td {
            padding: 1rem 1.25rem;
            text-align: left;
            vertical-align: middle;
        }
        .table-modern th {
            background-color: var(--light-bg);
            color: var(--muted-ink);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            border-bottom: none;
        }
        .table-modern td {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
            border-top: none;
        }
        .table-modern tbody tr {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .table-modern tbody tr:hover td {
            background-color: var(--light-bg);
        }
        .table-modern td:first-child { border-top-left-radius: 8px; border-bottom-left-radius: 8px; }
        .table-modern td:last-child { border-top-right-radius: 8px; border-bottom-right-radius: 8px; }

        /* Pour la petite image dans le tableau */
        .table-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 0.75rem;
        }

        /* Boutons stylisés */
        .btn-primary-modern {
            background-color: var(--dsi-blue);
            color: white;
            padding: 0.75rem 1.25rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.2s ease, transform 0.2s ease;
            border: none;
        }
        .btn-primary-modern:hover {
            background-color: var(--dsi-blue-light);
            transform: translateY(-2px);
            color: white;
        }
        .btn-outline-secondary-modern {
            background-color: transparent;
            color: var(--muted-ink);
            border: 1px solid var(--border-color);
            padding: 0.75rem 1.25rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .btn-outline-secondary-modern:hover {
            background-color: var(--light-bg);
            color: var(--ink);
            border-color: var(--dsi-blue-light);
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 992px) {
            .app-shell {
                grid-template-columns: 1fr;
            }
            .sidebar {
                position: fixed;
                left: -260px;
                top: 0;
                bottom: 0;
                z-index: 1050;
                transition: left 0.3s ease;
            }
            .sidebar.show {
                left: 0;
            }
            .topbar .logo-topbar {
                display: block;
                height: 40px;
                object-fit: contain;
            }
            .topbar .page-title {
                font-size: 1.3rem;
            }
            .main-content {
                padding: 1rem;
            }
            .stat-card {
                flex-direction: column;
                align-items: flex-start;
            }
            .stat-card .icon-wrapper {
                margin-right: 0;
                margin-bottom: 1rem;
            }
            .content-container { /* Sur mobile, supprimez la max-width pour utiliser toute la largeur disponible */
                max-width: 100%;
                padding: 0; /* Pas de padding horizontal supplémentaire ici */
            }
        }
        @media (max-width: 768px) {
            .topbar {
                padding: 0.75rem 1rem;
            }
            .topbar .user-name {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="app-shell">
    <!-- ============================================= -->
    <!--       SIDEBAR ESN (MENU LATÉRAL FIXE)         -->
    <!-- ============================================= -->
    <aside class="sidebar" id="sidebarESN">
        <div>
            {{-- Le logo et nom du Club DSI Bénin --}}
            <a href="{{ route('home') }}" class="brand">
                <img src="{{ asset('img/logo-dsi.png') }}" alt="Logo" style="height: 80px;">
            </a>

            {{-- Carte de profil de l'ESN --}}
            @auth('esn')
                <div class="esn-profile-card">
                    <img src="{{ Auth::guard('esn')->user()->logo_path ? asset('storage/' . Auth::guard('esn')->user()->logo_path) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::guard('esn')->user()->company_name) . '&color=FFFFFF&background=094281' }}"
                         alt="Logo ESN" class="profile-picture">
                    <h5>{{ Auth::guard('esn')->user()->company_name }}</h5>
                    <p>{{ Auth::guard('esn')->user()->promoter_name ?? 'Contact Principal' }}</p>
                </div>
            @endauth

            <ul class="sidebar-nav">
                <li class="nav-item">
                    <a href="{{ route('esn.dashboard') }}" class="nav-link {{ Request::routeIs('esn.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-chart-line"></i> Tableau de Bord
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('esn.profile.show') }}" class="nav-link {{ Request::routeIs('esn.profile.show') ? 'active' : '' }}">
                        <i class="fas fa-building"></i> Mon ESN
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-users"></i> Mes Membres
                    </a>
                </li>
                 <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-handshake"></i> Mes Partenariats
                    </a>
                </li>

                <li class="nav-title">Interactions</li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-comments"></i> Messagerie
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-bell"></i> Notifications
                    </a>
                </li>
                 <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-bullhorn"></i> Annonces
                    </a>
                </li>

                <li class="nav-title">Ressources</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-book"></i> Bibliothèque
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-calendar-alt"></i> Événements
                    </a>
                </li>
            </ul>
        </div>

        <div class="sidebar-footer">
             <ul class="sidebar-nav">
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fas fa-sign-out-alt" ></i> Déconnexion
                        </a>
                    </form>
                </li>
             </ul>
        </div>
    </aside>

    <!-- ============================================= -->
    <!--       CONTENU PRINCIPAL (DROITE)              -->
    <!-- ============================================= -->
    <div class="main-wrapper">
        <!-- Header / Topbar -->
        <header class="topbar">
            {{-- Bouton pour ouvrir la sidebar sur mobile --}}
            <button class="btn btn-outline-secondary-modern d-lg-none" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            <a href="{{ route('home') }}" class="logo-topbar d-lg-none">
                <img src="{{ asset('img/esn-logo-placeholder.png') }}" alt="Logo ESN" style="height: 40px;">
            </a>
            <h1 class="page-title d-none d-lg-block">@yield('title', 'Tableau de Bord ESN')</h1>

            <nav class="profile-dropdown">
                <div class="profile-dropdown-toggle" id="profileDropdownToggle">
                    <img src="{{ Auth::guard('esn')->user()->logo_path ? asset('storage/' . Auth::guard('esn')->user()->logo_path) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::guard('esn')->user()->company_name) . '&color=FFFFFF&background=094281' }}"
                         alt="Logo ESN" class="profile-picture-sm">
                    <span class="user-name">{{ Auth::guard('esn')->user()->company_name }}</span>
                    <i class="fas fa-chevron-down text-muted" style="font-size: 0.8rem;"></i>
                </div>
                <div class="dropdown-menu" id="profileDropdownMenu">
                    <a class="dropdown-item" href="{{ route('esn.profile.edit') }}"><i class="fas fa-user-circle"></i> Modifier Profil</a>
                    <a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Paramètres</a>
                    <hr class="dropdown-divider my-1">
            {{-- LOGOUT --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="fas fa-sign-out-alt" ></i> Déconnexion
                </a>
            </form>
                </div>
            </nav>
        </header>

        <!-- Main Content Area -->
        <main class="main-content">
            {{-- Nouveau conteneur pour limiter la largeur et centrer le contenu --}}
            <div class="content-container">
                {{-- Breadcrumbs --}}
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('esn.dashboard') }}">ESN</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@yield('title', 'Tableau de Bord')</li>
                    </ol>
                </nav>

                @yield('content')
            </div>
        </main>

        <footer class="footer bg-white text-center py-3" style="border-top: 1px solid var(--border-color); color: var(--muted-ink);">
            <p class="mb-0"> &copy; {{ date('Y') }} Copyright
            <span>CLUB DSI BENIN</span> - Tous droits réservés.
            </p>
        </footer>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Toggle pour le dropdown de profil
    document.getElementById('profileDropdownToggle').addEventListener('click', function() {
        document.getElementById('profileDropdownMenu').classList.toggle('show');
    });

    // Fermer le dropdown si on clique en dehors
    window.addEventListener('click', function(e) {
        if (!document.getElementById('profileDropdownToggle').contains(e.target) &&
            !document.getElementById('profileDropdownMenu').contains(e.target)) {
            document.getElementById('profileDropdownMenu').classList.remove('show');
        }
    });

    // Toggle pour la sidebar sur mobile
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        document.getElementById('sidebarESN').classList.toggle('show');
    });

    // Fermer la sidebar quand on clique en dehors sur mobile
    window.addEventListener('click', function(e) {
        const sidebar = document.getElementById('sidebarESN');
        const toggleButton = document.getElementById('sidebarToggle');
        if (!sidebar.contains(e.target) && !toggleButton.contains(e.target) && sidebar.classList.contains('show')) {
            sidebar.classList.remove('show');
        }
    });

</script>

@stack('scripts')
</body>
</html>
