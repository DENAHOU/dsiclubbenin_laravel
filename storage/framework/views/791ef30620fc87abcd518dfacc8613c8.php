

<?php $__env->startSection('title', 'Rapport Dettes'); ?>

<?php $__env->startSection('content'); ?>

<div class="container py-4">

    <h4 class="fw-bold mb-4">⚠ Membres en retard de cotisation</h4>

    <div class="card shadow-sm border-0 mb-3">
        <div class="card-body">

            <h5>Total des dettes :</h5>
            <h3 class="fw-bold text-danger">
                <?php echo e(number_format($totalDebt, 0, ',', ' ')); ?> FCFA
            </h3>

        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Membre</th>
                        <th>Email</th>
                        <th>Mois payés</th>
                        <th>Mois dus</th>
                        <th>Excédent</th>
                        <th>Dette estimée</th>
                        <th>Dernier paiement</th>
                        <th>Prochaine échéance</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $debtMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($member->name); ?></td>
                            <td><?php echo e($member->email); ?></td>
                            <td class="fw-bold text-success"><?php echo e($member->months_paid); ?></td>
                            <td class="fw-bold text-warning"><?php echo e($member->months_late); ?></td>
                            <td class="fw-bold text-info"><?php echo e($member->months_added); ?></td>
                            <td class="fw-bold text-danger"><?php echo e(number_format($member->estimated_debt, 0, ',', ' ')); ?> FCFA</td>
                            <td><?php echo e($member->last_payment_date ?? '-'); ?></td>
                            <td><?php echo e($member->next_due_date ?? '-'); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="text-center py-3">
                                Aucun membre en retard 🎉
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-shell-tresor', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/tresor/reports/debt.blade.php ENDPATH**/ ?>