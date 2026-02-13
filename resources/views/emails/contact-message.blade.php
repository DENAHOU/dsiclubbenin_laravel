<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau message reçu - Club DSI Bénin</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f6fa;
            padding: 20px;
            color: #1b2a41;
        }

        .email-container {
            background: white;
            max-width: 650px;
            margin: 0 auto;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(120deg,#0b3f7a,#29963a);
            padding: 25px;
            color: white;
            text-align: center;
        }

        .header img {
            height: 70px;
            margin-bottom: 10px;
        }

        .content {
            padding: 25px;
        }

        .content h2 {
            font-size: 20px;
            color: #0b3f7a;
            margin-bottom: 15px;
        }

        .info p strong {
            color: #0b3f7a;
        }

        .message-box {
            margin-top: 15px;
            background: #f7fafc;
            border-left: 4px solid #29963a;
            padding: 12px 15px;
            border-radius: 6px;
            white-space: pre-line;
        }

        .footer {
            background: #0b3f7a;
            padding: 15px;
            text-align: center;
            color: white;
            font-size: 12px;
        }
    </style>
</head>

<body>

<div class="email-container">

    <!-- HEADER -->
    <div class="header">
        <img src="{{ asset('img/logo-dsi.png') }}" alt="Logo Club DSI">
        <h1>💬 Nouveau message reçu</h1>
    </div>

    <!-- CONTENT -->
    <div class="content">
        <h2>Détails de l'expéditeur</h2>

        <div class="info">
            <p><strong>Nom :</strong> {{ $name }}</p>
            <p><strong>Email :</strong> {{ $email }}</p>
            <p><strong>Objet :</strong> {{ $subjectText }}</p>
        </div>

        <h2>Message :</h2>

        <div class="message-box">
            {!! nl2br(e($messageText)) !!}
        </div>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        Club DSI Bénin • Email : contact@clubdsibenin.bj
        <br>
        Ceci est une notification automatique — merci de ne pas répondre directement à ce mail.
    </div>

</div>

</body>
</html>
