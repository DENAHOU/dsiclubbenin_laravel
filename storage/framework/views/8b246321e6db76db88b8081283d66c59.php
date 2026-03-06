<?php $__env->startSection('title', 'Modifier la Formation'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold mb-0">Modifier la Formation</h1>
            <p class="text-muted"><?php echo e($formation->titre); ?></p>
        </div>
        <a href="<?php echo e(route('admin.formations.index')); ?>" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Annuler
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
            <form action="<?php echo e(route('admin.formations.update', $formation->id)); ?>" method="POST" enctype="multipart/form-data" class="row g-3">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                
                <!-- Colonne Principale -->
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre *</label>
                        <input type="text" name="titre" id="titre" class="form-control" value="<?php echo e(old('titre', $formation->titre)); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description *</label>
                        <textarea name="description" id="description" class="form-control" rows="8" required><?php echo e(old('description', $formation->description)); ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="lieu" class="form-label">Lieu (Location DB)</label>
                            <input type="text" name="lieu" id="lieu" class="form-control" value="<?php echo e(old('lieu', $formation->location)); ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="lien_formation" class="form-label">Lien (Online URL DB)</label>
                            <input type="url" name="lien_formation" id="lien_formation" class="form-control" value="<?php echo e(old('lien_formation', $formation->online_url)); ?>">
                        </div>
                    </div>
                </div>

                <!-- Colonne Latérale -->
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="status" class="form-label">Statut</label>
                        <select name="status" id="status" class="form-select">
                            <option value="draft" <?php if(old('status', $formation->status) == 'draft'): echo 'selected'; endif; ?>>Brouillon</option>
                            <option value="published" <?php if(old('status', $formation->status) == 'published'): echo 'selected'; endif; ?>>Publiée</option>
                            <option value="archived" <?php if(old('status', $formation->status) == 'archived'): echo 'selected'; endif; ?>>Archivée</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="type_formation" class="form-label">Type *</label>
                        <select name="type_formation" id="type_formation" class="form-select" required>
                            
                            <option value="en_presentiel" <?php if(old('type_formation', $formation->type_formation) == 'presentiel'): echo 'selected'; endif; ?>>En Présentiel</option>
                            <option value="en_ligne" <?php if(old('type_formation', $formation->type_formation) == 'en_ligne'): echo 'selected'; endif; ?>>En Ligne</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="categorie_formation_id" class="form-label">Catégorie *</label>
                        <select name="categorie_formation_id" id="categorie_formation_id" class="form-select" required>
                            <option value="">Choisir...</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cat->id); ?>" <?php if(old('categorie_formation_id', $formation->categorie_formation_id) == $cat->id): echo 'selected'; endif; ?>>
                                    <?php echo e($cat->nom); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="start_date" class="form-label">Date de début *</label>
                        <input type="datetime-local" name="start_date" id="start_date" class="form-control" 
                               value="<?php echo e(old('start_date', $formation->start_date ? \Carbon\Carbon::parse($formation->start_date)->format('Y-m-d\TH:i') : '')); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="date_fin" class="form-label">Date de fin *</label>
                        <input type="datetime-local" name="date_fin" id="date_fin" class="form-control" 
                               value="<?php echo e(old('date_fin', $formation->end_date ? \Carbon\Carbon::parse($formation->end_date)->format('Y-m-d\TH:i') : '')); ?>" required>
                    </div>

                    
                    <div class="mb-3">
                        <label for="prix_presentiel" class="form-label">Prix (Présentiel)</label>
                        <input type="number" name="prix_presentiel" id="prix_presentiel" class="form-control" 
                               value="<?php echo e(old('prix_presentiel', $formation->type_formation == 'presentiel' ? $formation->price : 0)); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="prix_en_ligne" class="form-label">Prix (En Ligne)</label>
                        <input type="number" name="prix_en_ligne" id="prix_en_ligne" class="form-control" 
                               value="<?php echo e(old('prix_en_ligne', $formation->type_formation == 'en_ligne' ? $formation->price : 0)); ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label d-block">Image actuelle</label>
                        <?php if($formation->image_path): ?>
                            <img src="<?php echo e(asset('storage/' . $formation->image_path)); ?>" class="img-thumbnail mb-2" style="max-height: 100px;">
                        <?php endif; ?>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                </div>

                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary px-4">Mettre à jour la Formation</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-shell-superadmin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/admin/formations/edit.blade.php ENDPATH**/ ?>