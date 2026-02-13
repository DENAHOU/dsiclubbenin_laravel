<?php $__env->startSection('title', 'Mes notifications'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">

    <h4 class="fw-bold mb-4">🔔 Notifications</h4>

    <div class="card shadow-sm border-0">
        <div class="list-group list-group-flush">

            <?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <a href=""
                   class="list-group-item list-group-item-action
                   <?php echo e($notif->is_read ? '' : 'fw-bold'); ?>">

                    <div class="d-flex justify-content-between">
                        <div>
                            <div><?php echo e($notif->title); ?></div>
                            <small class="text-muted"><?php echo e($notif->message); ?></small>
                        </div>

                        <small class="text-muted">
                            <?php echo e($notif->created_at->diffForHumans()); ?>

                        </small>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="p-4 text-center text-muted">
                    Aucune notification
                </div>
            <?php endif; ?>

        </div>
    </div>

    <div class="mt-3">
        <?php echo e($notifications->links()); ?>

    </div>

</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app-shell', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/notifications/index.blade.php ENDPATH**/ ?>