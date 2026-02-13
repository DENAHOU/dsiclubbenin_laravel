<?php $__env->startSection('title', 'Détails de la Formation'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">
                        <i class="fas fa-graduation-cap me-2"></i>
                        <?php echo e($formation->titre ?? 'Formation'); ?>

                    </h2>
                    <div>
                        <a href="<?php echo e(route($userType . '.formations')); ?>" class="btn btn-outline-secondary me-2">
                            <i class="fas fa-arrow-left me-2"></i>Retour aux formations
                        </a>
                        <a href="<?php echo e(route($userType . '.dashboard')); ?>" class="btn btn-outline-primary">
                            <i class="fas fa-home me-2"></i>Dashboard
                        </a>
                    </div>
                </div>

                <!-- Détails de la formation -->
                <?php if(isset($formation) && is_object($formation)): ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4 class="mb-3"><?php echo e($formation->titre ?? 'Formation'); ?></h4>
                                    
                                    <?php if($formation->description): ?>
                                        <div class="mb-4">
                                            <h5>Description</h5>
                                            <p><?php echo e($formation->description); ?></p>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($formation->content): ?>
                                        <div class="mb-4">
                                            <h5>Contenu</h5>
                                            <div><?php echo e($formation->content); ?></div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($formation->duree): ?>
                                        <div class="mb-3">
                                            <strong>Durée :</strong> <?php echo e($formation->duree); ?>

                                        </div>
                                    <?php endif; ?>

                                    <?php if($formation->prix): ?>
                                        <div class="mb-3">
                                            <strong>Prix :</strong> <?php echo e($formation->prix); ?>

                                        </div>
                                    <?php endif; ?>

                                    <?php if($formation->categoryFormation): ?>
                                        <div class="mb-3">
                                            <strong>Catégorie :</strong> <?php echo e($formation->categoryFormation->nom); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Actions</h5>
                                            
                                            <?php if($formation->lien_inscription_en_ligne || $formation->lien_inscription_presentiel): ?>
                                                <a href="<?php echo e($formation->lien_inscription_en_ligne ?: $formation->lien_inscription_presentiel); ?>" target="_blank" class="btn btn-primary w-100 mb-2">
                                                    <i class="fas fa-external-link-alt me-2"></i>S'inscrire
                                                </a>
                                            <?php endif; ?>

                                            <?php if($formation->contact): ?>
                                                <a href="mailto:<?php echo e($formation->contact); ?>" class="btn btn-outline-info w-100">
                                                    <i class="fas fa-envelope me-2"></i>Contact
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <?php if($formation->created_at): ?>
                                        <div class="mt-3">
                                            <small class="text-muted">
                                                Ajoutée le <?php echo e($formation->created_at->format('d/m/Y')); ?>

                                            </small>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Formation non trouvée ou données invalides.
                        <?php if(isset($formation) && is_array($formation) && count($formation) > 0): ?>
                            <br><small>Debug: Données reçues: <?php echo e(json_encode($formation)); ?></small>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-shell-' . ($userType === 'company' ? 'entite' : ($userType === 'college' ? 'college' : 'admin')), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/shared/formation-details.blade.php ENDPATH**/ ?>