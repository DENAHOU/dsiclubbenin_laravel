<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="mb-4">Ajouter un partenaire</h1>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('admin.partners.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Type de partenaire</label>
                <select name="partner_type_id" class="form-select" required>
                    <option value="">-- Choisir --</option>
                    <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Formule</label>
                <select name="partner_formule_id" class="form-select" required>
                    <option value="">-- Choisir --</option>
                    <?php $__currentLoopData = $formules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($formule->id); ?>"><?php echo e($formule->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Nom de l'entreprise</label>
                <input type="text" name="company_name" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Pays</label>
                <input type="text" name="country" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Téléphone</label>
                <input type="text" name="phone" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Logo</label>
                <input type="file" name="logo_path" class="form-control">
            </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Statut</label>
                    <select name="status" class="form-select" required>
                        <option value="pending">En attente</option>
                        <option value="approved">Approuvé</option>
                    </select>
                </div>
        </div>

        <button class="btn btn-success">Enregistrer</button>
        <a href="<?php echo e(route('admin.partners.index')); ?>" class="btn btn-secondary">Retour</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-shell-superadmin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/admin/partners/create.blade.php ENDPATH**/ ?>