<?php $__env->startSection('title', 'Ajouter une Formation'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold mb-0">Créer une Nouvelle Formation</h1>
            <p class="text-muted">Remplissez les détails ci-dessous.</p>
        </div>
        <a href="<?php echo e(route('admin.formations.index')); ?>" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Retour à la liste
        </a>
    </div>

    
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="<?php echo e(route('admin.formations.store')); ?>" method="POST" enctype="multipart/form-data" class="row g-3">
                <?php echo csrf_field(); ?>

                <!-- Colonne Principale -->
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre de la formation *</label>
                        <input type="text" name="titre" id="titre" class="form-control <?php $__errorArgs = ['titre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('titre')); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description complète *</label>
                        <textarea name="description" id="description" class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="8" required><?php echo e(old('description')); ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="lieu" class="form-label">Lieu (si présentiel)</label>
                            <input type="text" name="lieu" id="lieu" class="form-control" value="<?php echo e(old('lieu')); ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="lien_formation" class="form-label">Lien de la formation (si en ligne)</label>
                            <input type="url" name="lien_formation" id="lien_formation" class="form-control" value="<?php echo e(old('lien_formation')); ?>">
                        </div>
                    </div>
                </div>

                <!-- Colonne Latérale -->
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="status" class="form-label">Statut</label>
                        <select name="status" id="status" class="form-select">
                            <option value="draft" <?php echo e(old('status') == 'draft' ? 'selected' : ''); ?>>Brouillon</option>
                            <option value="published" <?php echo e(old('status') == 'published' ? 'selected' : ''); ?>>Publiée</option>
                            <option value="archived" <?php echo e(old('status') == 'archived' ? 'selected' : ''); ?>>Archivée</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="type_formation" class="form-label">Type de formation *</label>
                        <select name="type_formation" id="type_formation" class="form-select" required>
                            <option value="en_presentiel" <?php echo e(old('type_formation') == 'en_presentiel' ? 'selected' : ''); ?>>En Présentiel</option>
                            <option value="en_ligne" <?php echo e(old('type_formation') == 'en_ligne' ? 'selected' : ''); ?>>En Ligne</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="categorie_formation_id" class="form-label">Catégorie *</label>
                        <select name="categorie_formation_id" id="categorie_formation_id" class="form-select" required>
                            <option value="" disabled selected>Choisir...</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cat->id); ?>" <?php echo e(old('categorie_formation_id') == $cat->id ? 'selected' : ''); ?>>
                                    <?php echo e($cat->nom); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <div class="mb-3">
                        <label for="date_cloture_inscription" class="form-label">Clôture inscriptions *</label>
                        <input type="datetime-local" name="date_cloture_inscription" id="date_cloture_inscription" class="form-control" value="<?php echo e(old('date_cloture_inscription')); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="start_date" class="form-label">Date de début *</label>
                        <input type="datetime-local" name="start_date" id="start_date" class="form-control" value="<?php echo e(old('start_date')); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="date_fin" class="form-label">Date de fin *</label>
                        <input type="datetime-local" name="date_fin" id="date_fin" class="form-control" value="<?php echo e(old('date_fin')); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="prix_presentiel" class="form-label">Prix (Présentiel)</label>
                        <input type="number" name="prix_presentiel" id="prix_presentiel" class="form-control" value="<?php echo e(old('prix_presentiel', 0)); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="prix_en_ligne" class="form-label">Prix (En Ligne)</label>
                        <input type="number" name="prix_en_ligne" id="prix_en_ligne" class="form-control" value="<?php echo e(old('prix_en_ligne', 0)); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image d'illustration</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                </div>

                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary px-4">Enregistrer la Formation</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-shell-superadmin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/admin/formations/create.blade.php ENDPATH**/ ?>