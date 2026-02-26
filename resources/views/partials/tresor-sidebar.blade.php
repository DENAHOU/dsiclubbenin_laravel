<!-- Menu Trésorier -->
<div class="tresor-menu">
    <!-- Tableau de bord -->
    <li class="tresor-menu-title">Tableau de bord</li>
    <li>
        <a href="{{ route('tresor.dashboard') }}" class="{{ request()->routeIs('tresor.dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i>
            Tableau de bord
        </a>
    </li>

    <!-- Gestion des membres -->
    <li class="tresor-menu-title">Gestion des membres</li>
    <li>
        <a href="{{ route('tresor.members.index') }}" class="{{ request()->routeIs('tresor.members.*') ? 'active' : '' }}">
            <i class="fas fa-users"></i>
            Liste des membres
        </a>
    </li>
    <li>
        <a href="{{ route('tresor.members.inactive') }}" class="{{ request()->routeIs('tresor.members.inactive') ? 'active' : '' }}">
            <i class="fas fa-user-slash"></i>
            Membres inactifs
        </a>
    </li>

    <!-- Gestion des cotisations -->
    <li class="tresor-menu-title">Gestion des cotisations</li>
    <li>
        <a href="{{ route('tresor.cotisations.index') }}" class="{{ request()->routeIs('tresor.cotisations.*') ? 'active' : '' }}">
            <i class="fas fa-money-bill-wave"></i>
            Liste des paiements
        </a>
    </li>
    <li>
        <a href="{{ route('tresor.cotisations.create') }}" class="{{ request()->routeIs('tresor.cotisations.create') ? 'active' : '' }}">
            <i class="fas fa-plus-circle"></i>
            Enregistrer un paiement
        </a>
    </li>
    <li>
        <a href="{{ route('tresor.cotisations.reminder') }}" class="{{ request()->routeIs('tresor.cotisations.reminder') ? 'active' : '' }}">
            <i class="fas fa-envelope"></i>
            Mail de relance
        </a>
    </li>

    <!-- Rapports financiers -->
    <li class="tresor-menu-title">Rapports financiers</li>
    <li>
        <a href="{{ route('tresor.reports.summary') }}" class="{{ request()->routeIs('tresor.reports.summary') ? 'active' : '' }}">
            <i class="fas fa-chart-pie"></i>
            Point sur les cotisations
        </a>
    </li>
    <li>
        <a href="{{ route('tresor.reports.revenue') }}" class="{{ request()->routeIs('tresor.reports.revenue') ? 'active' : '' }}">
            <i class="fas fa-chart-line"></i>
            Recette du club
        </a>
    </li>
    <li>
        <a href="{{ route('tresor.reports.debt') }}" class="{{ request()->routeIs('tresor.reports.debt') ? 'active' : '' }}">
            <i class="fas fa-exclamation-triangle"></i>
            Dettes des membres
        </a>
    </li>

    <!-- Mes cotisations -->
    <li class="tresor-menu-title">Mes informations</li>
    <li>
        <a href="{{ route('tresor.profile') }}" class="{{ request()->routeIs('tresor.profile') ? 'active' : '' }}">
            <i class="fas fa-user-circle"></i>
            Mon profil
        </a>
    </li>
    <li>
        <a href="{{ route('tresor.cotisations.personal') }}" class="{{ request()->routeIs('tresor.cotisations.personal') ? 'active' : '' }}">
            <i class="fas fa-wallet"></i>
            Mes cotisations
        </a>
    </li>
</div>
