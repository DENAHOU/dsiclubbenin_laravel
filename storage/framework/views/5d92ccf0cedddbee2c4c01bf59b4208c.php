

<?php $__env->startSection('title', 'Rapport Résumé'); ?>

<?php $__env->startSection('content'); ?>

<div class="container py-4">

    <h4 class="mb-4 fw-bold">📊 Tableau de bord Trésorerie</h4>

    <div class="row g-3 mb-4">

        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-center p-3">
                <h6>Total membres</h6>
                <h3 class="fw-bold text-primary"><?php echo e($totalMembers); ?></h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-center p-3">
                <h6>Membres ayant payé</h6>
                <h3 class="fw-bold text-success"><?php echo e($paidMembers); ?></h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-center p-3">
                <h6>Membres en retard</h6>
                <h3 class="fw-bold text-danger"><?php echo e($lateMembers); ?></h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-center p-3">
                <h6>Recettes totales</h6>
                <h3 class="fw-bold text-dark">
                    <?php echo e(number_format($totalRevenue, 0, ',', ' ')); ?> FCFA
                </h3>
            </div>
        </div>

    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">💰 Recettes du mois</h5>
            <h3 class="text-success fw-bold">
                <?php echo e(number_format($thisMonthRevenue, 0, ',', ' ')); ?> FCFA
            </h3>
        </div>
    </div>


    <div class="card shadow-sm border-0">
        <div class="card-header bg-white fw-bold">
            Paiements récents
        </div>

        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Membre</th>
                        <th>Montant</th>
                        <th>Mois</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $__empty_1 = true; $__currentLoopData = $recentPayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($payment->user->name ?? '-'); ?></td>
                            <td class="fw-bold text-success">
                                <?php echo e(number_format($payment->amount, 0, ',', ' ')); ?> FCFA
                            </td>
                            <td><?php echo e($payment->months); ?> mois</td>
                            <td><?php echo e($payment->created_at->format('d/m/Y')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="text-center py-3">
                                Aucun paiement trouvé
                            </td>
                        </tr>
                    <?php endif; ?>

                </tbody>
            </table>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-shell-tresor', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/tresor/reports/summary.blade.php ENDPATH**/ ?>