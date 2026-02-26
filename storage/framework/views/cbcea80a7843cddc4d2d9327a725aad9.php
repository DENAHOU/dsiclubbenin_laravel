<?php $__env->startSection('title', 'Tableau de bord'); ?>

<?php $__env->startSection('content'); ?>
<div class="tresor-stats">
    <!-- Statistiques principales -->
    <div class="tresor-stat-card">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3><?php echo e(number_format($totalMembers, 0, ',', ' ')); ?></h3>
                <p>Total membres</p>
            </div>
            <div class="tresor-badge">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <div class="tresor-stat-card">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3><?php echo e(number_format($totalPaid, 0, ',', ' ')); ?></h3>
                <p>Membres à jour</p>
            </div>
            <div class="tresor-badge">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>

    <div class="tresor-stat-card">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3><?php echo e(number_format($totalUnpaid, 0, ',', ' ')); ?></h3>
                <p>Membres en retard</p>
            </div>
            <div class="tresor-badge">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
        </div>
    </div>

    <div class="tresor-stat-card">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3><?php echo e(number_format($totalRevenue, 0, ',', ' ')); ?> FCFA</h3>
                <p>Recette totale</p>
            </div>
            <div class="tresor-badge">
                <i class="fas fa-coins"></i>
            </div>
        </div>
    </div>
</div>

<!-- Activités récentes -->
<div class="row">
    <div class="col-md-8">
        <div class="tresor-card">
            <h4 class="mb-4">
                <i class="fas fa-history text-warning"></i>
                Paiements récents
            </h4>
            
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Membre</th>
                            <th>Montant</th>
                            <th>Date</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $recentPayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <strong><?php echo e($payment->user->name); ?></strong>
                                    <br><small class="text-muted"><?php echo e($payment->user->email); ?></small>
                                </td>
                                <td>
                                    <span class="text-success fw-bold">
                                        <?php echo e(number_format($payment->amount, 0, ',', ' ')); ?> FCFA
                                    </span>
                                </td>
                                <td><?php echo e($payment->created_at->format('d/m/Y')); ?></td>
                                <td>
                                    <span class="badge bg-success">Payé</span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    <i class="fas fa-inbox"></i>
                                    Aucun paiement récent
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!-- Actions rapides -->
        <div class="tresor-card">
            <h4 class="mb-4">
                <i class="fas fa-bolt text-warning"></i>
                Actions rapides
            </h4>
            
            <div class="d-grid gap-2">
                <a href="<?php echo e(route('tresor.cotisations.create')); ?>" class="btn btn-warning">
                    <i class="fas fa-plus"></i>
                    Enregistrer un paiement
                </a>
                <a href="<?php echo e(route('tresor.cotisations.reminder')); ?>" class="btn btn-outline-warning">
                    <i class="fas fa-envelope"></i>
                    Envoyer relances
                </a>
                <a href="<?php echo e(route('tresor.reports.summary')); ?>" class="btn btn-outline-secondary">
                    <i class="fas fa-chart-pie"></i>
                    Voir les rapports
                </a>
            </div>
        </div>

        <!-- Membres en retard -->
        <div class="tresor-card">
            <h4 class="mb-4">
                <i class="fas fa-exclamation-triangle text-warning"></i>
                Membres en retard
            </h4>
            
            <?php $__empty_1 = true; $__currentLoopData = $lateMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div>
                        <strong><?php echo e($member->name); ?></strong>
                        <br><small class="text-muted"><?php echo e($member->email); ?></small>
                    </div>
                    <span class="badge bg-danger"><?php echo e($member->months_late); ?> mois</span>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-muted text-center">
                    <i class="fas fa-check-circle"></i>
                    Tous les membres sont à jour
                </p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-shell-tresor', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/tresor/dashboard.blade.php ENDPATH**/ ?>