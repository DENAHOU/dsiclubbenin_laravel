

<?php $__env->startSection('title', 'Créer une cotisation'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Créer une cotisation</h1>

    <?php if($errors->any()): ?>
        <div class="bg-red-100 p-3 mb-4 rounded">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="text-red-600"><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('tresor.cotisations.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="mb-4">
            <label for="user_id" class="block font-medium">Membre</label>
            <select name="user_id" id="user_id" class="border rounded p-2 w-full">
                <option value="">-- Sélectionner un membre --</option>
                <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($m->id); ?>" <?php echo e((isset($member) && $member->id == $m->id) ? 'selected' : ''); ?>>
                        <?php echo e($m->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-4">
            <label for="amount" class="block font-medium">Montant</label>
            <input type="number" name="amount" id="amount" class="border rounded p-2 w-full" value="<?php echo e(old('amount')); ?>" min="0" step="0.01">
        </div>

        <div class="mb-4">
            <label for="months" class="block font-medium">Nombre de mois</label>
            <input type="number" name="months" id="months" class="border rounded p-2 w-full" value="<?php echo e(old('months')); ?>" min="1">
        </div>

        <div class="mb-4">
            <label for="created_at" class="block font-medium">Date de cotisation</label>
            <input type="date" name="created_at" id="created_at" class="border rounded p-2 w-full" value="<?php echo e(old('created_at', now()->format('Y-m-d'))); ?>">
        </div>

        <button type="submit" class=" px-4 py-2 rounded" style="color: white; background-color: #06398a; text-decoration: none;">
            Enregistrer
        </button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-shell-tresor', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/tresor/cotisations/create.blade.php ENDPATH**/ ?>