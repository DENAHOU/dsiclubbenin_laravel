

<?php $__env->startSection('title', 'Conditions Générales'); ?>

<?php $__env->startSection('content'); ?>
<style>
    /* ========== Hero Section ========== */
    .hero-conditions {
        background: linear-gradient(135deg, #0a2b5c 0%, #094281 100%);
        height: 50vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        position: relative;
        overflow: hidden;
    }

    .hero-conditions::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: rgba(255, 193, 7, 0.1);
        border-radius: 50%;
    }

    .hero-conditions-content {
        text-align: center;
        z-index: 1;
    }

    .hero-conditions-title {
        font-size: 3rem;
        font-weight: bold;
        margin: 0;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .hero-conditions-subtitle {
        font-size: 1.1rem;
        margin-top: 1rem;
        opacity: 0.95;
    }

    /* ========== Sidebar Navigation ========== */
    .conditions-sidebar {
        position: sticky;
        top: 100px;
        height: fit-content;
    }

    .conditions-nav-card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        padding: 25px;
        border-left: 5px solid #ffc107;
    }

    .conditions-nav-card h5 {
        font-weight: bold;
        color: #094281;
        font-size: 1.1rem;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .conditions-nav-card h5 i {
        color: #ffc107;
        font-size: 1.3rem;
    }

    .conditions-nav-link {
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

    .conditions-nav-link:hover {
        background-color: #f8f9fa;
        border-left-color: #ffc107;
        padding-left: 20px;
        color: #ffc107;
    }

    /* ========== Content Sections ========== */
    .conditions-main-content {
        background: #fff;
        border-radius: 10px;
        padding: 40px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .conditions-intro {
        background: #f8f9fa;
        border-left: 4px solid #ffc107;
        padding: 20px;
        border-radius: 6px;
        margin-bottom: 30px;
        font-weight: 600;
        color: #094281;
    }

    .conditions-section {
        margin-bottom: 45px;
        padding-bottom: 30px;
        border-bottom: 1px solid #e9ecef;
    }

    .conditions-section:last-child {
        border-bottom: none;
    }

    .conditions-section-title {
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

    .conditions-section-title i {
        color: #ffc107;
        font-size: 1.5rem;
    }

    .conditions-section-text {
        color: #495057;
        line-height: 1.8;
        text-align: justify;
        font-size: 1rem;
        margin-bottom: 15px;
    }

    .conditions-section-text strong {
        color: #094281;
        font-weight: 600;
    }

    .conditions-section-text a {
        color: #094281;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .conditions-section-text a:hover {
        color: #ffc107;
        text-decoration: underline;
    }

    .conditions-list {
        list-style: none;
        padding-left: 0;
        margin: 20px 0;
    }

    .conditions-list li {
        padding: 12px 0 12px 35px;
        position: relative;
        color: #495057;
        margin-bottom: 10px;
        line-height: 1.7;
        text-align: justify;
    }

    .conditions-list li::before {
        content: '✓';
        position: absolute;
        left: 0;
        color: #29963a;
        font-weight: bold;
        font-size: 1.2rem;
    }

    /* ========== Back to Top Button ========== */
    .back-to-top-conditions {
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

    .back-to-top-conditions:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 16px rgba(9, 66, 129, 0.4);
    }

    .back-to-top-conditions.show {
        display: flex;
    }

    /* ========== CTA Section ========== */
    .conditions-cta {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border-radius: 10px;
        padding: 30px;
        margin-top: 40px;
        text-align: center;
        border-left: 5px solid #ffc107;
    }

    .conditions-cta h4 {
        color: #094281;
        font-weight: bold;
        margin-bottom: 20px;
        font-size: 1.3rem;
    }

    .conditions-cta-btn {
        background: linear-gradient(135deg, #094281, #0a2b5c);
        color: #fff;
        padding: 12px 30px;
        border-radius: 25px;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        font-weight: 600;
    }

    .conditions-cta-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(9, 66, 129, 0.3);
        color: #fff;
    }

    /* ========== Responsive Design ========== */
    @media (max-width: 991px) {
        .conditions-sidebar {
            position: static;
            margin-bottom: 30px;
        }

        .hero-conditions-title {
            font-size: 2rem;
        }

        .conditions-main-content {
            padding: 25px;
        }

        .conditions-nav-card {
            padding: 20px;
        }

        .back-to-top-conditions {
            width: 45px;
            height: 45px;
            bottom: 20px;
            right: 20px;
            font-size: 1rem;
        }
    }

    @media (max-width: 576px) {
        .hero-conditions-title {
            font-size: 1.5rem;
        }

        .conditions-main-content {
            padding: 15px;
        }

        .conditions-section-title {
            font-size: 1.2rem;
        }

        .conditions-nav-link {
            font-size: 0.9rem;
            padding: 8px 10px;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero-conditions">
    <div class="hero-conditions-content">
        <h1 class="hero-conditions-title">
            <i class="fas fa-file-contract"></i> CONDITIONS GÉNÉRALES
        </h1>
        <p class="hero-conditions-subtitle">Conditions d'utilisation du site Club DSI Bénin</p>
    </div>
</section>

<!-- Main Content -->
<div class="container mt-5 mb-5">
    <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-lg-3 mb-4">
            <div class="conditions-sidebar">
                <div class="conditions-nav-card">
                    <h5>
                        <i class="fas fa-list"></i> Sommaire
                    </h5>
                    <a href="#objet-services" class="conditions-nav-link">
                        Objet et services
                    </a>
                    <a href="#conditions-d'utilisation" class="conditions-nav-link">
                        Conditions d'utilisation
                    </a>
                    <a href="#protection-donnees" class="conditions-nav-link">
                        Protection des données
                    </a>
                    <a href="#propriete-intellectuelle" class="conditions-nav-link">
                        Propriété intellectuelle
                    </a>
                    <a href="#resiliation" class="conditions-nav-link">
                        Résiliation
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9">
            <div class="conditions-main-content">
                <!-- Introduction -->
                <div class="conditions-intro">
                    <i class="fas fa-info-circle me-2"></i>
                    VEUILLEZ LIRE ATTENTIVEMENT CES CONDITIONS GÉNÉRALES D'UTILISATION DU SITE AVANT TOUTE NAVIGATION 
                    ET UTILISATION DES SERVICES ACCESSIBLES AUX UTILISATEURS VIA LE SITE.
                </div>

                <!-- Section 1: Objet Services -->
                <div class="conditions-section" id="objet-services">
                    <h2 class="conditions-section-title">
                        <i class="fas fa-cog"></i> Objet et services
                    </h2>
                    <p class="conditions-section-text">
                        Les présentes conditions générales d'utilisation (les CGU) régissent l'utilisation et le 
                        fonctionnement du site internet <strong>CLUB DSI BENIN</strong>.
                    </p>
                    <p class="conditions-section-text">
                        Le Site est édité par la société 
                        <a href="https://www.technodatasolutions.bj/" target="_blank">
                            TECHNO DATA SOLUTIONS
                        </a> 
                        dont le siège social est situé Akpakpa Sodjèatinmey, lot 112 Immeuble, en face de la SOBEBRA 
                        COTONOU BENIN. Le Site est hébergé chez 
                        <a href="https://tdshosting.bj/" target="_blank">
                            TDS CLOUD
                        </a> 
                        à Cotonou, BENIN.
                    </p>
                    <p class="conditions-section-text">
                        Toute utilisation des services accessibles sur le Site implique l'acceptation sans restriction 
                        ni réserve des présentes CGU. En cas de désaccord avec tout ou partie des CGU, l'utilisation 
                        du Site et des Services n'est pas autorisée.
                    </p>
                    <p class="conditions-section-text">
                        Les CGU sont consultables sur cette page. Elles peuvent aussi être envoyées à l'Utilisateur sur 
                        sa demande, par courrier électronique à l'adresse : 
                        <a href="<?php echo e(route('contact')); ?>">
                            contact@clubdsibenin.bj
                        </a>.
                    </p>
                    <p class="conditions-section-text">
                        L'acceptation des CGU par l'Utilisateur est préalable à toute utilisation du Site, en cochant 
                        la case prévue à cet effet.
                    </p>
                    <p class="conditions-section-text">
                        <strong>CLUB DSI BENIN</strong> se réserve la possibilité de mettre à jour les présentes CGU 
                        à tout moment et d'apporter des modifications au Site et aux Services, notamment en cas 
                        d'évolution réglementaire ou technique. CLUB DSI BENIN en informera l'Utilisateur, qui pourra 
                        donner son accord sur les CGU et/ou les Services ainsi modifiés. À défaut, les CGU applicables 
                        à l'utilisation des Services par l'utilisateur resteront celles en vigueur à la date de son 
                        inscription sur le Site.
                    </p>
                </div>

                <!-- Section 2: Conditions d'utilisation -->
                <div class="conditions-section" id="conditions-d'utilisation">
                    <h2 class="conditions-section-title">
                        <i class="fas fa-scroll"></i> Conditions d'utilisation du site et d'accès aux services
                    </h2>
                    <p class="conditions-section-text">
                        L'utilisation du Site est gratuite pour l'Utilisateur, hors coûts éventuels de connexion, 
                        qui sont facturés par son opérateur directement à l'Utilisateur.
                    </p>
                    <p class="conditions-section-text">
                        L'Utilisateur s'oblige à utiliser le Site conformément à sa destination et à ne pas nuire ou 
                        tenter de nuire au bon fonctionnement du Site.
                    </p>
                    <p class="conditions-section-text">
                        <strong>L'Utilisateur est bien conscient et accepte :</strong>
                    </p>
                    <ul class="conditions-list">
                        <li>
                            Qu'il est seul responsable des Informations qu'il émet et renseigne sur le Site, ainsi que 
                            de tous contenus qu'il poste sur le Site, y compris ses contributions aux forums et 
                            discussions, ainsi que de toutes conséquences liées à leur divulgation sur le Site.
                        </li>
                        <li>
                            Qu'il utilise le Site à ses risques et périls. L'Utilisateur est conscient des limites 
                            d'Internet et accepte que, malgré toutes les mesures de sécurité prises par CLUB DSI BENIN 
                            pour sécuriser l'accès au Site, ne peut garantir toute absence d'intrusion frauduleuse sur 
                            le Site ou sur le système d'information de l'Utilisateur.
                        </li>
                        <li>
                            Que CLUB DSI BENIN décline toute responsabilité en cas d'altérations non autorisées, 
                            contaminations par des virus informatiques, ou fuites de programmes ou de données, notamment 
                            les Informations, identifiants, mots de passe. Il appartient à l'Utilisateur d'en faire 
                            toute sauvegarde éventuelle.
                        </li>
                        <li>
                            Que CLUB DSI BENIN ne saurait être tenue responsable de toute interruption et/ou 
                            dysfonctionnement du Site et/ou des Services, quelle qu'en soit la cause.
                        </li>
                        <li>
                            Que CLUB DSI BENIN n'est aucunement partie aux éventuels échanges et relations 
                            contractuelles entre l'Utilisateur et les Recruteurs et qu'elle ne saurait encourir de 
                            responsabilité s'y rapportant.
                        </li>
                    </ul>
                    <p class="conditions-section-text">
                        En cas de non-respect des présentes CGU, notamment en cas de fausses informations ou de 
                        non-respect des obligations décrites aux présentes ou des réglementations applicables, l'accès 
                        aux Services pourra être suspendu, et CLUB DSI BENIN pourra mettre fin, en tout ou partie, à 
                        l'accès au Site, l'accès aux Services et retirer toutes Informations, sans préavis et sans 
                        préjudice ni indemnité, ce sans préjudice de tous dommages-intérêts auxquels CLUB DSI BENIN 
                        pourra prétendre.
                    </p>
                </div>

                <!-- Section 3: Protection des données personnelles -->
                <div class="conditions-section" id="protection-donnees">
                    <h2 class="conditions-section-title">
                        <i class="fas fa-shield-alt"></i> Protection des données personnelles
                    </h2>
                    <p class="conditions-section-text">
                        La collecte et le traitement de données à caractère personnel communiquées par l'Utilisateur 
                        au moyen du Site (les Données) répondent aux exigences légales en matière de protection de 
                        données à caractère personnel, et en particulier au Règlement Général pour la Protection des 
                        Données à caractère personnel (RGPD), à la loi n°78-17 du 6 janvier 1978 modifiée par la loi 
                        du 20 juin 2018 n° 2018-493 et l'Ordonnance n°2018-1125 du 12 décembre 2018.
                    </p>
                    <p class="conditions-section-text">
                        En application de cette réglementation, il est précisé que les données à caractère personnel 
                        demandées à l'Utilisateur et fournies par lui sont indispensables à l'exécution des Services 
                        auxquels il a souscrit.
                    </p>
                    <p class="conditions-section-text">
                        L'Utilisateur consent à la transmission de ses Informations et Contenus, notamment ses 
                        données à caractère personnel, aux Recruteurs, ainsi qu'aux membres administrateurs de la 
                        communauté.
                    </p>
                    <p class="conditions-section-text">
                        <strong>Les règles de protection des données à caractère personnel des Utilisateurs sont 
                        énoncées dans la politique de protection des données du Site</strong>, qui fait partie 
                        intégrante des présentes CGU et qui est consultable 
                        <a href="<?php echo e(route('protection-donnees')); ?>">
                            ici
                        </a>. 
                        Vous êtes priés de vous y reporter avant toute inscription sur le Site.
                    </p>
                </div>

                <!-- Section 4: Propriété intellectuelle -->
                <div class="conditions-section" id="propriete-intellectuelle">
                    <h2 class="conditions-section-title">
                        <i class="fas fa-copyright"></i> Propriété intellectuelle
                    </h2>
                    <p class="conditions-section-text">
                        Le Site, tous les éléments du Site tels que éléments logiciels, API, textes, images, vidéos, 
                        mise en page, charte graphique, logo, noms de domaine, et les marques, logos et marques de 
                        services qui apparaissent sur ce Site sont la propriété de <strong>CLUB DSI BENIN</strong> 
                        ou de ses partenaires et protégés par des droits de propriété intellectuelle.
                    </p>
                    <p class="conditions-section-text">
                        <strong>Toute reproduction</strong>, diffusion, représentation, combinaison ou modification, 
                        adaptation, correction, traduction en toutes langues, totale ou partielle, d'un élément 
                        quelconque du Site ou des Services est interdite.
                    </p>
                    <p class="conditions-section-text">
                        Toute infraction de l'Utilisateur aux dispositions des présentes constituerait un délit de 
                        contrefaçon passible de poursuites. Les droits référencés ci-dessus sont à titre informatif 
                        et non limitatifs.
                    </p>
                </div>

                <!-- Section 5: Résiliation -->
                <div class="conditions-section" id="resiliation">
                    <h2 class="conditions-section-title">
                        <i class="fas fa-times-circle"></i> Résiliation
                    </h2>
                    <p class="conditions-section-text">
                        L'inscription aux Services est valable pour une durée indéterminée, à compter de la date de 
                        création de son compte par l'Utilisateur. Chaque partie peut mettre fin à l'utilisation du 
                        Site à tout moment.
                    </p>
                    <p class="conditions-section-text">
                        <strong>Conformément à la réglementation et à la politique de protection des données de 
                        CLUB DSI BENIN :</strong>
                    </p>
                    <ul class="conditions-list">
                        <li>
                            Si l'Utilisateur demande la suppression de ses données à caractère personnel, celles-ci 
                            seront effacées dans le délai de quinze (15) jours à compter de la réception par 
                            CLUB DSI BENIN de la demande de l'Utilisateur, accompagnée d'un justificatif d'identité 
                            probant. Dans un tel cas, CLUB DSI BENIN ne pourra pas poursuivre l'exécution des 
                            Services éventuellement souscrits.
                        </li>
                        <li>
                            À l'issue de cette période, les Informations de l'Utilisateur seront conservées en 
                            archivage intermédiaire conformément à la loi et aux délais de prescription, afin de 
                            permettre à CLUB DSI BENIN de défendre ses intérêts en cas de contentieux. Elles seront 
                            ensuite détruites ou anonymisées.
                        </li>
                    </ul>
                </div>

                <!-- CTA Section -->
                <div class="conditions-cta">
                    <h4>
                        <i class="fas fa-question-circle"></i> Des questions sur ces conditions générales ?
                    </h4>
                    <p style="color: #495057; margin-bottom: 20px;">
                        Nous sommes à votre disposition pour clarifier toute question concernant nos conditions 
                        générales d'utilisation.
                    </p>
                    <a href="<?php echo e(route('contact')); ?>" class="conditions-cta-btn">
                        <i class="fas fa-envelope"></i> Nous contacter
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Back to Top Button -->
<button class="back-to-top-conditions" id="backToTopConditions">
    <i class="fas fa-arrow-up"></i>
</button>

<script>
    // Smooth scroll for navigation links
    document.querySelectorAll('.conditions-nav-link').forEach(link => {
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
    const backToTopBtn = document.getElementById('backToTopConditions');
    
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/politique/conditions-generales.blade.php ENDPATH**/ ?>