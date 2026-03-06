<?php $__env->startSection('title', 'Gestion des Formations'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }
    .status-badge {
        font-size: 0.8rem;
        font-weight: 600;
        padding: 0.3em 0.6em;
        border-radius: 20px;
    }
    .status-published { background-color: #d1fae5; color: #065f46; }
    .status-draft { background-color: #feefc3; color: #92400e; }
    .status-archived { background-color: #e5e7eb; color: #374151; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4">
        <!-- Header de la page -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 fw-bold mb-0">Gestion des Formations</h1>
                <p class="text-muted">Créez, modifiez et gérez toutes les formations du Club DSI.</p>
            </div>
            <a href="<?php echo e(route('admin.formations.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus-circle me-2"></i> Ajouter une Formation
            </a>
        </div>

        <!-- Alerte de succès -->
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Tableau des formations -->
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Titre</th>
                                <th scope="col">Catégorie</th>
                                <th scope="col">Type</th>
                                <th scope="col">Date de Début</th>
                                <th scope="col">Statut</th>
                                <th scope="col" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td>
                                        <strong class="text-dark"><?php echo e($formation->titre); ?></strong>
                                    </td>
                                    <td><?php echo e($formation->categoryFormation->nom ?? 'N/A'); ?></td>
                                    <td><?php echo e($formation->type_formation); ?></td>
                                    
                                    <td><?php echo e($formation->start_date ? \Carbon\Carbon::parse($formation->start_date)->format('d/m/Y') : 'N/A'); ?></td>
                                    <td>
                                        <span class="status-badge status-<?php echo e($formation->status); ?>"><?php echo e(ucfirst($formation->status)); ?></span>
                                    </td>
                                    <td class="text-end">
                                        <a href="<?php echo e(route('admin.formations.edit', $formation->id)); ?>" class="btn btn-sm btn-outline-primary" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="<?php echo e(route('admin.formations.destroy', $formation->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette formation ?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Aucune formation trouvée.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white">
                <?php echo e($formations->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-shell-superadmin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/admin/formations/index.blade.php ENDPATH**/ ?>