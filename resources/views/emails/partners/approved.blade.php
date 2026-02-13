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
    <h2>Demande d’adhésion validée</h2>

    <p> Félicitations {{ $partner->company_name }} 🎉</p>

    <p>
        Votre demande de partenariat avec <strong>Club DSI Bénin</strong> a été validée avec succès.
        .
    </p>

    <p>
        ✅ Votre inscription a bien été enregistrée
        📌 Elle est actuellement en cours d’analyse par notre équipe
    </p>

    <p>
        📌 Prochaine étape :
        Notre équipe vous contactera très prochainement afin de procéder
        au **paiement de la formule choisie** et à l’inscription de votre compte partenaire.
    </p>

    <p>
        Nous sommes ravis de vous compter parmi nous 🤝
    </p>

    <p>Cordialement,<br>
    <strong>Club DSI Bénin</strong></p>

    <div class="footer">
        © {{ date('Y') }} Club DSI Bénin – Tous droits réservés.
    </div>
</div>

</body>
</html>



