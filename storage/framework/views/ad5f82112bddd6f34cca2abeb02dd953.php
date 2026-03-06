<?php $__env->startSection('content'); ?>
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">📌 Types de partenaires</h4>

        <a href="<?php echo e(route('admin.partners.types.create')); ?>"
           class="btn btn-success">
            ➕ Ajouter un type
        </a>
    </div>

    
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">

            <?php if($types->count() > 0): ?>
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nom du type</th>
                            <th class="text-center" width="180">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($index + 1); ?></td>
                                <td>
                                    <strong><?php echo e($type->name); ?></strong>
                                </td>

                                <td class="text-center">
                                    <a href="<?php echo e(route('admin.partners.types.edit', $type->id)); ?>"
                                       class="btn btn-sm btn-warning">
                                        ✏️ Modifier
                                    </a>

                                    <form action="<?php echo e(route('admin.partners.types.delete', $type->id)); ?>"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Supprimer ce type ?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>

                                        <button class="btn btn-sm btn-danger">
                                            🗑️ Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="text-center text-muted py-4">
                    Aucun type de partenaire enregistré.
                </div>
            <?php endif; ?>

        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-shell-superadmin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/admin/partners/types/index.blade.php ENDPATH**/ ?>