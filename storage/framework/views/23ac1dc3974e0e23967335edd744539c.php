

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('activites.formations')); ?>">Formations</a></li>
                    <li class="breadcrumb-item active"><?php echo e($formation->titre); ?></li>
                </ol>
            </nav>
            
            <h1 class="fw-bold mb-4"><?php echo e($formation->titre); ?></h1>
            
            <?php if($formation->image_path): ?>
                <img src="<?php echo e(asset('storage/' . $formation->image_path)); ?>" class="img-fluid rounded-4 mb-4" alt="<?php echo e($formation->titre); ?>">
            <?php endif; ?>

            <div class="description-content fs-5 leading-relaxed">
                <?php echo nl2br(e($formation->description)); ?>

            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-lg sticky-top" style="top: 100px; border-radius: 20px;">
                <div class="card-body p-4">
                    <div class="mb-4">
                        <span class="badge bg-primary px-3 py-2 mb-2"><?php echo e(ucfirst($formation->type_formation)); ?></span>
                        <h2 class="text-primary fw-bold"><?php echo e(number_format($formation->price, 0, ',', ' ')); ?> FCFA</h2>
                    </div>

                    <ul class="list-unstyled mb-4">
                        <li class="mb-2"><i class="fas fa-calendar-alt text-muted me-2"></i> Début : <strong><?php echo e(\Carbon\Carbon::parse($formation->start_date)->format('d/m/Y')); ?></strong></li>
                        <li class="mb-2"><i class="fas fa-clock text-muted me-2"></i> Fin : <strong><?php echo e(\Carbon\Carbon::parse($formation->end_date)->format('d/m/Y')); ?></strong></li>
                        <?php if($formation->location): ?>
                            <li class="mb-2"><i class="fas fa-map-marker-alt text-muted me-2"></i> <?php echo e($formation->location); ?></li>
                        <?php endif; ?>
                    </ul>

                    <div class="d-grid gap-2">
                        <a href="<?php echo e(route('activites.formations.register', $formation->id)); ?>" class="btn btn-success btn-lg fw-bold shadow-sm">
                            S'inscrire maintenant
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/activites/formations_show.blade.php ENDPATH**/ ?>