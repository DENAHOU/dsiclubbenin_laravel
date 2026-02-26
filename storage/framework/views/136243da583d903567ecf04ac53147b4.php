


<?php $__env->startSection('title', 'Liste des cotisations'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-4">

    <?php if(session('success')): ?>
        <div class="bg-green-100 text-green-800 p-3 mb-4 rounded">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="bg-red-100 text-red-800 p-3 mb-4 rounded">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <a href="<?php echo e(route('tresor.cotisations.create')); ?>" style="color: white; background-color: #053177; text-decoration: none;" class="px-2 py-1 rounded" class=" px-2 py-2 rounded mb-2">
        Ajouter une cotisation
    </a>

    <table class="min-w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-2 py-2">ID</th>
                <th class="border px-2 py-2">Membre</th>
                <th class="border px-2 py-2">Montant</th>
                <th class="border px-2 py-2">Mois</th>
                <th class="border px-2 py-2">Référence</th>
                <th class="border px-2 py-2">Statut</th>
                <th class="border px-2 py-2">Date</th>
                <th class="border px-2 py-2">Facture</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $cotisations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="border px-2 py-2"><?php echo e($cot->id); ?></td>
                    <td class="border px-2 py-2"><?php echo e($cot->user->name); ?></td>
                    <td class="border px-2 py-2"><?php echo e(number_format($cot->amount, 2, ',', ' ')); ?> FCFA</td>
                    <td class="border px-2 py-2"><?php echo e($cot->months); ?></td>
                    <td class="border px-2 py-2"><?php echo e($cot->payment_reference); ?></td>
                    <td class="border px-2 py-2"><?php echo e(ucfirst($cot->status)); ?></td>
                    <td class="border px-2 py-2"><?php echo e($cot->created_at->format('d/m/Y')); ?></td>
                    <td class="border px-2 py-2">
                        <?php if($cot->invoice_path && file_exists(public_path("storage/{$cot->invoice_path}"))): ?>
                            <a href="<?php echo e(asset('storage/' . $cot->invoice_path)); ?>" target="_blank" style="color: white; background-color: green; text-decoration: none;" class="px-2 py-1 rounded">
                                Télécharger
                            </a>
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" class="border px-2 py-2 text-center">Aucune cotisation trouvée</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-shell-tresor', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/tresor/cotisations/index.blade.php ENDPATH**/ ?>