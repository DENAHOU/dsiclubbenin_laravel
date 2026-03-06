<?php $__env->startSection('title', 'Liste des membres'); ?>

<?php $__env->startSection('content'); ?>

<style>
.table-card {
    border-radius: 14px;
    background: #fff;
    box-shadow: 0 8px 24px rgba(0,0,0,0.05);
    padding: 1.5rem;
}

.search-box input {
    height: 46px;
    border-radius: 10px;
}

.badge-type {
    padding: 6px 10px;
    border-radius: 8px;
    font-size: .75rem;
}
.badge-user { background:#e3f2fd; color:#0d47a1; }
.badge-company { background:#e8f5e9; color:#1b5e20; }
.badge-administration { background:#fff3e0; color:#e65100; }
.badge-college { background:#f3e5f5; color:#6a1b9a; }
.badge-admin {
    background:#e1f5fe;
    color:#01579b;
}

.badge-tresor {
    background:#fce4ec;
    color:#880e4f;
}

.table-hover tbody tr:hover {
    background:#f8fbff;
}

.action-btn {
    padding: 4px 10px;
    border-radius: 6px;
    gap: 20px
}
.view-btn { background:#0d47a1; color:white; }
</style>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">📋 Liste des membres</h3>
        <a href="<?php echo e(route('admin.members.create')); ?>" class="btn btn-primary btn-lg">
            + Ajouter un membre
        </a>
    </div>

    
    <form method="GET" action="<?php echo e(route('admin.members.list')); ?>" class="row mb-4">
        <div class="col-md-4 mb-2">
            <div class="search-box">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>"

                       class="form-control"
                       placeholder="Rechercher : nom, email…">
            </div>
        </div>

        <div class="col-md-4 mb-2">
            <select name="type" class="form-select" onchange="this.form.submit()">
                <option value="">Tous les types</option>
                <option value="users" <?php echo e(request('type')=='users' ? 'selected' : ''); ?>>Membre Individuel</option>
                <option value="companies" <?php echo e(request('type')=='companies' ? 'selected' : ''); ?>>Entité Utilisatrice</option>
                <option value="administrations" <?php echo e(request('type')=='administrations' ? 'selected' : ''); ?>>Administration publique</option>
                <option value="colleges" <?php echo e(request('type')=='colleges' ? 'selected' : ''); ?>>Collège IT</option>
                <option value="admins" <?php echo e(request('type')=='admins' ? 'selected' : ''); ?>>Administrateurs</option>
                <option value="tresor" <?php echo e(request('type')=='tresor' ? 'selected' : ''); ?>>Trésorerie</option>
            </select>
        </div>

        
        <div class="col-md-2">
            <button class="btn btn-secondary w-100">Filtrer</button>
        </div>
    </form>

    <div class="table-card">

        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Date d'inscription</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="fw-bold"><?php echo e($m['name']); ?></td>
                        <td><?php echo e($m['email']); ?></td>

                        <td>
                            <?php if($m['type'] == 'Membre Individuel'): ?>
                                <span class="badge badge-type badge-user"><?php echo e($m['type']); ?></span>
                            <?php elseif($m['type'] == 'Entreprise'): ?>
                                <span class="badge badge-type badge-company"><?php echo e($m['type']); ?></span>
                            <?php elseif($m['type'] == 'Administration Publique'): ?>
                                <span class="badge badge-type badge-administration"><?php echo e($m['type']); ?></span>
                            <?php elseif($m['type'] == 'Collège IT'): ?>
                                <span class="badge badge-type badge-college"><?php echo e($m['type']); ?></span>
                            <?php elseif($m['type'] == 'Administrateur'): ?>
                                <span class="badge badge-type badge-admin"><?php echo e($m['type']); ?></span>
                            <?php elseif($m['type'] == 'Trésorerie'): ?>
                                <span class="badge badge-type badge-tresor"><?php echo e($m['type']); ?></span>
                            <?php else: ?>
                                <span class="badge badge-type badge-college"><?php echo e($m['type']); ?></span>
                            <?php endif; ?>
                        </td>


                        <td><?php echo e(\Carbon\Carbon::parse($m['created_at'])->format('d/m/Y H:i')); ?></td>

                        <td class="text-end">

                            
                            <a href="<?php echo e(route('admin.members.view', ['type' => $m['slug'], 'id' => $m['id']])); ?>"
                            class="btn btn-sm btn-primary me-2">
                                Voir
                            </a>

                            
                            <form action="<?php echo e(route('admin.members.block', ['type' => $m['slug'], 'id' => $m['id']])); ?>"
                                method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <button class="btn btn-sm btn-warning">
                                    Bloquer
                                </button>
                            </form>

                            
                            <form action="<?php echo e(route('admin.members.delete', ['type' => $m['slug'], 'id' => $m['id']])); ?>"
                                method="POST" class="d-inline"
                                onsubmit="return confirm('Supprimer ce membre ?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-danger">
                                    Supprimer
                                </button>
                            </form>

                        </td>

                    </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="5" class="text-center py-3 text-muted">Aucun membre trouvé.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        
        <div class="mt-3">
            <?php echo e($members->links('pagination::bootstrap-5')); ?>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-shell-superadmin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/admin/members/list.blade.php ENDPATH**/ ?>