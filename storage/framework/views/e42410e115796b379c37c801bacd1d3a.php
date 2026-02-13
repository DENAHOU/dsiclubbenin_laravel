<?php $__env->startSection('content'); ?>

<div class="container-fluid py-4">

    
    <div class="mb-4">
        <h3 class="fw-bold mb-1">👤 Mon Profil</h3>
        <p class="text-muted">Gérez vos informations personnelles et la sécurité de votre compte</p>
    </div>

    <div class="row g-4">

        
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 text-center p-4">
                <img src="<?php echo e(Auth::user()->photo_url ?? asset('img/avatar.png')); ?>"
                     class="rounded-circle mx-auto mb-3"
                     width="120" height="120"
                     style="object-fit: cover;">

                <h5 class="fw-bold mb-0"><?php echo e(Auth::user()->name); ?></h5>
                <small class="text-muted"><?php echo e(Auth::user()->email); ?></small>

                <hr>

                <span class="badge bg-primary px-3 py-2">
                    Membre individuel
                </span>
            </div>
        </div>

        
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 p-4 mb-4">
                <h5 class="fw-bold mb-3">📝 Informations personnelles</h5>

                <form method="POST" action="<?php echo e(route('profile.update')); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nom complet</label>
                            <input type="text"
                                   name="name"
                                   value="<?php echo e(old('name', Auth::user()->name)); ?>"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Adresse email</label>
                            <input type="email"
                                   name="email"
                                   value="<?php echo e(old('email', Auth::user()->email)); ?>"
                                   class="form-control"
                                   required>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button class="btn btn-primary px-4">
                            💾 Enregistrer les modifications
                        </button>

                        <?php if(session('status') === 'profile-updated'): ?>
                            <span class="text-success ms-3 fw-semibold">
                                ✔ Modifications enregistrées
                            </span>
                        <?php endif; ?>
                    </div>
                </form>
            </div>

            
            <div class="card shadow-sm border-0 p-4 mb-4">
                <?php echo $__env->make('profile.partials.update-password-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>

            
            <div class="card shadow-sm border-danger p-4">
                <h5 class="fw-bold text-danger mb-3">⚠️ Zone sensible</h5>

                <?php echo $__env->make('profile.partials.delete-user-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-shell', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/profile/edit.blade.php ENDPATH**/ ?>