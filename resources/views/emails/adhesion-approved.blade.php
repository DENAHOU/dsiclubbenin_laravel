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
    <h2>Votre adhésion est approuvée 🎉</h2>

    <p>Bonjour {{ $name }},</p>

    <p>
        Nous avons le plaisir de vous informer que votre demande d’adhésion au
        <strong>Club DSI Bénin</strong> vient d’être <strong>validée</strong>.
    </p>

    <p>
        Pour finaliser votre adhésion, veuillez procéder au paiement de votre adhésion.
        Une fois le paiement effectué, vous aurez immédiatement accès à votre espace membre.
    </p>

    <p>
        Cliquez sur le bouton ci-dessous pour vous connecter :
    </p>

    <a href="{{ $loginUrl }}" class="btn">Accéder à mon espace</a>

    <p>
        Si vous avez des questions ou rencontrez des difficultés,
        notre équipe reste disponible pour vous assister.
    </p>

    <p>Cordialement,<br>
        <strong>Club DSI Bénin</strong>
    </p>

    <div class="footer">
        © {{ date('Y') }} Club DSI Bénin – Tous droits réservés.
    </div>
</div>

</body>
</html>
