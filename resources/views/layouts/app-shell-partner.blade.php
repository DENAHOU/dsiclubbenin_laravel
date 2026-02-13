<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Club DSI Bénin') }} - Espace Partenaire</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome (for icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    <style>
        :root {
            --dsi-blue: #094281;
            --dsi-green: #29963a;
            --light-bg: #f4f7fc;
            --ink: #0e1a2b;
            --muted-ink: #5c6b81;
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 80px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
            margin: 0;
            display: flex; /* Utilisation de flexbox pour le layout principal */
            min-height: 100vh;
            overflow-x: hidden; /* Empêche le défilement horizontal */
        }

        /* ----- Sidebar Styles ----- */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--dsi-blue);
            color: white;
            padding: 1.5rem 0;
            transition: all 0.3s ease;
            flex-shrink: 0; /* Empêche le sidebar de rétrécir */
            position: sticky; /* Sidebar reste fixe lors du défilement */
            top: 0;
            left: 0;
            height: 100vh; /* Prend toute la hauteur de la fenêtre */
            z-index: 1000;
            overflow-y: auto; /* Permet le défilement si le contenu est trop long */
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            margin-bottom: 2rem;
        }

        .sidebar.collapsed .sidebar-header {
            justify-content: center;
            padding: 0 0.5rem;
        }

        .sidebar-logo {
            font-size: 1.8rem;
            font-weight: 800;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sidebar-logo i {
            font-size: 1.5rem;
        }

        .sidebar.collapsed .sidebar-logo span {
            display: none;
        }

        .toggle-btn {
            background: none;
            border: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .sidebar.collapsed .toggle-btn {
            transform: rotate(180deg);
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu-item {
            margin-bottom: 0.5rem;
        }

        .sidebar-menu-item a {
            display: flex;
            align-items: center;
            padding: 0.8rem 1.5rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            border-radius: 8px;
            margin: 0 1rem;
            transition: background-color 0.2s ease, color 0.2s ease;
            gap: 1rem;
            font-weight: 500;
        }

        .sidebar-menu-item a:hover,
        .sidebar-menu-item a.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .sidebar-menu-item a i {
            font-size: 1.2rem;
            width: 25px; /* Pour aligner les icônes */
            text-align: center;
        }

        .sidebar.collapsed .sidebar-menu-item a span {
            display: none;
        }

        .sidebar.collapsed .sidebar-menu-item a {
            justify-content: center;
            padding: 0.8rem 0.5rem;
        }

        .sidebar.collapsed .sidebar-menu-item a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* ----- Main Content Styles ----- */
        .main-content {
            flex-grow: 1; /* Le contenu principal prend tout l'espace restant */
            padding: 2rem;
            transition: margin-left 0.3s ease;
        }

        .navbar-top {
            background-color: white;
            padding: 1rem 2rem;
            border-bottom: 1px solid #e5eaf2;
            display: flex;
            justify-content: flex-end; /* Aligne les éléments à droite */
            align-items: center;
            gap: 1.5rem;
        }

        .navbar-top .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 500;
            color: var(--ink);
        }

        .navbar-top .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--dsi-blue); /* Placeholder */
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .navbar-top .dropdown-toggle::after {
            display: none; /* Cache la flèche par défaut de Bootstrap */
        }

        /* Content Area Padding */
        .content-area {
            padding-top: 2rem;
        }

        /* Media Queries for responsiveness */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed; /* Fixe le sidebar pour les petits écrans */
                left: -var(--sidebar-width); /* Cache le sidebar par défaut */
                height: 100vh;
                padding-top: 5rem; /* Espace pour la barre de navigation mobile */
            }

            .sidebar.active {
                left: 0;
            }

            .main-content {
                width: 100%;
                margin-left: 0;
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .navbar-top {
                justify-content: space-between;
                padding: 0.75rem 1rem;
            }

            .navbar-top .toggle-sidebar-mobile {
                display: block; /* Affiche le bouton de toggle sur mobile */
            }

            .sidebar-header {
                padding: 0 1rem;
            }

            .sidebar.collapsed {
                width: var(--sidebar-width); /* Le sidebar mobile ne se collapse pas en largeur */
            }
            .sidebar.collapsed .sidebar-logo span,
            .sidebar.collapsed .sidebar-menu-item a span {
                display: inline; /* Afficher le texte même si 'collapsed' est sur mobile */
            }
            .sidebar.collapsed .toggle-btn {
                transform: rotate(0deg); /* Réinitialiser la rotation pour mobile */
            }
        }

        .toggle-sidebar-mobile {
            display: none; /* Cacher par défaut sur desktop */
            background: none;
            border: none;
            color: var(--ink);
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* Footer */
        .app-footer {
            padding: 1.5rem 0;
            text-align: center;
            color: var(--muted-ink);
            font-size: 0.9rem;
            border-top: 1px solid #e5eaf2;
            margin-top: auto; /* Pousse le footer vers le bas */
            background-color: white;
        }


        /* ----- Sidebar Profile Card ----- */
        .partner-profile-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1.5rem 1rem;
            margin-bottom: 2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .partner-profile-card .profile-picture {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(255, 255, 255, 0.3);
            margin-bottom: 1rem;
            background-color: white; /* Pour les logos transparents */
        }

        .partner-profile-card h5 {
            margin-bottom: 0.25rem;
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .partner-profile-card p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.85rem;
            margin-bottom: 0;
        }

        /* Styles pour le sidebar collapsé */
        .sidebar.collapsed .partner-profile-card {
            padding: 1rem 0.5rem; /* Ajuster le padding */
        }

        .sidebar.collapsed .partner-profile-card .profile-picture {
            width: 50px; /* Plus petit en mode collapsé */
            height: 50px;
            margin-bottom: 0.5rem;
        }

        .sidebar.collapsed .partner-profile-card h5,
        .sidebar.collapsed .partner-profile-card p {
            display: none; /* Cacher le texte en mode collapsé */
        }
    </style>
</head>
<body>

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            {{-- Le logo et nom du Club DSI Bénin --}}
            <a href="{{ route('home') }}" class="brand">
                <img src="{{ asset('img/logo-dsi.png') }}" alt="Logo" style="height: 80px;">
            </a>

        </div>


        {{-- Carte de profil du Partenaire --}}
        @auth('partner')
            <div class="partner-profile-card">
                <img src="{{ Auth::guard('partner')->user()->logo_path ? asset('storage/' . Auth::guard('partner')->user()->logo_path) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::guard('partner')->user()->company_name) . '&color=FFFFFF&background=094281' }}"
                     alt="Logo Partenaire" class="profile-picture">
                <h5>{{ Auth::guard('partner')->user()->company_name ?? 'Nom de l\'entreprise' }}</h5>
                <p>{{ Auth::guard('partner')->user()->manager_name ?? 'Responsable' }}</p>
            </div>
        @endauth

        <nav class="sidebar-nav">
            <ul class="sidebar-menu">
                <li class="sidebar-menu-item">
                    <a href="{{ route('partner.dashboard') }}" class="{{ request()->routeIs('partner.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i> <span>Tableau de Bord</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('partner.profile.edit') }}" class="{{ request()->routeIs('partner.profile.edit') ? 'active' : '' }}">
                        <i class="fas fa-user-circle"></i> <span>Mon Profil</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('partner.documents.index') }}" class="{{ request()->routeIs('partner.documents') ? 'active' : '' }}">
                        <i class="fas fa-folder-open"></i> <span>Mes Documents</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="#" >
                        <i class="fas fa-code-branch"></i> <span>Gestion des Compétences</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="#">
                        <i class="fas fa-calendar-alt"></i> <span>Événements</span>
                    </a>
                </li>
            </ul>
        </nav>

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

    <div class="main-content d-flex flex-column">
        <header class="navbar-top">
            <div class="container-fluid">
                <h2 class="mb-2 text-primary fw-bold">Bienvenue, {{ Auth::guard('partner')->user()->manager_name }}!</h2>
                <p class="text-muted mb-3 lead">C'est votre espace dédié pour gérer votre partenariat avec Club DSI Bénin.</p>
            </div>
            <button class="toggle-sidebar-mobile" id="mobileSidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            <div class="user-info dropdown">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="user-avatar">{{ substr(Auth::guard('partner')->user()->manager_name, 0, 1) }}</span>
                    <span>{{ Auth::guard('partner')->user()->manager_name }}</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="{{ route('partner.profile.edit') }}">Mon Profil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Paramètres</a>
                    <hr class="dropdown-divider my-1">
            {{-- LOGOUT --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="fas fa-sign-out-alt" ></i> Déconnexion
                </a>
            </form>
                </ul>
            </div>
        </header>

        <main class="content-area flex-grow-1">
            @yield('content')
        </main>

        <footer class="app-footer">
            &copy; {{ date('Y') }} Club DSI Bénin. Tous droits réservés.
        </footer>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');
            const mainContent = document.querySelector('.main-content');

            // Toggle desktop sidebar
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                // Vous pouvez ajuster le mainContent si besoin, mais flexbox gère bien l'espace
            });

            // Toggle mobile sidebar
            mobileSidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active'); // Utilise 'active' pour montrer/cacher sur mobile
            });

            // Close mobile sidebar when clicking outside
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 768 && sidebar.classList.contains('active') &&
                    !sidebar.contains(event.target) && !mobileSidebarToggle.contains(event.target)) {
                    sidebar.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>
