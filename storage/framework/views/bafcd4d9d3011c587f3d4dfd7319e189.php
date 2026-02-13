<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        /* ===== HEADER ===== */
        .header {
            border-bottom: 3px solid #28a745;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .logo {
            width: 130px;
            height: 80px;
        }

        .club-info {
            text-align: right;
        }

        .club-name {
            font-size: 18px;
            font-weight: bold;
            color: #28a745;
        }

        .club-slogan {
            font-size: 11px;
            color: #666;
        }

        /* ===== TITLE ===== */
        .title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin: 25px 0;
            color: #000;
        }

        /* ===== BOX ===== */
        .box {
            border: 1px solid #ddd;
            padding: 12px;
            margin-bottom: 15px;
            background-color: #f9f9f9;
        }

        .box-title {
            font-weight: bold;
            margin-bottom: 8px;
            color: #28a745;
            font-size: 13px;
        }

        .info-row {
            margin-bottom: 6px;
            line-height: 1.5;
        }

        /* ===== TABLE ===== */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th {
            background: #28a745;
            color: #fff;
            padding: 12px;
            font-size: 12px;
            font-weight: bold;
            text-align: left;
        }

        table td {
            border: 1px solid #ddd;
            padding: 12px;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .amount {
            text-align: right;
            font-weight: bold;
        }

        /* ===== SUMMARY TABLE ===== */
        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-left: auto;
            margin-right: 0;
            width: 50%;
        }

        .summary-table td {
            padding: 10px;
            border: none;
        }

        .summary-row {
            text-align: right;
        }

        .summary-label {
            text-align: left;
            font-weight: normal;
        }

        .summary-total {
            border-top: 2px solid #28a745;
            border-bottom: 2px solid #28a745;
            font-weight: bold;
            font-size: 14px;
            color: #28a745;
        }

        /* ===== STATUS ===== */
        .status {
            margin-top: 15px;
            padding: 10px;
            background-color: #d4edda;
            border: 1px solid #28a745;
            border-radius: 4px;
            font-weight: bold;
            color: #28a745;
            text-align: center;
        }

        /* ===== FOOTER ===== */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            border-top: 1px solid #ddd;
            padding-top: 8px;
            font-size: 10px;
            text-align: center;
            color: #666;
            background-color: white;
        }

        .reference {
            font-size: 11px;
            color: #666;
            font-family: monospace;
            background-color: #f0f0f0;
            padding: 4px 8px;
            border-radius: 3px;
        }
    </style>
</head>

<body>

<!-- ================= HEADER ================= -->
<div class="header">
    <table width="100%">
        <tr>
            <td>
                <img src="<?php echo e(public_path('img/logo-dsi.png')); ?>" class="logo">
            </td>
            <td class="club-info">
                <div class="club-name">CLUB DSI BÉNIN</div>
                <div class="club-slogan">Club des Décideurs des Systèmes d'Informations</div>
                <div style="font-size: 10px; color: #666; margin-top: 5px;">
                    <strong>Email:</strong> contact@clubdsibenin.bj<br>
                    <strong>Site:</strong> www.clubdsibenin.bj<br>
                    <strong>Localisation:</strong> Cotonou, Bénin
                </div>
            </td>
        </tr>
    </table>
</div>

<!-- ================= TITLE ================= -->
<div class="title">
    FACTURE DE COTISATION MENSUELLE
</div>

<!-- ================= MEMBER INFO ================= -->
<div class="box">
    <div class="box-title">Informations du membre</div>
    <div class="info-row">
        <strong>Nom :</strong> <?php echo e($user->name); ?>

    </div>
    <div class="info-row">
        <strong>Email :</strong> <?php echo e($user->email); ?>

    </div>
    <?php if($user->phone): ?>
        <div class="info-row">
            <strong>Téléphone :</strong> <?php echo e($user->phone); ?>

        </div>
    <?php endif; ?>
</div>

<!-- ================= FACTURE INFO ================= -->
<div class="box">
    <div class="box-title">Détails de la facture</div>
    <div class="info-row">
        <strong>Numéro de facture :</strong>
        <span class="reference">
            <?php echo e($invoiceNumber ?? 'FACT-' . str_pad($payment->id, 6, '0', STR_PAD_LEFT)); ?>

        </span>
    </div>
    <div class="info-row">
        <strong>Date d'émission :</strong> <?php echo e($payment->created_at->format('d/m/Y')); ?>

    </div>
    <?php if($payment->payment_reference): ?>
        <div class="info-row">
            <strong>Référence de paiement :</strong>
            <span class="reference"><?php echo e($payment->payment_reference); ?></span>
        </div>
    <?php endif; ?>
</div>

<!-- ================= SERVICES TABLE ================= -->
<table>
    <thead>
        <tr>
            <th>Description du service</th>
            <th>Durée</th>
            <th style="text-align: right;">Montant</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Cotisation Mensuelle</td>
            <td>
                <?php if(isset($payment->months)): ?>
                    <?php echo e($payment->months); ?> mois
                <?php else: ?>
                    12 mois (Annuelle)
                <?php endif; ?>
            </td>
            <td class="amount"><?php echo e(number_format($payment->amount, 0, ',', ' ')); ?> FCFA</td>
        </tr>
    </tbody>
</table>

<!-- ================= SUMMARY ================= -->
<table class="summary-table">
    <tr>
        <td class="summary-label">Sous-total :</td>
        <td class="summary-row"><?php echo e(number_format($payment->amount, 0, ',', ' ')); ?> FCFA</td>
    </tr>
    <tr>
        <td class="summary-label">Frais :</td>
        <td class="summary-row">0 FCFA</td>
    </tr>
    <tr>
        <td class="summary-label">Remise :</td>
        <td class="summary-row">0 FCFA</td>
    </tr>
    <tr class="summary-total">
        <td class="summary-label">TOTAL À PAYER :</td>
        <td class="summary-row"><?php echo e(number_format($payment->amount, 0, ',', ' ')); ?> FCFA</td>
    </tr>
</table>

<!-- ================= STATUS ================= -->
<div class="status">
    ✓ STATUT : PAIEMENT EFFECTUÉ - FACTURE VALIDÉE
</div>

<!-- ================= FOOTER ================= -->
<div class="footer">
    <strong>Club DSI Bénin</strong> • Club des Décideurs des Systèmes d'Informations<br>
    Email : contact@clubdsibenin.bj • Site : www.clubdsibenin.bj • Localisation : Cotonou, Bénin<br>
    <strong>Merci pour votre adhésion et votre confiance!</strong>
</div>

</body>
</html>
<?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/pdf/invoice.blade.php ENDPATH**/ ?>