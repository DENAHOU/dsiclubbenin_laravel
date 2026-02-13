<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin - Club DSI Bénin</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0b3f7a, #29963a);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-box {
            background: #ffffff;
            width: 400px;
            padding: 2.5rem;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            text-align: center;
            animation: fadeIn 0.8s ease-out;
        }

        .login-box img {
            width: 120px;
            margin-bottom: 1rem;
        }

        h2 {
            color: #0b3f7a;
            font-weight: 800;
            margin-bottom: 1.5rem;
            font-size: 1.6rem;
        }

        .form-group {
            margin-bottom: 1.2rem;
            text-align: left;
        }

        input {
            width: 100%;
            padding: 0.9rem;
            border-radius: 10px;
            border: 1px solid #d8dce6;
            font-size: 0.95rem;
        }

        button {
            width: 100%;
            background: linear-gradient(95deg, #0b3f7a, #29963a);
            color: white;
            padding: 0.9rem;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            margin-top: 0.5rem;
            transition: 0.2s;
        }

        button:hover {
            transform: translateY(-2px);
            opacity: 0.95;
        }

        .error {
            margin-top: 1rem;
            color: red;
            font-weight: 600;
            font-size: 0.9rem;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>

<div class="login-box">

    <!-- LOGO -->
    <img src="{{ asset('img/logo-dsi.png') }}" alt="Logo Club DSI Bénin">

    <h2>Connexion Admin</h2>

    <form action="{{ route('admin.login') }}" method="POST">
        @csrf

        <div class="form-group">
            <input type="email" name="email" placeholder="Adresse email" required>
        </div>

        <div class="form-group">
            <input type="password" name="password" placeholder="Mot de passe" required>
        </div>

        <button type="submit">
            <i class="fa fa-sign-in-alt"></i> Se connecter
        </button>
    </form>

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif
</div>

</body>
</html>
