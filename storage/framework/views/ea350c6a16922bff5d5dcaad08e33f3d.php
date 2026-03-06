<style>
.admin-shell { display:flex; min-height:100vh; }
.admin-sidebar { width:260px; background:#094281; color:#fff; padding:1.3rem; position:fixed; height:100vh; }
.admin-content { margin-left:260px; padding:2rem; background:#f7fbff; width:calc(100% - 260px); min-height:100vh; }

.detail-card { background:white; padding:1.5rem; border-radius:12px; box-shadow:0 8px 20px rgba(9,66,129,0.06); }
.label { font-weight:600; color:#094281; }
.value { margin-bottom:.8rem; }
.actions { margin-top:1rem; }
.btn-approve,.btn-reject { padding:8px 14px; border-radius:6px; border:none; color:white; }
.btn-approve { background:#2aa84f; }
.btn-reject { background:#e55353; }
</style>

<?php $__env->startSection('content'); ?>

<div class="admin-shell">


    <main class="admin-content">
        <h1 class="h4 mb-4">
            Dossier adhérent — <?php echo e(ucfirst($type)); ?>

        </h1>

        <?php if($item->status === 'approved'): ?>
            <a href="<?php echo e(route('admin.board.addForm', ['type' => $type, 'id' => $item->id])); ?>"
            class="btn btn-primary mt-3">
                <i class="fa fa-user-plus"></i> Ajouter au bureau
            </a>
        <?php endif; ?>


        <div class="detail-card">

            <h4 class="mb-3">Informations principales</h4>

            
            <?php $__currentLoopData = $item->getAttributes(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(in_array($key, ['password'])) continue; ?>
                <div class="value">
                    <span class="label"><?php echo e(ucfirst(str_replace('_',' ', $key))); ?> :</span>
                    <span><?php echo e(is_null($val) || $val=='' ? '—' : $val); ?></span>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            
            <?php if(isset($item->photo_path) || isset($item->logo_path)): ?>
                <div class="mt-3">
                    <span class="label">Photo / Logo :</span><br>
                    <img src="<?php echo e(asset('storage/'.($item->photo_path ?? $item->logo_path))); ?>"
                         style="max-height:150px; margin-top:10px; border-radius:8px;">
                </div>
            <?php endif; ?>


            
            <div class="actions mt-4">
                <a href="<?php echo e(route('admin.members')); ?>" class="btn btn-secondary ms-3">Retour</a>
            </div>

        </div>
    </main>
</div>

<?php $__env->stopSection(); ?>

<script>
document.getElementById('approve-btn').onclick = function() {
    if(!confirm('Approuver cette adhésion ?')) return;

    fetch("<?php echo e(route('admin.members.approve', ['type'=>$type, 'id'=>$item->id])); ?>", {
        method:'POST',
        headers:{
            'X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>',
            'Accept':'application/json'
        }
    }).then(r=>r.json())
    .then(data=>{
        alert(data.message || "Approuvé !");
        window.location.href = "<?php echo e(route('admin.members')); ?>";
    });
};

document.getElementById('reject-btn').onclick = function() {
    if(!confirm('Rejeter cette adhésion ?')) return;

    fetch("<?php echo e(route('admin.members.reject', ['type'=>$type, 'id'=>$item->id])); ?>", {
        method:'POST',
        headers:{
            'X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>',
            'Accept':'application/json'
        }
    }).then(r=>r.json())
    .then(data=>{
        alert(data.message || "Rejeté !");
        window.location.href = "<?php echo e(route('admin.members')); ?>";
    });
};
</script>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/admin/members/show.blade.php ENDPATH**/ ?>