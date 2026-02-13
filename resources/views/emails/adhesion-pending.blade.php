<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Votre demande d’adhésion est reçue</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f6f9fc; margin: 0; padding: 0; }
        .container {
            max-width: 650px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            border-top: 6px solid #0b3f7a;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }
        h2 { color: #0b3f7a; }
        p { color: #333; line-height: 1.6; }
        .footer { margin-top: 30px; font-size: 13px; color: #777; text-align: center; }
    </style>
</head>
<body>

<div class="container">
    <h2>Demande d’adhésion reçue</h2>

    <p>Bonjour {{ $name }},</p>

    <p>
        Nous vous remercions pour votre intérêt à rejoindre le
        <strong>Club DSI Bénin</strong>.
    </p>

    <p>
        Votre demande d’adhésion a bien été reçue et est actuellement en cours d’examen
        par notre équipe.
    </p>

    <p>
        Vous recevrez un message de confirmation dès que votre dossier sera validé
        ou si des informations complémentaires sont nécessaires.
    </p>

    <p>
        Merci pour votre patience et votre confiance.
    </p>

    <p>Cordialement,<br>
    <strong>Club DSI Bénin</strong></p>

    <div class="footer">
        © {{ date('Y') }} Club DSI Bénin – Tous droits réservés.
    </div>
</div>

</body>
</html>
