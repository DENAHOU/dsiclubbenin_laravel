<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Connexion Espace Recruteur</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <style>
        :root {
            --dsi-blue: #094281;
            --dsi-green: #29963a;
            --light-bg: #f4f7fc;
            --ink: #0e1a2b;
            --muted-ink: #5c6b81;
        }
        body { font-family: 'Inter', sans-serif; background-color: var(--light-bg); }
        .auth-container { min-height: 100vh; display: grid; place-items: center; padding: 2rem 1rem; }
        .auth-box { width: 100%; max-width: 450px; background: white; border-radius: 24px; box-shadow: 0 25px 50px -12px rgba(11, 63, 122, 0.15); padding: clamp(2rem, 5vw, 3rem); }
        .auth-logo { text-align: center; margin-bottom: 2rem; }
        .auth-logo img { max-height: 60px; }
        .form-title { font-size: 1.8rem; font-weight: 700; text-align: center; margin-bottom: 0.5rem; color: var(--dsi-blue); }
        .form-subtitle { text-align: center; color: var(--muted-ink); margin-bottom: 2rem; }
        .form-group { margin-bottom: 1.5rem; position: relative; }
        .form-group i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: var(--muted-ink); }
        .form-control { width: 100%; height: 50px; padding: 0 1rem 0 45px; background: var(--light-bg); border: 1px solid #e5eaf2; border-radius: 10px; color: var(--ink); font-size: 1rem; box-sizing: border-box; box-shadow: none !important; }
        .btn-submit { width: 100%; padding: 0.9rem; border-radius: 10px; font-weight: 700; font-size: 1rem; border: none; cursor: pointer; transition: all .3s ease; background: linear-gradient(95deg, var(--dsi-blue), var(--dsi-green)); color: white; }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-box">
            <div class="auth-logo"><a href="/"><img src="{{ asset('img/logo-dsi.png') }}" alt="Logo"></a></div>
            <h2 class="form-title">Espace Recruteur</h2>

            <form method="POST" action="{{ route('login.recruter') }}">
                @csrf
                <!-- Affichage des erreurs -->
                @if($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif

                <div class="form-group"><i class="fas fa-envelope"></i><input type="email" name="email" required autofocus class="form-control" placeholder="E-mail"></div>
                <div class="form-group"><i class="fas fa-lock"></i><input type="password" name="password" required class="form-control" placeholder="Mot de passe"></div>

                <button type="submit" class="btn-submit mt-4">Se Connecter</button>

                <div class="social-divider">OU</div>
                <a href="#" class="btn-social"><i class="fab fa-linkedin"></i> Continuer avec LinkedIn</a>
            </form>
        </div>
    </div>
</body>
</html>
