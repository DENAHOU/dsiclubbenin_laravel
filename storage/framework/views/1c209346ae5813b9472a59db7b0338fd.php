<?php $__env->startSection('title', 'Adhésions Rejetées'); ?>

<?php $__env->startSection('content'); ?>

<h3 class="mb-4">Adhésions Rejetées</h3>

<div class="card">
    <div class="card-header">
        <strong>Liste des adhésions rejetées</strong>
    </div>

    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Détails</th>
                </tr>
            </thead>

            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $rejected; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($r['name']); ?></td>
                        <td><?php echo e($r['email'] ?? '—'); ?></td>
                        <td><?php echo e(ucfirst($r['type'])); ?></td>
                        <td><?php echo e(\Carbon\Carbon::parse($r['created_at'])->format('d/m/Y H:i')); ?></td>
                        <td>
                            <a href="<?php echo e(route('admin.members.show', ['type'=>$r['type'],'id'=>$r['id']])); ?>"
                               class="btn btn-sm btn-secondary">
                               Voir
                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="6" class="text-center p-3">Aucune adhésion rejetée.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-shell-superadmin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/admin/members/rejected.blade.php ENDPATH**/ ?>