

<?php $__env->startSection('title', 'Rapport Recettes'); ?>

<?php $__env->startSection('content'); ?>

<div class="container py-4">

    <h4 class="fw-bold mb-4">📈 Rapport des Recettes Mensuelles</h4>

    <div class="card shadow-sm border-0">

        <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0">

                <thead class="table-light">
                    <tr>
                        <th>Mois</th>
                        <th>Année</th>
                        <th>Total Collecté</th>
                    </tr>
                </thead>

                <tbody>

                    <?php $__empty_1 = true; $__currentLoopData = $monthlyRevenue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e(\Carbon\Carbon::create()->month($row->month)->format('F')); ?></td>
                            <td><?php echo e($row->year); ?></td>
                            <td class="fw-bold text-success">
                                <?php echo e(number_format($row->total, 0, ',', ' ')); ?> FCFA
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="3" class="text-center py-3">
                                Aucune donnée disponible
                            </td>
                        </tr>
                    <?php endif; ?>

                </tbody>

            </table>
        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-shell-tresor', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/tresor/reports/revenue.blade.php ENDPATH**/ ?>