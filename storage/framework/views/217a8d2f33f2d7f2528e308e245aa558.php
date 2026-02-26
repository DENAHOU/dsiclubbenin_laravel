

<?php $__env->startSection('title', 'Mes cotisations'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Mes cotisations</h1>

    <table class="min-w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Montant</th>
                <th class="border px-4 py-2">Mois</th>
                <th class="border px-4 py-2">Référence</th>
                <th class="border px-4 py-2">Statut</th>
                <th class="border px-4 py-2">Date</th>
                <th class="border px-4 py-2">Facture</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $cotisations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="border px-4 py-2"><?php echo e($cot->id); ?></td>
                    <td class="border px-4 py-2"><?php echo e(number_format($cot->amount, 2, ',', ' ')); ?> FCFA</td>
                    <td class="border px-4 py-2"><?php echo e($cot->months); ?></td>
                    <td class="border px-4 py-2"><?php echo e($cot->payment_reference); ?></td>
                    <td class="border px-4 py-2"><?php echo e(ucfirst($cot->status)); ?></td>
                    <td class="border px-4 py-2"><?php echo e($cot->created_at->format('d/m/Y')); ?></td>
                    <td class="border px-4 py-2">
                        <?php if($cot->invoice_path && file_exists(public_path("storage/{$cot->invoice_path}"))): ?>
                            <a href="<?php echo e(asset('storage/' . $cot->invoice_path)); ?>" target="_blank" class=" px-2 py-1 rounded " style="color: white; background-color: green; text-decoration: none;">
                                Télécharger
                            </a>
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" class="border px-4 py-2 text-center">Aucune cotisation trouvée</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="mt-4">
        <?php echo e($cotisations->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-shell-tresor', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/tresor/cotisations/personal.blade.php ENDPATH**/ ?>