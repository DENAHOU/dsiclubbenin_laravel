<?php $__env->startSection('title', 'Gestion des Rôles'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>
                    <i class="fas fa-user-shield me-2"></i>
                    Gestion des Rôles
                </h2>
            </div>

            <!-- Filtres -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" class="row g-3">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" 
                                   placeholder="Rechercher un membre..." value="<?php echo e($search); ?>">
                        </div>
                        <div class="col-md-4">
                            <select name="role" class="form-select">
                                <option value="all" <?php echo e($roleFilter == 'all' ? 'selected' : ''); ?>>
                                    Tous les rôles
                                </option>
                                <option value="membre" <?php echo e($roleFilter == 'membre' ? 'selected' : ''); ?>>
                                    Membres
                                </option>
                                <option value="admin" <?php echo e($roleFilter == 'admin' ? 'selected' : ''); ?>>
                                    Administrateurs
                                </option>
                                <option value="tresor" <?php echo e($roleFilter == 'tresor' ? 'selected' : ''); ?>>
                                    Trésors
                                </option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search me-2"></i>Filtrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tableau des membres -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Rôle Actuel</th>
                                    <th>Date de création</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <?php if($user->photo_path): ?>
                                                    <img src="<?php echo e(asset('storage/' . $user->photo_path)); ?>" 
                                                         class="rounded-circle me-2" width="32" height="32">
                                                <?php else: ?>
                                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2" 
                                                         style="width: 32px; height: 32px; font-size: 12px;">
                                                        <?php echo e(substr($user->name, 0, 1)); ?>

                                                    </div>
                                                <?php endif; ?>
                                                <span><?php echo e($user->name); ?></span>
                                            </div>
                                        </td>
                                        <td><?php echo e($user->email); ?></td>
                                        <td>
                                            <?php if($user->is_admin): ?>
                                                <span class="badge bg-danger">Administrateur</span>
                                            <?php elseif($user->is_tresor): ?>
                                                <span class="badge bg-warning">Trésor</span>
                                            <?php else: ?>
                                                <span class="badge bg-success">Membre</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($user->created_at->format('d/m/Y H:i')); ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" 
                                                        class="btn btn-sm btn-outline-primary dropdown-toggle" 
                                                        data-bs-toggle="dropdown">
                                                    <i class="fas fa-user-cog"></i> Changer le rôle
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="#" class="dropdown-item change-role-btn" 
                                                           data-user-id="<?php echo e($user->id); ?>" 
                                                           data-new-role="membre"
                                                           data-current-role="<?php echo e($user->is_admin ? 'admin' : ($user->is_tresor ? 'tresor' : 'membre')); ?>">
                                                            <i class="fas fa-user me-2"></i>Membre
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="dropdown-item change-role-btn" 
                                                           data-user-id="<?php echo e($user->id); ?>" 
                                                           data-new-role="admin"
                                                           data-current-role="<?php echo e($user->is_admin ? 'admin' : ($user->is_tresor ? 'tresor' : 'membre')); ?>">
                                                            <i class="fas fa-user-shield me-2"></i>Administrateur
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="dropdown-item change-role-btn" 
                                                           data-user-id="<?php echo e($user->id); ?>" 
                                                           data-new-role="tresor"
                                                           data-current-role="<?php echo e($user->is_admin ? 'admin' : ($user->is_tresor ? 'tresor' : 'membre')); ?>">
                                                            <i class="fas fa-coins me-2"></i>Trésor
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted">Aucun membre trouvé</h5>
                                            <p class="text-muted">Essayez de modifier vos filtres de recherche.</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        <?php echo e($users->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestion du changement de rôle
    document.querySelectorAll('.change-role-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            
            const userId = this.dataset.userId;
            const newRole = this.dataset.newRole;
            const currentRole = this.dataset.currentRole;
            
            if (newRole === currentRole) {
                showToast('Cet utilisateur a déjà ce rôle', 'warning');
                return;
            }
            
            if (confirm(`Voulez-vous vraiment changer le rôle de cet utilisateur de "${currentRole}" vers "${newRole}" ?`)) {
                updateRole(userId, newRole);
            }
        });
    });
    
    function updateRole(userId, newRole) {
        console.log('Tentative de mise à jour du rôle:', { userId, newRole });
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (!csrfToken) {
            showToast('Token CSRF non trouvé', 'error');
            return;
        }
        
        console.log('Token CSRF trouvé:', csrfToken.substring(0, 20) + '...');
        
        fetch(`/admin/roles/${userId}/update`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                role: newRole
            })
        })
        .then(response => {
            console.log('Response status:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('Response data:', data);
            if (data.success) {
                showToast(data.message, 'success');
                setTimeout(() => location.reload(), 1500);
            } else {
                showToast(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Erreur lors de la mise à jour du rôle: ' + error.message, 'error');
        });
    }
    
    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `alert alert-${type === 'success' ? 'success' : (type === 'error' ? 'danger' : 'warning')} position-fixed top-0 end-0 m-3`;
        toast.style.zIndex = '9999';
        toast.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="fas fa-${type === 'success' ? 'check-circle' : (type === 'error' ? 'exclamation-circle' : 'info-circle')} me-2"></i>
                ${message}
            </div>
        `;
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transition = 'opacity 0.3s ease';
            setTimeout(() => document.body.removeChild(toast), 300);
        }, 3000);
    }
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app-shell-superadmin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/admin/roles/index.blade.php ENDPATH**/ ?>