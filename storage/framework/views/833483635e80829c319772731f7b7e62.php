

<?php $__env->startSection('title', 'Relance cotisations'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Membres à relancer</h1>

    <table class="min-w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">Membre</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Téléphone</th>
                <th class="border px-4 py-2">Mois de retard</th>
                <th class="border px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $unpaidMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="border px-4 py-2"><?php echo e($member->name); ?></td>
                    <td class="border px-4 py-2"><?php echo e($member->email); ?></td>
                    <td class="border px-4 py-2"><?php echo e($member->phone ?? 'N/A'); ?></td>
                    <td class="border px-4 py-2"><?php echo e($member->months_late); ?></td>
                    <td class="border px-4 py-2">
                        <button class=" px-3 py-1 rounded send-reminder-btn" data-id="<?php echo e($member->id); ?>" style="color: white; background-color: rgba(255, 255, 0, 0.801);">
                            Envoyer relance
                        </button>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="border px-4 py-2 text-center">Aucun membre à relancer</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
document.querySelectorAll('.send-reminder-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const memberId = this.dataset.id;
        if(confirm("Voulez-vous vraiment envoyer la relance ?")) {
            fetch("<?php echo e(route('tresor.cotisations.sendReminder')); ?>", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>",
                },
                body: JSON.stringify({ member_id: memberId })
            })
            .then(res => res.json())
            .then(data => {
                if(data.success){
                    alert(data.message);
                }
            });
        }
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-shell-tresor', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/tresor/cotisations/reminder.blade.php ENDPATH**/ ?>