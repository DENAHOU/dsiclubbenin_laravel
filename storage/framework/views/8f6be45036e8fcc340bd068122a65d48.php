<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Trésorerie - DSI CLUB</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    
    <style>
        body { background:#f8f9fa; margin:0; }
        .tresor-shell { display:flex; min-height:100vh; }

        .tresor-sidebar {
            width:280px;
            background: #094281;
            color:white;
            padding:1.5rem;
            position:fixed;
            height:100vh;
            overflow-y: auto;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        /* Style du scrollbar pour la sidebar */
        .tresor-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .tresor-sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .tresor-sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        .tresor-sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        .tresor-logo {
            text-align:center;
            margin-bottom:2rem;
            padding-bottom:1rem;
            border-bottom:1px solid rgba(255,255,255,0.2);
        }

        .tresor-logo img {
            height:60px;
            border-radius:10px;
            margin-bottom:0.5rem;
        }

        .tresor-logo h4 {
            margin:0;
            font-size:1.2rem;
            font-weight:600;
        }

        .tresor-content {
            margin-left:260px;
            flex:1;
            padding:2rem;
        }

        .tresor-header {
            background:white;
            padding:1.5rem;
            border-radius:10px;
            box-shadow:0 2px 10px rgba(0,0,0,0.05);
            margin-bottom:2rem;
        }

        .tresor-card {
            background:white;
            border-radius:10px;
            box-shadow:0 2px 10px rgba(0,0,0,0.05);
            padding:1.5rem;
            margin-bottom:1.5rem;
            border-left:4px solid #094281;
        }

        .tresor-menu {
            list-style:none;
            padding:0;
            margin:0;
        }

        .tresor-menu li {
            margin-bottom:0.5rem;
        }

        .tresor-menu a {
            color:white;
            text-decoration:none;
            padding:0.75rem 1rem;
            display:block;
            border-radius:8px;
            transition:all 0.3s ease;
            font-weight:500;
        }

        .tresor-menu a:hover {
            background:rgba(255,255,255,0.1);
            transform:translateX(5px);
        }

        .tresor-menu a.active {
            background:rgba(255,255,255,0.2);
            border-left:3px solid white;
        }

        .tresor-menu i {
            width:20px;
            margin-right:0.75rem;
        }

        .tresor-menu-title {
            font-size:0.85rem;
            text-transform:uppercase;
            color:rgba(255,255,255,0.7);
            margin:1.5rem 0 1rem 0;
            font-weight:600;
            letter-spacing:1px;
        }

        .tresor-stats {
            display:grid;
            grid-template-columns:repeat(auto-fit, minmax(250px, 1fr));
            gap:1.5rem;
            margin-bottom:2rem;
        }

        .tresor-stat-card {
            background:white;
            padding:1.5rem;
            border-radius:10px;
            box-shadow:0 2px 10px rgba(0,0,0,0.05);
            border-top:3px solid #094281;
        }

        .tresor-stat-card h3 {
            color:#094281;
            font-size:2rem;
            font-weight:700;
            margin:0;
        }

        .tresor-stat-card p {
            color:#6c757d;
            margin:0.5rem 0 0 0;
            font-weight:500;
        }

        .tresor-badge {
            background:#094281;
            color:white;
            padding:0.25rem 0.75rem;
            border-radius:20px;
            font-size:0.8rem;
            font-weight:600;
        }

        @media (max-width: 768px) {
            .tresor-sidebar {
                transform:translateX(-100%);
                transition:transform 0.3s ease;
            }

            .tresor-sidebar.show {
                transform:translateX(0);
            }

            .tresor-content {
                margin-left:0;
                padding:1rem;
            }
        }
    </style>
</head>
<body>
    <div class="tresor-shell">
        <!-- Sidebar Trésorier -->
        <div class="tresor-sidebar" id="tresorSidebar">
            <div class="tresor-logo">
                    <img src="<?php echo e(asset('img/logo-dsi.png')); ?>" class="logo" alt="Logo DSI">
                <h4>Trésorerie</h4>
            </div>

            <?php echo $__env->make('partials.tresor-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

        <!-- Contenu principal -->
        <div class="tresor-content">
            <!-- Header -->
            <div class="tresor-header">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h1 class="mb-0">
                            <i class="fas fa-coins text-warning"></i>
                            <?php echo $__env->yieldContent('title', 'Espace Trésorier'); ?>
                        </h1>
                    </div>
                    <div class="col-md-6 text-end">
                        <div class="dropdown">
                            <button class="btn btn-outline-warning dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle"></i>
                                <?php echo e(Auth::user()->name); ?>

                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?php echo e(route('tresor.profile')); ?>">
                                    <i class="fas fa-user"></i> Mon Profil
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                                </a></li>
                            </ul>
                        </div>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Contenu de la page -->
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts personnalisés -->
    <script>
        // Menu mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('tresorSidebar');
            sidebar.classList.toggle('show');
        }

        // Activer le menu courant
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const menuLinks = document.querySelectorAll('.tresor-menu a');

            menuLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });
        });
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/layouts/app-shell-tresor.blade.php ENDPATH**/ ?>