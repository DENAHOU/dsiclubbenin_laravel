<?php $__env->startSection('title', 'Accès Refusé'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card border-0 shadow-lg">
                    <div class="card-body text-center p-5">
                        <!-- Icône -->
                        <div class="mb-4">
                            <i class="fas fa-lock fa-4x text-warning"></i>
                        </div>

                        <!-- Titre -->
                        <h3 class="card-title mb-3">Accès Refusé</h3>

                        <!-- Message -->
                        <p class="card-text text-muted mb-4">
                            <?php echo e($message); ?>

                        </p>

                        <!-- Informations supplémentaires -->
                        <?php if($motif == 'cotisations'): ?>
                            <div class="alert alert-info border-0">
                                <h6 class="alert-heading">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Comment régulariser votre situation ?
                                </h6>
                                <p class="mb-2">
                                    Pour accéder à l'annuaire, vous devez être à jour dans vos cotisations.
                                    Vérifiez votre statut de paiement dans votre dashboard.
                                </p>
                                <hr>
                                <a href="<?php echo e(route('member.cotisations.pay')); ?>" class="btn btn-primary">
                                    <i class="fas fa-credit-card me-2"></i>
                                    Effectuer un paiement
                                </a>
                                <a href="<?php echo e(route('member.cotisations.history')); ?>" class="btn btn-outline-primary ms-2">
                                    <i class="fas fa-history me-2"></i>
                                    Voir l'historique
                                </a>
                            </div>
                        <?php endif; ?>

                        <!-- Bouton retour -->
                        <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>
                            Retour au dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-shell', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/member/annuaire/acces_refuse.blade.php ENDPATH**/ ?>