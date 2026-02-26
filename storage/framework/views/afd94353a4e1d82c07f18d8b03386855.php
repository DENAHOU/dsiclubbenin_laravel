<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Espace Membre - Club DSI Bénin</title>
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
            --border-color: #e5eaf2;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
            display: grid;
            place-items: center;
            min-height: 100vh;
            padding: 2rem 1rem;
        }
        .auth-box {
            width: 100%;
            max-width: 450px;
            background: white;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(11, 63, 122, 0.15);
            padding: clamp(2rem, 5vw, 3rem);
        }
        .auth-logo { text-align: center; margin-bottom: 2rem; }
        .auth-logo img { max-height: 60px; }
        .form-title {
            font-size: 1.8rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 0.5rem;
            color: var(--dsi-blue);
        }
        .form-subtitle {
            text-align: center;
            color: var(--muted-ink);
            margin-bottom: 2rem;
        }
        .form-group { margin-bottom: 1.5rem; position: relative; }
        .form-group i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: var(--muted-ink); }
        .form-control {
            width: 100%;
            height: 50px;
            padding: 0 1rem 0 45px;
            background: var(--light-bg);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            color: var(--ink);
            font-size: 1rem;
            box-sizing: border-box;
            box-shadow: none !important;
        }
        .btn-submit {
            width: 100%;
            padding: 0.9rem;
            border-radius: 10px;
            font-weight: 700;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            transition: all .3s ease;
            background: linear-gradient(95deg, var(--dsi-blue), var(--dsi-green));
            color: white;
        }
        .social-divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: var(--muted-ink);
            margin: 1.5rem 0;
            font-size: 0.9rem;
            font-weight: 500;
        }
        .social-divider::before, .social-divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid var(--border-color);
        }
        .social-divider:not(:empty)::before { margin-right: .75em; }
        .social-divider:not(:empty)::after { margin-left: .75em; }

        .btn-microsoft {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 50px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            border: 1px solid var(--dsi-blue);
            color: var(--dsi-blue);
            background: white;
            transition: all .2s ease;
        }
        .btn-microsoft:hover {
            background-color: var(--dsi-blue);
            color: white;
        }
        .btn-microsoft i { margin-right: 0.75rem; font-size: 1.2rem; }
    </style>
</head>
<body>
    <div class="auth-box">
        <div class="auth-logo">
            <a href="<?php echo e(route('home')); ?>"><img src="<?php echo e(asset('img/logo-dsi.png')); ?>" alt="Logo Club DSI Bénin"></a>
        </div>
        <h2 class="form-title">Connexion Membre / Admin</h2>
        <p class="form-subtitle">Utilisez vos identifiants pour accéder à l'espace membre.</p>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger"><?php echo e($errors->first('email')); ?></div>
        <?php endif; ?>

        <a href="<?php echo e(route('login.microsoft.redirect')); ?>" class="btn btn-primary d-block mb-3">
            <i class="fab fa-microsoft me-2"></i> Continuer avec Microsoft
        </a>

        <div class="social-divider">OU</div>

        <form method="POST" action="<?php echo e(route('login.member')); ?>">
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <i class="fas fa-envelope"></i>
                <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus class="form-control" placeholder="E-mail">
            </div>

            <div class="form-group">
                <i class="fas fa-lock"></i>
                <input id="password" type="password" name="password" required class="form-control" placeholder="Mot de passe">
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                    <label class="form-check-label" for="remember_me">Se souvenir de moi</label>
                </div>
                <a href="<?php echo e(route('password.request')); ?>" class="text-muted" style="font-size: 0.9rem;">Mot de passe oublié ?</a>
            </div>

            <button type="submit" class="btn-submit">Se Connecter</button>
        </form>
    </div>
</body>
</html>
<?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/auth/login-member.blade.php ENDPATH**/ ?>