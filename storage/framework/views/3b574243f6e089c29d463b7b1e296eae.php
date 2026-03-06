<?php $__env->startSection('content'); ?>
<div class="admin-header">
    <h1>Liste des Évènements</h1>
    <a href="<?php echo e(route('admin.events.create')); ?>" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Ajouter un évènement
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>Lieu</th>
                        <th>Média</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($event->id); ?></td>
                        <td><?php echo e($event->titre); ?></td>
                        <td><?php echo e($event->typeEvent->nom ?? '-'); ?></td>
                        <td><?php echo e($event->date ? $event->date->format('d/m/Y') : '-'); ?></td>
                        <td><?php echo e($event->location ?? '-'); ?></td>
                        <td>
                            <?php if($event->image): ?>
                                <img src="<?php echo e(asset($event->image)); ?>" alt="Image" style="max-width: 50px; max-height: 50px; object-fit: cover;">
                            <?php elseif($event->video_url): ?>
                                <i class="fas fa-video text-primary"></i>
                                <small class="d-block">Vidéo</small>
                            <?php else: ?>
                                <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="badge bg-<?php echo e($event->status == 'actif' ? 'success' : 'secondary'); ?>">
                                <?php echo e($event->status); ?>

                            </span>
                        </td>
                        <td>
                            <a href="<?php echo e(route('admin.events.edit', $event->id)); ?>" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="<?php echo e(route('admin.events.delete', $event->id)); ?>" style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="text-center">Aucun évènement trouvé</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-shell-superadmin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/admin/events/index.blade.php ENDPATH**/ ?>