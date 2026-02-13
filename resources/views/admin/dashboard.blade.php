@extends('layouts.app-shell-superadmin')

<style>

:root {
    --primary: #094281;
    --primary-light: #0c549f;
    --success: #2aa84f;
    --danger: #e55353;
    --bg-light: #f4f7fb;
}

/* ===== STRUCTURE ===== */
.admin-shell {
    display: flex;
    min-height: 100vh;
    background: var(--bg-light);
}

/* ===== SIDEBAR ===== */
.admin-sidebar {
    width: 260px;
    background: var(--primary);
    color: #fff;
    padding: 1.5rem;
    position: fixed;
    height: 100vh;
    top: 0;
    left: 0;
    box-shadow: 4px 0 16px rgba(0,0,0,0.1);
}

.admin-sidebar .logo {
    display: block;
    margin: 0 auto 1.5rem;
    max-width: 140px;
}

.admin-sidebar .nav a {
    display: block;
    padding: .65rem 1rem;
    margin-bottom: .35rem;
    border-radius: 8px;
    color: rgba(255,255,255,0.9);
    text-decoration: none;
    font-weight: 500;
    transition: 0.2s linear;
}

.admin-sidebar .nav a:hover,
.admin-sidebar .nav a.active {
    background: rgba(255,255,255,0.12);
}

/* ===== CONTENT ===== */
.admin-content {
    margin-left: 260px;
    padding: 2rem;
    width: calc(100% - 260px);
}

/* Header */
.admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.admin-header h1 {
    font-size: 26px;
    font-weight: 700;
    margin-bottom: 4px;
}

/* ===== STAT CARDS ===== */
.stat-card {
    background: #fff;
    border-radius: 12px;
    padding: 1.4rem;
    box-shadow: 0 4px 16px rgba(9,66,129,0.08);
    border-left: 5px solid var(--primary);
    transition: .2s ease;
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 22px rgba(9,66,129,0.12);
}

.stat-value {
    font-size: 2rem;
    font-weight: 800;
    color: var(--primary);
}

/* ===== TABLE ===== */
.card {
    border-radius: 12px;
    overflow: hidden;
}

.card-header {
    background: #fff;
    font-weight: 600;
    padding: 1rem 1.3rem;
    border-bottom: 1px solid #e5e9ef;
}

.table td, .table th {
    vertical-align: middle;
}

/* ===== BUTTONS APPROVE / REJECT ===== */
.btn-approve {
    background: var(--success);
    border: none;
    padding: .45rem .6rem;
    border-radius: 8px;
    color: #fff;
    font-size: .9rem;
    transition: .2s;
}

.btn-approve:hover {
    background: #238c42;
}

.btn-reject {
    background: var(--danger);
    border: none;
    padding: .45rem .6rem;
    border-radius: 8px;
    color: #fff;
    font-size: .9rem;
    transition: .2s;
}

.btn-reject:hover {
    background: #c04141;
}

/* ===== MOBILE ===== */
@media (max-width: 992px) {
    .admin-sidebar {
        position: fixed;
        width: 220px;
        transform: translateX(-100%);
        transition: 0.3s ease;
        z-index: 999;
    }

    .admin-sidebar.open {
        transform: translateX(0);
    }

    .admin-content {
        margin-left: 0;
        width: 100%;
    }
}
</style>

@section('content')

<div class="admin-header d-flex justify-content-between align-items-center">
    <div>
        <h1>Tableau de bord</h1>
        <p class="text-muted mb-0">
Bienvenue, {{ auth()->user()->name ?? 'Administrateur' }}
        </p>
    </div>

    <div class="d-flex align-items-center gap-3">

        {{-- Voir le site --}}
        <a href="{{ route('home') }}" class="btn btn-outline-secondary">
            <i class="fa fa-globe me-1"></i> Voir le site
        </a>

        {{-- MENU UTILISATEUR --}}
        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle d-flex align-items-center"
                    type="button"
                    id="adminMenu"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">

                <i class="fa fa-user-circle fa-lg me-2"></i>
                <span class="fw-semibold">
                    {{ auth()->user()->name ?? 'Admin' }}

                </span>
            </button>

            <ul class="dropdown-menu dropdown-menu-end shadow-sm"
                aria-labelledby="adminMenu">

                {{-- PROFIL --}}
                <li>
                    <a class="dropdown-item"
                       href="{{ route('admin.profile') }}">
                        <i class="fa fa-user me-2"></i> Profil
                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                {{-- DÉCONNEXION --}}
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fas fa-sign-out-alt" ></i> Déconnexion
                        </a>
                    </form>
                </li>

            </ul>
        </div>

    </div>
</div>


{{-- STATISTIQUES --}}
<div class="row g-4 mb-4">

    <div class="col-md-3">
        <div class="stat-card">
            <div class="small text-muted">Utilisateurs Individuels</div>
            <div class="stat-value">{{ $totalUsers }}</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">
            <div class="small text-muted">Entreprises</div>
            <div class="stat-value">{{ $totalCompanies }}</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">
            <div class="small text-muted">Administrations</div>
            <div class="stat-value">{{ $totalAdministrations }}</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">
            <div class="small text-muted">Collèges</div>
            <div class="stat-value">{{ $totalColleges }}</div>
        </div>
    </div>
</div>

{{-- ADHESIONS EN ATTENTE --}}
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <strong>Adhésions en attente ({{ $pendingTotal }})</strong>
        <span class="text-muted">Actions rapides – Validation instantanée</span>
    </div>

    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th width="180">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($recentPending as $p)
                    <tr id="member-row-{{ $p['type'] }}-{{ $p['id'] }}">
                        <td>{{ $p['name'] }}</td>
                        <td>{{ $p['email'] ?? '—' }}</td>
                        <td>{{ ucfirst($p['type']) }}</td>
                        <td>{{ \Carbon\Carbon::parse($p['created_at'])->format('d/m/Y H:i') }}</td>

                        <td>
                            <button class="btn-approve btn-action me-2"
                                    data-type="{{ $p['type'] }}"
                                    data-id="{{ $p['id'] }}">
                                <i class="fa fa-check"></i>
                            </button>

                            <button class="btn-reject btn-action me-2"
                                    data-type="{{ $p['type'] }}"
                                    data-id="{{ $p['id'] }}">
                                <i class="fa fa-times"></i>
                            </button>

                            <a href="{{ route('admin.members.show', ['type'=>$p['type'],'id'=>$p['id']]) }}"
                               class="btn btn-light btn-sm">
                               Détails
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center p-3 text-muted">
                            Aucune adhésion en attente.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>

@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){

    document.querySelectorAll('.btn-action').forEach(btn => {
        btn.addEventListener('click', function() {

            const type = this.dataset.type;
            const id = this.dataset.id;
            const action = this.classList.contains('btn-approve') ? 'approve' : 'reject';

            if (!confirm("Confirmer l'action ?")) return;

            fetch(`/admin/members/${type}/${id}/${action}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`member-row-${type}-${id}`).remove();
                    alert("Opération réussie !");
                } else {
                    alert("Erreur : " + data.error);
                }
            });
        });
    });

});
</script>
@endpush
