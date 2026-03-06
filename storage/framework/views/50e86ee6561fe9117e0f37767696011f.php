

<?php $__env->startSection('content'); ?>
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
                            <span class="badge bg-info text-dark" id="totalUsers">Total: <?php echo e($users->count()); ?> utilisateurs</span>
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
                                    <th>Adhésion</th>
                                    <th>Rôle ajouté</th>
                                    <th>Date de création</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="usersTableBody">
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr data-user-id="<?php echo e($user->id); ?>">
                                    <td><?php echo e($user->id); ?></td>
                                    <td>
                                        <strong><?php echo e($user->name); ?></strong>
                                       
                                    </td>
                                    <td><?php echo e($user->email); ?></td>
                                    <td>
                                        <span class="badge bg-<?php echo e($user->role === 'admin' ? 'danger' : ($user->role === 'tresor' ? 'warning' : ($user->role === 'member' ? 'primary' : 'secondary'))); ?>" id="role-<?php echo e($user->id); ?>">
                                            <?php echo e(ucfirst($user->role)); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-<?php echo e($user->status === 'approved' ? 'success' : ($user->status === 'pending' ? 'warning' : 'danger')); ?>">
                                            <?php echo e(ucfirst($user->status)); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-<?php echo e($user->is_paid ? 'success' : 'danger'); ?>">
                                            <?php echo e($user->is_paid ? 'Payé' : 'Non payé'); ?>

                                        </span>
                                    </td>
                                   <td id="added-role-<?php echo e($user->id); ?>">
                                        <?php if($user->is_admin == 1 && $user->is_tresor == 1): ?>
                                            <span class="badge bg-danger">Admin</span>
                                            <span class="badge bg-warning text-dark">Trésor</span>
                                        <?php elseif($user->is_admin == 1): ?>
                                            <span class="badge bg-danger">Admin</span>
                                        <?php elseif($user->is_tresor == 1): ?>
                                            <span class="badge bg-warning text-dark">Trésor</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Aucun</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php echo e($user->created_at ? $user->created_at->format('d/m/Y H:i') : '-'); ?>

                                    </td>
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
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
            body: JSON.stringify({ role: newRole })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Mise à jour de la colonne "Rôle ajouté"
                const addedRoleCell = document.getElementById(`added-role-${userId}`);
                if (addedRoleCell) {
                    let badges = '';

                    if (data.user.is_admin == 1) {
                        badges += '<span class="badge bg-danger">Admin</span> ';
                    }
                    if (data.user.is_tresor == 1) {
                        badges += '<span class="badge bg-warning text-dark">Trésor</span> ';
                    }
                    if (!data.user.is_admin && !data.user.is_tresor) {
                        badges = '<span class="badge bg-secondary">Aucun</span>';
                    }

                    addedRoleCell.innerHTML = badges;
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app-shell-superadmin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/admin/roles/index.blade.php ENDPATH**/ ?>