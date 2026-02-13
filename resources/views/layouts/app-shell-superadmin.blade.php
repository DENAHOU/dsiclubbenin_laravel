<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration - DSI CLUB</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Styles personnalisés --}}
    <style>
        body { background:#f4f7fb; margin:0; }
        .admin-shell { display:flex; min-height:100vh; }

        .admin-sidebar {
            width:260px;
            background:#094281;
            color:white;
            padding:1.5rem;
            position:fixed;
            height:100vh;
            overflow-y: auto;
        }

        /* Style du scrollbar pour la sidebar */
        .admin-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .admin-sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .admin-sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        .admin-sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        .admin-sidebar .logo {
            max-width:150px;
            display:block;
            margin:0 auto 1.5rem;
        }

        .admin-sidebar .nav-title {
            font-size: 0.8rem;
            text-transform: uppercase;
            color: rgba(255,255,255,0.4);
            padding: 0 0.75rem;
            margin: 1.5rem 0 0.5rem 0;
        }


        .admin-sidebar .nav a {
            color:rgba(255,255,255,0.9);
            padding:.7rem .9rem;
            border-radius:8px;
            display:block;
            text-decoration:none;
            margin-bottom:.3rem;
            font-size:15px;
        }

        .admin-sidebar .nav a:hover,
        .admin-sidebar .nav a.active {
            background:rgba(255,255,255,0.15);
        }

        .admin-content {
            margin-left:260px;
            padding:2rem;
            width:calc(100% - 260px);
        }

        .admin-header {
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:1.5rem;
        }

        .admin-header h1 {
            margin:0;
            font-size:24px;
            font-weight:700;
        }
    </style>

    @stack('styles')
</head>
<body>

<div class="admin-shell">

    {{-- SIDEBAR --}}
    <aside class="admin-sidebar">
        <img src="{{ asset('img/logo-dsi.png') }}" class="logo" alt="Logo DSI">

        <nav class="nav mt-3">

            {{-- DASHBOARD --}}
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa fa-home me-2"></i> Tableau de bord
            </a>

            {{-- MEMBRES --}}
            <div class="has_sub">
                <li class="nav-title">Les Membres</li>
                <a onclick="toggleMenu(this)" style="gap: 30px;">
                    <i class="fa fa-user me-2"></i>
                    Membres <i class="fa fa-chevron-right float-end"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{ route('admin.members.create') }}">
                        <i class="fa fa-users"></i> Ajouter un membre</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.members.list') }}">
                            <i class="fa fa-users"></i> Liste des membres
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.members.pending') }}"
                            class="{{ request()->routeIs('admin.members.pending') ? 'active' : '' }}">
                            <i class="fa fa-users me-2"></i> Adhésions en attentes
                        </a>

                    </li>

                    <li>
                        <a href="{{ route('admin.members.rejected') }}">
                            <i class="fa fa-users"></i> Adhésions rejetées</a>
                    </li>

                    <li>
                        <a href="{{ route('admin.board.index') }}">
                            Bureau
                        </a>
                    </li>

                </ul>
            </div>




            {{-- PARTENAIRES --}}
            <div class="has_sub">
                <li class="nav-title">Le Club</li>
                <a onclick="toggleMenu(this)">
                    <i class="fa fa-user-plus me-2"></i>
                    Partenaires <i class="fa fa-chevron-right float-end"></i>
                </a>
                <ul class="submenu">
                     <li><a href="{{ route('admin.partners.types') }}">Types de Partenaires</a></li>
                    <li><a href="{{ route('admin.partners.formules') }}">Formules d'adhésions</a></li>
                    <li><a href="{{ route('admin.partners.index') }}">Liste des Partenaires</a></li>

                    {{-- PARTENAIRES PRESSE --}}
                    <li><a href="{{ route('admin.partners.press') }}">Partenaires Presse</a></li>
                </ul>
            </div>

            {{-- PROGRAMMES THÉMATIQUES --}}
            <a href="{{ route('admin.programs.index') }}">
                <i class="fa fa-th-list me-2"></i> Programmes Thématiques
            </a> 

            {{-- ÉVÈNEMENTS --}}
            <div class="has_sub">
            <li class="nav-title">Activités</li>
                <a onclick="toggleMenu(this)">
                    <i class="fa fa-calendar me-2"></i>
                    Évènements <i class="fa fa-chevron-right float-end"></i>
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('admin.events.type') }}">Type d'évènement</a></li>
                    <li><a href="{{ route('admin.events.create') }}">Ajouter un évènement</a></li>
                    <li><a href="{{ route('admin.events.index') }}">Liste des évènements</a></li>
                </ul>
            </div>

            {{-- FORMATIONS --}}
            <div class="has_sub">
                <a onclick="toggleMenu(this)">
                    <i class="fa fa-graduation-cap me-2"></i>
                    Formations <i class="fa fa-chevron-right float-end"></i>
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('admin.formations.categories') }}">Catégories de formations</a></li>
                    <li><a href="{{ route('admin.formations.create') }}">Ajouter une formation</a></li>
                    <li><a href="{{ route('admin.formations.index') }}">Liste des formations</a></li>
                </ul>
            </div>


            {{-- RECRUTEMENTS --}}
            


            {{-- ESN --}}
            {{-- <div class="has_sub">
                <a onclick="toggleMenu(this)">
                    <i class="fas fa-building me-2"></i>
                    ESN <i class="fa fa-chevron-right float-end"></i>
                </a>
                <ul class="submenu">
                    <li><a href="https://clubdsibenin.bj/espace-admin/gestion-esn/liste-demandes">Liste des demandes</a></li>
                    <li><a href="https://clubdsibenin.bj/chatify">Messagerie</a></li>
                    <li><a href="https://clubdsibenin.bj/espace-admin/esn/notifications">Notifications</a></li>
                </ul>
            </div> --}}


            {{-- FAQ --}}
            {{-- <div class="has_sub">
                <a onclick="toggleMenu(this)">
                    <i class="fa fa-question me-2"></i>
                    FAQ <i class="fa fa-chevron-right float-end"></i>
                </a>
                <ul class="submenu">
                    <li><a href="https://clubdsibenin.bj/espace-admin/faqs/ajouter">Ajouter</a></li>
                    <li><a href="https://clubdsibenin.bj/espace-admin/faqs">Liste</a></li>
                </ul>
            </div> --}}


            {{-- DOCUMENTS --}}
            {{-- <div class="has_sub">
                <a onclick="toggleMenu(this)">
                    <i class="far fa-file me-2"></i>
                    Documents <i class="fa fa-chevron-right float-end"></i>
                </a>
                <ul class="submenu">
                    <li><a href="https://clubdsibenin.bj/espace-admin/documents/ajouter">Ajouter</a></li>
                    <li><a href="https://clubdsibenin.bj/espace-admin/documents">Liste</a></li>
                    <li><a href="https://clubdsibenin.bj/espace-admin/category-documents">Catégories</a></li>
                </ul>
            </div> --}}


            {{-- LOGOUT --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="fas fa-sign-out-alt" ></i> Déconnexion
                </a>
            </form>

        </nav>
    </aside>

    {{-- CONTENU PRINCIPAL --}}
    <main class="admin-content">
        @yield('content')
    </main>
</div>


{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
function toggleMenu(element) {
    const parent = element.parentElement;
    parent.classList.toggle('open');
}
</script>

<style>
.has_sub ul.submenu {
    display: none;
    list-style: none;
    padding-left: 1rem;
    margin-top: .4rem;
}

.has_sub.open ul.submenu {
    display: block;
}

.has_sub > a {
    cursor: pointer;
}
</style>


@stack('scripts')
</body>
</html>
