@extends('layouts.guest')

@section('title', 'Accueil')

@section('content')

        <style>
            /* ======================================================= */
            /*      CSS FINAL POUR LA RESPONSIVITÉ DU HERO & TITRES    */
            /* ======================================================= */

            /* --- Style par défaut (Grands écrans) --- */
            #header-carousel .carousel-item {
                /* Sur grand écran, on prend une hauteur généreuse */
                height: 90vh;
                min-height: 700px; /* Hauteur de sécurité */
            }

            #header-carousel .carousel-item img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .carousel-caption {
                /* On utilise Flexbox pour un centrage vertical parfait */
                display: flex;
                align-items: center;
                justify-content: center;
                inset: 0; /* Prend toute la place */
            }

            .carousel-caption h1 {
                font-size: clamp(3rem, 6vw, 5rem); /* Taille de police flexible */
            }

            .carousel-caption .btn {
                padding: 0.9rem 2.2rem;
                font-size: 1.1rem;
                font-weight: 600;
            }

            /*** Section Title (Grands écrans) ***/
            .section-title {
                max-width: 600px;
                /* Le style du titre est déjà bon pour les grands écrans */
            }
            .section-title::before {
                position: absolute;
                content: "";
                width: 50px;
                height: 4px;
                bottom: 0;
                left: 50%;
                margin-left: -25px;
                background: var(--primary);
            }
            .section-title.text-start::before {
                left: 0;
                margin-left: 0;
            }


            /* ======================================================= */
            /*      MEDIA QUERIES : La Magie pour les Mobiles          */
            /* ======================================================= */

            /* --- Pour les Tablettes et Mobiles (en dessous de 992px) --- */
            @media (max-width: 991.98px) {
                #header-carousel .carousel-item {
                    height: 65vh; /* On réduit un peu la hauteur */
                    min-height: 600px;
                }

                #header-carousel .carousel-item img {
                    height: 45vh; /* On réduit un peu la hauteur */
                }

                .carousel-caption h1 {
                    font-size: clamp(2.5rem, 8vw, 3.5rem); /* Le titre peut être un peu plus gros proportionnellement */
                }
            }


            /* --- Uniquement pour les Mobiles (en dessous de 768px) --- */
            @media (max-width: 767.98px) {
                #header-carousel .carousel-item {
                    height: 50vh; /* Hauteur beaucoup plus petite pour laisser voir la suite */
                    min-height: 500px;
                }

                
                #header-carousel .carousel-item img {
                    height: 40vh; /* On réduit un peu la hauteur */
                }

                .carousel-caption h1 {
                    font-size: 2rem; /* Taille de titre bien adaptée au mobile */
                    margin-bottom: 1.5rem !important; /* On force un peu d'espace sous le titre */
                }

                .carousel-caption .btn {
                    padding: 0.7rem 1.5rem; /* Boutons légèrement plus petits */
                    font-size: 0.95rem;
                }

                /* On cache le sous-titre du carrousel s'il prend trop de place */
                .carousel-caption h5 {
                    display: none;
                }

                /* On adapte les titres de section */
                .section-title h1, .section-title h2 {
                    font-size: 1.8rem !important;
                }
            }
        </style>

    <!-- ======================================================= -->
    <!--       BLOC POUR AFFICHER LE MESSAGE DE SUCCÈS         -->
    <!-- ======================================================= -->
    @if (session('success'))
        <div class="container" style="margin-top: -50px; position: relative; z-index: 10;">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    <!-- ======================================================= -->

        <!-- ======================================================= -->
        <!--     ACTE I : LE HÉROS FUSIONNÉ                          -->
        <!-- ======================================================= -->
    <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="https://clubdsibenin.bj/storage/slide/uTBV6OVA0CUTIhlq.png" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h5 class="text-white text-uppercase mb-3 animated slideInDown">Club DSI Bénin</h5>
                        <h1 class="display-1 text-white mb-4 animated zoomIn">Le Cœur du Numérique au Bénin</h1>
                        <a href="register.blade.php" class="btn btn-primary me-3 animated slideInLeft">Rejoindre le mouvement</a>
                        <a href="#ecosysteme" class="btn btn-light animated slideInRight">Explorer nos services</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="https://clubdsibenin.bj/storage/slide/IqrKwcfz5j7fdENU.png" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h5 class="text-white text-uppercase mb-3 animated slideInDown">Innovation & Collaboration</h5>
                        <h1 class="display-1 text-white mb-4 animated zoomIn">Construisons l'Écosystème de Demain</h1>
                        <a href="register.blade.php" class="btn btn-primary me-3 animated slideInLeft">Devenir membre</a>
                        <a href="#activites" class="btn btn-light animated slideInRight">Nos activités</a>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"><span class="carousel-control-prev-icon" aria-hidden="true"></span></button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"><span class="carousel-control-next-icon" aria-hidden="true"></span></button>
    </div>

        <!-- ======================================================= -->
        <!--     ACTE II : NOS MAQUETTES INTÉGRÉES                 -->
        <!-- ======================================================= -->

        <!-- ======================================================= -->
        <!--  NOUVELLE SECTION "MOT DU PRÉSIDENT" AVEC ANIMATION "SUPER" -->
        <!-- ======================================================= -->
        <div class="container-fluid py-3 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container py-3">
                <div class="row g-5">

                    <!-- MODIFICATION 1 : On ajoute l'animation "slideInLeft" pour le bloc de gauche -->
                    <div class="col-lg-7 wow slideInLeft" data-wow-delay="0.3s">
                        <div class="section-title position-relative pb-3 mb-5">
                            <h5 class="fw-bold text-primary text-uppercase">Le Mot du Président</h5>
                            <h1 class="mb-0">Ensemble, construisons l’avenir numérique du Bénin.</h1>
                        </div>

                        <div id="presidentWordContent">
                            <p class="mb-4">Chers Décideurs, Cher(e)s adhérents, c’est avec un immense honneur que j’assume aujourd’hui la présidence du Club des Décideurs des Systèmes d’Information du Bénin (Club DSI). En tant que nouvelle figure à la tête de notre association, je suis profondément engagé à poursuivre et à renforcer notre mission collective...</p>

                            <div class="collapse" id="presidentMoreText">
                                <p>Notre association réunit des experts de premier plan issus des secteurs public et privé, formant ainsi un réseau dynamique et diversifié. Cette richesse d'expertise est un atout majeur pour relever les défis numériques de notre époque et saisir les opportunités qu’elle offre.</p>
                                <p>Pour ce mandat, nous avons fixé des objectifs ambitieux qui guideront nos actions :</p>
                                <ul>
                                    <li><strong>Redynamiser</strong> les fondements et les bases de notre association ;</li>
                                    <li><strong>Valoriser la fonction DSI</strong> dans l’administration et dans l’entreprise ;</li>
                                    <li><strong>Elargir le cercle des membres</strong> pour enrichir notre réseau et nos échanges ;</li>
                                    <li><strong>Étendre les DSI Awards à une portée internationale</strong> ;</li>
                                    <li><strong>Dynamiser nos commissions</strong> de production intellectuelle ;</li>
                                    <li>Faire de notre association un <strong>acteur majeur de l'écosystème</strong> ;</li>
                                    <li><strong>Élargir notre catalogue</strong> de formations et d’afterworks ;</li>
                                    <li><strong>Renforcer l’impact</strong> du D-Magazine ;</li>
                                    <li><strong>Renforcer notre réseau</strong> de partenariats stratégiques.</li>
                                </ul>
                                <p>Ces objectifs reflètent notre engagement à faire du Club DSI un acteur incontournable de la transformation numérique. [...] Comme le dit le proverbe africain : « Les grands arbres ne poussent pas sans racines profondes ».</p>
                                <p class="mt-4">
                                    <strong>Fabrice G. DAKO</strong><br>
                                    <small>Président du Club DSI Bénin</small>
                                </p>
                            </div>
                        </div>

                        <button id="presidentReadMoreBtn"
                                class="btn "
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#presidentMoreText"
                                aria-expanded="false"
                                aria-controls="presidentMoreText"
                                style="            background: linear-gradient(95deg, var(--dsi-blue), var(--dsi-green));
                                    color: white;
                                    font-weight: 700;
                                    padding: 0.9rem 2rem;
                                    border-radius: 10px;
                                    text-decoration: none;
                                    transition: all 0.3s ease;">
                                Lire la Suite
                        </button>

                    </div>

                    <!-- MODIFICATION 2 : On remplace "zoomIn" pour l'image pour un meilleur effet -->
                    <div class="col-lg-5 wow zoomIn" data-wow-delay="0.6s" style="min-height: 500px;">
                        <div class="position-relative h-100">
                            <img class="position-absolute w-100 h-100 rounded" src="https://clubdsibenin.bj/storage/member_of_office_president/rNgwG5cHZeMTRjoX.jpg" style="object-fit: cover; object-position: center top;">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Mot du Président End -->

    <!-- ======================================================= -->
    <!--       SECTION "ACTIVITÉS" AMÉLIORÉE (À COPIER/COLLER)   -->
    <!-- ======================================================= -->
        <!-- Activités Start -->
            <div id="activites" class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="container py-5">
                    <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                        <h5 class="fw-bold text-primary text-uppercase">Nos Activités</h5>
                        <h1 class="mb-0">Du partage d'expertise au networking de haut niveau</h1>
                    </div>
                    <div class="row g-5">
                        <!-- CARTE 1: SÉMINAIRES -->
                        <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.3s">
                            <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center bg-white h-100">
                                <div class="service-icon" style="background-color:#123c7c;" >
                                    <i class="fa fa-chalkboard-teacher text-white"></i>
                                </div>
                                <h4 class="mb-3"> Formations</h4>
                                <p class="m-0">Approfondissez vos connaissances sur des sujets de pointe (IA, Cloud, Gouvernance) avec les meilleurs experts du secteur.</p>
                                <a class="btn btn-lg btn-primary rounded" href="{{ route('activites.formations') }}" style="background-color:#0a2b5c;">
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>

                        <!-- CARTE 2: AFTERWORKS -->
                        <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.6s">
                            <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center bg-white h-100">
                                <div class="service-icon" style="background-color:#123c7c;">
                                    <i class="fa fa-comments text-white" ></i>
                                </div>
                                <h4 class="mb-3">Séminaires & Afterworks</h4>
                                <p class="m-0">Échangez avec vos pairs dans un cadre convivial et développez votre réseau professionnel lors de nos rencontres mensuelles.</p>
                                <a class="btn btn-lg btn-primary rounded" href="{{ route('activites.evenements') }}" style="background-color:#0a2b5c;">
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>

                        <!-- CARTE 3 "STAR": DSI AWARDS -->
                        <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.9s">
                            <div class="position-relative bg-primary rounded h-100 d-flex flex-column align-items-center justify-content-center text-center p-5"
                                style="background-image: linear-gradient(rgba(9, 66, 129, 0.9), rgba(9, 66, 129, 0.9)), url('https://images.unsplash.com/photo-1579548122204-7b8b835b7161?w=800'); background-size: cover;">
                                <i class="fa fa-trophy fa-3x text-white mb-3" style="color: var(--dsi-gold) !important;"></i>
                                <h3 class="text-white mb-3">DSI AWARDS</h3>
                                <p class="text-white mb-3">L'événement annuel qui célèbre et récompense les projets et les leaders de la transformation numérique au Bénin.</p>
                                <a href="https://dsiawards.bj/" class="btn btn-light py-2 px-4">Découvrir l'édition</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Activités End -->


    <!-- SECTION ÉCOSYSTÈME CARRIÈRES & ESN (Notre maquette) -->
        <div id="ecosysteme"class="container-fluid py-3 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container py-3">
                <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                    <h5 class="fw-bold text-primary text-uppercase">Nos Plateformes</h5>
                    <h1 class="mb-0">Au cœur de l'écosystème numérique</h1>
                </div>
                <div class="row g-5 align-items-stretch">
                    <div class="col-lg-6"><div class="p-5 rounded-4 h-100 card-hover" style="background: linear-gradient(135deg, #eef7ff, #ffffff);"><i class="fa-solid fa-briefcase fa-3x  mb-3" style="color:#0a2b5c;"></i><h3 class="fw-bold">Plateforme carrières professionnelle intelligente</h3><p class="text-muted">Plus qu'une liste d'offres, un véritable outil pour une expérience professionnelle.</p><ul class="feature-list mt-3"><li><i class="fa-solid fa-check-circle text-blue-dark me-2"></i>Matching automatisé par IA</li><li><i class="fa-solid fa-check-circle text-blue-dark me-2"></i>Alertes d'offres personnalisées</li><li><i class="fa-solid fa-check-circle text-blue-dark me-2"></i>Statistiques du marché en temps réel</li></ul><a href="{{ route('recrutement') }}" class="btn btn-primary mt-3" style="background-color:#0a2b5c;">Explorer les offres</a></div></div>
                    <div class="col-lg-6"><div class="p-5 rounded-4 h-100 card-hover" style="background: linear-gradient(135deg, #f0fff4, #ffffff);"><i class="fa-solid fa-handshake-angle fa-3x text-success mb-3"></i><h3 class="fw-bold">Annuaire dynamique des ESN</h3><p class="text-muted">Trouvez le partenaire idéal pour la réussite de vos projets numériques.</p><ul class="feature-list mt-3"><li><i class="fa-solid fa-check-circle text-success me-2"></i>Recherche avancée par compétences</li><li><i class="fa-solid fa-check-circle text-success me-2"></i>Mise en relation directe</li><li><i class="fa-solid fa-check-circle text-success me-2"></i>Accès à la communauté de pratique</li></ul><a href="{{ route('esn') }}" class="btn btn-success mt-3">Trouver un partenaire ESN</a></div></div>
                </div>
            </div>
        </div>

    {{-- SECTION GESTION DES COMPÉTENCES (Version sobre) --}}
    <style>
        :root {
            --dsi-blue: #0b3f7a;
            --dsi-green: #29963a;
            --light-bg: #f4f7fc;
            --ink: #0e1a2b;
            --muted-ink: #5c6b81;
            --border-color: #e5eaf2;
        }

        /* SECTION PRINCIPALE */
        .skills-platform-section {
            background: var(--light-bg);
            padding: clamp(3rem, 5vw, 5rem) 1.5rem;
            overflow: hidden;
            position: relative;
        }

        /* Lignes décoratives légères */
        .skills-platform-section::before,
        .skills-platform-section::after {
            content: "";
            position: absolute;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(41,150,58,0.12) 0%, transparent 70%);
            z-index: 0;
        }
        .skills-platform-section::before {
            top: -40px;
            left: -40px;
        }
        .skills-platform-section::after {
            bottom: -40px;
            right: -40px;
        }

        .skills-platform-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: clamp(2rem, 5vw, 4rem);
            align-items: center;
            position: relative;
            z-index: 1;
        }

        @media (max-width: 992px) {
            .skills-platform-container { grid-template-columns: 1fr; text-align: center; }
        }

        /* PARTIE GAUCHE */
        .skills-info {
            animation: fadeSlide 1.3s ease forwards;
            opacity: 0;
            transform: translateY(25px);
        }

        .skills-info .eyebrow {
            color: var(--dsi-green);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .skills-info h2 {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 800;
            color: var(--ink);
            margin: 0.75rem 0 1.2rem 0;
        }

        .skills-info p {
            color: var(--muted-ink);
            line-height: 1.7;
            font-size: 1.05rem;
            margin-bottom: 2rem;
            max-width: 520px;
        }

        .skills-info .btn {
            background: linear-gradient(95deg, var(--dsi-blue), var(--dsi-green));
            color: white;
            font-weight: 700;
            padding: 0.9rem 2rem;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .skills-info .btn:hover {
            opacity: 0.9;
            transform: translateY(-3px);
        }

        /* FONCTIONNALITÉS */
        .features-grid {
            display: grid;
            gap: 1.5rem;
        }

        .feature-card {
            background: white;
            border-radius: 14px;
            padding: 1.5rem;
            display: flex;
            align-items: flex-start;
            gap: 1.25rem;
            border: 1px solid var(--border-color);
            box-shadow: 0 5px 15px -5px rgba(11, 63, 122, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: fadeSlide 1s ease forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .feature-card:nth-child(1) { animation-delay: 0.3s; }
        .feature-card:nth-child(2) { animation-delay: 0.5s; }
        .feature-card:nth-child(3) { animation-delay: 0.7s; }
        .feature-card:nth-child(4) { animation-delay: 0.9s; }
        .feature-card:nth-child(5) { animation-delay: 1.1s; }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px -10px rgba(11, 63, 122, 0.15);
        }

        .feature-icon {
            flex-shrink: 0;
            width: 50px; height: 50px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--dsi-blue), var(--dsi-green));
            display: grid;
            place-items: center;
            color: white;
            font-size: 1.3rem;
        }

        .feature-card h4 {
            margin: 0;
            font-weight: 700;
            color: var(--ink);
        }

        .feature-card p {
            margin: 0.3rem 0 0;
            color: var(--muted-ink);
            font-size: 0.9rem;
        }

        @keyframes fadeSlide {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

<section class="skills-platform-section">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 650px;">
                <h5 class="fw-bold text-primary text-uppercase">Plateforme de gestion des compétences</h5>
                <h1 class="mb-0">Valoriser les talents, connecter les opportunités</h1>
            </div>

            <div class="skills-platform-container">
                <!-- Partie gauche -->
                <div class="skills-info">
                    <p class="eyebrow">Club DSI Bénin</p>
                    <h2>Une plateforme pour révéler les talents du numérique</h2>
                    <p>
                        Cet espace digital permet de <strong>centraliser les profils d’experts</strong>,
                        <strong>favoriser les opportunités professionnelles</strong>
                        et <strong>renforcer les partenariats</strong> entre les acteurs publics, privés et les DSI membres.
                    </p>
                    <a href="{{ route('competences.comingsoon') }}" class="btn">
                        <i class="fas fa-user-plus me-2"></i> Rejoindre la plateforme
                    </a>
                </div>

                <!-- Partie droite -->
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-database"></i></div>
                        <div>
                            <h4>Centralisation des profils</h4>
                            <p>Une base regroupant CV, diplômes, certificats et expériences des experts membres.</p>
                        </div>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-search"></i></div>
                        <div>
                            <h4>Recherche ciblée</h4>
                            <p>Les entreprises et institutions peuvent filtrer les profils selon des critères précis.</p>
                        </div>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                        <div>
                            <h4>Traçabilité & sécurité</h4>
                            <p>Chaque mise en relation est enregistrée pour garantir transparence et confiance.</p>
                        </div>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-coins"></i></div>
                        <div>
                            <h4>Revenus pour le Club</h4>
                            <p>Abonnements et commissions sur les mises en relation réussies renforcent la pérennité du modèle.</p>
                        </div>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-globe-africa"></i></div>
                        <div>
                            <h4>Rayonnement international</h4>
                            <p>La plateforme valorise l’expertise béninoise sur les marchés régionaux et mondiaux.</p>
                        </div>
                    </div>
                </div>
            </div>
</section>


    <!-- SECTION FORMATIONS -->
    <section id="training" class="section ">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Se Former pour Performer</h5>
                <h1 class="mb-0">Des compétences à jour, pour un avenir connecté</h1>
            </div>
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 order-lg-2"><h2 class="section-title">Développez vos compétences</h2><p class="section-subtitle">Accédez à des formations actuelles : Services IT, Gestion de Projet et Sécurité.</p><div class="d-flex flex-wrap gap-2 mb-4"><span class="badge rounded-pill fs-6 text-dark-emphasis bg-dark-subtle border border-dark-subtle" style="color: black;">Gouvernance & Architecture d'Entreprise</span><span class="badge rounded-pill fs-6 text-dark-emphasis bg-dark-subtle border border-dark-subtle" style="color: black;">Gestions des Services IT</span><span class="badge rounded-pill fs-6 text-dark-emphasis bg-dark-subtle border border-dark-subtle" style="color: black;">Gestion de Projet et Programme</span><span class="badge rounded-pill fs-6 text-dark-emphasis bg-dark-subtle border border-dark-subtle" style="color: black;">Sécurité Défensive</span></div><a href="{{ route('activites.formations') }}" class="btn " style="            background: linear-gradient(95deg, var(--dsi-blue), var(--dsi-green));
            color: white;
            font-weight: 700;
            padding: 0.9rem 2rem;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.3s ease;">Voir le catalogue</a></div>
                <div class="col-lg-6 order-lg-1"><img class="rounded-4 w-100" style="box-shadow: var(--shadow-lg);" alt="Session de formation" src="{{ asset('img/img.jpg') }}" /></div>
            </div>
        </div>
    </section>

    <!-- SECTION NEXUSDSI HUB (Version sobre sans animation de fond) -->
    <style>
        :root {
            --dsi-blue: #0b3f7a;
            --dsi-green: #29963a;
            --ink: #0e1a2b;
            --muted: #5c6b81;
            --bg: #f4f7fc;
        }

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            overflow-x: hidden;
            background-color: var(--bg);
        }

        /* SECTION PRINCIPALE */
        .forum-section {
            position: relative;
            padding: clamp(2rem, 6vw, 5rem) 1.5rem;
            background: var(--bg);
            overflow: hidden;
        }

        .section-title-wrapper {
            text-align: center;
            margin-bottom: clamp(2rem, 3vw, 2rem);
            position: relative;
            z-index: 1;
            transform: translateY(20px);
            opacity: 0;
            animation: slideUpFade 0.8s 0.1s ease-out forwards;
        }

        .section-title-wrapper .eyebrow {
            font-size: .9rem;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--dsi-green);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .section-title-wrapper h2 {
            margin: 0;
            font-size: clamp(2.2rem, 4.5vw, 3.2rem);
            line-height: 1.2;
            font-weight: 800;
            color: var(--ink);
            max-width: 800px;
            margin-inline: auto;
        }

        /* CONTENU PRINCIPAL */
        .forum-wrap {
            position: relative;
            z-index: 1;
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            align-items: center;
            gap: clamp(2rem, 6vw, 5rem);
        }

        @media (max-width: 992px) {
            .forum-wrap {
                grid-template-columns: 1fr;
                text-align: center;
            }
        }

        .forum-presentation {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            text-align: left;
            transform: translateX(-30px);
            opacity: 0;
            animation: slideInFade 1s 0.4s ease-out forwards;
        }

        .forum-eyebrow {
            font-size: .85rem;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--dsi-green);
            font-weight: 700;
            margin-bottom: .3rem;
        }

        .forum-title {
            font-size: clamp(2.5rem, 5vw, 3.8rem);
            font-weight: 800;
            background: linear-gradient(95deg, var(--dsi-blue), var(--dsi-green));
            -webkit-background-clip: text;
            color: transparent;
            margin: 0;
        }

        .forum-subtitle {
            margin: 1rem 0 0;
            color: var(--muted);
            font-size: clamp(1rem, 2vw, 1.25rem);
            max-width: 480px;
        }

        /* POINTS / FONCTIONNALITÉS */
        .forum-points {
            display: grid;
            gap: 1.5rem;
            grid-template-columns: 1fr 1fr;
            padding: 0;
            list-style: none;
        }

        @media (max-width: 600px) {
            .forum-points {
                grid-template-columns: 1fr;
            }
        }

        .point {
            border-radius: 16px;
            padding: 1.5rem;
            text-align: left;
            background: white;
            border: 1px solid #e0e6f1;
            box-shadow: 0 8px 25px -10px rgba(11, 63, 122, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            transform: translateY(20px);
            opacity: 0;
            animation: fadeUp 0.8s ease forwards;
        }

        .point:nth-child(1) { animation-delay: 0.3s; }
        .point:nth-child(2) { animation-delay: 0.5s; }
        .point:nth-child(3) { animation-delay: 0.7s; }
        .point:nth-child(4) { animation-delay: 0.9s; }

        .point:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px -10px rgba(11, 63, 122, 0.2);
        }

        .point-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 0.75rem;
        }

        .icon {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, var(--dsi-blue), var(--dsi-green));
            color: white;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .point h3 {
            margin: 0;
            color: var(--ink);
            font-size: 1.15rem;
            font-weight: 700;
        }

        .point p {
            margin: 0;
            color: var(--muted);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* CTA */
        .forum-cta {
            margin-top: 2rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.9rem 1.8rem;
            border-radius: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
        }

        .btn.primary {
            background: linear-gradient(95deg, var(--dsi-blue), var(--dsi-green));
            color: white;
        }

        .btn.primary:hover {
            transform: translateY(-3px);
            opacity: 0.9;
        }

        /* ANIMATIONS DOUCES */
        @keyframes slideUpFade {
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes slideInFade {
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes fadeUp {
            to { transform: translateY(0); opacity: 1; }
        }
    </style>

    <section class="forum-section">
        <div class="section-title-wrapper">
            <p class="eyebrow">Notre Espace d'Échange</p>
            <h2>Au cœur de l'intelligence collective</h2>
        </div>

        <div class="forum-wrap">
            <!-- Colonne gauche -->
            <div class="forum-presentation">
                <p class="forum-eyebrow">CLUB DSI BÉNIN</p>
                <h3 class="forum-title">NexusDSI Hub</h3>
                <p class="forum-subtitle">
                    Une interface moderne et intuitive pour la veille, l'entraide et le networking.
                    Recevez des notifications personnalisées et ne manquez aucune opportunité de collaboration.
                </p>
                <div class="forum-cta">
                    <a class="btn primary" href="{{ route('nexusdsi.coming-soon') }}">Aller sur NexusDSI Hub</a>
                </div>
            </div>

            <!-- Colonne droite -->
            <ul class="forum-points">
                <li class="point">
                    <div class="point-header">
                        <div class="icon">🏆</div><h3>Valorisation</h3>
                    </div>
                    <p>Gagnez des points et badges pour vos contributions et devenez un pilier de la communauté.</p>
                </li>

                <li class="point">
                    <div class="point-header">
                        <div class="icon">🔍</div><h3>Recherche avancée</h3>
                    </div>
                    <p>Retrouvez instantanément discussions, ressources et documents grâce à un moteur intelligent.</p>
                </li>

                <li class="point">
                    <div class="point-header">
                        <div class="icon">🎯</div><h3>Sous-groupes thématiques</h3>
                    </div>
                    <p>Rejoignez des cercles spécialisés : Cybersécurité, IA, Cloud, Gouvernance, et bien plus.</p>
                </li>

                <li class="point">
                    <div class="point-header">
                        <div class="icon">🤝</div><h3>Entraide & Expertise</h3>
                    </div>
                    <p>Posez vos questions, partagez vos défis et bénéficiez de l’expérience collective du réseau.</p>
                </li>
            </ul>
        </div>
    </section>


    <!-- SECTION CTA FINALE (Notre maquette) -->
    <style>
            :root {
                --dsi-blue: #0b3f7a;
                --dsi-green: #29963a;
                --dsi-blue-dark: #0a2b5c;
                --dsi-gold: #ffc107;
            }

            .cta-section-v2 {
                position: relative;
                padding: clamp(2rem, 4vh, 2rem) 1rem;
                background-color: #0b3f7a;
                color: white !important;
                text-align: center;
                overflow: hidden;
            }

            #cta-particles-js {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 0;
            }

            .cta-content {
                position: relative;
                z-index: 1;
                max-width: 800px;
                margin: 0 auto;
            }

            .cta-content h2 {
                font-family: 'Rubik', sans-serif; /* Pour correspondre au thème */
                font-size: clamp(2.5rem, 4vw, 2.5rem);
                color: #fff;
                font-weight: 800;
                margin-bottom: 1rem;
                opacity: 0;
                transform: translateY(20px);
                animation: slideUpFade 0.8s 0.2s ease-out forwards;
            }

            .cta-content .lead {
                font-size: clamp(1rem, 1vw, 1rem);
                opacity: 0.8;
                margin-bottom: 1rem;
                opacity: 0;
                transform: translateY(20px);
                animation: slideUpFade 0.8s 0.4s ease-out forwards;
            }

            .benefits-list {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                gap: 2rem;
                margin-bottom: 1.5rem;
                list-style: none;
                padding: 0;
            }

            .benefit-item {
                font-size: 1.1rem;
                font-weight: 500;
                opacity: 0;
                transform: translateY(20px);
                animation: slideUpFade 0.7s ease-out forwards;
            }
            /* Animation en cascade pour les bénéfices */
            .benefit-item:nth-child(1) { animation-delay: 0.6s; }
            .benefit-item:nth-child(2) { animation-delay: 0.8s; }
            .benefit-item:nth-child(3) { animation-delay: 1.0s; }

            .benefit-item .fa-check-circle {
                color: var(--dsi-green);
                margin-right: 0.5rem;
            }

            .btn-cta-final {
                background-color: var(--dsi-gold);
                color: var(--dsi-blue-dark);
                border-color: var(--dsi-gold);
                font-weight: 700;
                font-size: 1.2rem;
                padding: 1rem;
                border-radius: 12px;
                text-decoration: none;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                display: inline-block;
                opacity: 0;
                transform: translateY(20px);
                animation: slideUpFade 0.8s 1.2s ease-out forwards, pulse 2s infinite 2s;
            }

            .btn-cta-final:hover {
                transform: translateY(-5px);
                box-shadow: 0 15px 30px -5px rgba(255, 193, 7, 0.4);
                animation-play-state: paused; /* Arrête la pulsation au survol */
            }

            @keyframes slideUpFade {
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            @keyframes pulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.05); }
                100% { transform: scale(1); }
            }
    </style>
    <section class="cta-section-v2">
        <div id="cta-particles-js"></div>
        <div class="cta-content">
            <h2>Prêt à transformer le numérique ?</h2>
            <p class="lead">Rejoignez le réseau des leaders, accédez à des ressources exclusives et participez activement à l'essor technologique du Bénin.</p>

            <ul class="benefits-list">
                <li class="benefit-item"><i class="fas fa-check-circle"></i> Réseau d'experts de haut niveau</li>
                <li class="benefit-item"><i class="fas fa-check-circle"></i> Paiement en ligne sécurisé</li>
                <li class="benefit-item"><i class="fas fa-check-circle"></i> Ressources & opportunités exclusives</li>
            </ul>

            <a href="{{ route('register') }}" class="btn-cta-final">Adhérer maintenant</a>
        </div>
    </section>

    <!-- Script pour l'animation du Plexus -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

    <script>
        // Mettre à jour le texte du bouton selon l'état du collapse
        document.addEventListener('DOMContentLoaded', function () {
            var presCollapse = document.getElementById('presidentMoreText');
            var btn = document.getElementById('presidentReadMoreBtn');
            if (presCollapse && btn && typeof bootstrap !== 'undefined') {
                presCollapse.addEventListener('show.bs.collapse', function () {
                    btn.textContent = 'Réduire';
                    btn.setAttribute('aria-expanded', 'true');
                });
                presCollapse.addEventListener('hide.bs.collapse', function () {
                    btn.textContent = 'Lire la Suite';
                    btn.setAttribute('aria-expanded', 'false');
                });
            }
        });
    </script>

@endsection


