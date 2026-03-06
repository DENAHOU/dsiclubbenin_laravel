<?php $__env->startSection('content'); ?>
<div class="container">
    <h3 class="mb-4">👁️ Détails du partenaire</h3>

    <table class="table table-bordered">
        <tr>
            <th>Entreprise</th>
            <td><?php echo e($partner->company_name); ?></td>
        </tr>

        <tr>
            <th>Email</th>
            <td><?php echo e($partner->email); ?></td>
        </tr>

        <tr>
            <th>Téléphone</th>
            <td><?php echo e($partner->phone); ?></td>
        </tr>

        <tr>
            <th>Type</th>
            <td><?php echo e($partner->partnerType->name ?? '-'); ?></td>
        </tr>

        <tr>
            <th>Formule</th>
            <td><?php echo e($partner->partnerFormule->name ?? '-'); ?></td>
        </tr>

        <tr>
            <th>Logo</th>
            <td>
                <?php if($partner->logo_path): ?>
                    <img src="<?php echo e(asset('storage/' . $partner->logo_path)); ?>"
                         alt="Logo de <?php echo e($partner->company_name); ?>"
                         style="max-width: 150px; max-height: 150px;">
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>
        </tr>

        <tr>
            <th>Statut</th>
            <td>
                <?php if($partner->status === 'approved'): ?>
                    <span class="badge bg-success">Validé</span>
                <?php elseif($partner->status === 'rejected'): ?>
                    <span class="badge bg-danger">Rejeté</span>
                <?php else: ?>
                    <span class="badge bg-warning">En attente</span>
                <?php endif; ?>
            </td>
        </tr>
    </table>

    <a href="<?php echo e(route('admin.partners.index')); ?>" class="btn btn-secondary">Retour</a>
<a href="<?php echo e(route('admin.partners.edit', $partner->id)); ?>" class="btn btn-primary btn-sm">
    Modifier
</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-shell-superadmin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/admin/partners/show.blade.php ENDPATH**/ ?>