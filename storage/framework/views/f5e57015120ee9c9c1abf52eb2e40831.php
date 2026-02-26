<?php $__env->startSection('title', 'Mon Profil'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-4">
        <div class="tresor-card text-center">
            <div class="mb-3">
                <?php if(auth()->user()->photo_path): ?>
                    <img src="<?php echo e(asset('storage/' . auth()->user()->photo_path)); ?>" 
                         class="rounded-circle" 
                         style="width: 120px; height: 120px; object-fit: cover;">
                <?php else: ?>
                    <div class="rounded-circle d-flex align-items-center justify-content-center" 
                         style="width: 120px; height: 120px; background: linear-gradient(135deg, #f39c12, #e67e22); color: white; font-size: 3rem; margin: 0 auto;">
                        <i class="fas fa-user"></i>
                    </div>
                <?php endif; ?>
            </div>
            
            <h4><?php echo e(auth()->user()->name); ?></h4>
            <p class="text-muted"><?php echo e(auth()->user()->email); ?></p>
            
            <div class="mt-3">
                <span class="tresor-badge">
                    <i class="fas fa-coins"></i>
                    Trésorier
                </span>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="tresor-card">
            <h4 class="mb-4">
                <i class="fas fa-user-circle text-warning"></i>
                Informations du profil
            </h4>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nom complet</label>
                        <p class="form-control-plaintext"><?php echo e(auth()->user()->name); ?></p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <p class="form-control-plaintext"><?php echo e(auth()->user()->email); ?></p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Téléphone</label>
                        <p class="form-control-plaintext"><?php echo e(auth()->user()->phone ?? 'Non renseigné'); ?></p>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Rôle</label>
                        <p class="form-control-plaintext">
                            <span class="tresor-badge">Trésorier</span>
                        </p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Date d'inscription</label>
                        <p class="form-control-plaintext"><?php echo e(auth()->user()->created_at->format('d/m/Y')); ?></p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Dernière connexion</label>
                        <p class="form-control-plaintext"><?php echo e(auth()->user()->last_login_at ? auth()->user()->last_login_at->format('d/m/Y H:i') : 'Première connexion'); ?></p>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <a href="<?php echo e(route('profile.show')); ?>" class="btn btn-warning">
                    <i class="fas fa-edit"></i>
                    Modifier mon profil
                </a>
                <a href="<?php echo e(route('tresor.dashboard')); ?>" class="btn btn-outline-secondary ms-2">
                    <i class="fas fa-arrow-left"></i>
                    Retour au tableau de bord
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-shell-tresor', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/tresor/profile.blade.php ENDPATH**/ ?>