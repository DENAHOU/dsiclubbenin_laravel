

<?php $__env->startSection('content'); ?>
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-4">Partenaires en attente</h1>

        <a href="<?php echo e(route('admin.partners.create')); ?>"
           class="btn btn-success">
            ➕ Ajouter un partenaire
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <table class="table table-bordered table-hover">

        <thead class="table">
            <tr>
                <th>#</th>
                <th>Type</th>
                <th>Entreprise</th>
                <th>Domaine</th>
                <th>Spécialité</th>
                <th>Responsable</th>
                <th>Pays</th>
                <th>Email</th>
                <th>logo</th>
                <th>Formule d'adhésion</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>

                    <td><?php echo e($partner->partnerType->name ?? '-'); ?></td>

                    <td><?php echo e($partner->company_name); ?></td>

                    <td><?php echo e($partner->domain); ?></td>

                    <td><?php echo e($partner->specialty); ?></td>

                    <td><?php echo e($partner->manager_name); ?></td>

                    <td><?php echo e($partner->country); ?></td>

                    <td><?php echo e($partner->email); ?></td>

                    <td>
                        <?php if($partner->logo_path): ?>
                            <img src="<?php echo e(asset('storage/' . $partner->logo_path)); ?>"
                                 alt="Logo de <?php echo e($partner->company_name); ?>"
                                 style="max-width: 150px; max-height: 150px;">
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>

                    <td><?php echo e($partner->partnerFormule->name ?? '-'); ?></td>

                    <td>
                        <?php if($partner->status === 'pending'): ?>
                            <span class="badge bg-warning">En attente</span>
                        <?php endif; ?>
                    </td>

                    <td class="text-center">
                        <!-- VOIR -->
                        <a href="<?php echo e(route('admin.partners.show', $partner->id)); ?>"
                           class="btn btn-sm btn-info"><i class="fas fa-eye"></i>
                        </a>

                        <!-- EDIT -->
                        <a href="<?php echo e(route('admin.partners.edit', $partner->id)); ?>"
                           class="btn btn-sm btn-primary"><i class="fas fa-edit"></i>
                        </a>

                        <!-- DELETE -->
                        <form action="<?php echo e(route('admin.partners.delete', $partner->id)); ?>"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Supprimer ce partenaire ?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>
                            </button>
                        </form>

                        <!-- APPROUVER / REJETER -->
                        <?php if($partner->status === 'pending'): ?>
                            <form action="<?php echo e(route('admin.partners.approve', $partner)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button class="btn btn-success btn-sm">Approuver</button>
                            </form>

                            <form action="<?php echo e(route('admin.partners.reject', $partner)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button class="btn btn-danger btn-sm">Rejeter</button>
                            </form>
                        <?php endif; ?>

                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="10" class="text-center">
                        Aucun partenaire trouvé
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-shell-superadmin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/admin/partners/listpending.blade.php ENDPATH**/ ?>