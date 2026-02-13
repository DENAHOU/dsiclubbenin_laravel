<?php $__env->startSection('title', 'Adhésions en attente'); ?>

<?php $__env->startSection('content'); ?>

<style>
.pending-card {
    border-radius: 18px;
    background: #ffffff;
    padding: 0;
    box-shadow: 0 8px 28px rgba(0,0,0,0.08);
    overflow: hidden;
}

.pending-header {
    background: linear-gradient(135deg, #0a3d62, #0a4f8a);
    padding: 22px 30px;
    color: white;
}

.pending-header h3 {
    font-size: 22px;
    font-weight: 700;
}

.pending-table tbody tr:hover {
    background: #f3f8ff;
}

.btn-approve {
    background: #037432;
    border: none;
    padding: 6px 10px;
    border-radius: 8px;
    color: white;
    font-size: .85rem;
}

.btn-reject {
    background: #8d1306;
    border: none;
    padding: 6px 10px;
    border-radius: 8px;
    color: white;
    font-size: .85rem;
}
</style>

<div class="pending-card">

    <div class="pending-header d-flex justify-content-between align-items-center">
        <h3>⏳ Adhésions en attente (<?php echo e($pendingTotal); ?>)</h3>
        <span class="opacity-75">Validation – Gestion rapide</span>
    </div>

    <table class="table pending-table mb-0">
        <thead class="bg-light">
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Type</th>
                <th>Date</th>
                <th width="200">Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php $__currentLoopData = $recentPending; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr id="row-<?php echo e($p['table']); ?>-<?php echo e($p['id']); ?>">
                    <td class="fw-bold"><?php echo e($p['name']); ?></td>
                    <td><?php echo e($p['email']); ?></td>
                    <td class="text-capitalize"><?php echo e($p['type']); ?></td>
                    <td><?php echo e(\Carbon\Carbon::parse($p['created_at'])->format('d/m/Y H:i')); ?></td>

                    <td>
                        <button class="btn-approve me-1 btn-action"
                                data-type="<?php echo e($p['table']); ?>"
                                data-id="<?php echo e($p['id']); ?>">
                            Approuver
                        </button>

                        <button class="btn-reject me-1 btn-action"
                                data-type="<?php echo e($p['table']); ?>"
                                data-id="<?php echo e($p['id']); ?>">
                            Rejeter
                        </button>

                        <a href="<?php echo e(route('admin.members.show', ['type'=>$p['table'],'id'=>$p['id']])); ?>"
                           class="btn btn-sm btn-outline-primary">
                           Détails
                        </a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>

    </table>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', () => {

    document.querySelectorAll('.btn-action').forEach(btn => {
        btn.addEventListener('click', () => {

            const type = btn.dataset.type;
            const id   = btn.dataset.id;
            const action = btn.classList.contains('btn-approve') ? 'approve' : 'reject';

            if (!confirm("Confirmer l'action ?")) return;

            fetch(`/admin/members/${type}/${id}/${action}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`row-${type}-${id}`).remove();
                }
            });

        });
    });

});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app-shell-superadmin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/admin/members/pending.blade.php ENDPATH**/ ?>