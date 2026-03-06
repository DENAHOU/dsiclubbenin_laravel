<?php $__env->startSection('content'); ?>
<h3>📰 Partenaires Presse</h3>

<a href="<?php echo e(route('admin.partners.press.create')); ?>" class="btn btn-success mb-3">
    Ajouter
</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Logo</th>
            <th>Nom</th>
            <th>Site</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $pressPartners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td>
                <?php if($p->logo): ?>
                    <img src="<?php echo e(asset('storage/'.$p->logo)); ?>" height="40">
                <?php endif; ?>
            </td>
            <td><?php echo e($p->name); ?></td>
            <td><?php echo e($p->website); ?></td>
            <td><?php echo e($p->description); ?></td>
            <td>
                <a href="<?php echo e(route('admin.partners.press.edit', $p->id)); ?>" class="btn btn-sm btn-primary">Edit</a>
                <form action="<?php echo e(route('admin.partners.press.delete', $p->id)); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button class="btn btn-sm btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-shell-superadmin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/admin/partners/press/index.blade.php ENDPATH**/ ?>