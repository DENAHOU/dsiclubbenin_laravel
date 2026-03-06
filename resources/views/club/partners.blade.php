@extends('layouts.guest')

@section('title', 'Nos Partenaires')


@section('content')


    <style>
        :root {
            --dsi-blue: #094281;
            --dsi-green: #29963a;
            --light-bg: #f4f7fc;
            --ink: #0e1a2b;
            --muted-ink: #5c6b81;
            --border-color: #e5eaf2;
            --shadow-light: 0 10px 30px rgba(0, 0, 0, 0.08);
            --shadow-medium: 0 20px 40px rgba(0, 0, 0, 0.12);
            --shadow-dark: 0 30px 60px rgba(0, 0, 0, 0.15);
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: white;
            color: var(--ink);
            margin: 0;
            overflow-x: hidden;
            scroll-behavior: smooth; /* Pour le smooth scroll vers les ancres */
        }
        .animated-section { opacity: 0; transform: translateY(50px); transition: opacity 0.8s ease-out, transform 0.8s ease-out; }
        .animated-section.is-visible { opacity: 1; transform: translateY(0); }

        /* --- Héros --- */
        .hero-partners {
            position: relative;
            height: 100vh;
            display: grid;
            place-items: center;
            text-align: center;
            color: white;
            overflow: hidden;
        }

        .hero-partners::before {
            content: '';
            position: absolute;
            inset: 0;
            z-index: 0;
            background-image: url("{{ asset('img/IMG_1929.jpg') }}"); /* Assurez-vous que le chemin est correct */
            background-size: cover;
            background-position: center;
            animation: ken-burns-zoom-out 25s ease-out infinite alternate; /* Ajout de 'alternate' pour un cycle plus doux */
        }
        .hero-partners::after {
            content: '';
            position: absolute;
            inset: 0;
            z-index: 1;
            background: rgba(2, 26, 51, 0.644); /* Fond dsi-blue pour plus de profondeur */
        }

        .hero-content {
            position: relative;
            z-index: 2;
            padding: 1.5rem;
            max-width: 900px; /* Limiter la largeur du contenu */
        }

        .animated-hero-title {
            font-size: clamp(1.5rem, 4vw, 3rem); /* Légèrement plus grand */
            font-weight: 900; /* Plus de poids */
            color: #fff;
            opacity: 0;
            transform: translateY(30px);
            animation: slideUpFadeIn 1s 0.5s ease-out forwards;
            letter-spacing: -0.05em; /* Rapprochement des lettres pour le titre */
        }

        .animated-hero-subtitle {
            font-size: clamp(0.5rem, 1.5vw, 1rem); /* Légèrement plus grand */
            max-width: 700px;
            margin: 1.5rem auto 2.5rem auto; /* Plus d'espace */
            opacity: 0.9;
            opacity: 0;
            transform: translateY(30px);
            animation: slideUpFadeIn 1s 0.8s ease-out forwards;
        }

        .hero-cta-button {
            display: inline-block;
            background: #fff;
            color: var(--dsi-blue);
            padding: 1rem 2.5rem;
            border-radius: 50px; /* Bouton arrondi */
            text-decoration: none;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            opacity: 0;
            transform: translateY(30px);
            animation: slideUpFadeIn 1s 1.1s ease-out forwards;
            box-shadow: var(--shadow-medium);
        }
        .hero-cta-button:hover {
            background: var(--dsi-green);
            color: white;
            box-shadow: var(--shadow-dark);
            transform: translateY(-5px);
        }

        /* --- Définition des animations --- */
        @keyframes ken-burns-zoom-out {
            0% { transform: scale(1.1) translateX(-5%); } /* Début légèrement décalé et zoomé */
            100% { transform: scale(1) translateX(0%); } /* Fin au centre */
        }

        @keyframes slideUpFadeIn {
            to { opacity: 1; transform: translateY(0); }
        }

        /* --- Section Titre --- */
        .section-header { text-align: center; padding: 6rem 1.5rem 4rem 1.5rem; } /* Plus de padding */
        .section-header h2 {
            font-size: clamp(2.2rem, 4.5vw, 3.2rem); /* Plus grand */
            font-weight: 900; /* Plus de poids */
            color: var(--ink);
            margin-bottom: 0.75rem;
            position: relative;
            display: inline-block; /* Pour centrer la ligne */
        }
        .section-header h2::after {
            content: "";
            display: block;
            width: 80px; /* Ligne plus longue */
            height: 5px; /* Ligne plus épaisse */
            background: linear-gradient(to right, var(--dsi-blue), var(--dsi-green)); /* Dégradé */
            margin: 15px auto 0 auto;
            border-radius: 10px;
        }
        .section-header p {
            color: var(--muted-ink);
            max-width: 700px;
            margin: 1.5rem auto 0 auto; /* Plus d'espace */
            font-size: 1.15rem;
            line-height: 1.7;
        }

        /* --- Grille des Partenaires - Version Magnifique --- */
        .partners-category-section {
            background-color: white;
            padding: 5rem 1.5rem; /* Plus de padding */
        }
        .partners-category-section:nth-of-type(odd) { /* Pour alterner les couleurs de fond si besoin */
            background-color: var(--light-bg);
        }

        .category-header { text-align: center; margin-bottom: 4rem; }
        .category-header h3 {
            font-size: clamp(1.8rem, 3.5vw, 2.5rem);
            font-weight: 800;
            color: var(--dsi-blue);
            margin-bottom: 0.5rem;
        }
        .category-header h4 {
            font-size: clamp(1rem, 2vw, 1.2rem);
            color: var(--muted-ink);
            max-width: 600px;
            margin: 0.75rem auto 0 auto;
        }

        /* Styles spécifiques pour chaque type de partenaire */

        /* --- Institutions : Logos Géants et Carrousel --- */
        .institutions-carousel-wrapper {
            max-width: 1400px;
            margin: 0 auto;
            /* Si vous utilisez un carrousel JS/CSS, ces styles seront adaptés */
            /* Pour une grille simple mais grandiose : */
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); /* Logos plus grands */
            gap: 2.5rem; /* Plus d'espace */
            justify-items: center;
            align-items: center;
        }

        .institution-card {
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow-light); /* Ombre douce */
            padding: 2.5rem; /* Plus de padding interne */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: all 0.4s ease;
            height: 250px; /* Hauteur fixe pour un bel alignement */
            width: 100%;
            max-width: 350px; /* Limiter la largeur de la carte */
            text-align: center;
            position: relative;
            overflow: hidden; /* Pour l'effet de bordure animée */
        }

        .institution-card::before { /* Bordure animée */
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 20px;
            padding: 4px; /* Épaisseur de la bordure */
            background: linear-gradient(45deg, var(--dsi-blue), var(--dsi-green), var(--dsi-blue));
            -webkit-mask:
                linear-gradient(#fff 0 0) content-box,
                linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .institution-card:hover::before {
            opacity: 1;
        }

        .institution-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: var(--shadow-dark);
        }

        .institution-card img {
            max-width: 80%; /* Logo très grand */
            max-height: 120px; /* Hauteur max du logo */
            object-fit: contain;
            filter: grayscale(0%); /* Enlever le grayscale si présent */
            opacity: 1; /* Enlever l'opacité si présent */
            margin-bottom: 1.5rem;
        }

        .institution-card .partner-name {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--ink);
            line-height: 1.3;
        }
        .institution-card .partner-link {
            position: absolute; /* Positionner le lien au-dessus de tout */
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: transparent; /* Rendre le lien invisible */
            z-index: 10;
        }


        /* --- Fournisseurs de Services et Associations : Grille Élégante --- */
        .partners-grid-elegant {
            max-width: 1400px;
            margin: 0 auto;
            /* Si vous utilisez un carrousel JS/CSS, ces styles seront adaptés */
            /* Pour une grille simple mais grandiose : */
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); /* Logos plus grands */
            gap: 2.5rem; /* Plus d'espace */
            justify-items: center;
            align-items: center;
        }

        .partner-card-elegant {
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow-light); /* Ombre douce */
            padding: 2.5rem; /* Plus de padding interne */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: all 0.4s ease;
            height: 250px; /* Hauteur fixe pour un bel alignement */
            width: 100%;
            max-width: 350px; /* Limiter la largeur de la carte */
            text-align: center;
            position: relative;
            overflow: hidden; /* Pour l'effet de bordure animée */
        }
        .partner-card-elegant::before { /* Bordure animée */
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 20px;
            padding: 4px; /* Épaisseur de la bordure */
            background: linear-gradient(45deg, var(--dsi-blue), var(--dsi-green), var(--dsi-blue));
            -webkit-mask:
                linear-gradient(#fff 0 0) content-box,
                linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .partner-card-elegant:hover::before {
            opacity: 1;
        }

        .partner-card-elegant:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: var(--shadow-dark);
        }
        .partner-card-elegant img {
            max-width: 80%; /* Logo très grand */
            max-height: 120px; /* Hauteur max du logo */
            object-fit: contain;
            filter: grayscale(0%); /* Enlever le grayscale si présent */
            opacity: 1; /* Enlever l'opacité si présent */
            margin-bottom: 1.5rem;
        }


        /* --- Section Focus (SIT Africa) --- */
        .focus-section { padding: 5rem 1.5rem; background-color: var(--light-bg); } /* Changement de fond */
        .focus-container {
            display: grid;
            grid-template-columns: 1fr 1.5fr; /* L'image peut être un peu plus petite */
            gap: 4rem;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto 5rem auto; /* Plus d'espace après ce bloc */
            background: white; /* Fond blanc pour le container focus */
            border-radius: 20px;
            box-shadow: var(--shadow-dark); /* Ombre prononcée */
            overflow: hidden; /* Pour l'image */
        }
        @media (max-width: 992px) { .focus-container { grid-template-columns: 1fr; } } /* Adapté aux tablettes */

        .focus-image { border-radius: 0; /* Pas de bordure ici, déjà dans le container */ overflow: hidden; box-shadow: none; }
        .focus-image img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease; } /* Image couvre bien */
        .focus-image:hover img { transform: scale(1.08); } /* Zoom plus marqué */
        .focus-text { padding: 3rem; } /* Ajout de padding interne */
        .focus-text .eyebrow { color: var(--dsi-green); font-weight: 700; text-transform: uppercase; letter-spacing: 1px; }
        .focus-text h3 {
            font-size: clamp(2rem, 3.5vw, 2.5rem);
            font-weight: 800;
            color: var(--dsi-blue);
            margin-top: 0.5rem;
            margin-bottom: 1.5rem;
        }
        .focus-text p { color: var(--muted-ink); line-height: 1.8; font-size: 1.1rem; margin-bottom: 2rem; }
        .focus-text .btn {
            background: var(--dsi-blue);
            color: white;
            border-radius: 50px; /* Bouton arrondi */
            padding: 1rem 2.5rem;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-light);
        }
        .focus-text .btn:hover {
            background: var(--dsi-green);
            transform: translateY(-3px);
            box-shadow: var(--shadow-medium);
        }

        /* Section des autres partenaires presse/médias */
        .media-partners-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); /* Grille plus dense pour les médias */
            gap: 1.5rem;
            max-width: 1200px;
            margin: 3rem auto 0 auto;
        }
        .media-partner-card {
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            height: 100px;
            box-shadow: var(--shadow-light);
        }
        .media-partner-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-medium);
            border-color: var(--dsi-blue);
        }
        .media-partner-card img {
            max-width: 90%;
            max-height: 60px;
            object-fit: contain;
        }


        /* --- Double CTA --- */
        .cta-section { padding: 3rem 1.5rem; background-color: var(--dsi-blue); } /* Fond bleu DSI pour le CTA */
        .cta-container { max-width: 1000px; margin: auto; display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; } /* Plus d'espace */
        @media (max-width: 768px) { .cta-container { grid-template-columns: 1fr; } }
        .cta-card {
            padding: 1.5rem; /* Plus de padding */
            border-radius: 20px; /* Plus arrondi */
            text-align: center;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-dark);
        }
        .cta-card:hover { transform: translateY(-15px); }
        .cta-card::before { /* Effet de dégradé au survol */
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(45deg, var(--dsi-green), var(--dsi-blue));
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: 0;
        }
        .cta-card:hover::before { opacity: 1; }

        .cta-card.primary { background: white; color: var(--ink); } /* Le "secondary" devient primary, fond blanc */
        .cta-card.secondary { background: var(--dsi-blue); color: white; border: 2px solid white; } /* Ancien primary est maintenant secondaire, bordure blanche */

        /* S'assurer que le contenu est au-dessus de l'overlay */
        .cta-card > * { position: relative; z-index: 1; }

        .cta-card i { font-size: 1.5rem; /* Plus grande icône */ margin-bottom: 1.5rem; }
        .cta-card h3 { font-size: 1rem; /* Plus grand titre */ font-weight: 800; margin-bottom: 0.75rem; }
        .cta-card p { opacity: 0.9; margin: 0.5rem 0 2rem 0; font-size: 1.1rem; }
        .cta-card .btn {
            padding: 1rem 1.5rem; /* Boutons plus grands */
            border-radius: 50px; /* Plus arrondis */
            font-weight: 700;
            text-decoration: none;
            box-shadow: var(--shadow-medium);
            transition: all 0.3s ease;
        }
        .cta-card.primary .btn { background: var(--dsi-blue); color: white; } /* Bouton principal en bleu */
        .cta-card.primary .btn:hover { background: var(--dsi-green); }
        .cta-card.secondary .btn { background: white; color: var(--dsi-blue); } /* Bouton secondaire en blanc */
        .cta-card.secondary .btn:hover { background: var(--light-bg); }

        /* Inversement des couleurs pour le hover sur le CTA bleu */
        .cta-card.secondary:hover {
            color: white; /* Le texte reste blanc si le dégradé est en dessous */
            /* Pas de transform/shadow ici, déjà géré par l'effet :before */
        }
        .cta-card.secondary:hover i,
        .cta-card.secondary:hover h3,
        .cta-card.secondary:hover p {
            color: white; /* S'assurer que le texte reste blanc */
        }


        /* Media queries pour l'adaptativité */
        @media (max-width: 768px) {
            .hero-partners { height: 75vh; }
            .hero-content { padding: 1rem; }
            .animated-hero-title { font-size: clamp(2rem, 8vw, 3.5rem); }
            .animated-hero-subtitle { font-size: clamp(0.9rem, 3vw, 1.2rem); margin: 0.75rem auto 1.5rem auto; }
            .hero-cta-button { padding: 0.8rem 2rem; font-size: 1rem; }

            .section-header { padding: 3rem 1rem 2rem 1rem; }
            .section-header h2 { font-size: clamp(1.8rem, 6vw, 2.5rem); }
            .section-header p { font-size: 1rem; margin: 1rem auto 0 auto; }

            .partners-category-section { padding: 3rem 1rem; }
            .category-header { margin-bottom: 2rem; }
            .category-header h3 { font-size: clamp(1.5rem, 5vw, 2rem); }
            .category-header h4 { font-size: 0.95rem; }

            .institutions-carousel-wrapper {
                grid-template-columns: 1fr; /* Une seule colonne sur mobile */
                gap: 1.5rem;
            }
            .institution-card { padding: 1.5rem; height: 200px; max-width: 90%; margin: auto; }
            .institution-card img { max-height: 100px; margin-bottom: 1rem; }
            .institution-card .partner-name { font-size: 1rem; }

            .partners-grid-elegant {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); /* Plus petits sur mobile */
                gap: 1rem;
            }
            .partner-card-elegant { height: 120px; padding: 0.8rem; }
            .partner-card-elegant img { max-height: 60px; }

            .focus-section { padding: 3rem 1rem; }
            .focus-container { gap: 2rem; margin-bottom: 3rem; padding: 1rem; }
            .focus-text { padding: 1.5rem; }
            .focus-text h3 { font-size: clamp(1.5rem, 5vw, 2rem); margin-bottom: 1rem; }
            .focus-text p { font-size: 1rem; margin-bottom: 1.5rem; }
            .focus-text .btn { padding: 0.8rem 1.8rem; font-size: 1rem; }

            .media-partners-grid {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
                gap: 1rem;
            }
            .media-partner-card { height: 80px; padding: 0.5rem; }
            .media-partner-card img { max-height: 40px; }

            .cta-section { padding: 4rem 1rem; }
            .cta-container { gap: 1.5rem; }
            .cta-card { padding: 2rem; border-radius: 20px; }
            .cta-card i { font-size: 2.5rem; margin-bottom: 1rem; }
            .cta-card h3 { font-size: 1.4rem; }
            .cta-card p { font-size: 1rem; margin: 0.5rem 0 1rem 0; }
            .cta-card .btn { padding: 0.8rem 2rem; font-size: 1rem; }
        }

    </style>


    <section class="hero-partners">
        <!-- L'image de fond sera gérée par le CSS -->
        <div class="hero-content">
            <h1 class="animated-hero-title">La Constellation des Alliances</h1>
            <p class="animated-hero-subtitle">
                Le Club DSI est fier de collaborer avec des acteurs majeurs qui partagent
                 notre vision du futur numérique et qui façonnent l'écosystème avec nous.
            </p>
            <a href="#main-partners-section" class="hero-cta-button">Découvrir nos partenaires <i class="fas fa-arrow-down ms-2"></i></a>
        </div>
    </section>

    <!-- ================= SECTION PRINCIPALE DES PARTENAIRES ================= -->
    <div id="main-partners-section"> <!-- Ancre pour le CTA du héros -->

        @foreach($types as $type)
            @if($type->partners->count())

                <section class="partners-category-section animated-section">
                    <div class="container">
                        <div class="category-header">
                            <h3>Nos Partenaires {{ $type->name }}</h3>
                            @if($type->id == 1) {{-- Institutions --}}
                                <h4>Des acteurs clés du développement numérique national et international.</h4>
                            @elseif($type->id == 2) {{-- Fournisseur de services --}}
                                <h4>L'innovation au service de la performance des DSI et des entreprises.</h4>
                            @elseif($type->id == 3) {{-- Associations --}}
                                <h4>Un réseau d'expertise et de partage des connaissances au cœur de nos initiatives.</h4>
                            @else
                                <h4>Découvrez nos partenaires dans cette catégorie.</h4>
                            @endif
                        </div>

                        @if($type->id == 1) {{-- Institutions: Utiliser le style institutionnel (logos plus grands) --}}
                            <div class="institutions-carousel-wrapper">
                                @foreach($type->partners as $partner)
                                    <div class="institution-card">
                                        @if($partner->website_url)
                                            <a href="{{ $partner->website_url }}" target="_blank" class="partner-link"></a>
                                        @endif
                                        <img src="{{ asset('storage/'.$partner->logo_path) }}" alt="{{ $partner->company_name }}">
                                        <span class="partner-name">{{ $partner->company_name }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else {{-- Autres types: Utiliser la grille élégante --}}
                            <div class="partners-grid-elegant">
                                @foreach($type->partners as $partner)
                                    <div class="partner-card-elegant">
                                        @if($partner->website_url)
                                            <a href="{{ $partner->website_url }}" target="_blank">
                                        @endif
                                            <img src="{{ asset('storage/'.$partner->logo_path) }}" alt="{{ $partner->company_name }}">
                                        @if($partner->website_url)
                                            </a>
                                        @endif
                                        <span class="partner-name">{{ $partner->company_name }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </section>

            @endif
        @endforeach

    </div> <!-- Fin de l'ancre principale -->


    <!-- ================= PARTENAIRES PRESSE & SALONS ================= -->
    <section class="focus-section animated-section">
        <div class="container">
            <div class="section-header">
                <h2>Partenaires Presse & Salons</h2>
                <p>Des collaborations clés pour amplifier notre message et connecter notre communauté aux grands rendez-vous de la Tech.</p>
            </div>

            {{-- PARTENAIRE EN FOCUS (Ex: SIT Africa) --}}
            <div class="focus-container animated-section is-visible"> <!-- is-visible pour le faire apparaître avec la section parente -->
                <div class="focus-image">
                    <img src="https://clubdsibenin.bj/storage/partenaire-presses-salons/pXKYyVrGR8xcts4i.jpg" alt="SIT Africa">
                </div>
                <div class="focus-text">
                    <p class="eyebrow">Événement Majeur</p>
                    <h3>SIT Africa : Le Rendez-vous de la Cybersécurité</h3>
                    <p>Le SIT est un événement incontournable réservé aux éditeurs de la cybersécurité pour inviter chaque année leurs clients et prospects africains (DSI/RSSI grands comptes) dans un cadre agréable et convivial afin d’échanger ensemble sur leurs projets.</p>
                    <a href="https://sit.africa/" target="_blank" class="btn"><i class="fas fa-globe me-2"></i> Visitez le site</a>
                </div>
            </div>

            {{-- Autres Partenaires Média/Presse (si vous avez une variable $pressPartners) --}}
            {{-- @if(isset($pressPartners) && $pressPartners->count())
                <div class="category-header mt-5">
                    <h3>Nos Partenaires Média</h3>
                    <h4>Ceux qui portent notre voix et éclairent notre actualité.</h4>
                </div>
                <div class="media-partners-grid">
                    @foreach($pressPartners as $partner)
                        <div class="media-partner-card">
                            @if($partner->website_url ?? $partner->website)
                                <a href="{{ $partner->website_url ?? $partner->website }}" target="_blank">
                            @endif
                                <img src="{{ asset('storage/'.($partner->logo_path ?? $partner->logo)) }}" alt="{{ $partner->company_name ?? $partner->name }}">
                            @if($partner->website_url ?? $partner->website)
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif --}}

        </div>
    </section>


    <!-- ================= DOUBLE APPEL À L'ACTION ================= -->
    <section class="cta-section animated-section">
        <div class="cta-container">
            <div class="cta-card primary">
                <i class="fas fa-handshake"></i> <!-- Icône changée pour 'handshake' -->
                <h3>Devenir partenaire </h3>
                <p>Rejoignez notre constellation d'alliés. Accédez à un réseau unique de décideurs et amplifiez votre impact dans l'écosystème numérique.</p>
                <a href="{{ route('register.partner') }}" class="btn">Postuler au Partenariat</a>
            </div>
            <div class="cta-card secondary">
                <i class="fas fa-laptop-code"></i> <!-- Icône changée pour 'laptop-code' -->
                <h3>Accéder à la plateforme des compétences</h3>
                <p>Pour nos partenaires accrédités, accédez à votre espace dédié. Explorez les opportunités de collaboration et gérez vos interactions avec nos experts.</p>
                <a href="{{ route('login.partner') }}" class="btn">Accéder à la Plateforme</a>
            </div>
        </div>
    </section>

    <script>
        // Script simple pour déclencher les animations au scroll
        const animatedSections = document.querySelectorAll('.animated-section');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 }); // Le seuil à 15% est souvent un bon compromis
        animatedSections.forEach(section => { observer.observe(section); });

        // Smooth scroll pour le bouton "Découvrir nos Partenaires"
        document.querySelector('.hero-cta-button').addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({ behavior: 'smooth' });
            }
        });

        // Votre script pour l'animation "Nébuleuse" du héros (si vous avez un canvas)
        // Vérifiez si vous avez bien un <canvas id="nebula-canvas"></canvas> dans votre HTML du héros
        const canvas = document.getElementById('nebula-canvas');
        if(canvas) {
            const ctx = canvas.getContext('2d');
            let width = canvas.width = canvas.offsetWidth;
            let height = canvas.height = canvas.offsetHeight;
            let points = [];

            function setup() {
                // Clear existing points if resizing
                points = [];
                for (let i = 0; i < 20; i++) { // Moins de points, plus subtil
                    points.push({
                        x: Math.random() * width,
                        y: Math.random() * height,
                        vx: (Math.random() - 0.5) * 0.1, // Vitesse plus lente
                        vy: (Math.random() - 0.5) * 0.1,
                        size: Math.random() * 150 + 80, // Tailles ajustées
                        color: i % 2 === 0 ? 'rgba(9, 66, 129, 0.15)' : 'rgba(41, 150, 58, 0.1)' // Opacité plus faible
                    });
                }
            }

            function draw() {
                ctx.clearRect(0, 0, width, height);
                points.forEach(p => {
                    p.x += p.vx;
                    p.y += p.vy;

                    // Rebondir sur les bords
                    if (p.x < 0 || p.x > width) p.vx *= -1;
                    if (p.y < 0 || p.y > height) p.vy *= -1;

                    ctx.beginPath();
                    const grad = ctx.createRadialGradient(p.x, p.y, 0, p.x, p.y, p.size);
                    grad.addColorStop(0, p.color);
                    grad.addColorStop(1, 'transparent');
                    ctx.fillStyle = grad;
                    // Dessiner un cercle ou un rectangle pour l'effet de flou
                    ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
                    ctx.fill();
                });
                requestAnimationFrame(draw);
            }

            setup();
            draw();

            window.addEventListener('resize', () => {
                width = canvas.width = canvas.offsetWidth;
                height = canvas.height = canvas.offsetHeight;
                setup(); // Réinitialiser les points avec les nouvelles dimensions
            });
        }
    </script>
@endsection