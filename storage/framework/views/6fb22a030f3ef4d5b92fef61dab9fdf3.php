<?php $__env->startSection('content'); ?>
<div class="container">
    <h4 class="mb-4">📦 Formules de partenariat</h4>

    <a href="<?php echo e(route('admin.partners.formules.create')); ?>" class="btn btn-primary mb-3">
        ➕ Nouvelle formule
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Montant</th>
                <th>Avantages</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $formules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td style="font-weight: bold;"><?php echo e($formule->name); ?></td>
                    <td><?php echo e(number_format($formule->amount, 0, ',', ' ')); ?> FCFA</td>
                    <td style="font-weight: bold; white-space: pre-line;"><?php echo e($formule->description); ?></td>
                    <td>
                        <a href="<?php echo e(route('admin.partners.formules.edit', $formule->id)); ?>" class="btn btn-sm btn-warning">✏️</a>

                        <form method="POST" action="<?php echo e(route('admin.partners.formules.delete', $formule->id)); ?>" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-sm btn-danger">🗑️</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-shell-superadmin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/admin/partners/formules/index.blade.php ENDPATH**/ ?>