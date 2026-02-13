<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Intelligente - DSI CLUB</title>
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .main-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .login-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            max-width: 400px;
            width: 100%;
        }
        
        .card-header-custom {
            background: linear-gradient(135deg, #094281 0%, #29963a 100%);
            color: white;
            text-align: center;
            padding: 30px 20px;
            border: none;
        }
        
        .card-body-custom {
            padding: 30px;
        }
        
        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }
        
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #094281;
            box-shadow: 0 0 0 0.2rem rgba(9, 66, 129, 0.25);
        }
        
        .input-group-text {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 0 10px 10px 0;
        }
        
        .btn-primary-custom {
            background: linear-gradient(135deg, #094281 0%, #29963a 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 20px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(9, 66, 129, 0.3);
        }
        
        .info-box {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            font-size: 0.85rem;
            margin-top: 20px;
        }
        
        .info-item {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }
        
        .info-item i {
            margin-right: 8px;
            width: 20px;
        }
        
        .alert-custom {
            border-radius: 10px;
            border: none;
            padding: 15px;
            margin-bottom: 20px;
        }
        
        .badge-animation {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s ease;
        }
        
        .badge-animation.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="login-card">
            <!-- En-tête -->
            <div class="card-header-custom">
                <h3 class="mb-0">
                    <i class="fas fa-user-shield me-2"></i>
                    Connexion Intelligente
                </h3>
                <p class="mb-0 small mt-2" style="opacity: 0.8;">
                    Accès automatique selon votre rôle
                </p>
            </div>

            <!-- Corps -->
            <div class="card-body-custom">
                <!-- Messages d'erreur/succès -->
                <div id="alert-container"></div>

                <!-- Formulaire -->
                <form id="smartLoginForm" method="POST" action="http://127.0.0.1:8000/smart-login">
                    <input type="hidden" name="_token" value="YOUR_CSRF_TOKEN_HERE">
                    
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-envelope me-2"></i>
                            Adresse Email
                        </label>
                        <div class="input-group">
                            <input type="email" 
                                   class="form-control" 
                                   name="email" 
                                   placeholder="exemple@email.com" 
                                   required>
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-lock me-2"></i>
                            Mot de passe
                        </label>
                        <div class="input-group">
                            <input type="password" 
                                   class="form-control" 
                                   name="password" 
                                   placeholder="•••••••" 
                                   required>
                            <span class="input-group-text">
                                <i class="fas fa-key"></i>
                            </span>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary-custom">
                            <i class="fas fa-sign-in-alt me-2"></i>
                            Se Connecter
                        </button>
                    </div>

                    <hr class="my-4">

                    <!-- Informations -->
                    <div class="text-center">
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            <strong>Comment ça marche :</strong>
                        </small>
                        <div class="info-box">
                            <div class="info-item badge-animation">
                                <i class="fas fa-user text-success"></i>
                                <strong>Membre</strong> → Accès au dashboard membre
                            </div>
                            <div class="info-item badge-animation">
                                <i class="fas fa-user-shield text-danger"></i>
                                <strong>Administrateur</strong> → Redirection vers dashboard admin
                            </div>
                            <div class="info-item badge-animation">
                                <i class="fas fa-coins text-warning"></i>
                                <strong>Trésor</strong> → Redirection vers dashboard trésor
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animation des badges
            const badges = document.querySelectorAll('.badge-animation');
            badges.forEach((badge, index) => {
                setTimeout(() => {
                    badge.classList.add('show');
                }, index * 200);
            });
            
            // Gestion du formulaire
            const form = document.getElementById('smartLoginForm');
            const alertContainer = document.getElementById('alert-container');
            
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Simulation de connexion (remplacer par vraie logique)
                const email = form.email.value;
                const password = form.password.value;
                
                if (email && password) {
                    showAlert('Connexion en cours...', 'info');
                    
                    // Simuler une requête AJAX
                    setTimeout(() => {
                        // Redirection selon le rôle (à adapter avec vraie logique)
                        if (email.includes('admin')) {
                            showAlert('Redirection vers le dashboard admin...', 'success');
                            setTimeout(() => {
                                window.location.href = '/admin/dashboard';
                            }, 1500);
                        } else if (email.includes('tresor')) {
                            showAlert('Redirection vers le dashboard trésor...', 'success');
                            setTimeout(() => {
                                window.location.href = '/tresor/dashboard';
                            }, 1500);
                        } else {
                            showAlert('Redirection vers le dashboard membre...', 'success');
                            setTimeout(() => {
                                window.location.href = '/dashboard';
                            }, 1500);
                        }
                    }, 1000);
                } else {
                    showAlert('Veuillez remplir tous les champs', 'danger');
                }
            });
        });
        
        function showAlert(message, type) {
            const alertContainer = document.getElementById('alert-container');
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${alertContainer.className.includes('alert-${type}') ? type : type} alert-custom`;
            alertDiv.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : (type === 'danger' ? 'exclamation-triangle' : 'info-circle')} me-2"></i>
                ${message}
            `;
            
            alertContainer.innerHTML = '';
            alertContainer.appendChild(alertDiv);
        }
    </script>
</body>
</html>
<?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/auth/smart-login.blade.php ENDPATH**/ ?>