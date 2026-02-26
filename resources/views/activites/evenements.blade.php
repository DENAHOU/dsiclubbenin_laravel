@extends('layouts.guest')

@section('title', 'Evenements-Actualités')

@section('content')

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

        /* --- Héros Carrousel --- */
         /* 1. On définit la hauteur du carrousel pour qu'il prenne tout l'écran */
        .hero-carousel .carousel-item {
            height: 100vh; /* 100% de la hauteur de la fenêtre du navigateur */
            min-height: 600px; /* Hauteur minimale de sécurité pour les écrans très larges mais peu hauts */
        }

        /* 2. On s'assure que l'image remplit bien tout l'espace */
        .hero-carousel .carousel-item img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Important: couvre la zone sans déformer l'image */
        }

        /* 3. C'est ici que la magie de l'overlay opère */
        .hero-carousel .carousel-caption {
            /* Positionnement pour couvrir toute l'image */
            position: absolute;
            inset: 0; /* Raccourci pour top:0, right:0, bottom:0, left:0 */

            /* Création de l'overlay bleu nuit transparent */
            background: rgba(9, 33, 70, 0.685); /* C'est votre couleur --dsi-blue-dark avec 60% d'opacité */

            /* On garde le centrage Flexbox pour le titre */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* 4. Style final pour le titre sur l'overlay */
        .hero-carousel .carousel-caption h1 {
            font-size: clamp(2.5rem, 6vw, 4.5rem); /* Taille de police flexible et grande */
            font-weight: 800;
            color: white; /* Texte en blanc pur pour un contraste maximal */
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.4); /* Ombre portée pour encore plus de lisibilité */
            text-align: center;
        }
        /* --- Conteneur principal --- */
        .events-container { padding: 4rem 1.5rem; }
        .section-header { text-align: center; max-width: 800px; margin: 0 auto 3rem auto; }
        .section-header h2 { font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 800; }
        .section-header p { color: var(--muted-ink); font-size: 1.125rem; }

        /* --- Filtres --- */
        .filter-buttons { display: flex; justify-content: center; flex-wrap: wrap; gap: 1rem; margin-bottom: 3rem; }
        .filter-btn { background: white; border: 1px solid var(--border-color); color: var(--muted-ink); font-size: 1rem; font-weight: 600; padding: 0.7rem 1.5rem; border-radius: 30px; cursor: pointer; transition: all 0.3s ease; }
        .filter-btn:hover { background-color: var(--dsi-blue); color: white; }
        .filter-btn.active { background-color: var(--dsi-blue); color: white; box-shadow: 0 5px 15px rgba(9, 66, 129, 0.2); }

        /* --- Grille d'événements --- */
        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
            max-width: 1400px;
            margin: auto;
        }
        .event-card {
            background: white; border-radius: 16px; overflow: hidden;
            box-shadow: 0 10px 30px -15px rgba(11, 63, 122, 0.1);
            transition: transform 0.4s ease, opacity 0.4s ease, width 0.4s ease, padding 0.4s ease, margin 0.4s ease;
        }
        .event-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px -15px rgba(11, 66, 129, 0.2); }
        .event-card.hidden { transform: scale(0.8); opacity: 0; width: 0; padding: 0; margin: 0; overflow: hidden; }

        .card-media { position: relative; height: 200px; background-color: #eee; }
        .card-media img, .card-media iframe { width: 100%; height: 100%; object-fit: cover; border: none; }
        .play-icon { position: absolute; inset: 0; display: grid; place-items: center; font-size: 3rem; color: white; background: rgba(0,0,0,0.3); opacity: 0; transition: opacity 0.3s ease; pointer-events: none; }
        .event-card:hover .play-icon { opacity: 1; }

        .card-content { padding: 1.5rem; }
        .card-tag { display: inline-block; font-size: 0.8rem; font-weight: 700; padding: 0.3rem 0.8rem; border-radius: 20px; margin-bottom: 1rem; color: white; }
        .tag-afterwork { background-color: var(--dsi-green); }
        .tag-seminaire { background-color: var(--dsi-blue); }
        .tag-actualite { background-color: #f39c12; }
        
        /* Tags dynamiques pour les nouveaux types d'événements */
        .tag-conference { background-color: #e74c3c; }
        .tag-workshop { background-color: #9b59b6; }
        .tag-meetup { background-color: #3498db; }
        .tag-webinaire { background-color: #1abc9c; }
        .tag-autre { background-color: #95a5a6; }

        .card-title { font-size: 1.2rem; font-weight: 700; color: var(--ink); text-decoration: none; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 3.6rem; margin-bottom: 1rem; }
       
       
    /* --- Section Premium DSI Awards Gold Élégant --- */
        .premium-section {
            margin: 4rem 0;
            padding: 5rem 0;
            background: #ebf2fa;
            position: relative;
            overflow: hidden;
            color: black;
        }


        .premium-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(255,215,0,0.4) 1px, transparent 1px);
            background-size: 40px 40px;
            opacity: 0.15;
            animation: sparkleMove 20s linear infinite;
            pointer-events: none;
        }

        @keyframes sparkleMove {
            from { transform: translateY(0); }
            to { transform: translateY(-40px); }
        }


        .premium-content {
            max-width: 1700px;
            margin: 0 auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            position: relative;
            z-index: 1;
        }

.premium-text h2 {
    font-size: 3.8rem;
    font-weight: 900;
    background: linear-gradient(135deg, #ffd700, #fff4b0, #ffd700);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 2rem;
    letter-spacing: 1px;
    position: relative;
}

/* reflet lumineux */
.premium-text h2::after {
    content: '';
    position: absolute;
    top: 0;
    left: -60%;
    width: 50%;
    height: 100%;
    background: linear-gradient(120deg, transparent, rgba(255,255,255,0.8), transparent);
    transform: skewX(-25deg);
    animation: shine 4s infinite;
}

@keyframes shine {
    0% { left: -60%; }
    100% { left: 120%; }
}


        .premium-text .gold-accent {
            color: #ffd700;
            font-weight: 900;
            -webkit-text-fill-color: #ffd700;
        }

        .premium-text p {
            font-size: 1.2rem;
            color: #2c3e50;
            line-height: 1.8;
            margin-bottom: 1.5rem;
            font-weight: 400;
        }

.premium-image {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 30px 70px rgba(0,0,0,0.5);
    transition: 0.6s;
    border: 2px solid rgba(255,215,0,0.6);
    width: 700px;
}

.premium-image::before {
    content: '';
    position: absolute;
    inset: -2px;
    border-radius: 20px;
    background: linear-gradient(45deg, #ffd700, transparent, #ffd700);
    opacity: 0.4;
    z-index: 0;
}

.premium-image img {
    position: relative;
    z-index: 1;
}

.premium-image:hover {
    transform: translateY(-12px) scale(1.03);
    box-shadow: 0 40px 90px rgba(255,215,0,0.35);
}


.premium-btn {
    display: inline-block;
    padding: 1.3rem 3.8rem;
    background: linear-gradient(135deg, #ffd700, #fff0a0, #ffd700);
    color: #041c36;
    border-radius: 50px;
    font-weight: 800;
    font-size: 1.1rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    box-shadow: 0 15px 35px rgba(255,215,0,0.4);
    transition: 0.4s;
    position: relative;
    overflow: hidden;
}

.premium-btn:hover {
    transform: translateY(-6px) scale(1.07);
    box-shadow: 0 25px 55px rgba(255,215,0,0.6);
}


        .premium-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.6), transparent);
            transition: left 0.6s ease;
        }


        .premium-btn:hover::before {
            left: 100%;
        }

        /* --- Éléments décoratifs dorés --- */
.gold-corner {
    position: absolute;
    width: 70px;
    height: 70px;
    border: 2px solid #ffd700;
    opacity: 0.5;
    filter: drop-shadow(0 0 8px rgba(255,215,0,0.6));
}


        .gold-corner.top-left {
            top: 20px;
            left: 20px;
            border-right: none;
            border-bottom: none;
        }

        .gold-corner.top-right {
            top: 20px;
            right: 20px;
            border-left: none;
            border-bottom: none;
        }

        .gold-corner.bottom-left {
            bottom: 20px;
            left: 20px;
            border-right: none;
            border-top: none;
        }

        .gold-corner.bottom-right {
            bottom: 20px;
            right: 20px;
            border-left: none;
            border-top: none;
        }

/* ================= MOBILE VERSION GALA ================= */

@media (max-width: 768px) {

    .premium-section {
        padding: 50px 20px;
        text-align: center;
    }

    .premium-content {
        display: flex;
        flex-direction: column;   /* empile verticalement */
        align-items: center;
        gap: 25px;
    }

    /* TEXTE EN HAUT */
    .premium-text {
        order: 1;
    }

    /* IMAGE EN BAS */
    .premium-image {
        order: 2;
        width: 100%;
    
    }

    .premium-text h2 {
        font-size: 28px;
        line-height: 1.2;
        margin-bottom: 15px;
    }

    .premium-text p {
        font-size: 14px;
        line-height: 1.6;
    }

    .premium-image img {
        width: 100%;
        max-width: 420px;
        border-radius: 18px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.25); /* effet gala */
    }

    .premium-btn {
        padding: 12px 24px;
        font-size: 14px;
    }

    /* Coins dorés plus discrets */
    .gold-corner {
        width: 40px;
        height: 40px;
        opacity: 0.6;
    }

}



        /* --- Animations innovantes pour les cartes d'événements --- */
        .event-card {
            position: relative;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .event-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(9, 66, 129, 0.1) 0%, transparent 50%);
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 16px;
            pointer-events: none;
        }

        .event-card:hover::before {
            opacity: 1;
        }

        .event-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 25px 50px rgba(9, 66, 129, 0.15);
        }

        /* --- Effet de particules flottantes --- */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .floating-particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 215, 0, 0.3);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .premium-section .floating-particle:nth-child(1) { top: 20%; left: 10%; animation-delay: 0s; }
        .premium-section .floating-particle:nth-child(2) { top: 60%; left: 80%; animation-delay: 2s; }
        .premium-section .floating-particle:nth-child(3) { top: 80%; left: 20%; animation-delay: 4s; }

        /* --- Effet de brillance sur les titres --- */
        @keyframes shine {
            0% { background-position: -200% center; }
            100% { background-position: 200% center; }
        }

        .shine-effect {
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            background-size: 200% 100%;
            animation: shine 3s ease-in-out infinite;
        }

        /* --- Amélioration des filtres --- */
        .filter-buttons {
            position: relative;
            z-index: 10;
        }

        .filter-btn {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .filter-btn::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--dsi-blue);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .filter-btn.active::after {
            width: 100%;
        }

        /* --- Effet de chargement progressif --- */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .event-card {
            animation: fadeInUp 0.6s ease-out;
            animation-fill-mode: both;
        }

        .event-card:nth-child(1) { animation-delay: 0.1s; }
        .event-card:nth-child(2) { animation-delay: 0.2s; }
        .event-card:nth-child(3) { animation-delay: 0.3s; }
        .event-card:nth-child(4) { animation-delay: 0.4s; }
        .event-card:nth-child(5) { animation-delay: 0.5s; }
        .event-card:nth-child(6) { animation-delay: 0.6s; }

        /* --- Section Statistiques Innovante --- */
        .stats-section {
            padding: 4rem 0;
            position: relative;
            overflow: hidden;
        }

        .stats-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ffd700, #ffed4e, #ffd700);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .stat-card:hover::before {
            transform: scaleX(1);
        }

        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .stat-icon {
            font-size: 3rem;
            color: #ffd700;
            margin-bottom: 1rem;
            display: block;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 900;
            color: #2c3e50;
            margin-bottom: 0.5rem;
            line-height: 1;
        }

        .stat-label {
            font-size: 1rem;
            color: #6c757d;
            font-weight: 500;
        }

       
        /* --- Style Flip-Cards pour les nouveaux événements --- */
        .new-events-section {
            margin-top: 4rem;
            padding: 3rem 0;
            border-radius: 20px;
        }

        .new-events-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .new-events-header h2 {
            color: var(--dsi-blue);
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .new-events-header p {
            color: var(--muted-ink);
            font-size: 1.1rem;
        }

        .new-events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .flip-card {
            background-color: transparent;
            width: 100%;
            height: 280px;
            perspective: 1000px;
        }

        .flip-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.6s;
            transform-style: preserve-3d;
        }

        .flip-card:hover .flip-card-inner {
            transform: rotateY(180deg);
        }

        .flip-card-front, .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .flip-card-front {
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .flip-card-back {
            background: var(--dsi-white);
            color: var(--dsi-blue);
            transform: rotateY(180deg);
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .front-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.9;
        }

        .flip-card-front h3 {
            font-size: 1.3rem;
            font-weight: 600;
            margin: 0;
            line-height: 1.4;
        }

        .flip-card-back h4 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dsi-blue);
        }

        .flip-card-back p {
            color: #666;
            line-height: 1.6;
            flex-grow: 1;
            margin: 0;
        }

        .btn-close-card { 
            background: none; 
            border: none; 
            color: #999; 
            font-size: 1.5rem; 
            position: absolute; 
            top: 1rem; 
            right: 1rem; 
            cursor: pointer;
            transition: color 0.3s;
        }

        .btn-close-card:hover {
            color: var(--dsi-blue);
        }

        .event-meta {
            color: var(--dsi-blue);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            margin-top: 1rem;
        }

        .event-image {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .event-video {
            width: 100%;
            height: 120px;
            border-radius: 8px;
            background: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            margin-bottom: 1rem;
        }
    </style>

        <div id="heroCarousel"
            class="carousel slide hero-carousel carousel-fade"
            data-bs-ride="carousel"
            data-bs-interval="5000">  <!-- <<<<<<<<<<<<<<<< LA MAGIE EST ICI -->

            <!-- Indicateurs (générés dynamiquement) -->
            <div class="carousel-indicators">
                @foreach ($slides as $index => $slide)
                    <button type="button"
                            data-bs-target="#heroCarousel"
                            data-bs-slide-to="{{ $index }}"
                            class="{{ $loop->first ? 'active' : '' }}"
                            aria-current="{{ $loop->first ? 'true' : 'false' }}">
                    </button>
                @endforeach
            </div>

            <!-- Slides (générées dynamiquement) -->
            <div class="carousel-inner">
                @foreach ($slides as $slide)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <img class="w-100" src="{{ asset($slide['image']) }}" alt="{{ $slide['alt'] }}">
                        <div class="carousel-caption d-flex align-items-center justify-content-center">
                            <div class="text-center">
                                <h1>{{ $slide['title'] }}</h1>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Flèches de contrôle -->
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Précédent</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Suivant</span>
            </button>
        </div>


        <main class="events-container">
            <!-- SECTION STATISTIQUES INNOVANTE -->
            <section class="stats-section">
                <div class="stats-container">
                    <div class="stats-grid">
                        <div class="stat-card">
                            <i class="fas fa-calendar-alt stat-icon"></i>
                            <div class="stat-number">50+</div>
                            <div class="stat-label">Événements Organisés</div>
                        </div>
                        <div class="stat-card">
                            <i class="fas fa-users stat-icon"></i>
                            <div class="stat-number">1000+</div>
                            <div class="stat-label">Participants</div>
                        </div>
                        <div class="stat-card">
                            <i class="fas fa-globe stat-icon"></i>
                            <div class="stat-number">15+</div>
                            <div class="stat-label">Partenaires</div>
                        </div>
                        <div class="stat-card">
                            <i class="fas fa-trophy stat-icon"></i>
                            <div class="stat-number">100+</div>
                            <div class="stat-label">Awards Remis</div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="section-header">
                <h2>Explorez nos Événements & Actualités</h2>
                <p>Restez connecté à l'écosystème numérique. Découvrez les replays de nos afterworks, les résumés de nos séminaires et nos dernières actualités.</p>
            </div>

            <div class="filter-buttons">
                <button class="filter-btn active" data-filter="all">Tous</button>
                <button class="filter-btn" data-filter="afterwork">Afterworks</button>
                <button class="filter-btn" data-filter="seminaire">Séminaires</button>
                <button class="filter-btn" data-filter="actualite">Actualités</button>
            </div>

            <div class="events-grid">
                <!-- AFTERWORKS -->
                <div class="event-card" data-category="afterwork"><div class="card-media"><iframe src="https://www.youtube.com/embed/_zx1mprSGek" allowfullscreen></iframe><div class="play-icon"><i class="fas fa-play"></i></div></div><div class="card-content"><span class="card-tag tag-afterwork">Afterwork</span><a href="#" class="card-title">Sensibilisation à la sécurité informatique et au traitement des données personnelles</a></div><div class="card-footer">Publié il y a 2 ans</div></div>
                <div class="event-card" data-category="afterwork"><div class="card-media"><iframe src="https://www.youtube.com/embed/S92ONG8YBIY" allowfullscreen></iframe><div class="play-icon"><i class="fas fa-play"></i></div></div><div class="card-content"><span class="card-tag tag-afterwork">Afterwork</span><a href="#" class="card-title">Les villes intelligentes, enjeux et perspectives</a></div><div class="card-footer">Publié il y a 2 ans</div></div>
                <div class="event-card" data-category="afterwork"><div class="card-media"><iframe src="https://www.youtube.com/embed/HiWip0NQPPc" allowfullscreen></iframe><div class="play-icon"><i class="fas fa-play"></i></div></div><div class="card-content"><span class="card-tag tag-afterwork">Afterwork</span><a href="#" class="card-title">Modernisez votre stratégie de protection des données avec Veeam</a></div><div class="card-footer">Publié il y a 2 ans</div></div>
                <div class="event-card" data-category="afterwork"><div class="card-media"><iframe src="https://www.youtube.com/embed/ATR11u2eCM0" allowfullscreen></iframe><div class="play-icon"><i class="fas fa-play"></i></div></div><div class="card-content"><span class="card-tag tag-afterwork">Afterwork</span><a href="#" class="card-title">Plan de continuité informatique et Plan de reprise informatique (PCI/PRI)</a></div><div class="card-footer">Publié il y a 2 ans</div></div>
                <div class="event-card" data-category="afterwork"><div class="card-media"><iframe src="https://www.youtube.com/embed/m7y2Lxi47qs" allowfullscreen></iframe><div class="play-icon"><i class="fas fa-play"></i></div></div><div class="card-content"><span class="card-tag tag-afterwork">Afterwork</span><a href="#" class="card-title">Les 12 Principes de Gestion des Projets</a></div><div class="card-footer">Publié il y a 2 ans</div></div>
                <div class="event-card" data-category="afterwork"><div class="card-media"><iframe src="https://www.youtube.com/embed/0BD0vPZwKEc" allowfullscreen></iframe><div class="play-icon"><i class="fas fa-play"></i></div></div><div class="card-content"><span class="card-tag tag-afterwork">Afterwork</span><a href="#" class="card-title">Utilisation du docker en entreprise</a></div><div class="card-footer">Publié il y a 2 ans</div></div>

                <!-- SÉMINAIRES -->
                <div class="event-card" data-category="seminaire"><div class="card-media"><img src="https://clubdsibenin.bj/assets/images/dsi-get-it/get.jpg" alt="Forum Bénino Tunisien"></div><div class="card-content"><span class="card-tag tag-seminaire">Séminaire</span><a href="#" class="card-title">Forum Bénino Tunisien du numérique 2024</a></div><div class="card-footer">Lieu : Novotel Orisha</div></div>
                <div class="event-card" data-category="seminaire"><div class="card-media"><iframe src="https://www.youtube.com/embed/JhoVgVa2rmw" allowfullscreen></iframe><div class="play-icon"><i class="fas fa-play"></i></div></div><div class="card-content"><span class="card-tag tag-seminaire">Séminaire</span><a href="#" class="card-title">Présentation sur la signature numérique</a></div><div class="card-footer">Publié il y a 2 ans</div></div>
                <div class="event-card" data-category="seminaire"><div class="card-media"><iframe src="https://www.youtube.com/embed/ENo6KVGm9fI" allowfullscreen></iframe><div class="play-icon"><i class="fas fa-play"></i></div></div><div class="card-content"><span class="card-tag tag-seminaire">Séminaire</span><a href="#" class="card-title">Séminaire sur l'identité numérique</a></div><div class="card-footer">Publié il y a 2 ans</div></div>
            </div>

            <!-- SECTION NOUVEAUX ÉVÉNEMENTS AVEC STYLE FLIP-CARD -->
            @if($events->count() > 0)
                <section class="new-events-section">
                    <div class="new-events-header">
                        <h2>Nouveaux Événements</h2>
                        <p>Découvrez les derniers événements ajoutés par notre équipe</p>
                    </div>
                    
                    <!-- BOUTONS DE FILTRE POUR NOUVEAUX ÉVÉNEMENTS -->
                    <div class="filter-buttons">
                        <button class="filter-btn active" data-filter-new="all">Tous</button>
                        @foreach($events as $type => $eventsByType)
                            @if($type !== 'autre')
                                <button class="filter-btn" data-filter-new="{{ $type }}">{{ ucfirst($type) }}</button>
                            @endif
                        @endforeach
                    </div>
                    
                    <div class="events-grid" id="new-events-grid">
                        @foreach($events as $type => $eventsByType)
                            @foreach($eventsByType as $event)
                                <div class="event-card" data-category-new="{{ $type }}">
                                    <div class="card-media">
                                        @if($event->image)
                                            <img src="{{ asset($event->image) }}" alt="{{ $event->titre }}">
                                        @elseif($event->video_url)
                                            <iframe src="{{ $event->video_url }}" allowfullscreen></iframe>
                                            <div class="play-icon"><i class="fas fa-play"></i></div>
                                        @else
                                            <div style="background: linear-gradient(135deg, var(--dsi-blue) 0%, #0a539e 100%); height: 100%; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-calendar-alt fa-3x text-white"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-content">
                                        <span class="card-tag" style="background-color: {{ $event->typeEvent ? $event->typeEvent->couleur : '#95a5a6' }};">
                                            {{ $event->typeEvent ? $event->typeEvent->nom : 'Événement' }}
                                        </span>
                                        <a href="#" class="card-title">{{ $event->titre }}</a>
                                        @if($event->date)
                                            <div class="card-footer">
                                                <i class="fas fa-clock me-1"></i>
                                                {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}
                                                @if($event->location)
                                                    <br><i class="fas fa-map-marker-alt me-1"></i> {{ $event->location }}
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </section>
            @endif


                        <!-- Pagination -->
            <nav class="d-flex justify-content-center mt-5">
                <ul class="pagination">
                    <li class="page-item disabled"><a class="page-link" href="#">Précédent</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">Suivant</a></li>
                </ul>
            </nav>


                        <!-- SECTION PREMIUM DSI AWARDS -->
            <section class="premium-section">
                <div class="gold-corner top-left"></div>
                <div class="gold-corner top-right"></div>
                <div class="gold-corner bottom-left"></div>
                <div class="gold-corner bottom-right"></div>
                <div class="premium-content">
                    <div class="premium-text">
                        <h2 class="shine-effect">DSI <span class="gold-accent">AWARDS</span></h2>
                        <p>Le plus grand événement organisé par le DSI CLUB, célébrant l'excellence dans le domaine des technologies de l'information. Une soirée prestigieuse qui récompense les meilleurs projets, les innovations les plus remarquables et les talents qui transforment notre écosystème numérique.</p>
                        <p>Rejoignez-nous pour une expérience unique où innovation, réseautage et célébration se rencontrent dans une atmosphère d'excellence et d'inspiration.</p>
                        <a href="https://dsiawards.bj/" target="_blank" class="premium-btn">
                            Visiter le site
                        </a>
                    </div>
                    <div class="premium-image">
                        <img src="{{ asset('img/dsi.jpg') }}" alt="dsi awards">
                    </div>
                </div>
            </section>

        </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Filtres pour les événements existants
                const filterButtons = document.querySelectorAll('.filter-btn:not([data-filter-new])');
                const eventCards = document.querySelectorAll('.event-card:not([data-category-new])');

                filterButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        filterButtons.forEach(btn => btn.classList.remove('active'));
                        button.classList.add('active');
                        const filter = button.dataset.filter;
                        eventCards.forEach(card => {
                            card.style.transition = 'transform 0.3s ease, opacity 0.3s ease, width 0.3s ease 0.3s, padding 0.3s ease 0.3s, margin 0.3s ease 0.3s';
                            if (filter === 'all' || card.dataset.category === filter) {
                                card.classList.remove('hidden');
                            } else {
                                card.classList.add('hidden');
                            }
                        });
                    });
                });

                // Filtres pour les nouveaux événements
                const newFilterButtons = document.querySelectorAll('.filter-btn[data-filter-new]');
                const newEventCards = document.querySelectorAll('.event-card[data-category-new]');

                newFilterButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        newFilterButtons.forEach(btn => btn.classList.remove('active'));
                        button.classList.add('active');
                        const filter = button.dataset.filterNew;
                        newEventCards.forEach(card => {
                            card.style.transition = 'transform 0.3s ease, opacity 0.3s ease, width 0.3s ease 0.3s, padding 0.3s ease 0.3s, margin 0.3s ease 0.3s';
                            if (filter === 'all' || card.dataset.categoryNew === filter) {
                                card.classList.remove('hidden');
                            } else {
                                card.classList.add('hidden');
                            }
                        });
                    });
                });
            });
        </script>


@endsection
