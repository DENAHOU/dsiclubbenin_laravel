@extends('layouts.app-shell-superadmin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-users-cog"></i> Gestion des Rôles
                    </h3>
                </div>
                
                <div class="card-body">
                    <!-- Filtres et recherche -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" id="searchInput" class="form-control" placeholder="Rechercher un utilisateur...">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select id="roleFilter" class="form-select">
                                <option value="">Tous les rôles</option>
                                <option value="membre">Membre</option>
                                <option value="admin">Admin</option>
                                <option value="tresor">Trésor</option>
                            </select>
                        </div>
                        <div class="col-md-5 text-end">
                            <span class="badge bg-info" id="totalUsers">Total: {{ $users->count() }} utilisateurs</span>
                        </div>
                    </div>

                    <!-- Tableau des utilisateurs -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Rôle actuel</th>
                                    <th>Statut</th>
                                    <th>Paiement</th>
                                    <th>Date de création</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="usersTableBody">
                                @foreach($users as $user)
                                <tr data-user-id="{{ $user->id }}">
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        <strong>{{ $user->name }}</strong>
                                        @if($user->username)
                                            <br><small class="text-muted">@{{ $user->username }}</small>
                                        @endif
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : ($user->role === 'tresor' ? 'warning' : ($user->role === 'membre' ? 'primary' : 'secondary')) }}" id="role-{{ $user->id }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $user->status === 'approved' ? 'success' : ($user->status === 'pending' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($user->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $user->is_paid ? 'success' : 'danger' }}">
                                            {{ $user->is_paid ? 'Payé' : 'Non payé' }}
                                        </span>
                                    </td>
                                    <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                <i class="fas fa-user-tag"></i> Changer le rôle
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item change-role" href="#" data-role="membre">
                                                    <i class="fas fa-user"></i> Membre
                                                </a></li>
                                                <li><a class="dropdown-item change-role" href="#" data-role="admin">
                                                    <i class="fas fa-user-shield text-danger"></i> Admin
                                                </a></li>
                                                <li><a class="dropdown-item change-role" href="#" data-role="tresor">
                                                    <i class="fas fa-coins text-warning"></i> Trésor
                                                </a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toast pour les notifications -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="roleToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Gestion des rôles</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="toastMessage">
            Message...
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const roleFilter = document.getElementById('roleFilter');
    const usersTableBody = document.getElementById('usersTableBody');
    const totalUsers = document.getElementById('totalUsers');
    const roleToast = new bootstrap.Toast(document.getElementById('roleToast'));
    const toastMessage = document.getElementById('toastMessage');

    // Fonction pour afficher un message
    function showToast(message, type = 'success') {
        toastMessage.textContent = message;
        const toastHeader = roleToast.querySelector('.toast-header');
        toastHeader.className = 'toast-header text-bg-' + (type === 'success' ? 'success' : 'danger');
        roleToast.show();
    }

    // Recherche en temps réel
    let searchTimeout;
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            performSearch();
        }, 300);
    });

    // Filtre par rôle
    roleFilter.addEventListener('change', performSearch);

    function performSearch() {
        const query = searchInput.value.trim();
        const role = roleFilter.value;

        fetch(`/admin/roles/search?q=${encodeURIComponent(query)}&role=${encodeURIComponent(role)}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newTableBody = doc.getElementById('usersTableBody');
            
            if (newTableBody) {
                usersTableBody.innerHTML = newTableBody.innerHTML;
                updateTotalCount();
            }
        })
        .catch(error => {
            console.error('Erreur lors de la recherche:', error);
            showToast('Erreur lors de la recherche', 'error');
        });
    }

    function updateTotalCount() {
        const rows = usersTableBody.querySelectorAll('tr');
        totalUsers.textContent = `Total: ${rows.length} utilisateurs`;
    }

    // Gestion du changement de rôle
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('change-role')) {
            e.preventDefault();
            
            const dropdownItem = e.target;
            const userId = dropdownItem.closest('tr').dataset.userId;
            const newRole = dropdownItem.dataset.role;
            
            if (confirm(`Êtes-vous sûr de vouloir changer le rôle de cet utilisateur en "${newRole}" ?`)) {
                changeRole(userId, newRole);
            }
        }
    });

    function changeRole(userId, newRole) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        fetch(`/admin/roles/${userId}/update`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                role: newRole
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Mettre à jour le badge de rôle
                const roleBadge = document.getElementById(`role-${userId}`);
                if (roleBadge) {
                    roleBadge.textContent = ucfirst(newRole);
                    roleBadge.className = `badge bg-${newRole === 'admin' ? 'danger' : (newRole === 'tresor' ? 'warning' : (newRole === 'membre' ? 'primary' : 'secondary'))}`;
                }
                
                showToast(data.message, 'success');
            } else {
                showToast(data.message || 'Erreur lors de la mise à jour', 'error');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            showToast('Erreur lors de la mise à jour du rôle', 'error');
        });
    }

    function ucfirst(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }
});
</script>
@endpush