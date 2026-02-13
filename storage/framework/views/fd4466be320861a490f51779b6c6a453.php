<?php $__env->startSection('title', 'Historique des paiements'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">📜 Historique des cotisations</h4>
            <small class="text-muted">Tous vos paiements effectués</small>
        </div>

        <div class="bg-success-subtle px-4 py-2 rounded-3">
            <strong>Total payé :</strong>
            <span class="text-success fw-bold">
                <?php echo e(number_format($totalPaid, 0, ',', ' ')); ?> FCFA
            </span>
        </div>
    </div>

    
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">

            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Mois</th>
                        <th>Montant</th>
                        <th>Référence</th>
                        <th>Statut</th>
                        <th>Facture</th> 
                    </tr>
                </thead>

                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $pay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($index + 1); ?></td>

                        <td>
                            <?php echo e($pay->created_at->format('d/m/Y')); ?>

                            <br>
                            <small class="text-muted">
                                <?php echo e($pay->created_at->format('H:i')); ?>

                            </small>
                        </td>

                        <td>
                            <span class="badge bg-primary">
                                <?php echo e($pay->months); ?> mois
                            </span>
                        </td>

                        <td class="fw-bold">
                            <?php echo e(number_format($pay->amount, 0, ',', ' ')); ?> FCFA
                        </td>

                        <td>
                            <small class="text-muted">
                                <?php echo e($pay->payment_reference); ?>


                            </small>
                        </td>

                        <td>
                            <?php if($pay->status === 'paid'): ?>
                                <span class="badge bg-success">Payé</span>
                            <?php elseif($pay->status === 'pending'): ?>
                                <span class="badge bg-warning text-dark">En attente</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Échoué</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($pay->invoice_path): ?>
                                <a href="<?php echo e(asset('storage/'.$pay->invoice_path)); ?>"
                                class="btn btn-sm btn-outline-success"
                                target="_blank">
                                    📄 Télécharger la facture
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            Aucun paiement enregistré.
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-shell', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/member/cotisations/history.blade.php ENDPATH**/ ?>