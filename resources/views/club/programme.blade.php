@extends('layouts.guest')

@section('title', 'Programmes Thématiques')

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

        .hero-themes {
            position: relative; height: 100vh; display: grid; place-items: center; text-align: center; color: white;
            background-image: linear-gradient(#101d34bd), url("{{ asset('img/image.jpg') }}");
            background-size: cover; background-position: center;
        }
        .hero-themes h1 { font-size: clamp(2.5rem, 6vw, 4rem); font-weight: 800; color: rgba(253, 251, 251, 0.993); }

        .themes-container { padding: 4rem 1.5rem; }
        .section-header { text-align: center; max-width: 800px; margin: 0 auto 3rem auto; }
        .section-header h2 { font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 800; }
        .section-header p { color: var(--muted-ink); font-size: 1.125rem; }

        .themes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
            max-width: 1400px;
            margin: auto;
        }

        .flip-card {
            background-color: transparent; min-height: 280px; perspective: 1000px;
            display: none; /* Caché par défaut, JS gèrera l'affichage */
        }
        .flip-card.visible {
            display: block; /* La classe 'visible' affiche la carte */
        }

        .flip-card-inner { position: relative; width: 100%; height: 100%; transition: transform 0.8s; transform-style: preserve-3d; }
        .flip-card.active .flip-card-inner { transform: rotateY(180deg); }
        .flip-card-front, .flip-card-back { position: absolute; width: 100%; height: 100%; -webkit-backface-visibility: hidden; backface-visibility: hidden; border-radius: 16px; overflow: hidden; }
        .flip-card-front { background: white; border: 1px solid var(--border-color); display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 2rem; text-align: center; cursor: pointer; }
        .front-icon { font-size: 2.5rem; margin-bottom: 1.5rem; width: 70px; height: 70px; border-radius: 50%; display: grid; place-items: center; background: linear-gradient(135deg, var(--dsi-blue), var(--dsi-green)); color: white; }
        .flip-card-front h3 { font-size: 1.3rem; font-weight: 700; color: var(--ink); }
        .flip-card-back { background: var(--dsi-blue); color: white; transform: rotateY(180deg); padding: 2rem; display: flex; flex-direction: column; }
        .flip-card-back h4 { font-weight: 700; border-bottom: 2px solid var(--dsi-green); padding-bottom: 0.5rem; margin-bottom: 1rem; }
        .flip-card-back p { font-size: 0.95rem; line-height: 1.6; opacity: 0.9; flex-grow: 1; }
        .btn-close-card { background: none; border: none; color: white; font-size: 1.5rem; position: absolute; top: 1rem; right: 1rem; cursor: pointer; }

        /* --- Pagination --- */
        .pagination-container { 
            display: flex; 
            justify-content: center; 
            margin-top: 3rem; 
            width: 100%;
        }
        .pagination { 
            display: flex; 
            justify-content: center; 
            align-items: center;
            gap: 0.5rem;
            padding: 0;
            margin: 0;
        }
        .pagination .page-link { 
            color: var(--dsi-blue); 
            padding: 0.5rem 1rem;
            border: 1px solid var(--dsi-blue);
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .pagination .page-link:hover {
            background-color: var(--dsi-blue);
            color: white;
        }
        .pagination .page-item.active .page-link { 
            background-color: var(--dsi-blue); 
            border-color: var(--dsi-blue); 
            color: white;
        }
        .pagination .page-item.disabled .page-link {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* --- Section Premium Programmes d'Excellence --- */
        .excellence-section {
            margin: 4rem 0;
            padding: 4rem 0;
            position: relative;
            overflow: hidden;
        }

        .excellence-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="gold-pattern" width="30" height="30" patternUnits="userSpaceOnUse"><circle cx="15" cy="15" r="2" fill="rgba(255,215,0,0.08)"/><circle cx="0" cy="0" r="1" fill="rgba(255,215,0,0.05)"/><circle cx="30" cy="30" r="1" fill="rgba(255,215,0,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23gold-pattern)"/></svg>');
            pointer-events: none;
        }

        .excellence-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .excellence-header {
            margin-bottom: 3rem;
        }

        .excellence-header h2 {
            font-size: 3rem;
            font-weight: 900;
            background: var(--dsi-blue);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
            line-height: 1.2;
            text-shadow: 0 2px 4px rgba(255,215,0,0.1);
        }

        .excellence-header p {
            font-size: 1.2rem;
            color: #2c3e50;
            line-height: 1.8;
            max-width: 600px;
            margin: 0 auto;
        }

        .excellence-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .excellence-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            border: 2px solid transparent;
            background-clip: padding-box;
        }

        .excellence-card::before {
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

        .excellence-card:hover::before {
            transform: scaleX(1);
        }

        .excellence-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(255,215,0,0.15);
            border-color: #ffd700;
        }

        .excellence-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: #2c3e50;
            box-shadow: 0 10px 20px rgba(255,215,0,0.2);
            transition: all 0.3s ease;
        }

        .excellence-card:hover .excellence-icon {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 15px 30px rgba(255,215,0,0.3);
        }

        .excellence-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 1rem;
            line-height: 1.3;
        }

        .excellence-description {
            color: #6c757d;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .excellence-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid #e9ecef;
        }

        .excellence-date {
            font-size: 0.9rem;
            color: var(--dsi-blue);
            font-weight: 600;
        }

        .excellence-status {
            display: inline-block;
            padding: 0.3rem 1rem;
            background: linear-gradient(135deg, #28a745 0%, #34ce57 100%);
            color: white;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* --- Éléments décoratifs dorés --- */
        .gold-star {
            position: absolute;
            font-size: 1.5rem;
            color: #ffd700;
            opacity: 0.3;
            animation: twinkle 3s ease-in-out infinite;
        }

        .gold-star:nth-child(1) { top: 10%; left: 5%; animation-delay: 0s; }
        .gold-star:nth-child(2) { top: 20%; right: 10%; animation-delay: 1s; }
        .gold-star:nth-child(3) { bottom: 15%; left: 8%; animation-delay: 2s; }
        .gold-star:nth-child(4) { bottom: 25%; right: 5%; animation-delay: 3s; }

        @keyframes twinkle {
            0%, 100% { opacity: 0.3; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(1.2); }
        }

    </style>

    <body>

        <section class="hero-themes"><h1>Programmes Thématiques</h1></section>

        <main class="themes-container">
            <div class="section-header">
                <h2>Les thématiques au cœur de nos échanges</h2>
                <p>Découvrez les sujets clés qui animent notre communauté. Cliquez sur une carte pour en savoir plus.</p>
            </div>

            <div class="themes-grid" id="themes-grid">
                <!-- PROGRAMMES STATIQUES EXISTANTS -->
                <!-- PAGE 1 -->
                <div class="flip-card"><div class="flip-card-inner"><div class="flip-card-front"><div class="front-icon"><i class="fas fa-shield-alt"></i></div><h3>Sécurité Web & Accès (Zero Trust)</h3></div><div class="flip-card-back"><button class="btn-close-card">&times;</button><h4>Détails</h4><p>Examiner les solutions de sécurisation des plateformes web, des accès distants et explorer la mise en place de la stratégie de sécurité Zero Trust.</p></div></div></div>
                <div class="flip-card"><div class="flip-card-inner"><div class="flip-card-front"><div class="front-icon"><i class="fas fa-sitemap"></i></div><h3>Management de la Sécurité (SMSI)</h3></div><div class="flip-card-back"><button class="btn-close-card">&times;</button><h4>Détails</h4><p>Explorer les étapes clés pour la migration vers un SMSI, incluant MSSP, pare-feu Nextgen et la planification PRA/PCA.</p></div></div></div>
                <div class="flip-card"><div class="flip-card-inner"><div class="flip-card-front"><div class="front-icon"><i class="fas fa-tasks"></i></div><h3>Gestion des Événements de Sécurité</h3></div><div class="flip-card-back"><button class="btn-close-card">&times;</button><h4>Détails</h4><p>Explorer les meilleures pratiques pour la gestion de la sécurité des informations et des événements (SIEM), afin de protéger les données et d'assurer la conformité.</p></div></div></div>
                <div class="flip-card"><div class="flip-card-inner"><div class="flip-card-front"><div class="front-icon"><i class="fas fa-cloud-shield"></i></div><h3>Sécurité Cloud & Données</h3></div><div class="flip-card-back"><button class="btn-close-card">&times;</button><h4>Détails</h4><p>Explorer les meilleures pratiques pour assurer la sécurité dans le cloud, y compris la sécurité de la messagerie et des données qui y sont stockées.</p></div></div></div>
                <div class="flip-card"><div class="flip-card-inner"><div class="flip-card-front"><div class="front-icon"><i class="fas fa-file-signature"></i></div><h3>Signature Électronique & Transactions</h3></div><div class="flip-card-back"><button class="btn-close-card">&times;</button><h4>Détails</h4><p>Explorer les pratiques de sécurité pour protéger les documents et les transactions numériques, y compris la signature électronique.</p></div></div></div>
                <div class="flip-card"><div class="flip-card-inner"><div class="flip-card-front"><div class="front-icon"><i class="fas fa-network-wired"></i></div><h3>Gestion des Menaces Réseaux</h3></div><div class="flip-card-back"><button class="btn-close-card">&times;</button><h4>Détails</h4><p>Explorer les méthodes de gestion des anomalies et des menaces réseaux : contrôle d'accès, pares-feux, prévention et détection d'intrusions.</p></div></div></div>
                <div class="flip-card"><div class="flip-card-inner"><div class="flip-card-front"><div class="front-icon"><i class="fas fa-binoculars"></i></div><h3>SIEM, SOAR, SOC & Monitoring</h3></div><div class="flip-card-back"><button class="btn-close-card">&times;</button><h4>Détails</h4><p>Aborder les outils et stratégies (SIEM, SOAR, SOC) permettant de surveiller, d'analyser et de répondre aux incidents de sécurité au sein d'un SI.</p></div></div></div>
                <div class="flip-card"><div class="flip-card-inner"><div class="flip-card-front"><div class="front-icon"><i class="fas fa-server"></i></div><h3>Sécurité du DataCenter</h3></div><div class="flip-card-back"><button class="btn-close-card">&times;</button><h4>Détails</h4><p>Explorer les meilleures pratiques pour assurer la sécurité du datacenter, y compris la sécurité physique avec la vidéosurveillance.</p></div></div></div>
                <div class="flip-card"><div class="flip-card-inner"><div class="flip-card-front"><div class="front-icon"><i class="fas fa-credit-card"></i></div><h3>Antivirus & Sécurité des Paiements</h3></div><div class="flip-card-back"><button class="btn-close-card">&times;</button><h4>Détails</h4><p>Explorer les meilleures pratiques pour assurer la sécurité des transactions et des paiements électroniques, y compris l'utilisation d'un antivirus.</p></div></div></div>

                <!-- PAGE 2 -->
                <div class="flip-card"><div class="flip-card-inner"><div class="flip-card-front"><div class="front-icon"><i class="fas fa-database"></i></div><h3>Protection des Données & SDDC</h3></div><div class="flip-card-back"><button class="btn-close-card">&times;</button><h4>Détails</h4><p>Explorer les pratiques pour protéger les données dans un centre de données défini par logiciel (SDDC), incluant les stratégies de sauvegarde.</p></div></div></div>
                <div class="flip-card"><div class="flip-card-inner"><div class="flip-card-front"><div class="front-icon"><i class="fas fa-hdd"></i></div><h3>Gestion de l'Infrastructure</h3></div><div class="flip-card-back"><button class="btn-close-card">&times;</button><h4>Détails</h4><p>Aborder la gestion des serveurs, du stockage et de la virtualisation, qui sont les piliers de toute infrastructure technique moderne.</p></div></div></div>
                <div class="flip-card"><div class="flip-card-inner"><div class="flip-card-front"><div class="front-icon"><i class="fas fa-mobile-alt"></i></div><h3>Sécurité Mobile & Endpoints</h3></div><div class="flip-card-back"><button class="btn-close-card">&times;</button><h4>Détails</h4><p>Explorer les meilleures pratiques pour assurer la sécurité des appareils mobiles en entreprise, incluant la gestion de contenu et les antivirus d'extrémité.</p></div></div></div>
                <div class="flip-card"><div class="flip-card-inner"><div class="flip-card-front"><div class="front-icon"><i class="fas fa-project-diagram"></i></div><h3>Edge Computing & EDR</h3></div><div class="flip-card-back"><button class="btn-close-card">&times;</button><h4>Détails</h4><p>Identifier comment l'informatique Edge peut être utilisé avec des technologies telles que EDR et le chiffrement pour renforcer la sécurité.</p></div></div></div>
                <div class="flip-card"><div class="flip-card-inner"><div class="flip-card-front"><div class="front-icon"><i class="fas fa-desktop"></i></div><h3>Sécurité des Postes de Travail</h3></div><div class="flip-card-back"><button class="btn-close-card">&times;</button><h4>Détails</h4><p>Explorer les meilleures pratiques pour sécuriser les postes de travail dans un environnement professionnel.</p></div></div></div>
                <div class="flip-card"><div class="flip-card-inner"><div class="flip-card-front"><div class="front-icon"><i class="fas fa-wifi"></i></div><h3>Sécurisation des Réseaux Wi-Fi</h3></div><div class="flip-card-back"><button class="btn-close-card">&times;</button><h4>Détails</h4><p>Explorer les meilleures pratiques pour sécuriser les réseaux sans fil Wi-Fi.</p></div></div></div>
                <div class="flip-card"><div class="flip-card-inner"><div class="flip-card-front"><div class="front-icon"><i class="fas fa-lock"></i></div><h3>Sécurisation des Bases de Données</h3></div><div class="flip-card-back"><button class="btn-close-card">&times;</button><h4>Détails</h4><p>Explorer les meilleures pratiques pour sécuriser l'accès aux bases de données sensibles.</p></div></div></div>
                <div class="flip-card"><div class="flip-card-inner"><div class="flip-card-front"><div class="front-icon"><i class="fas fa-brain"></i></div><h3>Machine Learning</h3></div><div class="flip-card-back"><button class="btn-close-card">&times;</button><h4>Détails</h4><p>Explorer les applications et les défis du Machine Learning dans les domaines de la science des données et de l'intelligence artificielle.</p></div></div></div>
                <div class="flip-card"><div class="flip-card-inner"><div class="flip-card-front"><div class="front-icon"><i class="fas fa-robot"></i></div><h3>Cybersécurité & IoT</h3></div><div class="flip-card-back"><button class="btn-close-card">&times;</button><h4>Détails</h4><p>Explorer les enjeux de sécurité liés à l'Internet des objets (IoT) et les mesures pour protéger les appareils contre les cyberattaques.</p></div></div></div>

                <!-- PAGE 3 -->
                <div class="flip-card"><div class="flip-card-inner"><div class="flip-card-front"><div class="front-icon"><i class="fas fa-industry"></i></div><h3>Cybersécurité Industrielle</h3></div><div class="flip-card-back"><button class="btn-close-card">&times;</button><h4>Détails</h4><p>Explorer les défis et les meilleures pratiques de la cybersécurité industrielle pour l'IoT et l'industrie 4.0.</p></div></div></div>
                <div class="flip-card"><div class="flip-card-inner"><div class="flip-card-front"><div class="front-icon"><i class="fas fa-cogs"></i></div><h3>DevOps & Transformation Digitale</h3></div><div class="flip-card-back"><button class="btn-close-card">&times;</button><h4>Détails</h4><p>Explorer comment DevOps peut favoriser la transformation numérique des entreprises et les avantages de cette approche.</p></div></div></div>
                <div class="flip-card"><div class="flip-card-inner"><div class="flip-card-front"><div class="front-icon"><i class="fas fa-user-shield"></i></div><h3>Protection Anti-DDOS</h3></div><div class="flip-card-back"><button class="btn-close-card">&times;</button><h4>Détails</h4><p>Explorer les risques d'attaques DDoS dans les environnements cloud, ainsi que les mesures préventives pour protéger les ressources.</p></div></div></div>
                <div class="flip-card"><div class="flip-card-inner"><div class="flip-card-front"><div class="front-icon"><i class="fas fa-key"></i></div><h3>Authentification Forte</h3></div><div class="flip-card-back"><button class="btn-close-card">&times;</button><h4>Détails</h4><p>Faire comprendre l'importance de l'authentification forte dans la protection des données et la réduction des risques de piratage.</p></div></div></div>
                <div class="flip-card"><div class="flip-card-inner"><div class="flip-card-front"><div class="front-icon"><i class="fas fa-bug"></i></div><h3>Bug Bounty & BYOD</h3></div><div class="flip-card-back"><button class="btn-close-card">&times;</button><h4>Détails</h4><p>Explorer les risques pour la sécurité des données associés à un bogue dans un environnement BYOD et les mesures pour éviter ces vulnérabilités.</p></div></div></div>
                <div class="flip-card"><div class="flip-card-inner"><div class="flip-card-front"><div class="front-icon"><i class="fas fa-user-check"></i></div><h3>Audit de Sécurité & Pentesting</h3></div><div class="flip-card-back"><button class="btn-close-card">&times;</button><h4>Détails</h4><p>Explorer les Méthodes de détection des vulnérabilités et faiblesses de sécurité du système via les tests d'intrusion.</p></div></div></div>
                <div class="flip-card"><div class="flip-card-inner"><div class="flip-card-front"><div class="front-icon"><i class="fas fa-archive"></i></div><h3>Archivage Électronique</h3></div><div class="flip-card-back"><button class="btn-close-card">&times;</button><h4>Détails</h4><p>Faire comprendre à tout DSI l'importance de l'archivage et de la gestion électronique des documents (GED).</p></div></div></div>
                <div class="flip-card"><div class="flip-card-inner"><div class="flip-card-front"><div class="front-icon"><i class="fas fa-chart-line"></i></div><h3>Analyse de Données & Big Data</h3></div><div class="flip-card-back"><button class="btn-close-card">&times;</button><h4>Détails</h4><p>Permettre aux DSI de comprendre comment l'analyse des données peut être utilisée pour améliorer les opérations et la prise de décision.</p></div></div></div>
            </div>

            <!-- PAGINATION -->
            <nav class="pagination-container" id="pagination-container">
                <ul class="pagination">
                    <!-- Les boutons de pagination seront générés par JavaScript -->
                </ul>
            </nav>

            <!-- SECTION PREMIUM PROGRAMMES D'EXCELLENCE -->
            @if($programs->count() > 0)
                <section class="excellence-section">                    
                    <div class="excellence-content">
                        <div class="excellence-header">
                            <h2>Programmes d'excellence</h2>
                            <p>Découvrez les programmes exclusifs ajoutés par notre équipe, conçus pour vous offrir une expérience d'apprentissage premium et innovante.</p>
                        </div>
                        
                        <div class="excellence-grid">
                            @foreach($programs as $program)
                                <div class="excellence-card">
                                    <div class="excellence-icon">
                                        <i class="{{ $program->display_icon }}"></i>
                                    </div>
                                    <h3 class="excellence-title">{{ $program->titre }}</h3>
                                    <p class="excellence-description">{{ $program->description }}</p>
                                    <div class="excellence-meta">
                                        <span class="excellence-date">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            {{ \Carbon\Carbon::parse($program->created_at)->format('d/m/Y') }}
                                        </span>
                                        <span class="excellence-status">
                                            {{ $program->status == 'actif' ? 'Actif' : 'Inactif' }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif


        </main>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // --- Logique pour l'animation des cartes 3D "Flip" ---
                const flipCards = document.querySelectorAll('.flip-card');
                flipCards.forEach(card => {
                    card.addEventListener('click', (event) => {
                        if (event.target.tagName === 'A') return;
                        card.classList.toggle('active');
                    });
                });

                // --- Logique pour la Pagination Intelligente ---
                const grid = document.getElementById('themes-grid');
                const cards = Array.from(grid.getElementsByClassName('flip-card'));
                const paginationContainer = document.getElementById('pagination-container').querySelector('.pagination');
                const itemsPerPage = 9; // MODIFIEZ ICI pour changer le nombre de cartes par page
                let currentPage = 1;
                const pageCount = Math.ceil(cards.length / itemsPerPage);

                function showPage(page) {
                    currentPage = page;
                    // Cache toutes les cartes
                    cards.forEach(card => card.classList.remove('visible'));

                    // Calcule les index de début et de fin
                    const startIndex = (page - 1) * itemsPerPage;
                    const endIndex = startIndex + itemsPerPage;

                    // Affiche seulement les cartes de la page actuelle
                    cards.slice(startIndex, endIndex).forEach(card => card.classList.add('visible'));

                    updatePaginationButtons();
                }

                function createPaginationButtons() {
                    // Bouton "Précédent"
                    let liPrev = document.createElement('li');
                    liPrev.classList.add('page-item');
                    liPrev.innerHTML = `<a class="page-link" href="#">Précédent</a>`;
                    liPrev.addEventListener('click', (e) => {
                        e.preventDefault();
                        if (currentPage > 1) showPage(currentPage - 1);
                    });
                    paginationContainer.appendChild(liPrev);

                    // Boutons numérotés
                    for (let i = 1; i <= pageCount; i++) {
                        let li = document.createElement('li');
                        li.classList.add('page-item');
                        li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
                        li.addEventListener('click', (e) => {
                            e.preventDefault();
                            showPage(i);
                        });
                        paginationContainer.appendChild(li);
                    }

                    // Bouton "Suivant"
                    let liNext = document.createElement('li');
                    liNext.classList.add('page-item');
                    liNext.innerHTML = `<a class="page-link" href="#">Suivant</a>`;
                    liNext.addEventListener('click', (e) => {
                        e.preventDefault();
                        if (currentPage < pageCount) showPage(currentPage + 1);
                    });
                    paginationContainer.appendChild(liNext);
                }

                function updatePaginationButtons() {
                    const pageItems = paginationContainer.querySelectorAll('.page-item');
                    pageItems.forEach((item, index) => {
                        // Gère l'état actif du bouton numéroté
                        if (index > 0 && index <= pageCount) {
                            if (index === currentPage) {
                                item.classList.add('active');
                            } else {
                                item.classList.remove('active');
                            }
                        }
                        // Gère l'état désactivé de "Précédent" et "Suivant"
                        if (index === 0) { // Bouton Précédent
                            item.classList.toggle('disabled', currentPage === 1);
                        }
                        if (index === pageCount + 1) { // Bouton Suivant
                            item.classList.toggle('disabled', currentPage === pageCount);
                        }
                    });
                }

                // Initialisation
                createPaginationButtons();
                showPage(1);
            });
        </script>

    </body>

@endsection
