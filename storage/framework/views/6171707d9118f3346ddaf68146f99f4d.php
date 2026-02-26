

<?php $__env->startSection('title', 'Membres Inactifs'); ?>

<?php $__env->startSection('content'); ?>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">👥 Adhésion non payée</h2>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Adhésion</th>
                            <th>Inscription</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php $__empty_1 = true; $__currentLoopData = $inactiveMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                            <tr>
                                <td><?php echo e($member->name); ?></td>
                                <td><?php echo e($member->email); ?></td>
                                <td><?php echo e($member->phone ?? '-'); ?></td>

                                <td>
                                    <span class="badge bg-danger">
                                        Non payé
                                    </span>
                                </td>

                                <td>
                                    <?php echo e($member->created_at->format('d M Y')); ?>

                                </td>
                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    Aucun membre en retard
                                </td>
                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

            
            <div class="mt-3 d-flex justify-content-center">
                <?php echo e($inactiveMembers->links('pagination::simple-bootstrap-5')); ?>

            </div>

        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-shell-tresor', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/tresor/members/inactive.blade.php ENDPATH**/ ?>