<?php $__env->startSection('title', 'Effectuer un paiement'); ?>

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

                    <small class="text-muted">
                        Dernier paiement :
                        <?php echo e($lastPayment?->created_at?->format('d/m/Y') ?? '—'); ?>

                    </small>
                </div>
            </div>

            <form method="POST" action="<?php echo e(route('member.cotisations.confirm')); ?>" id="paymentForm">
                <?php echo csrf_field(); ?>

                <div class="card shadow border-0">
                    <div class="card-body">

                        <label class="fw-bold mb-2">Nombre de mois à payer</label>
                        <input type="number" min="1" value="1"
                               id="months"
                               name="number_of_months"
                               class="form-control form-control-lg text-center mb-3">

                        <div class="bg-light rounded p-3 text-center mb-3">
                            <h6 class="mb-1 text-muted">Montant total</h6>
                            <h3 class="fw-bold text-success">
                                <span id="total">5 000</span> FCFA
                            </h3>
                        </div>

                        <input type="hidden" id="amount" name="amount" value="5000">

                        <button type="submit" class="btn btn-success btn-lg w-100" id="payBtn">
                            💳 Payer maintenant
                        </button>

                    </div>
                </div>

            </form>

        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        const PRICE = 5000;

        const monthsInput = document.getElementById('months');
        const totalSpan = document.getElementById('total');
        const amountInput = document.getElementById('amount');
        const paymentForm = document.getElementById('paymentForm');

        // Mise à jour du montant en temps réel
        monthsInput.addEventListener('input', () => {
            const amount = monthsInput.value * PRICE;
            totalSpan.innerText = amount.toLocaleString('fr-FR');
            amountInput.value = amount;
        });

        // Le formulaire se soumet normalement au clic sur "Payer"
        paymentForm.addEventListener('submit', (e) => {
            if (monthsInput.value < 1) {
                e.preventDefault();
                alert('Veuillez sélectionner au moins 1 mois');
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app-shell', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/member/cotisations/pay.blade.php ENDPATH**/ ?>