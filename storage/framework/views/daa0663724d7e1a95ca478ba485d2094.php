<?php $__env->startSection('title', 'Mon Profil'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">

    <div class="card shadow-sm p-4 mb-4">
        <div class="d-flex align-items-center gap-4">
            <img src="<?php echo e($user->photo_path ? asset('storage/'.$user->photo_path) : asset('img/avatar.png')); ?>"
                 class="rounded-circle"
                 width="120" height="120">

            <div>
                <h4 class="fw-bold mb-0"><?php echo e($user->firstname); ?> <?php echo e($user->lastname); ?></h4>
                <span class="text-muted"><?php echo e($user->email); ?></span>
                <p class="mb-0 mt-2">
                    <span class="badge bg-primary"><?php echo e(ucfirst($user->type_members)); ?></span>
                </p>
            </div>

            <div class="ms-auto">
                <a href="<?php echo e(route('member.profile.edit')); ?>" class="btn btn-outline-primary">
                    ✏️ Éditer
                </a>
            </div>
        </div>
    </div>

    
    <div class="row g-4">

        <div class="col-md-6">
            <div class="card shadow-sm p-4">
                <h6 class="fw-bold mb-3">Informations personnelles</h6>
                <p><strong>Sexe :</strong> <?php echo e($user->sexe); ?></p>
                <p><strong>Téléphone :</strong> <?php echo e($user->phone); ?></p>
                <p><strong>Date de naissance :</strong> <?php echo e($user->birthday); ?></p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm p-4">
                <h6 class="fw-bold mb-3">Informations professionnelles</h6>
                <p><strong>Poste :</strong> <?php echo e($user->current_position); ?></p>
                <p><strong>Employeur :</strong> <?php echo e($user->current_employer); ?></p>
                <p><strong>Secteur :</strong> <?php echo e($user->sector); ?></p>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card shadow-sm p-4">
                <h6 class="fw-bold mb-3">Compétences & Description</h6>
                <p><strong>Expertise :</strong> <?php echo e($user->area_of_expertise); ?></p>
                <p><?php echo e($user->description); ?></p>
            </div>
        </div>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-shell', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/member/profile/show.blade.php ENDPATH**/ ?>