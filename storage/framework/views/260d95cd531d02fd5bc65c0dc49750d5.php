<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="mb-4">Modifier le partenaire</h1>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('admin.partners.update', $partner->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Raison sociale</label>
                <input type="text" name="company_name" class="form-control"
                       value="<?php echo e($partner->company_name); ?>" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Domaine</label>
                <input type="text" name="domain" class="form-control"
                       value="<?php echo e($partner->domain); ?>" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Responsable</label>
                <input type="text" name="manager_name" class="form-control"
                       value="<?php echo e($partner->manager_name); ?>" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Téléphone</label>
                <input type="text" name="phone" class="form-control"
                       value="<?php echo e($partner->phone); ?>" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Type de partenaire</label>
                <input type="text" name="type" class="form-control"
                       value="<?php echo e($partner->partnerType->name ?? '-'); ?>" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Formule d'adhésion</label>
                <input type="text" name="formule" class="form-control"
                       value="<?php echo e($partner->partnerFormule->name ?? '-'); ?>" required>
            </div>


            <div class="col-md-6 mb-3">
                <label class="form-label">Statut</label>
                <select name="status" class="form-select">
                    <option value="pending" <?php echo e($partner->status == 'pending' ? 'selected' : ''); ?>>En attente</option>
                    <option value="approved" <?php echo e($partner->status == 'approved' ? 'selected' : ''); ?>>Approuvé</option>
                    <option value="rejected" <?php echo e($partner->status == 'rejected' ? 'selected' : ''); ?>>Rejeté</option>
                </select>
            </div>
        </div>

        <button class="btn btn-primary">Mettre à jour</button>
        <a href="<?php echo e(route('admin.partners.index')); ?>" class="btn btn-secondary">Retour</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-shell-superadmin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/admin/partners/edit.blade.php ENDPATH**/ ?>