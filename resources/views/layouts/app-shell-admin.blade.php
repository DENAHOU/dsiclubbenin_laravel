<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club DSI Bénin - @yield('title', 'Espace Membre')</title>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    <!-- CSS de base pour le layout "App Shell" -->
    <style>
        :root {
            --dsi-blue: #094281;
            --dsi-blue-dark: #0a2b5c;
            --dsi-green: #29963a;
            --light-bg: #f4f7fc;
            --ink: #0e1a2b;
            --muted-ink: #5c6b81;
            --border-color: #e5eaf2;
        }
        body { font-family: 'Inter', sans-serif; background-color: var(--light-bg); margin: 0; }
        .app-shell { display: grid; grid-template-columns: 260px 1fr; min-height: 100vh; }

        /* --- SIDEBAR (Menu Latéral) --- */
        .sidebar {
            background: linear-gradient(180deg, #0f2b57 0%, #083063 100%);
            color: white;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
        }
        .sidebar .brand { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 2rem; }
        .sidebar .brand img { height: 45px; } /* Ajusté pour le logo centré */
        .sidebar .brand-name { font-weight: 700; font-size: 1.2rem; color: white; text-decoration: none; }

        .sidebar-nav { list-style: none; padding: 0; margin: 0; }
        .sidebar-nav .nav-title { font-size: 0.8rem; text-transform: uppercase; color: rgba(255,255,255,0.4); padding: 0 0.75rem; margin: 1.5rem 0 0.5rem 0; }
        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.75rem;
            border-radius: 8px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .sidebar-nav .nav-link:hover {
            background: rgba(255,255,255,0.1);
            color: white;
        }
        .sidebar-nav .nav-link.active {
            background: var(--dsi-green);
            color: white;
            font-weight: 600;
        }
        .sidebar-nav .nav-link i { width: 20px; text-align: center; }

        /* Styles spécifiques pour le profil admin dans la sidebar */
        .admin-profile-sidebar {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .admin-profile-sidebar .profile-picture {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--dsi-green);
            margin-bottom: 0.75rem;
        }
        .admin-profile-sidebar h5 {
            color: white;
            margin-bottom: 0.25rem;
            font-weight: 600;
        }
        .admin-profile-sidebar p {
            color: rgba(255,255,255,0.7);
            font-size: 0.9rem;
            margin-bottom: 0;
        }

        .sidebar-footer { margin-top: auto; } /* Pousse le pied de page en bas */

        /* --- Zone de Contenu Principal --- */
        .main-wrapper {
            display: flex;
            flex-direction: column;
        }

        /* --- Règles pour la Responsivité --- */
        @media (max-width: 992px) {
            .app-shell { grid-template-columns: 1fr; }
            .sidebar {
                /* Sur mobile, on pourrait transformer la sidebar en menu hamburger */
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="app-shell">
    <!-- ============================================= -->
    <!--       SIDEBAR (MENU LATÉRAL FIXE)             -->
    <!-- ============================================= -->
    <aside class="sidebar">
        <div>
            {{-- Le logo et nom du Club DSI Bénin --}}
            <a href="{{ route('home') }}" class="brand">
                <img src="{{ asset('img/logo-dsi.png') }}" alt="Logo" style="height: 80px;">
            </a>

            <ul class="sidebar-nav">
                <li class="nav-item">
                    {{-- Le lien du tableau de bord dépend du type d'utilisateur connecté --}}
                    @auth('administration')
                        <a href="{{ route('administration.dahbord') }}" class="nav-link {{ Request::routeIs('administration.dahbord') ? 'active' : '' }}"><i class="fas fa-home"></i> Tableau de Bord</a>
                     @endauth
                </li>

                {{-- Sections communes --}}
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-comments"></i> Forum </a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-book-bookmark"></i> Bibliothèque</a></li>

                {{-- Sections spécifiques aux Administrations --}}
                    <li class="nav-title">Espace Administration Publique</li>

                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#cotisationMenu">
                            <i class="fas fa-wallet"></i> Mes Cotisations
                        </a>

                        <ul class="collapse list-unstyled ps-3" id="cotisationMenu">
                            <li>
                                <a href="{{ route('membership.pay') }}" class="nav-link">
                                    ➕ Effectuer un paiement
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('membership.history') }}" class="nav-link">
                                    📜 Historique des paiements
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item"><a href="{{ route('administration.profil', Auth::guard('administration')->user()->id) }}" class="nav-link"><i class="fas fa-user-circle"></i> Mon Profil</a></li>
                    {{-- <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-star"></i> Compétences disponibles</a></li> --}}
                    <li class="nav-item"><a href="{{ route($userType . '.formations') }}" class="nav-link"><i class="fas fa-book"></i> Formations disponibles </a></li>

                    <li class="nav-title">Réseau</li>
                    <li class="nav-item"><a href="{{ route($userType . '.annuaire.membres') }}" class="nav-link"><i class="fas fa-users"></i> Annuaire Membres</a></li>
                    <li class="nav-item"><a href="{{ route($userType . '.annuaire.partenaires') }}" class="nav-link"><i class="fas fa-handshake"></i> Annuaire Partenaires</a></li>
            </ul>
        </div>

        <div class="sidebar-footer">
             <ul class="sidebar-nav">
                <li class="nav-item">

                    <li class="nav-title">Mon Compte</li>

                    <li class="nav-item"><a class="nav-link" href="{{ route('administration.settings', Auth::guard('administration')->user()->id) }}"><i class="fas fa-cogs me-2"></i> Paramètres du Compte</a></li>
                    <li class="nav-item">
            {{-- LOGOUT --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="fas fa-sign-out-alt" ></i> Déconnexion
                </a>
            </form>
                    </li>
                </li>
             </ul>
        </div>
    </aside>

    <!-- ============================================= -->
    <!--       CONTENU PRINCIPAL (DROITE)              -->
    <!-- ============================================= -->
    <div class="main-wrapper">
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
