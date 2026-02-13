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
        }
        body { font-family: 'Inter', sans-serif; background-color: white; color: var(--ink); margin: 0; overflow-x: hidden; }
        .animated-section { opacity: 0; transform: translateY(50px); transition: opacity 0.8s ease-out, transform 0.8s ease-out; }
        .animated-section.is-visible { opacity: 1; transform: translateY(0); }

        /* --- Héros --- */
        .hero-partners {
            position: relative;
            height: 100vh; /* Hauteur confortable, ni trop grande ni trop petite. Ajustez si besoin. */
            display: grid;
            place-items: center;
            text-align: center;
            color: white;
            overflow: hidden;
        }

        /* --- L'IMAGE DE FOND ET L'OVERLAY --- */
        .hero-partners::before {
            content: '';
            position: absolute;
            inset: 0;
            z-index: 0;

            /* VOTRE IMAGE DE FOND EST ICI */
            background-image: url("{{ asset('img/IMG_1929.jpg') }}");
            background-size: cover;
            background-position: center;

            /* Animation "Ken Burns" (zoom lent) pour donner vie à l'image */
            animation: ken-burns-zoom-out 25s ease-out infinite;
        }
        .hero-partners::after {
            content: '';
            position: absolute;
            inset: 0;
            z-index: 1;
            /* VOTRE OVERLAY BLEU NUIT SEMI-TRANSPARENT EST ICI */
            background: rgba(10, 27, 48, 0.733); /* 75% d'opacité, ajustez si besoin */
        }

        /* Le contenu textuel est au premier plan */
        .hero-content {
            position: relative;
            z-index: 2;
            padding: 1.5rem;
        }

        /* --- LES BELLES ANIMATIONS DU TEXTE --- */
        .animated-hero-title {
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            font-weight: 800;
            color: #fff;

            /* Animation d'apparition */
            opacity: 0;
            transform: translateY(30px);
            animation: slideUpFadeIn 1s 0.5s ease-out forwards;
        }

        .animated-hero-subtitle {
            font-size: clamp(1rem, 2vw, 1.25rem);
            max-width: 700px;
            margin: 1rem auto 0 auto;
            opacity: 0.9;

            /* Animation d'apparition (avec un délai) */
            opacity: 0;
            transform: translateY(30px);
            animation: slideUpFadeIn 1s 0.8s ease-out forwards;
        }


        /* --- Définition des animations --- */

        /* Animation pour l'image de fond */
        @keyframes ken-burns-zoom-out {
            0% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        /* Animation pour le texte */
        @keyframes slideUpFadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        /* --- Section Titre --- */
        .section-header { text-align: center; padding: 4rem 1.5rem 3rem 1.5rem; }
        .section-header h2 { font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 800; }
        .section-header p { color: var(--muted-ink); max-width: 600px; margin: 0.5rem auto; }

        /* --- Grille des Partenaires --- */
        .partners-grid-section-v2 {
            /* Fond blanc pour la clarté */
            background-color: white;
            padding: 4rem 1.5rem;
        }

        .partners-grid-v2 {
            display: grid;
            /* Grille responsive avec des cartes plus larges */
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: auto;
        }

        .partner-card-v2 {
            background: white;
            border: 1px solid var(--border-color); /* Bordure très subtile */
            border-radius: 16px;
            padding: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 160px; /* Assure une hauteur uniforme */
            width: 300px;
        }

        .partner-card-v2:hover {
            /* Effet de soulèvement au survol */
            transform: translateY(-10px);
            box-shadow: 0 20px 40px -15px rgba(9, 66, 129, 0.2);
        }

        .partner-card-v2 img {
            max-width: 100%;
            /* On agrandit les logos */
            height: 80px;
            object-fit: contain;
            /* On retire le filtre grayscale et l'opacité */
            filter: none;
            opacity: 1;
        }

        /* --- Section Focus --- */
        .focus-section { padding: 5rem 1.5rem; }
        .focus-container {
            display: grid; grid-template-columns: 1fr 1.2fr; gap: 4rem; align-items: center;
            max-width: 1100px; margin: auto;
        }
        @media (max-width: 768px) { .focus-container { grid-template-columns: 1fr; } }
        .focus-image { border-radius: 16px; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(9, 66, 129, 0.25); }
        .focus-image img { width: 100%; transition: transform 0.4s ease; }
        .focus-image:hover img { transform: scale(1.05); }
        .focus-text .eyebrow { color: var(--dsi-green); font-weight: 700; }
        .focus-text h3 { font-size: 1.8rem; font-weight: 700; color: var(--dsi-blue); }
        .focus-text p { color: var(--muted-ink); line-height: 1.8; }
        .focus-text .btn { background: var(--dsi-blue); color: white; border-radius: 10px; padding: 0.7rem 1.5rem; text-decoration: none; }

        /* --- Double CTA --- */
        /* --- Section Double CTA --- */
        .cta-section { padding: 4rem 1.5rem; background-color: var(--light-bg); }
        .cta-container { max-width: 1000px; margin: auto; display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; }
        @media (max-width: 768px) { .cta-container { grid-template-columns: 1fr; } }
        .cta-card { padding: 2.5rem; border-radius: 20px; text-align: center; transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .cta-card:hover { transform: translateY(-10px); }
        .cta-card.primary { background: var(--dsi-blue); color: white; box-shadow: 0 20px 40px -15px color-mix(in oklab, var(--dsi-blue) 40%, transparent); }
        .cta-card.secondary { background: white; color: var(--ink); box-shadow: 0 20px 40px -15px rgba(11, 63, 122, 0.2); }
        .cta-card i { font-size: 2.5rem; margin-bottom: 1rem; }
        .cta-card h3 { font-size: 1.5rem; font-weight: 700; }
        .cta-card p { opacity: 0.8; margin: 0.5rem 0 1.5rem 0; }
        .cta-card .btn { padding: 0.8rem 1.5rem; border-radius: 10px; font-weight: 600; text-decoration: none; }
        .cta-card.primary .btn { background: white; color: var(--dsi-blue); }
        .cta-card.secondary .btn { background: var(--dsi-blue); color: white; }
    </style>


    <section class="hero-partners">
        <!-- L'image de fond sera gérée par le CSS -->
        <div class="hero-content">
            <h1 class="animated-hero-title">La Constellation des Alliances</h1>
            <p class="animated-hero-subtitle">
                Découvrez les partenaires stratégiques qui, avec le Club DSI Bénin, construisent et renforcent l'écosystème numérique national.
            </p>
        </div>
    </section>

    <section class="partners-grid-section-v2 animated-section">
        <div class="container">
            <div class="section-header">
                <h2>Nos Partenaires de Croissance</h2>
                <p>Des leaders technologiques et institutionnels engagés à nos côtés pour l'excellence et l'innovation.</p>
            </div>
            <div class="partners-grid-v2">
                <!-- Partenaire 1 -->
                <div class="partner-card-v2">
                    <img src="{{ asset('img/partners/part1.jpg') }}" alt="Coopération Allemande">
                </div>
                <!-- Partenaire 2 -->
                <div class="partner-card-v2">
                    <img src="{{ asset('img/partners/part6.jpeg') }}" alt="GIZ">
                </div>
                <!-- Partenaire 3 -->
                <div class="partner-card-v2">
                    <img src="{{ asset('img/partners/part4.jpeg') }}" alt="Centre de Transformation Digitale Bénin"> <!-- Utilisez une version du logo visible sur fond blanc -->
                </div>
                <!-- Partenaire 4 -->
                <div class="partner-card-v2">
                    <img src="{{ asset('img/partners/150.png') }}" alt="Ministère du Numérique et de la Digitalisation">
                </div>
                <!-- Partenaire 5 -->
                <div class="partner-card-v2">
                    <img src="{{ asset('img/partners/part3.png') }}" alt="Get'IT Smart Synergies">
                </div>
                <!-- Partenaire 6 -->
                <div class="partner-card-v2">
                    <img src="{{ asset('img/partners/part2.jpg') }}" alt="Project Management Institute Benin">
                </div>

                <div class="partners-grid-v2">

                    @forelse($partners as $partner)
                        <div class="partner-card-v2">
                            <img
                                src="{{ asset('storage/' . $partner->logo_path) }}"
                                alt="{{ $partner->company_name }}"
                                title="{{ $partner->company_name }}"
                            >
                        </div>
                    @empty
                        <p class="text-center">Aucun partenaire pour le moment.</p>
                    @endforelse

                </div>

            </div>
        </div>
    </section>

    <!-- ================= NOUVEAU : FOCUS COOPÉRATION ALLEMANDE ================= -->
    <section class="focus-section animated-section">
        <div class="container">
            <div class="focus-container">
                <div class="focus-image">
                    <img src="{{ asset('img/partners/part1.jpg') }}" alt="Coopération Allemande">
                </div>
                <div class="focus-text">
                    <p class="eyebrow">Partenariat Stratégique</p>
                    <h3>La Coopération Allemande (GIZ)</h3>
                    <p>Un partenaire de premier plan qui soutient activement le développement de l'écosystème numérique au Bénin. Grâce à cette collaboration, le Club DSI Bénin renforce ses programmes de formation, de mentorat et de mise en réseau au profit de tous ses membres et de l'économie locale.</p>
                    <a href="http://www.giz.de/benin" class="btn"><i class="fas fa-arrow-right me-2"></i> En savoir plus</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= FOCUS PRESSE & SALONS ================= -->
    <section class="focus-section animated-section">
        <div class="container">
            <div class="section-header">
                <h2>Partenaires Presses & Salons</h2>
                <p>Des collaborations clés pour amplifier notre message et connecter notre communauté aux grands rendez-vous de la Tech.</p>
            </div>
            <div class="focus-container">
                <div class="focus-text">
                    <h3>SIT Africa : Le Rendez-vous de la Cybersécurité</h3>
                    <p>Le SIT est un événement incontournable réservé aux éditeurs de la cybersécurité pour inviter chaque année leurs clients et prospects africains (DSI/RSSI grands comptes) dans un cadre agréable et convivial afin d’échanger ensemble sur leurs projets.</p>
                    <a href="https://sit.africa/" target="_blank" class="btn"><i class="fas fa-globe me-2"></i> Visitez le site</a>
                </div>
                <div class="focus-image">
                    <img src="https://clubdsibenin.bj/storage/partenaire-presses-salons/pXKYyVrGR8xcts4i.jpg" alt="SIT Africa">
                </div>
            </div>
            @foreach($pressPartners as $partner)
                <div class="partner-card-v2">
                    <a href="{{ $partner->website }}" target="_blank">
                        <img src="{{ asset('storage/'.$partner->logo) }}" alt="{{ $partner->name }}">
                        <p>{{ $partner->description }}</p>
                    </a>
                </div>
            @endforeach

        </div>
    </section>


    <!-- ================= DOUBLE APPEL À L'ACTION ================= -->
    <section class="cta-section animated-section">
        <div class="cta-container">
            <div class="cta-card secondary">
                <i class="fas fa-user-plus"></i>
                <h3>Devenir Partenaire</h3>
                <p>Rejoignez notre constellation et accédez à un réseau unique de décideurs pour amplifier votre impact.</p>
                <a href="{{ route('register.partner') }}" class="btn">S'inscrire</a>
            </div>
            <div class="cta-card primary">
                <i class="fas fa-sign-in-alt"></i>
                <h3>Espace Partenaire</h3>
                <p>Accédez à votre tableau de bord, gérez votre profil et découvrez les opportunités exclusives réservées à nos partenaires.</p>
                <a href="{{ route('login.partner') }}" class="btn">Se connecter</a>
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
        }, { threshold: 0.15 });
        animatedSections.forEach(section => { observer.observe(section); });

        // Script pour l'animation "Nébuleuse" du héros
        const canvas = document.getElementById('nebula-canvas');
        if(canvas) {
            const ctx = canvas.getContext('2d');
            let width = canvas.width = canvas.offsetWidth;
            let height = canvas.height = canvas.offsetHeight;
            let points = [];

            function setup() {
                for (let i = 0; i < 20; i++) {
                    points.push({
                        x: Math.random() * width,
                        y: Math.random() * height,
                        vx: (Math.random() - 0.5) * 0.2,
                        vy: (Math.random() - 0.5) * 0.2,
                        size: Math.random() * 200 + 100,
                        color: i % 2 === 0 ? 'rgba(9, 66, 129, 0.2)' : 'rgba(41, 150, 58, 0.15)'
                    });
                }
            }

            function draw() {
                ctx.clearRect(0, 0, width, height);
                points.forEach(p => {
                    p.x += p.vx;
                    p.y += p.vy;
                    if (p.x < 0 || p.x > width) p.vx *= -1;
                    if (p.y < 0 || p.y > height) p.vy *= -1;

                    ctx.beginPath();
                    const grad = ctx.createRadialGradient(p.x, p.y, 0, p.x, p.y, p.size);
                    grad.addColorStop(0, p.color);
                    grad.addColorStop(1, 'transparent');
                    ctx.fillStyle = grad;
                    ctx.fillRect(0, 0, width, height);
                });
                requestAnimationFrame(draw);
            }
            setup();
            draw();
            window.addEventListener('resize', () => {
                width = canvas.width = canvas.offsetWidth;
                height = canvas.height = canvas.offsetHeight;
                points = [];
                setup();
            });
        }
    </script>




@endsection
