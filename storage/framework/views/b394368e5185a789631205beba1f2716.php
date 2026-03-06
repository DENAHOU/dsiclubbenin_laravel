<?php $__env->startSection('title', 'Qui-sommes-nous'); ?>

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
        body { font-family: 'Inter', sans-serif; background-color: white; color: var(--ink); margin: 0; overflow-x: hidden; }

        .animated-section { opacity: 0; transform: translateY(50px); transition: opacity 0.8s ease-out, transform 0.8s ease-out; }
        .animated-section.is-visible { opacity: 1; transform: translateY(0); }

        /* --- HÉROS AVEC IMAGE ANIMÉE --- */
        .hero-about {
            position: relative; height: 100vh; display: grid; place-items: center; text-align: center;
            overflow: hidden; /* Important pour l'effet de zoom */
        }
        .hero-about .hero-background-image {
            position: absolute; top: 0; left: 0;
            width: 100%; height: 100%;
            background-image: url("<?php echo e(asset('img/IMG (2).jpg')); ?>");
            background-size: cover;
            background-position: center;
            z-index: 0;
            /* Animation "Ken Burns" */
            animation: ken-burns 20s ease-out infinite;
        }
            .hero-about::after {
                content: '';
                position: absolute;
                inset: 0;
                background: rgba(4, 28, 54, 0.55); /* #0b3f7a à 55% */
                z-index: 1;
            }

        .hero-content { position: relative; z-index: 2; }
        .hero-content h1 { font-size: clamp(2.5rem, 6vw, 4.5rem); font-weight: 800; text-shadow: 0 4px 10px rgba(0,0,0,0.3); color: #fff;}

        @keyframes ken-burns {
            0% { transform: scale(1); }
            100% { transform: scale(1.1); }
        }

        /* --- Section Contenu --- */
        .content-section { padding: 5rem 1.5rem; }
        .content-section .container { max-width: 1100px; }
        .content-row { display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center; }
        @media (max-width: 992px) { .content-row { grid-template-columns: 1fr; } }
        .content-text .eyebrow { color: var(--dsi-green); font-weight: 700; letter-spacing: .1em; text-transform: uppercase; }
        .content-text h2 { font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 800; margin: 0.5rem 0 1rem 0; }
        .content-text p, .content-text li { color: var(--muted-ink); line-height: 1.8; font-size: 1.1rem; }
        .content-text ul { list-style: none; padding-left: 0; margin-top: 1rem; }
        .content-text li { position: relative; padding-left: 25px; margin-bottom: 0.75rem; }
        .content-text li::before { content: '\f058'; font-family: "Font Awesome 6 Free"; font-weight: 900; position: absolute; left: 0; top: 5px; color: var(--dsi-green); }
        .content-image img { width: 100%; border-radius: 16px; box-shadow: 0 25px 50px -12px rgba(9, 66, 129, 0.25); }
        .values-section { background-color: var(--light-bg); }
        .values-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem; }
        .value-card { background: white; border-radius: 16px; padding: 2rem; text-align: center; border: 1px solid var(--border-color); transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .value-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px -15px rgba(9, 66, 129, 0.2); }
        .value-card .card-icon { font-size: 2.5rem; margin-bottom: 1.5rem; width: 70px; height: 70px; border-radius: 50%; display: grid; place-items: center; background: linear-gradient(135deg, var(--dsi-blue), var(--dsi-green)); color: white; margin-left: auto; margin-right: auto; }
        .value-card h3 { font-size: 1.3rem; font-weight: 700; }


         /* --- Section Timeline Innovante Premium Gold --- */
        .timeline-section {
            padding: 4rem 0;
            position: relative;
            overflow: hidden;
            background-color: var(--light-bg);
        }

        .timeline-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="gold-pattern" width="40" height="40" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="2" fill="rgba(255,215,0,0.06)"/><circle cx="0" cy="0" r="1" fill="rgba(255,215,0,0.03)"/><circle cx="40" cy="40" r="1" fill="rgba(255,215,0,0.03)"/><path d="M10 10 L30 30" stroke="rgba(255,215,0,0.04)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23gold-pattern)"/></svg>');
            pointer-events: none;
        }

        .timeline-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            position: relative;
            z-index: 1;
        }

        .timeline-header {
            text-align: center;
            margin-bottom: 3rem;
            display: block !important;
            visibility: visible !important;
        }

        .timeline-header h2 {
            font-size: 2.5rem;
            font-weight: 900;
            background: var(--dsi-blue);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
            line-height: 1.2;
            text-shadow: 0 2px 4px rgba(255,215,0,0.1);
        }

        .timeline-header p {
            font-size: 1.1rem;
            color: #2c3e50;
            line-height: 1.8;
            max-width: 600px;
            margin: 0 auto;
        }

        .timeline {
            position: relative;
            padding: 2rem 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 3px;
            background: var(--dsi-gold);
            transform: translateX(-50%);
            box-shadow: 0 0 10px rgba(255, 174, 0, 0.3);
        }

        .timeline-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
            position: relative;
        }

        .timeline-item:nth-child(even) {
            flex-direction: row-reverse;
        }

        .timeline-content {
            width: 45%;
            background: white;
            padding: 1.8rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 2px solid transparent;
            background-clip: padding-box;
            position: relative;
            overflow: hidden;
        }

        .timeline-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #ffd700, #ffed4e, #ffd700);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .timeline-content:hover::before {
            transform: scaleX(1);
        }

        .timeline-content:hover {
            transform: translateY(-8px) scale(1.02);
            border-color: var(--dsi-gold);
            box-shadow: 0 20px 40px rgba(255,174,0,0.2);
        }

        .timeline-dot {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 20px;
            background: var(--dsi-gold);
            border: 4px solid white;
            border-radius: 50%;
            box-shadow: 0 0 0 6px rgba(255,174,0,0.3), 0 0 20px rgba(255,174,0,0.4);
            z-index: 2;
            transition: all 0.3s ease;
        }

        .timeline-item:hover .timeline-dot {
            transform: translateX(-50%) scale(1.2);
            box-shadow: 0 0 0 8px rgba(255,174,0,0.4), 0 0 30px rgba(255,174,0,0.6);
        }

        .timeline-date {
            font-size: 0.9rem;
            color: var(--dsi-blue);
            font-weight: 700;
            margin-bottom: 0.6rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .timeline-title {
            font-size: 1.2rem;
            font-weight: 800;
            color: #2c3e50;
            margin-bottom: 0.8rem;
            line-height: 1.3;
        }

        .timeline-description {
            color: #6c757d;
            line-height: 1.6;
            font-size: 0.95rem;
        }

        /* --- Éléments décoratifs dorés --- */
        .gold-star {
            position: absolute;
            font-size: 1.8rem;
            color: #ffd700;
            opacity: 0.2;
            animation: twinkle 4s ease-in-out infinite;
        }

        .gold-star:nth-child(1) { top: 5%; left: 3%; animation-delay: 0s; }
        .gold-star:nth-child(2) { top: 15%; right: 5%; animation-delay: 1s; }
        .gold-star:nth-child(3) { bottom: 10%; left: 6%; animation-delay: 2s; }
        .gold-star:nth-child(4) { bottom: 20%; right: 3%; animation-delay: 3s; }

        @keyframes twinkle {
            0%, 100% { opacity: 0.2; transform: scale(1); }
            50% { opacity: 0.6; transform: scale(1.3); }
        }
        

    /* ===== HERO MOBILE ===== */
    @media (max-width: 768px) {

        .hero-about {
            height: 25vh;
            min-height: 200px; /* sécurité */
            padding: 15px;
        }

        .hero-about .hero-background-image {
            animation: ken-burns-mobile 20s ease-out infinite;
            background-position: center center;
            /* PAS DE HEIGHT ICI */
        }

        .hero-content h1 {
            font-size: 26px;
            line-height: 1.3;
            padding: 0 10px;
        }

    }

    /* Animation plus douce mobile */
    @keyframes ken-burns-mobile {
        0% { transform: scale(1); }
        100% { transform: scale(1.05); }
    }


        /* Animation plus douce mobile */
        @keyframes ken-burns-mobile {
            0% { transform: scale(1); }
            100% { transform: scale(1.05); }
        }

        .hero-about {
            min-height: 100svh;
        }

        .hero-content h1 {
            letter-spacing: 1px;
        }


        /* ================= MOBILE ================= */

@media (max-width: 768px) {

    .timeline-section {
        padding: 40px 15px;
    }

    .timeline-header h2 {
        font-size: 24px;
    }

    .timeline-header p {
        font-size: 14px;
    }

    .timeline {
        padding-left: 30px;
        margin-top: 30px;
    }

    .timeline::before {
        left: 10px;
    }

    .timeline-dot {
        left: -10px;
        width: 16px;
        height: 16px;
    }

    .timeline-content {
        padding: 16px;
        border-radius: 10px;
    }

    .timeline-title {
        font-size: 16px;
    }

    .timeline-description {
        font-size: 13px;
    }

}


    </style>

    <body>

    <!-- ================= HÉROS CINÉMATIQUE AVEC IMAGE ================= -->
    <section class="hero-about">
        <div class="hero-background-image"></div>
        <div class="hero-content">
            <h1>L'ADN du Club DSI Bénin</h1>
        </div>
    </section>

    <!-- ================= CHAPITRE 1 : QUI SOMMES-NOUS ? ================= -->
    <section class="content-section animated-section">
        <div class="container">
            <div class="content-row">
                <div class="content-text">
                    <p class="eyebrow">Notre Identité</p>
                    <h2>Le Premier réseau des décideurs IT au Bénin</h2>
                    <p>Porté sur les fonts baptismaux suite à l’Assemblée générale du 20 août 2016, le Club DSI est une Association enregistrée au Bénin qui regroupe plus d'une centaine de décideurs informatiques d’entreprises privées, d’entités publiques, et d’organisations internationales sur tout le territoire.</p>
                </div>
                <div class="content-image">
                    <img src="https://clubdsibenin.bj/storage/abouts/8sMXmv5GiURcQ8B5.JPG" alt="Réunion des membres du Club DSI Bénin">
                </div>
            </div>
        </div>
    </section>

    <!-- ================= CHAPITRE 2 : NOTRE MISSION ================= -->
    <section class="content-section animated-section" style="background-color: var(--light-bg);">
        <div class="container">
            <div class="content-row">
                <div class="content-image" style="order: 2;">
                    <img src="https://clubdsibenin.bj/storage/abouts/G9vvHoiKwXL7sXBz.jpeg" alt="Atelier de travail du Club DSI Bénin">
                </div>
                <div class="content-text" style="order: 1;">
                    <p class="eyebrow">Notre Vocation</p>
                    <h2>Créer de la valeur par le numérique</h2>
                    <p>Notre mission première est de créer un cadre d’échange pour permettre à chaque membre d’exprimer ses talents et de partager ses expériences. Au-delà du renforcement de nos liens, nous contribuons activement à :</p>
                    <ul>
                        <li>La promotion des bonnes pratiques des systèmes d'information.</li>
                        <li>L'amélioration de la gouvernance IT des entreprises et Institutions.</li>
                        <li>Faire du lobbying pour améliorer la qualité des contenus académiques.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= CHAPITRE 3 : NOS VALEURS ================= -->
    <section class="content-section values-section animated-section">
        <div class="container">
            <div class="section-header" style="padding-top: 0;">
                <h2>Au cœur de nos actions</h2>
                <p>La recherche continuelle de la perfection nous caractérise. Nous agissons ensemble pour construire l’avenir et bénéficier des opportunités d’aujourd’hui et de demain.</p>
            </div>
            <div class="values-grid">
                <div class="value-card"><div class="card-icon"><i class="fas fa-handshake-angle"></i></div><h3>Entraide</h3><p>Nous nous donnons la main pour réaliser de petites et grandes choses.</p></div>
                <div class="value-card"><div class="card-icon"><i class="fas fa-shield-alt"></i></div><h3>Intégrité</h3><p>L'honnêteté et la transparence sont au cœur de toutes nos interactions.</p></div>
                <div class="value-card"><div class="card-icon"><i class="fas fa-rocket"></i></div><h3>Combativité</h3><p>Nous relevons les défis technologiques avec détermination et innovation.</p></div>
                <div class="value-card"><div class="card-icon"><i class="fas fa-globe"></i></div><h3>Ouverture d'Esprit</h3><p>Nous accueillons les nouvelles idées et perspectives pour enrichir notre écosystème.</p></div>
            </div>
        </div>
    </section>


                <!-- ================= CHAPITRE 4 : NOTRE HISTOIRE DIGITALE ================= -->
    <section class="timeline-section animated-section">
        
        <div class="timeline-container">
            <div class="timeline-header">
                <h2>Notre histoire digitale</h2>
                <p>Une décennie d'innovation et d'excellence dans l'écosystème numérique béninois</p>
            </div>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-date">2016</div>
                        <div class="timeline-title">Fondation du DSI CLUB</div>
                        <div class="timeline-description">Création du club sous 
                        le nom de Club des Directeurs des Systèmes d'Informations
                         avec l'élection du premier Bureau Exécutif. Mise en place des partenariats
                          ASSI, CNIL, MND, ADN etc.</div>
                    </div>
                    <div class="timeline-dot"></div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-date">2017</div>
                        <div class="timeline-title">Formations certifiées</div>
                        <div class="timeline-description"> Première formation certiﬁante CISA. <br>
                            Séminaires: Forum CioMAG: Cybersécurité et conﬁance numérique
                        </div>
                    </div>
                    <div class="timeline-dot"></div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-date">2018</div>
                        <div class="timeline-title">Election du deuxième Bureau Exécutif</div>
                        <div class="timeline-description">Mise en place du deuxième Bureau Exécutif <br>
                            Formation certiﬁante PMP <br>
                             Formation certiﬁante ITIL <br>
                             Séminaires: « La Protection des données,
                              enjeux et solutions » avec le CNIL,
                               CONFERENCE DE SECURITE INTERIEURE EN REPUBLIQUE DU BENIN
                               « Les innovations technologiques dans la co-production de la sécurité »
                        </div>
                    </div>
                    <div class="timeline-dot"></div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-date">2019</div>
                        <div class="timeline-title">Afterwork</div>
                        <div class="timeline-description">INFRASTRUCTURE À CLÉ PUBLIQUE (PKI) 
                            Workﬂows d'authentiﬁcation et de signature et intégration avec l’ASSI,
                             “Cycle DevOps” avec l’ASSI, Transformation digitale avec MediaPart <br>
                             Séminaire: Forum International CITIC de Tunis, Fortinet Security seminar <br> 
                             Remise de prix à la startup ALIVO <br>
                        </div>
                    </div>
                    <div class="timeline-dot"></div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-date">2020</div>
                        <div class="timeline-title">Création du tenants Office 365 du club.</div>
                        <div class="timeline-description">
                            Mise en service du site web du club avec gestion électronique des cotisations <br>
                            Election du troisième Bureau Exécutif
                        </div>
                    </div>
                    <div class="timeline-dot"></div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-date">2021</div>
                        <div class="timeline-title">Première édition des DSI Awards</div>
                        <div class="timeline-description">Lancement de la 
                        première édition des DSI Awards pour récompenser 
                        l'excellence numérique et célébrer les meilleurs 
                        projets technologiques.</div>
                    </div>
                    <div class="timeline-dot"></div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-date">2022</div>
                        <div class="timeline-title">Changement de dénomination - Election du quatrième Bureau Exécutif</div>
                        <div class="timeline-description">Le Club des Directeurs des Systèmes d'Informations
                             devient Club des Décideurs de Systèmes d'Informations. <br> 
                            Organisation des DSI Awards 2ème édition <br>
                            Organisation du PRIX NSIA VIE ASSURANCES & DSI CLUB BÉNIN DE L’INNOVATION STARTUPS <br>
                        </div>
                    </div>
                    <div class="timeline-dot"></div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-date">2023</div>
                        <div class="timeline-title">Forum Benino-Tunisien du Numérique</div>
                        <div class="timeline-description">Organisation de la première du
                         Forum Benino-Tunisien du Numérique</div>
                    </div>
                    <div class="timeline-dot"></div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-date">2024</div>
                        <div class="timeline-title">Election du cinquième Bureau Exécutif & 
                            DSI Awards 4ème édition</div>
                    </div>
                    <div class="timeline-dot"></div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-date">2025</div>
                        <div class="timeline-title">Forum Benino-Tunisien du Numérique 2ème édition & QSI Awards 5ème édition</div>
                    </div>
                    <div class="timeline-dot"></div>
                </div>
            </div>
        </div>
    </section>

    <script>
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
    </script>

    </body>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/club/about.blade.php ENDPATH**/ ?>