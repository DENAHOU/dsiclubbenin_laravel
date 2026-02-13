<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club DSI Bénin - <?php echo $__env->yieldContent('title', 'Espace Membre'); ?></title>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    <!-- CSS de base pour le layout "App Shell" -->
    <style>
        :root {
            --dsi-blue: #094281;
            --dsi-blue-dark: #0a2b5c;
            --dsi-green: #29963a;
            --light-bg: #f4f7fc;
            --ink: #0e1a2b;
            --muted-ink: #5c6b81;
            --border-color: #e5eaf2;
        }
        body { font-family: 'Inter', sans-serif; background-color: var(--light-bg); margin: 0; }
        .app-shell { display: grid; grid-template-columns: 260px 1fr; min-height: 100vh; }

        /* --- SIDEBAR (Menu Latéral) --- */
        .sidebar {
            background: linear-gradient(180deg, #0f2b57 0%, #083063 100%);
            color: white;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
        }
        .sidebar .brand { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 2rem; }
        .sidebar .brand img { height: 45px; }
        .sidebar .brand-name { font-weight: 700; font-size: 1.2rem; color: white; text-decoration: none; }

        .sidebar-nav { list-style: none; padding: 0; margin: 0; }
        .sidebar-nav .nav-title { font-size: 0.8rem; text-transform: uppercase; color: rgba(255,255,255,0.4); padding: 0 0.75rem; margin: 1.5rem 0 0.5rem 0; }
        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.75rem;
            border-radius: 8px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .sidebar-nav .nav-link:hover {
            background: rgba(255,255,255,0.1);
            color: white;
        }
        .sidebar-nav .nav-link.active {
            background: var(--dsi-green);
            color: white;
            font-weight: 600;
        }
        .sidebar-nav .nav-link i { width: 20px; text-align: center; }

        .sidebar-footer { margin-top: auto; } /* Pousse le pied de page en bas */

        /* --- Zone de Contenu Principal --- */
        .main-wrapper {
            display: flex;
            flex-direction: column;
        }



        /* --- Règles pour la Responsivité --- */
        @media (max-width: 992px) {
            .app-shell { grid-template-columns: 1fr; }
            .sidebar {
                /* Sur mobile, on pourrait transformer la sidebar en menu hamburger */
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="app-shell">
    <!-- ============================================= -->
    <!--       SIDEBAR (MENU LATÉRAL FIXE)             -->
    <!-- ============================================= -->
    <aside class="sidebar">
        <div>
            <a href="<?php echo e(route('home')); ?>" class="brand">
                <img src="<?php echo e(asset('img/logo-dsi.png')); ?>" alt="Logo" style="height: 80px;">
            </a>

            <ul class="sidebar-nav">
                <li class="nav-item"><a href="<?php echo e(route('company.dashboard')); ?>" class="nav-link active"><i class="fas fa-home"></i> Espace de travail</a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-comments"></i> Forum </a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-book-bookmark"></i> Bibliothèque</a></li>

                <li class="nav-title">Mon Compte</li>

                <li class="nav-item">
                    <a href="<?php echo e(route('company.profil', Auth::guard('company')->user()->id)); ?>" class="nav-link">
                        <i class="fas fa-briefcase"></i> Mon Profil
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('company.edit', Auth::guard('company')->user()->id)); ?>" class="nav-link">
                        <i class="fas fa-edit"></i> Modifier le Profil
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#cotisationMenu">
                        <i class="fas fa-wallet"></i> Mes Cotisations
                    </a>

                    <ul class="collapse list-unstyled ps-3" id="cotisationMenu">
                        <li>
                            <a href="<?php echo e(route('membership.pay')); ?>" class="nav-link">
                                ➕ Effectuer un paiement
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('membership.history')); ?>" class="nav-link">
                                📜 Historique des paiements
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('company.settings', Auth::guard('company')->user()->id)); ?>" class="nav-link">
                        <i class="fas fa-cog"></i> Paramètres
                    </a>
                </li>
                
                <li class="nav-item"><a href="<?php echo e(route($userType . '.formations')); ?>" class="nav-link"><i class="fas fa-book"></i> Formations disponibles </a></li>

                <li class="nav-title">Réseau</li>
                <li class="nav-item"><a href="<?php echo e(route($userType . '.annuaire.membres')); ?>" class="nav-link"><i class="fas fa-users"></i> Annuaire Membres</a></li>
                <li class="nav-item"><a href="<?php echo e(route($userType . '.annuaire.partenaires')); ?>" class="nav-link"><i class="fas fa-handshake"></i> Annuaire Partenaires</a></li>
            </ul>
        </div>

        <div>
             <ul class="sidebar-nav">
                <li class="nav-item">
            
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <a href="<?php echo e(route('logout')); ?>" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="fas fa-sign-out-alt" ></i> Déconnexion
                </a>
            </form>
                </li>
             </ul>
        </div>
    </aside>

    <!-- ============================================= -->
    <!--       CONTENU PRINCIPAL (DROITE)              -->
    <!-- ============================================= -->
    <div class="main-wrapper">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/layouts/app-shell-entite.blade.php ENDPATH**/ ?>