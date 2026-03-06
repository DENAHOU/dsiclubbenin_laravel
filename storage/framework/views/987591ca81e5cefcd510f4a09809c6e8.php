<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choisissez Votre Statut - Club DSI Bénin</title>
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
        .page-header { text-align: center; padding: 4rem 1.5rem; background-color: white; }
        .page-header h1 { font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 800; color: var(--dsi-blue); }
        .page-header p { color: var(--muted-ink); max-width: 700px; margin: 0.5rem auto 0 auto; }

        .membership-grid {
            padding: 3rem 1.5rem;
            display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem; max-width: 1400px; margin: auto;
        }
        .membership-card {
            border: 1px solid #e5eaf2; border-radius: 16px;
            background: white; display: flex; flex-direction: column;
            box-shadow: 0 10px 30px -15px rgba(11, 63, 122, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .membership-card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px -15px rgba(9, 66, 129, 0.2); }

        .card-header-custom { padding: 2rem; text-align: center; border-bottom: 1px solid #e5eaf2; }
        .card-icon { font-size: 2.5rem; color: var(--dsi-blue); margin-bottom: 1rem; }
        .card-title { font-size: 1.5rem; font-weight: 700; }
        .card-price { font-size: 2rem; font-weight: 800; color: var(--ink); }
        .card-price small { font-size: 1rem; font-weight: 500; color: var(--muted-ink); display: block; }

        .card-body { padding: 2rem; flex-grow: 1; }
        .advantages-list { list-style: none; padding-left: 0; margin: 0; }
        .advantages-list li { position: relative; padding-left: 25px; margin-bottom: 0.75rem; font-size: 0.95rem; }
        .advantages-list li::before { content: '\f058'; font-family: "Font Awesome 6 Free"; font-weight: 900; position: absolute; left: 0; top: 4px; color: var(--dsi-green); }

        .card-footer { padding: 2rem; background-color: var(--light-bg); border-top: 1px solid #e5eaf2; }
        .btn-select {
            width: 100%; font-size: 1.1rem; font-weight: 600;
            padding: 0.8rem; border-radius: 10px; text-decoration: none;
            background-color: var(--dsi-blue); color: white;
            transition: background-color 0.2s ease;
        }
        .btn-select:hover { background-color: #073566; }
    </style>
</head>
<body>

<div class="page-header">
    <h1>Choisissez Votre Statut de Membre</h1>
    <p>Chaque statut offre un ensemble unique d'avantages pour vous connecter, apprendre et grandir au sein de notre écosystème.</p>
</div>

<!-- ======================================================= -->
<!--       NOUVELLE GRILLE DE CARTES AVEC TEXTES ORIGINAUX   -->
<!-- ======================================================= -->

<div class="membership-grid">
    <!-- Carte 1: Membre Individuel -->
    <div class="membership-card">
        <div class="card-header-custom">
            <div class="card-icon"><i class="fas fa-user"></i></div>
            <h3 class="card-title">Membre Individuel</h3>
            <div class="card-price">5 000 <small>FCFA / mois</small></div>
        </div>
        <div class="card-body">
            <ul class="advantages-list">
                <!-- 5 avantages visibles -->
                <li>Accès privilégié aux événements et conférences organisés par le Club DSI et ses partenaires</li>
                <li>Possibilité de présenter des keynotes ou de participer à des panels de haut niveau</li>
                <li>Opportunités de réseautage avec d'autres DSI et experts du secteur</li>
                <li>Accès des diplômes complémentaires et certifications à l’Ecole des DSI à des coûts très réduits</li>
                <li>Participation aux réalisations des projets (à travers les accords de partenariats du BE) dans le numérique en tant Consultant IT</li>

                <!-- Contenu caché -->
                <div class="collapse" id="more-individuel">
                    <li>Partage d'expériences et de bonnes pratiques entre pairs</li>
                    <li>Accès aux études et analyses technologiques du Club DSI</li>
                    <li>Participation aux groupes de travail et réflexions stratégiques</li>
                    <li>Possibilité de mentorat ou d’accompagnement sur des problématiques spécifiques</li>
                    <li>Membre d’une association de référence dans le domaine du numérique</li>
                    <li>Accéder à un réseau d’experts/partenaires du club DSI</li>
                    <li>Contribuer à la promotion de l’usage des Systèmes d’Information</li>
                </div>
            </ul>
        </div>
        <div class="card-footer text-center">
            <button class="btn btn-link text-decoration-none read-more-btn" data-bs-toggle="collapse" data-bs-target="#more-individuel">
                Lire plus
            </button>
            <a href="<?php echo e(route('register.membre')); ?>?type=individuel" class="btn btn-select mt-2">Choisir ce Statut</a>
        </div>
    </div>

    <!-- Carte 2: Entité Utilisatrice -->
    <div class="membership-card">
        <div class="card-header-custom">
            <div class="card-icon"><i class="fas fa-building"></i></div>
            <h3 class="card-title">Membre Entité Utilisatrice</h3>
            <div class="card-price">Dès 150 000 <small>FCFA / an (selon CA)</small></div>
        </div>
        <div class="card-body">
            <ul class="advantages-list">
                <!-- 5 avantages visibles -->
                <li>Accès à des recommandations et conseils pour la transformation numérique</li>
                <li>Participation aux comités de réflexion sur les tendances IT</li>
                <li>Opportunités de partenariats avec des prestataires technologiques</li>
                <li>Présentation de cas d’usage et retour d’expérience lors des événements</li>
                <li>Accès à des formations adaptées aux besoins des entreprises</li>

                <!-- Contenu caché -->
                <div class="collapse" id="more-entite">
                    <li>Accès privilégié aux événements et conférences du Club DSI et partenaires</li>
                    <li>Opportunités de réseautage avec d'autres DSI et experts</li>
                    <li>Accès à des diplômes complémentaires et certifications à coût réduit</li>
                    <li>Participation aux projets numériques comme Consultant IT</li>
                    <li>Préparation au métier de consultant après le poste de DSI</li>
                    <li>Partage d'expériences et bonnes pratiques entre pairs</li>
                    <li>Accès aux études et analyses technologiques du Club DSI</li>
                    <li>Participation aux groupes de travail et réflexions stratégiques</li>
                    <li>Possibilité de mentorat ou accompagnement sur des problématiques ciblées</li>
                    <li>Adhésion à une association de référence dans le numérique</li>
                    <li>Accès à un réseau d’experts et partenaires du Club DSI</li>
                </div>
            </ul>
        </div>
        <div class="card-footer text-center">
            <button class="btn btn-link text-decoration-none read-more-btn" data-bs-toggle="collapse" data-bs-target="#more-entite">
                Lire plus
            </button>
            <a href="<?php echo e(route('register.company')); ?>?type=entite" class="btn btn-select mt-2">Choisir ce Statut</a>
        </div>
    </div>

    <!-- Carte 3: Administration Publique -->
    <div class="membership-card">
        <div class="card-header-custom">
            <div class="card-icon"><i class="fas fa-landmark"></i></div>
            <h3 class="card-title">Administration Publique</h3>
            <div class="card-price">100 000 <small>FCFA / an</small></div>
        </div>
        <div class="card-body">
            <p class="text-muted">Bénéficie des mêmes avantages que les "Membres Entités Utilisatrices", adaptés au contexte du secteur public.</p>
        </div>
        <div class="card-footer text-center">
             <a href="<?php echo e(route('register.admin')); ?>?type=admin_publique" class="btn btn-select mt-2">Choisir ce Statut</a>
        </div>
    </div>

        <!-- Carte 4: Collège IT -->
    <div class="membership-card">
        <div class="card-header-custom">
            <div class="card-icon"><i class="fas fa-laptop-code"></i></div>
            <h3 class="card-title">Membre Collège IT</h3>
            <div class="card-price">Dès 100 000 <small>FCFA / an (selon CA)</small></div>
        </div>
        <div class="card-body">
            <ul class="advantages-list">
                <!-- 5 avantages visibles -->
                <li>Développer son réseau professionnel</li>
                <li>Se mettre en relation avec les décideurs IT</li>
                <li>Présenter et démontrer ses innovations lors d’évènements</li>
                <li>Défendre les intérêts de la corporation au sein d’une association forte</li>
                <li>Bénéficier de visibilité dans l’écosystème numérique</li>

                <!-- Contenu caché -->
                <div class="collapse" id="more-entite">
                <li>Avoir la priorité pour assister aux évènements du Club DSI</li>
                <li>Accorder à son personnel des réductions sur diplômes et formations</li>
                <li>Donner de la visibilité à sa société sur le site du Club DSI</li>
                <li>Participer aux ateliers et forums sur les solutions technologiques</li>
                <li>Accéder aux tendances et perspectives du marché IT</li>
                <li>Être invité à des sessions privées avec des experts du secteur</li>
                <li>Partager ses évènements et actualités avec les membres du Club DSI</li>
                </div>
            </ul>
        </div>
        <div class="card-footer text-center">
            <button class="btn btn-link text-decoration-none read-more-btn" data-bs-toggle="collapse" data-bs-target="#more-entite">
                Lire plus
            </button>
            <a href="<?php echo e(route('register.college_it')); ?>?type=college_it" class="btn btn-select mt-2">Choisir ce Statut</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



















<?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/auth/register-choice-type.blade.php ENDPATH**/ ?>