@extends('layouts.guest')

@section('title', 'Utilisation des Cookies')

@section('content')
<style>
    /* ========== Hero Section ========== */
    .hero-cookies {
        background: linear-gradient(135deg, #0a2b5c 0%, #094281 100%);
        height: 50vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        position: relative;
        overflow: hidden;
    }

    .hero-cookies::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: rgba(255, 193, 7, 0.1);
        border-radius: 50%;
    }

    .hero-cookies-content {
        text-align: center;
        z-index: 1;
    }

    .hero-cookies-title {
        font-size: 3rem;
        font-weight: bold;
        margin: 0;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .hero-cookies-subtitle {
        font-size: 1.1rem;
        margin-top: 1rem;
        opacity: 0.95;
    }

    /* ========== Sidebar Navigation ========== */
    .cookies-sidebar {
        position: sticky;
        top: 100px;
        height: fit-content;
    }

    .cookies-nav-card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        padding: 25px;
        border-left: 5px solid #ffc107;
    }

    .cookies-nav-card h5 {
        font-weight: bold;
        color: #094281;
        font-size: 1.1rem;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .cookies-nav-card h5 i {
        color: #ffc107;
        font-size: 1.3rem;
    }

    .cookies-nav-link {
        display: block;
        padding: 12px 15px;
        margin-bottom: 8px;
        color: #094281;
        text-decoration: none;
        border-radius: 6px;
        transition: all 0.3s ease;
        font-size: 0.95rem;
        border-left: 3px solid transparent;
    }

    .cookies-nav-link:hover {
        background-color: #f8f9fa;
        border-left-color: #ffc107;
        padding-left: 20px;
        color: #ffc107;
    }

    /* ========== Content Sections ========== */
    .cookies-main-content {
        background: #fff;
        border-radius: 10px;
        padding: 40px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .cookies-section {
        margin-bottom: 45px;
        padding-bottom: 30px;
        border-bottom: 1px solid #e9ecef;
    }

    .cookies-section:last-child {
        border-bottom: none;
    }

    .cookies-section-title {
        color: #094281;
        font-size: 1.6rem;
        font-weight: bold;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        padding-bottom: 12px;
        border-bottom: 3px solid #ffc107;
    }

    .cookies-section-title i {
        color: #ffc107;
        font-size: 1.5rem;
    }

    .cookies-section-text {
        color: #495057;
        line-height: 1.8;
        text-align: justify;
        font-size: 1rem;
        margin-bottom: 15px;
    }

    .cookies-section-text strong {
        color: #094281;
        font-weight: 600;
    }

    .cookies-list {
        list-style: none;
        padding-left: 0;
        margin: 20px 0;
    }

    .cookies-list li {
        padding: 12px 0 12px 35px;
        position: relative;
        color: #495057;
        margin-bottom: 10px;
        line-height: 1.7;
    }

    .cookies-list li::before {
        content: '✓';
        position: absolute;
        left: 0;
        color: #29963a;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .cookies-links-list a {
        color: #094281;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .cookies-links-list a:hover {
        color: #ffc107;
        text-decoration: underline;
    }

    /* ========== Back to Top Button ========== */
    .back-to-top-cookies {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #094281, #ffc107);
        color: #fff;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        display: none;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(9, 66, 129, 0.3);
        z-index: 1000;
    }

    .back-to-top-cookies:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 16px rgba(9, 66, 129, 0.4);
    }

    .back-to-top-cookies.show {
        display: flex;
    }

    /* ========== CTA Section ========== */
    .cookies-cta {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border-radius: 10px;
        padding: 30px;
        margin-top: 40px;
        text-align: center;
        border-left: 5px solid #ffc107;
    }

    .cookies-cta h4 {
        color: #094281;
        font-weight: bold;
        margin-bottom: 20px;
        font-size: 1.3rem;
    }

    .cookies-cta-btn {
        background: linear-gradient(135deg, #094281, #0a2b5c);
        color: #fff;
        padding: 12px 30px;
        border-radius: 25px;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        font-weight: 600;
    }

    .cookies-cta-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(9, 66, 129, 0.3);
        color: #fff;
    }

    /* ========== Responsive Design ========== */
    @media (max-width: 991px) {
        .cookies-sidebar {
            position: static;
            margin-bottom: 30px;
        }

        .hero-cookies-title {
            font-size: 2rem;
        }

        .cookies-main-content {
            padding: 25px;
        }

        .cookies-nav-card {
            padding: 20px;
        }

        .back-to-top-cookies {
            width: 45px;
            height: 45px;
            bottom: 20px;
            right: 20px;
            font-size: 1rem;
        }
    }

    @media (max-width: 576px) {
        .hero-cookies-title {
            font-size: 1.5rem;
        }

        .cookies-main-content {
            padding: 15px;
        }

        .cookies-section-title {
            font-size: 1.2rem;
        }

        .cookies-nav-link {
            font-size: 0.9rem;
            padding: 8px 10px;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero-cookies">
    <div class="hero-cookies-content">
        <h1 class="hero-cookies-title">
            <i class="fas fa-cookie"></i> UTILISATION DES COOKIES
        </h1>
        <p class="hero-cookies-subtitle">Comprendre comment nous utilisons les cookies pour améliorer votre expérience</p>
    </div>
</section>

<!-- Main Content -->
<div class="container mt-5 mb-5">
    <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-lg-3 mb-4">
            <div class="cookies-sidebar">
                <div class="cookies-nav-card">
                    <h5>
                        <i class="fas fa-list"></i> Sommaire
                    </h5>
                    <a href="#les-cookies-et-autres-technologies-similaires" class="cookies-nav-link">
                        Les cookies et autres technologies similaires
                    </a>
                    <a href="#les-cookies-expirent-ils" class="cookies-nav-link">
                        Les cookies expirent-ils ?
                    </a>
                    <a href="#comment-désactiver-les-cookies" class="cookies-nav-link">
                        Comment désactiver les cookies
                    </a>
                    <a href="#quels-cookies-utilisons-nous" class="cookies-nav-link">
                        Quels cookies utilisons-nous ?
                    </a>
                    <a href="#les-cookies-nécessaires" class="cookies-nav-link">
                        Les cookies nécessaires
                    </a>
                    <a href="#les-cookies-de-fonctionnalité" class="cookies-nav-link">
                        Les cookies de fonctionnalité
                    </a>
                    <a href="#les-cookies-de-performance" class="cookies-nav-link">
                        Les cookies de performance
                    </a>
                    <a href="#consentement-cookies" class="cookies-nav-link">
                        Consentement pour les cookies
                    </a>
                    <a href="#liste-des-cookies" class="cookies-nav-link">
                        Liste des cookies
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9">
            <div class="cookies-main-content">
                <!-- Introduction -->
                <div class="cookies-section">
                    <h2 class="cookies-section-title">
                        <i class="fas fa-info-circle"></i> Notre utilisation des cookies
                    </h2>
                    <p class="cookies-section-text">
                        Chez <strong>CLUB DSI BENIN</strong>, nos partenaires et nous utilisons des cookies et d'autres technologies similaires. 
                        Ces cookies nous permettent de garantir le bon fonctionnement, l'analyse et l'amélioration de nos sites Web, 
                        nos applications et nos communications. Ils nous permettent également de personnaliser votre expérience sur 
                        <strong>CLUB DSI BENIN</strong>, notamment en vous proposant des contenus pertinents. 
                        Pour mieux comprendre ce que cela signifie pour vous, veuillez également consulter notre 
                        <a href="{{ route('protection-donnees') }}" style="color: #094281; font-weight: 600;">politique de confidentialité</a>.
                    </p>
                </div>

                <!-- Section 1 -->
                <div class="cookies-section" id="les-cookies-et-autres-technologies-similaires">
                    <h2 class="cookies-section-title">
                        <i class="fas fa-code"></i> Les cookies et autres technologies similaires
                    </h2>
                    <p class="cookies-section-text">
                        Les cookies et autres technologies similaires permettent de personnaliser votre expérience en ligne, 
                        notamment en affichant des contenus basés sur vos préférences lorsque vous naviguez sur d'autres sites Web 
                        ou applications. Ils nous aident également à mieux comprendre comment vous utilisez nos services 
                        (site Web, applications) et nos e-mails. Enfin, ils vous font gagner du temps en se souvenant de vos 
                        informations pour vous.
                    </p>
                    <p class="cookies-section-text">
                        <strong>Comment fonctionnent-ils ?</strong>
                    </p>
                    <p class="cookies-section-text">
                        Les cookies sont de petits fichiers conservés sur votre appareil, souvent dotés d'un identifiant unique. 
                        Ils stockent de petites quantités de données chaque fois que vous consultez un site Web.
                    </p>
                    <p class="cookies-section-text">
                        Les cookies recueillent, sauvegardent et partagent des informations vous concernant et/ou concernant votre 
                        appareil lorsque vous consultez un site Web, une application ou un e-mail. Ces informations peuvent comprendre :
                    </p>
                    <ul class="cookies-list">
                        <li>Vos préférences de langue</li>
                        <li>Vos identifiants de connexion</li>
                        <li>Le type d'appareil et/ou de navigateur que vous utilisez</li>
                        <li>L'heure et la date de vos visites</li>
                        <li>La manière dont vous utilisez le site Web ou l'application</li>
                    </ul>
                    <p class="cookies-section-text">
                        Nous utilisons des <strong>cookies internes</strong> qui sont configurés par nos soins afin de recueillir 
                        vos informations. Pour en savoir plus sur les cookies, veuillez consulter 
                        <a href="https://www.allaboutcookies.org/fr/" target="_blank" style="color: #094281; font-weight: 600;">
                            AllAboutCookies.org
                        </a>.
                    </p>
                </div>

                <!-- Section 2 -->
                <div class="cookies-section" id="les-cookies-expirent-ils">
                    <h2 class="cookies-section-title">
                        <i class="fas fa-hourglass-end"></i> Les cookies expirent-ils ?
                    </h2>
                    <p class="cookies-section-text">
                        Les cookies ont généralement une date de validité qui détermine la durée pendant laquelle ils seront 
                        conservés dans votre navigateur ou votre appareil :
                    </p>
                    <ul class="cookies-list">
                        <li><strong>Cookies de session :</strong> Ce sont des cookies temporaires qui expirent automatiquement 
                            lorsque vous fermez votre navigateur.</li>
                        <li><strong>Cookies permanents :</strong> Ils sont habituellement conservés dans votre navigateur pour une 
                            période définie ou jusqu'à ce que vous les supprimiez manuellement.</li>
                    </ul>
                </div>

                <!-- Section 3 -->
                <div class="cookies-section" id="comment-désactiver-les-cookies">
                    <h2 class="cookies-section-title">
                        <i class="fas fa-ban"></i> Comment désactiver les cookies
                    </h2>
                    <p class="cookies-section-text">
                        Vous pouvez gérer et supprimer les cookies depuis la plupart des navigateurs Internet en modifiant 
                        vos paramètres de cookies. Voici les instructions par navigateur :
                    </p>
                    
                    <p><strong>Navigateurs Desktop :</strong></p>
                    <ul class="cookies-list cookies-links-list">
                        <li><a href="https://support.google.com/chrome/answer/95647?co=GENIE.Platform%3DDesktop" target="_blank">
                            <i class="fab fa-chrome"></i> Google Chrome
                        </a></li>
                        <li><a href="https://support.mozilla.org/fr/kb/effacer-cookies-donnees-site-firefox" target="_blank">
                            <i class="fab fa-firefox"></i> Firefox
                        </a></li>
                        <li><a href="https://support.apple.com/fr-fr/guide/safari/sfri11471/mac" target="_blank">
                            <i class="fab fa-safari"></i> Safari
                        </a></li>
                        <li><a href="https://support.microsoft.com/fr-fr/windows/supprimer-et-g%C3%A9rer-les-cookies-168dab11-0753-043d-7c16-ede5947fc64d" target="_blank">
                            <i class="fab fa-edge"></i> Edge
                        </a></li>
                    </ul>

                    <p><strong>Navigateurs Mobile :</strong></p>
                    <ul class="cookies-list cookies-links-list">
                        <li><a href="https://support.google.com/chrome/answer/95647?co=GENIE.Platform%3DAndroid" target="_blank">
                            <i class="fab fa-chrome"></i> Chrome pour Android
                        </a></li>
                        <li><a href="https://support.mozilla.org/fr/kb/supprimer-historique-navigation-et-autres-donnees-personnelles-firefox-android" target="_blank">
                            <i class="fab fa-firefox"></i> Firefox pour Android
                        </a></li>
                        <li><a href="https://support.apple.com/fr-fr/HT201265" target="_blank">
                            <i class="fab fa-apple"></i> Safari pour iOS
                        </a></li>
                    </ul>
                </div>

                <!-- Section 4 -->
                <div class="cookies-section" id="quels-cookies-utilisons-nous">
                    <h2 class="cookies-section-title">
                        <i class="fas fa-boxes"></i> Quels cookies utilisons-nous ?
                    </h2>
                    <p class="cookies-section-text">
                        Pour des informations plus générales sur notre utilisation des cookies, veuillez 
                        consulter les sections ci-dessous détaillant chaque type de cookie que nous utilisons.
                    </p>
                </div>

                <!-- Section 5 -->
                <div class="cookies-section" id="les-cookies-nécessaires">
                    <h2 class="cookies-section-title">
                        <i class="fas fa-shield-alt"></i> Les cookies nécessaires
                    </h2>
                    <p class="cookies-section-text">
                        Ces cookies sont <strong>nécessaires au bon fonctionnement d'un site Web ou d'un service</strong>. 
                        Nous ne pouvons pas les désactiver dans nos systèmes. Ils sont généralement activés en réponse à une 
                        action de votre part équivalant à une demande de service, notamment :
                    </p>
                    <ul class="cookies-list">
                        <li>Configuration de vos préférences de confidentialité</li>
                        <li>Connexion à votre compte</li>
                        <li>Remplissage de formulaires</li>
                    </ul>
                    <p class="cookies-section-text">
                        Vous pouvez configurer votre navigateur afin qu'il bloque ces cookies ou qu'il vous en avertisse, 
                        mais cela empêchera le fonctionnement correct de certaines pages de ce site.
                    </p>
                </div>

                <!-- Section 6 -->
                <div class="cookies-section" id="les-cookies-de-fonctionnalité">
                    <h2 class="cookies-section-title">
                        <i class="fas fa-sliders-h"></i> Les cookies de fonctionnalité
                    </h2>
                    <p class="cookies-section-text">
                        Ces cookies permettent au site Web ou service de proposer une <strong>meilleure fonctionnalité et une 
                        meilleure personnalisation</strong> de votre utilisation de notre site. Ils mémorisent les choix que 
                        vous effectuez pour vous offrir une expérience personnalisée.
                    </p>
                    <p class="cookies-section-text">
                        Si vous n'autorisez pas ces cookies, certains voire tous nos services risquent de ne pas fonctionner 
                        correctement et vous ne pourrez pas bénéficier de la personnalisation offerte.
                    </p>
                </div>

                <!-- Section 7 -->
                <div class="cookies-section" id="les-cookies-de-performance">
                    <h2 class="cookies-section-title">
                        <i class="fas fa-chart-line"></i> Les cookies de performance
                    </h2>
                    <p class="cookies-section-text">
                        Ces cookies nous permettent de <strong>comptabiliser le nombre de visites et les sources de trafic</strong> 
                        afin de mesurer et d'améliorer la performance de notre site et de nos services digitaux. 
                        Ils nous aident à déterminer :
                    </p>
                    <ul class="cookies-list">
                        <li>Les pages les plus ou moins consultées</li>
                        <li>Comment les utilisateurs se déplacent sur notre site</li>
                        <li>Les sources de trafic principal</li>
                        <li>Les opportunités d'amélioration</li>
                    </ul>
                    <p class="cookies-section-text">
                        Si vous n'autorisez pas ces cookies, nous ne pourrons pas savoir quand vous avez visité ou utilisé 
                        notre site, et nous ne pourrons alors pas non plus surveiller la performance de notre site ou service.
                    </p>
                </div>

                <!-- Section 8 -->
                <div class="cookies-section" id="consentement-cookies">
                    <h2 class="cookies-section-title">
                        <i class="fas fa-handshake"></i> Avez-vous besoin de mon consentement ?
                    </h2>
                    <p class="cookies-section-text">
                        <strong>Dans la majorité des cas, nous avons besoin de votre consentement</strong> pour utiliser 
                        des cookies. Vous ne nous le donner pas si vous ne le souhaitez pas.
                    </p>
                    <p class="cookies-section-text">
                        Cependant, <strong>nous n'avons pas besoin de votre consentement</strong> lorsque nous utilisons 
                        des cookies essentiels ou nécessaires au fonctionnement du site. Vous pouvez néanmoins choisir de 
                        les bloquer ou de les effacer via vos paramètres de navigateur.
                    </p>
                    <p class="cookies-section-text">
                        Si vous refusez nos cookies non-essentiels, cela ne vous empêchera pas d'utiliser le site, mais 
                        certaines fonctionnalités de personnalisation pourront ne pas être disponibles.
                    </p>
                </div>

                <!-- Section 9 -->
                <div class="cookies-section" id="liste-des-cookies">
                    <h2 class="cookies-section-title">
                        <i class="fas fa-list-check"></i> Liste de nos cookies
                    </h2>
                    <p class="cookies-section-text">
                        <strong>Cookies strictement nécessaires :</strong>
                    </p>
                    <p class="cookies-section-text">
                        Ces cookies sont nécessaires au fonctionnement du site Web et ne peuvent pas être désactivés dans nos 
                        systèmes. Ils sont généralement établis en tant que réponse à des actions que vous avez effectuées et qui 
                        constituent une demande de services, telles que :
                    </p>
                    <ul class="cookies-list">
                        <li>La définition de vos préférences en matière de confidentialité</li>
                        <li>La connexion à votre compte</li>
                        <li>Le remplissage de formulaires</li>
                        <li>La gestion de votre panier d'achat</li>
                    </ul>
                    <p class="cookies-section-text">
                        Vous pouvez configurer votre navigateur afin de bloquer ou être informé de l'existence de ces cookies, 
                        mais certaines parties du site Web peuvent être affectées. <strong>Ces cookies ne stockent aucune 
                        information d'identification personnelle</strong>.
                    </p>

                    <p class="cookies-section-text mt-4">
                        <strong>Cookies de fonctionnalité :</strong>
                    </p>
                    <p class="cookies-section-text">
                        Ces cookies permettent d'améliorer et de personnaliser les fonctionnalités du site Web. 
                        Ils peuvent être activés par nos équipes, ou par des tiers dont les services are utilisés sur 
                        les pages de notre site Web.
                    </p>
                    <p class="cookies-section-text">
                        Si vous n'acceptez pas ces cookies, une partie ou la totalité de ces services risquent de ne pas 
                        fonctionner correctement.
                    </p>
                </div>

                <!-- CTA Section -->
                <div class="cookies-cta">
                    <h4>
                        <i class="fas fa-question-circle"></i> Des questions sur notre politique de cookies ?
                    </h4>
                    <p style="color: #495057; margin-bottom: 20px;">
                        N'hésitez pas à nous contacter pour toute clarification concernant notre utilisation des cookies.
                    </p>
                    <a href="{{ route('contact') }}" class="cookies-cta-btn">
                        <i class="fas fa-envelope"></i> Nous contacter
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Back to Top Button -->
<button class="back-to-top-cookies" id="backToTopCookies">
    <i class="fas fa-arrow-up"></i>
</button>

<script>
    // Smooth scroll for navigation links
    document.querySelectorAll('.cookies-nav-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Back to Top Button
    const backToTopBtn = document.getElementById('backToTopCookies');
    
    window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            backToTopBtn.classList.add('show');
        } else {
            backToTopBtn.classList.remove('show');
        }
    });

    backToTopBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
</script>
@endsection
