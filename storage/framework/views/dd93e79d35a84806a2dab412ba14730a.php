<?php $__env->startSection('title', 'Rejoindre l\'Écosystème'); ?>

<?php $__env->startSection('content'); ?>

    <style>
        :root {
            --dsi-blue: #094281;
            --dsi-green: #29963a;
            --light-bg: #f4f7fc;
            --ink: #0e1a2b;
            --muted-ink: #5c6b81;
            --border-color: #e5eaf2;
        }
        body { font-family: 'Inter', sans-serif; background-color: var(--light-bg); color: var(--ink); margin: 0; }

        /* .register-hub-container {
            padding: 4rem 1.5rem;
        } */

        .hero-section-v2 {
            position: relative; /* Contexte pour les éléments superposés */
            display: flex; /* Active Flexbox */
            align-items: center; /* Centre le contenu verticalement */
            justify-content: center; /* Centre le contenu horizontalement */
            text-align: center;
            color: white;

            /* --- Contrôle de la hauteur --- */
            height: 70vh; /* Prend 65% de la hauteur de la fenêtre. Ajustez si besoin. */
            min-height: 500px; /* Hauteur minimale pour les petits écrans */

            /* Image de fond */
            background-image: url('https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=1200');
            background-size: cover;
            background-position: center;
        }

        /* Overlay bleu nuit semi-transparent */
        .hero-section-v2 .hero-overlay {
            position: absolute;
            inset: 0; /* Raccourci pour top:0, right:0, bottom:0, left:0 */
            background-color: rgba(18, 39, 63, 0.8); /* Votre couleur --dsi-blue avec 80% d'opacité */
        }

        /* Le conteneur du texte */
        .hero-section-v2 .hero-content {
            position: relative; /* Pour s'assurer qu'il est au-dessus de l'overlay */
            z-index: 2;
        }

        .hero-section-v2 .hero-title {
            font-size: clamp(2.2rem, 5vw, 3.5rem);
            font-weight: 800;
            color: #fff;
        }

        .hero-section-v2 .hero-subtitle {
            font-size: 1.125rem;
            max-width: 700px;
            margin: 1rem auto 0 auto;
            opacity: 0.9;
        }

        .profiles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }

        .profile-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem 2rem;
            text-align: center;
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .profile-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px -15px rgba(9, 66, 129, 0.2);
        }

        .card-icon {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            color: var(--dsi-blue);
            transition: transform 0.3s ease;
        }
        .profile-card:hover .card-icon {
            transform: scale(1.1);
        }

        .profile-card h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
        }
        .profile-card p {
            color: var(--muted-ink);
            line-height: 1.7;
            min-height: 80px; /* Pour aligner les boutons */
        }
        .btn-select-profile {
            background-color: var(--dsi-blue);
            color: white;
            font-weight: 600;
            padding: 0.8rem 2rem;
            border-radius: 10px;
            text-decoration: none;
            display: inline-block;
            margin-top: 1.5rem;
            transition: background-color 0.3s ease;
        }
        .profile-card.highlight .btn-select-profile {
            background: linear-gradient(95deg, var(--dsi-blue), var(--dsi-green));
        }

        /* Effet spécial pour la carte "Membre" */
        .profile-card.highlight {
            background-color: var(--dsi-blue);
            color: white;
            border: none;
        }
        .profile-card.highlight .card-icon,
        .profile-card.highlight h3 {
            color: white;
        }
        .profile-card.highlight p {
            color: rgba(255, 255, 255, 0.8);
        }
        .profile-card.highlight .btn-select-profile {
            background-color: white;
            color: var(--dsi-blue);
        }
    </style>


    <main class="register-hub-container">
        <section class="hero-section-v2">
            <div class="hero-overlay"></div>
            <div class="container hero-content">
                <h1 class="hero-title">Un Écosystème Conçu pour Votre Croissance</h1>
                <p class="hero-subtitle">
                    Que vous soyez une startup innovante, un partenaire stratégique ou une ESN établie, le Club DSI vous offre une plateforme unique pour accélérer votre développement.
                </p>
            </div>
        </section>

        <div class="profiles-grid">
            <!-- Carte 1: Membre DSI (Mise en avant) -->
            <div class="profile-card highlight">
                <div class="card-icon"><i class="fas fa-star"></i></div>
                <h3>Je suis un Décideur IT</h3>
                <p>Rejoignez le réseau exclusif des membres officiels du Club DSI pour accéder au forum, au mentorat et à tous les avantages premium.</p>
                <a href="<?php echo e(route('register.membre.conditions')); ?>" class="btn-select-profile text-white">Devenir Membre</a>
            </div>

            <!-- Carte 2: Talent / Candidat -->
            <div class="profile-card">
                <div class="card-icon"><i class="fas fa-user-tie"></i></div>
                <h3>Je suis un Talent du Numérique - Candidat</h3>
                <p>Déposez votre CV, créez des alertes emploi et laissez notre plateforme intelligente vous connecter aux meilleures opportunités de carrière.</p>
                <a href="<?php echo e(route('register.candidat')); ?>" class="btn-select-profile">Créer mon Profil Candidat</a>
            </div>

            <!-- Carte 3: ESN  -->
            <div class="profile-card">
                <div class="card-icon"><i class="fas fa-building"></i></div>
                <h3>Je suis une Entreprise - ESN</h3>
                <p>Publiez vos offres, découvrez des talents qualifiés ou enregistrez votre ESN pour gagner en visibilité et développer votre business.</p>
                <a href="<?php echo e(route('register.esn')); ?>" class="btn-select-profile">Créer un Compte Entreprise</a>
            </div>

            <!-- Carte 4: Partenaire -->
            <div class="profile-card">
                <div class="card-icon"><i class="fas fa-building"></i></div>
                <h3>Je suis une Entreprise - Partenaire</h3>
                <p>Publiez vos offres, découvrez des talents qualifiés ou enregistrez votre ESN pour gagner en visibilité et développer votre business.</p>
                <a href="<?php echo e(route('register.partner')); ?>" class="btn-select-profile">Créer un Compte Entreprise</a>
            </div>

            <!-- Carte 5: Recruteur -->
            <div class="profile-card">
                <div class="card-icon"><i class="fas fa-building"></i></div>
                <h3>Je suis une Entreprise - Recruteur</h3>
                <p>Publiez vos offres, découvrez des talents qualifiés ou enregistrez votre ESN pour gagner en visibilité et développer votre business.</p>
                <a href="<?php echo e(route('register.recruter')); ?>" class="btn-select-profile">Créer un Compte Entreprise</a>
            </div>
        </div>
    </main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>




<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/auth/register-choice.blade.php ENDPATH**/ ?>