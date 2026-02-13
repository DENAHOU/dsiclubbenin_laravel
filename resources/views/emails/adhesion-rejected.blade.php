<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Votre adhésion est approuvée</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f6f9fc; margin: 0; padding: 0; }
        .container {
            max-width: 650px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            border-top: 6px solid #29963a;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }
        h2 { color: #29963a; }
        p { color: #333; line-height: 1.6; }

        .btn {
            background: linear-gradient(120deg, #0b3f7a, #29963a);
            color: white !important;
            padding: 12px 20px;
            text-decoration: none;
            display: inline-block;
            border-radius: 6px;
            font-weight: bold;
            margin-top: 20px;
        }

        .footer { margin-top: 30px; font-size: 13px; color: #777; text-align: center; }
    </style>
</head>
<body>

<div class="container">

    <p>Bonjour {{ $name }},</p>

    <p>Nous vous remercions pour votre demande d'adhésion. Après examen, votre demande n'a pas été retenue pour le moment.</p>


    <p>Si vous souhaitez plus d'informations, merci de répondre à ce mail ou de nous contacter.</p>

    <p>Cordialement,<br>
        <strong>Club DSI Bénin</strong>
    </p>

    <div class="footer">
        © {{ date('Y') }} Club DSI Bénin – Tous droits réservés.
    </div>
</div>

</body>
</html>
