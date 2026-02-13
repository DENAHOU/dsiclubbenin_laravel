<?php $__env->startSection('title', 'Confirmer le paiement'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-lg border-0 mb-4">
                <div class="card-body text-center">
                    <img src="<?php echo e(Auth::user()->photo_path ? asset('storage/' . Auth::user()->photo_path) : asset('img/avatar.png')); ?>" 
                         class="rounded-circle mb-3" 
                         width="90"
                         alt="Photo de profil">

                    <h5 class="fw-bold"><?php echo e($user->name); ?></h5>
                    <p class="text-muted mb-1"><?php echo e($user->phone); ?></p>
                </div>
            </div>

            <div class="card shadow border-0">
                <div class="card-body text-center">

                    <h6 class="text-muted mb-2">Montant à payer</h6>
                    <h2 class="fw-bold text-success mb-4">
                        <?php echo e(number_format($amount, 0, ',', ' ')); ?> FCFA
                    </h2>

                    <p class="text-muted mb-3">
                        Durée: <strong><?php echo e($months); ?> mois</strong>
                    </p>

                    <div class="d-flex gap-2">
                        <a href="<?php echo e(route('member.cotisations.pay')); ?>" class="btn btn-outline-secondary btn-lg flex-grow-1">
                            Annuler
                        </a>

                        <button class="btn btn-success btn-lg flex-grow-1" id="confirmBtn" data-bs-toggle="modal" data-bs-target="#confirmModal">
                            ✅ Confirmer
                        </button>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>


<div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold">Confirmer le paiement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">
                <h5>Êtes-vous sûr de vouloir payer</h5>
                <h3 class="fw-bold text-success my-3">
                    <?php echo e(number_format($amount, 0, ',', ' ')); ?> FCFA
                </h3>
                <p class="text-muted">pour <strong><?php echo e($months); ?> mois</strong> de cotisation?</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Annuler
                </button>
                <button type="button" class="btn btn-success" id="proceedBtn">
                    Procéder au paiement
                </button>
            </div>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

    <script src="https://cdn.kkiapay.me/k.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const btn = document.getElementById('proceedBtn');

            btn.addEventListener('click', function () {

                console.log('✅ Bouton cliqué');

                if (typeof openKkiapayWidget === 'undefined') {
                    alert('❌ Kkiapay non chargé');
                    return;
                }

                fetch("<?php echo e(route('member.cotisations.process')); ?>", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        number_of_months: <?php echo e($months); ?>,
                        amount: <?php echo e($amount); ?>

                    })
                })
                .then(res => res.json())
                .then(data => {

                    console.log('📦 Données serveur', data);
                    console.log('🆔 Cotisation ID:', data.cotisation_id);

                    const callbackUrl = "<?php echo e(route('member.cotisations.notify')); ?>?cotisation_id=" + data.cotisation_id + "&transaction_id=";
                    console.log('🔗 Callback URL:', callbackUrl);

                    openKkiapayWidget({
                        amount: data.amount,
                        position: "center",
                        theme: "green",
                        sandbox: true,
                        key: "<?php echo e(config('services.kkiapay.public_key')); ?>",
                        callback: callbackUrl,
                        name: "Club DSI Bénin",
                        email: "<?php echo e($user->email); ?>",
                        phone: "<?php echo e($user->phone ?? ''); ?>"
                    });

                })
                .catch(err => {
                    console.error('❌ Erreur:', err);
                    alert('Erreur lors de la création de la cotisation');
                });

            });

        });
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app-shell', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/member/cotisations/confirm.blade.php ENDPATH**/ ?>