<?php $__env->startSection('content'); ?>

<style>
.payment-wrapper {
    max-width: 520px;
    margin: 40px auto;
}

.payment-card {
    background: #ffffff;
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.05);
    border: 1px solid #e9eef5;
}

.payment-header {
    text-align: center;
    margin-bottom: 25px;
}

.payment-header h2 {
    font-size: 22px;
    font-weight: 700;
    color: #1a3353;
}

.payment-header p {
    color: #6c7a91;
    font-size: 15px;
}

.pay-amount-box {
    background: #f1f8ff;
    padding: 15px;
    border-radius: 12px;
    text-align: center;
    font-size: 20px;
    font-weight: 700;
    color: #0a529c;
    margin-bottom: 25px;
    border: 1px solid #d6e7ff;
}

#payBtn {
    background: #0a7cff;
    color: white;
    border: none;
    padding: 14px 20px;
    width: 100%;
    font-size: 17px;
    font-weight: 600;
    border-radius: 10px;
    cursor: pointer;
    transition: 0.2s ease-in-out;
}

#payBtn:hover {
    background: #006be6;
    transform: translateY(-2px);
}

#payBtn:active {
    transform: scale(0.98);
}

.secure-text {
    margin-top: 12px;
    font-size: 13px;
    text-align: center;
    color: #6c7a91;
}
</style>

<div class="container payment-wrapper">

    <div class="payment-card">

        <div class="payment-header">
            <h2>Paiement de l’adhésion</h2>
            <p>Utilisateur : <strong><?php echo e($user->name); ?></strong> <br> <small><?php echo e($user->email); ?></small></p>
        </div>

        <div class="pay-amount-box">
            10 000 FCFA
        </div>

        <button id="payBtn">Payer maintenant</button>

        <p class="secure-text">
            🔒 Paiement sécurisé via Kkiapay
        </p>
    </div>
</div>


<script src="https://cdn.kkiapay.me/k.js"></script>

<script src="https://cdn.kkiapay.me/k.js"></script>

<script>
    const publicKey = "<?php echo e($publicKey); ?>";
    const sandbox = <?php echo e($sandbox === 'true' ? 'true' : 'false'); ?>;
    const amount = <?php echo e($amount); ?>;

    document.getElementById('payBtn').addEventListener('click', function () {
        openKkiapayWidget({
            amount: amount,
            api_key: publicKey,
            sandbox: sandbox,
            callback: "<?php echo e(route('payments.notify')); ?>",
            data: JSON.stringify({
                user_id: <?php echo e($user->id); ?>,
                email: "<?php echo e($user->email); ?>"
            }),
            name: "Club DSI Bénin",
            email: "<?php echo e($user->email); ?>",
            phone: "<?php echo e($user->phone ?? ''); ?>"
        });
    });

    addSuccessListener(function(response){
        fetch("<?php echo e(route('payments.notify')); ?>", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
            },
            body: JSON.stringify(response)
        })
        .then(r => r.json())
        .then(json => {
            if (json.success) {

                let ref = response.transactionId ?? response.id ?? response.reference;

                window.location.href =
                    "<?php echo e(route('payments.success')); ?>?email=<?php echo e($user->email); ?>&reference=" + ref;
            }
        });
    });
</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/payments/checkout.blade.php ENDPATH**/ ?>