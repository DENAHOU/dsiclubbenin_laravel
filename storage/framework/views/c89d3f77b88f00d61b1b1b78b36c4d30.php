<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Club DSI Bénin</title>
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
            --error: #dc3545;
            --success: #28a745;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
            display: grid;
            place-items: center;
            min-height: 100vh;
            padding: 2rem 1rem;
        }
        .login-container {
            width: 100%;
            max-width: 450px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(9, 66, 129, 0.2);
            padding: 2.5rem;
        }
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .login-header img {
            max-height: 50px;
            margin-bottom: 1rem;
        }
        .login-header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dsi-blue);
            margin-bottom: 0.5rem;
        }
        .login-header p {
            color: var(--muted-ink);
            font-size: 0.95rem;
        }
        .form-floating label {
            color: var(--muted-ink);
        }
        .form-control:focus {
            border-color: var(--dsi-blue);
            box-shadow: 0 0 0 0.2rem rgba(9, 66, 129, 0.25);
        }
        .btn-login {
            background-color: var(--dsi-blue);
            border: none;
            padding: 0.75rem;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            background-color: var(--dsi-green);
            transform: translateY(-2px);
        }
        .divider {
            text-align: center;
            margin: 1.5rem 0;
            position: relative;
        }
        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background-color: var(--border-color);
        }
        .divider span {
            background-color: white;
            padding: 0 1rem;
            color: var(--muted-ink);
            font-size: 0.85rem;
        }
        .microsoft-btn {
            background-color: #0078d4;
            color: white;
            border: none;
            padding: 0.75rem;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        .microsoft-btn:hover {
            background-color: #106ebe;
            transform: translateY(-2px);
            color: white;
        }
        .alert {
            border-radius: 10px;
            font-size: 0.9rem;
        }
        .links-section {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border-color);
        }
        .links-section a {
            color: var(--dsi-blue);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .links-section a:hover {
            color: var(--dsi-green);
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="login-header">
            <a href="<?php echo e(route('home')); ?>">
                <img src="<?php echo e(asset('img/logo-dsi.png')); ?>" alt="Logo Club DSI Bénin">
            </a>
            <h1>Connexion</h1>
            <p>Accédez à votre espace personnel</p>
        </div>

        <?php if(session('error')): ?>
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <?php if(session('success')): ?>
            <div class="alert alert-success" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('login.unified')); ?>">
            <?php echo csrf_field(); ?>

            <div class="form-floating mb-3">
                <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                       id="email" name="email" placeholder="name@example.com"
                       value="<?php echo e(old('email')); ?>" required autocomplete="email">
                <label for="email">Adresse email</label>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback">
                        <?php echo e($message); ?>

                    </div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                       id="password" name="password" placeholder="Mot de passe"
                       required autocomplete="current-password">
                <label for="password">Mot de passe</label>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback">
                        <?php echo e($message); ?>

                    </div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                    <label class="form-check-label" for="remember">
                        Se souvenir de moi
                    </label>
                </div>
                <a href="<?php echo e(route('password.request')); ?>" class="text-decoration-none">
                    Mot de passe oublié ?
                </a>
            </div>

            <button type="submit" class="btn btn-primary btn-login w-100">
                <i class="fas fa-sign-in-alt me-2"></i>
                Se connecter
            </button>
        </form>

        <div class="divider">
            <span>OU</span>
        </div>

        <a href="<?php echo e(route('login.microsoft.redirect')); ?>" class="btn btn-microsoft w-100">
            <i class="fab fa-microsoft me-2"></i>
            Continuer avec Microsoft
        </a>
        <p class="mt-2 mb-3 text-muted small text-center">Utilisez votre compte <strong>@clubdsibenin.org</strong> pour la connexion SSO. Les comptes personnels seront pris en charge plus tard.</p>

        <div class="links-section">
            <p class="mb-2">
                Vous n'avez pas de compte ?
                <a href="<?php echo e(route('register')); ?>">Créer un compte</a>
            </p>
            <p class="mb-0 text-muted small">
                Membre DSI, Entreprise, Administration, ESN, Partenaire, Candidat ou Recruteur :
                utilisez cette même page pour vous connecter.
            </p>
        </div>
    </div>

</body>
</html>
<?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/auth/login.blade.php ENDPATH**/ ?>