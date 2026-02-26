@extends('layouts.guest')

@section('title', 'Protection de données')

@section('content')
<!-- Hero Section -->
<section class="hero-protection-donnees" style="background: linear-gradient(135deg, #0a2b5c 0%, #094281 100%); height: 50vh; display: flex; align-items: center; justify-content: center;">
    <div class="text-center">
        <h1 class="fw-bold" style="font-size: 3.5rem; color: #fff; margin: 0;">
            <i class="fas fa-lock me-3" style="color: #ffc107;"></i>PROTECTION DES DONNÉES
        </h1>
        <p class="mt-3" style="color: #c9d4e5; font-size: 1.1rem;">Votre confidentialité est notre priorité</p>
    </div>
</section>

<!-- Main Content -->
<div class="container my-5">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-9">
            <div class="policy-content">
                <!-- Title -->
                <h2 class="text-center fw-bold mb-5" id="cookie-ban" style="color: #094281; font-size: 2rem;">
                    POLITIQUE DE PROTECTION DES DONNÉES À CARACTÈRE PERSONNEL
                </h2>

                <!-- Intro Paragraphs -->
                <div style="text-align: justify; line-height: 1.8; color: #333;">
                    <p class="mb-4">
                        CLUB DSI BENIN met périodiquement cette politique de protection des données personnelles à jour, 
                        en fonction des évolutions techniques et réglementaires applicables. Nous vous conseillons de consulter 
                        régulièrement cette page pour prendre connaissance d'éventuelles modifications ou mises à jour apportées 
                        à notre politique. En cas de modification substantielle, CLUB DSI BENIN s'engage à en informer les 
                        personnes concernées.
                    </p>

                    <p class="mb-5">
                        La présente politique de confidentialité décrit comment CLUB DSI BENIN, dont le siège social est 
                        Immeuble Bouaké, Avenue Steinmetz, rue après le Festival des Glaces en allant à Ganhi collecte, 
                        utilise et protège les Données à caractère personnel que vous nous confiez, en conformité avec les 
                        exigences de la réglementation applicable au Bénin, et plus particulièrement le Règlement Général 
                        sur la Protection des Données (UE) 2016/679 (RGPD).
                    </p>

                    <!-- Section 1 -->
                    <h3 id="engagements-club-dsi-benin" style="color: #094281; font-weight: 600; margin-top: 2.5rem; margin-bottom: 1.5rem; border-left: 4px solid #ffc107; padding-left: 1rem;">
                        Engagements de CLUB DSI BENIN
                    </h3>
                    <p class="mb-4">
                        Dans tous les cas CLUB DSI BENIN est susceptible de collecter et/ou de traiter des données à caractère 
                        personnel se rapportant aux Utilisateurs de ses Services ou visiteurs de son Site, CLUB DSI BENIN prend 
                        les engagements et met en place les mesures suivantes, conformément à la Réglementation :
                    </p>

                    <!-- Section 2 -->
                    <h3 id="un-traitement-loyal-et-transparent" style="color: #094281; font-weight: 600; margin-top: 2.5rem; margin-bottom: 1.5rem; border-left: 4px solid #ffc107; padding-left: 1rem;">
                        Un traitement loyal et transparent
                    </h3>
                    <p class="mb-4">
                        Nous ne collectons pas d'informations personnelles vous concernant sans vous en informer. Soyez assurés 
                        que nous nous engageons à ne pas vendre, céder, faire commerce ou autrement partager vos Données, sauf 
                        à solliciter pour cela votre accord préalable exprès.
                    </p>

                    <!-- Section 3 -->
                    <h3 id="un-traitement-pertinent-et-limité" style="color: #094281; font-weight: 600; margin-top: 2.5rem; margin-bottom: 1.5rem; border-left: 4px solid #ffc107; padding-left: 1rem;">
                        Un traitement pertinent et limité
                    </h3>
                    <p class="mb-4">
                        Nous limitons les traitements de données personnelles que nous effectuons à ceux qui sont nécessaires et 
                        pertinents au regard de leurs finalités légitimes et nous veillons à clairement identifier celles-ci et 
                        à en informer les personnes concernées avant toute collecte.
                    </p>
                    <p class="mb-4">
                        Plus précisément, nous collectons les Données de nos Utilisateurs du Site pour vous permettre d'utiliser 
                        nos services de recueil de candidatures et de mise en relation avec des recruteurs, la communication entre 
                        les entreprises du service numérique ou encore entre les membres de notre communauté comme décrit dans nos 
                        <a href="{{ route('home') }}" style="color: #094281; font-weight: 500;">CGU</a>.
                    </p>
                    <p class="mb-4">
                        Nous prenons soin de ne collecter que les informations dont nous avons besoin à cet effet. Dans le cadre 
                        du développement de nos services et des activités de notre Site, nous avons soigneusement pris en compte 
                        la nécessité de définir les modes de traitement les plus protecteurs des droits des personnes concernées, 
                        nous efforçant, chaque fois que possible, de proposer par défaut, l'option ayant le moins d'impact sur ceux-ci.
                    </p>

                    <!-- Section 4 -->
                    <h3 id="un-traitement-confidentiel-et-sécurisé" style="color: #094281; font-weight: 600; margin-top: 2.5rem; margin-bottom: 1.5rem; border-left: 4px solid #ffc107; padding-left: 1rem;">
                        Un traitement confidentiel et sécurisé
                    </h3>
                    <p class="mb-4">
                        Nous définissons et nous mettons en œuvre un ensemble de mesures techniques et organisationnelles destinées 
                        à protéger la confidentialité et l'intégrité de vos données, et pour les protéger contre toutes pertes, vols, 
                        détérioration et utilisations frauduleuses ainsi qu'à vous permettre d'exercer vos droits. Ces mesures sont 
                        régulièrement mises à jour. Notre personnel dédié est formé et a souscrit les engagements de confidentialité requis.
                    </p>
                    <p class="mb-4">
                        Votre compte utilisateur est protégé par un mot de passe de façon à ce que chaque Utilisateur soit le seul 
                        à avoir accès à ses informations. Pour nous aider à protéger la confidentialité et l'intégrité de vos données, 
                        nous vous recommandons de ne pas divulguer votre mot de passe, ni votre login. Vous êtes le seul responsable 
                        de la préservation et de la confidentialité de votre mot de passe et/ou de toute information en rapport avec 
                        votre compte. Vous êtes bien conscient des risques inhérents à internet et nous vous remercions de faire preuve 
                        de prudence et de responsabilité chaque fois que vous êtes en ligne.
                    </p>
                    <p class="mb-5">
                        CLUB DSI BENIN ne vous demandera jamais votre mot de passe via un appel téléphonique ou un e-mail non sollicité. 
                        Vous devez en outre, ne pas oublier de vous déconnecter et de fermer la fenêtre de votre navigateur à l'issue de 
                        votre session de travail si vous utilisez un ordinateur ne vous appartenant pas (Cybercafé, au travail, chez des amis…).
                    </p>

                    <!-- Section 5 -->
                    <h3 id="des-transferts-strictement-encadrés" style="color: #094281; font-weight: 600; margin-top: 2.5rem; margin-bottom: 1.5rem; border-left: 4px solid #ffc107; padding-left: 1rem;">
                        Des transferts strictement encadrés
                    </h3>
                    <p class="mb-5">
                        Vos données sont hébergées sur des serveurs dédiés situés dans le DATA CENTER NATIONAL. Leur traitement est, 
                        conformément à la Réglementation, réalisé exclusivement sur le territoire d'un Etat Membre de l'Union Africaine. 
                        Le prestataire TDS CLOUD a mis en place des garanties supplémentaires pour protéger les Données que nous lui 
                        confions en cas de demande d'accès d'autorités gouvernementales pouvant donner lieu à un transfert de vos Données 
                        en dehors de l'Union Africaine.
                    </p>

                    <!-- Section 6 -->
                    <h3 id="données-des-utilisateurs-du-site" style="color: #094281; font-weight: 600; margin-top: 2.5rem; margin-bottom: 1.5rem; border-left: 4px solid #ffc107; padding-left: 1rem;">
                        Catégories de données à caractère personnel collectées
                    </h3>
                    <p class="mb-3"><strong>Données des Utilisateurs du Site :</strong></p>
                    <ul style="color: #555; line-height: 2; margin-bottom: 2rem;">
                        <li><i class="fas fa-check-circle me-2" style="color: #29963a;"></i>Données d'identification : nom, prénom, adresse email, téléphones</li>
                        <li><i class="fas fa-check-circle me-2" style="color: #29963a;"></i>Données professionnelles : profession, formation, secteur, références professionnelles, domaines d'expertise, catégories de service, autres données de Profil, contenus postés par vous sur le Site</li>
                        <li><i class="fas fa-check-circle me-2" style="color: #29963a;"></i>Données techniques : adresse IP, données relatives à votre navigateur, localisation, fuseau horaire, données de connexion, identifiants et mots de passe</li>
                        <li><i class="fas fa-check-circle me-2" style="color: #29963a;"></i>Données de navigation : pages parcourues, le temps passé, etc.</li>
                        <li><i class="fas fa-check-circle me-2" style="color: #29963a;"></i>Données marketing et préférences en matière de marketing et de communication</li>
                    </ul>

                    <p class="mb-3"><strong id="données-des-visiteurs-du-site">Données des visiteurs du Site :</strong></p>
                    <ul style="color: #555; line-height: 2; margin-bottom: 5rem;">
                        <li><i class="fas fa-check-circle me-2" style="color: #29963a;"></i>Données techniques : adresse IP, données de connexion, navigateur, localisation, utilisation des données relatives à votre utilisation du Site et données marketing, y compris vos préférences de communication</li>
                    </ul>

                    <!-- Section 7 -->
                    <h3 id="droits-des-personnes-concernées" style="color: #094281; font-weight: 600; margin-top: 2.5rem; margin-bottom: 1.5rem; border-left: 4px solid #ffc107; padding-left: 1rem;">
                        Droits des personnes concernées
                    </h3>
                    <p class="mb-4">
                        Vous disposez sur vos données personnelles de l'ensemble des droits suivants, que vous pouvez exercer à tout 
                        moment (sauf pour le droit d'être informé, qui s'exerce avant la collecte) en nous adressant une demande à 
                        l'adresse <a href="{{ route('contact') }}" style="color: #094281; font-weight: 500;">Contactez-nous</a> 
                        accompagnée d'un justificatif d'identité de votre choix.
                    </p>

                    <div style="background-color: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
                        <p class="mb-3">
                            La demande doit émaner de la personne concernée elle-même qui doit être en mesure de justifier son 
                            identité. Le cas échéant, et conformément à la Réglementation, une copie de votre pièce d'identité 
                            pourra vous être demandée.
                        </p>
                        <p>
                            Nous vous répondrons dans les 15 jours de la réception de votre demande, sauf dans les cas où la loi 
                            nous impose des opérations de vérification préalable.
                        </p>
                    </div>

                    <!-- Rights List -->
                    <div style="background-color: #f0f4f8; padding: 2rem; border-radius: 10px; margin-top: 2rem;">
                        <div class="rights-item mb-4">
                            <h5 style="color: #094281; font-weight: 600; border-bottom: 2px solid #ffc107; padding-bottom: 0.5rem;">
                                <i class="fas fa-info-circle me-2"></i>Droit d'information
                            </h5>
                            <p class="mt-2 text-justify">
                                Avant toute collecte de vos données personnelles, vous serez informés des catégories de données 
                                collectées, de chaque finalité de cette collecte, des destinataires, de la durée de conservation des 
                                données, des sources de collecte lorsque les données sont collectées indirectement, de la base légale 
                                du traitement envisagé, des mesures de sécurité mises en œuvre, d'éventuels transferts internationaux, 
                                de l'existence éventuelle de procédés de prise de décision automatique, de vos autres droits et de la 
                                manière dont vous pouvez les exercer.
                            </p>
                        </div>

                        <div class="rights-item mb-4">
                            <h5 style="color: #094281; font-weight: 600; border-bottom: 2px solid #ffc107; padding-bottom: 0.5rem;">
                                <i class="fas fa-eye me-2"></i>Droit d'accès
                            </h5>
                            <p class="mt-2 text-justify">
                                À tout moment vous avez la possibilité d'avoir accès à vos données et à l'ensemble des informations 
                                listées ci-dessus et d'en prendre copie.
                            </p>
                        </div>

                        <div class="rights-item mb-4">
                            <h5 style="color: #094281; font-weight: 600; border-bottom: 2px solid #ffc107; padding-bottom: 0.5rem;">
                                <i class="fas fa-pen me-2"></i>Droit de rectification
                            </h5>
                            <p class="mt-2 text-justify">
                                À tout moment, vous avez le droit de nous demander de rectifier, compléter, mettre à jour vos données 
                                personnelles si elles sont inexactes ou périmées ou pour les préciser. Le traitement de ces données 
                                pourra devoir être interrompu pendant le temps nécessaire à la vérification et l'exécution des modifications.
                            </p>
                        </div>

                        <div class="rights-item mb-4">
                            <h5 style="color: #094281; font-weight: 600; border-bottom: 2px solid #ffc107; padding-bottom: 0.5rem;">
                                <i class="fas fa-times-circle me-2"></i>Droit d'objection
                            </h5>
                            <p class="mt-2 text-justify">
                                À tout moment, vous avez le droit de vous opposer au traitement de vos données personnelles en en 
                                indiquant les raisons. Il sera répondu à votre demande aussi rapidement que possible, compte tenu de 
                                la nécessité pour le Site de vérifier qu'il n'existe pas un motif légitime impérieux de la part du 
                                Site devant l'emporter sur vos raisons, comme la défense de nos droits en justice.
                            </p>
                        </div>

                        <div class="rights-item mb-4">
                            <h5 style="color: #094281; font-weight: 600; border-bottom: 2px solid #ffc107; padding-bottom: 0.5rem;">
                                <i class="fas fa-hand-paper me-2"></i>Droit de demander la limitation du traitement
                            </h5>
                            <p class="mt-2 text-justify">
                                À tout moment, vous avez le droit de demander que le traitement de vos données soit limité, dans les 
                                cas et dans le respect des exceptions prévus par la loi.
                            </p>
                        </div>

                        <div class="rights-item mb-4">
                            <h5 style="color: #094281; font-weight: 600; border-bottom: 2px solid #ffc107; padding-bottom: 0.5rem;">
                                <i class="fas fa-undo me-2"></i>Droit de retrait du consentement
                            </h5>
                            <p class="mt-2 text-justify">
                                Chaque fois que le traitement de vos données est subordonné à votre consentement, vous pourrez retirer 
                                celui-ci à tout moment et ce retrait sera traité aussitôt, sans rétroactivité toutefois.
                            </p>
                        </div>

                        <div class="rights-item mb-4">
                            <h5 style="color: #094281; font-weight: 600; border-bottom: 2px solid #ffc107; padding-bottom: 0.5rem;">
                                <i class="fas fa-trash-alt me-2"></i>Droit d'effacement
                            </h5>
                            <p class="mt-2 text-justify">
                                À tout moment, vous avez le droit de demander l'effacement de vos données, sauf exception légale et sauf 
                                nécessité pour CLUB DSI BENIN de les conserver, par exemple pour les besoins de la défense de ses droits 
                                en justice.
                            </p>
                        </div>

                        <div class="rights-item mb-4">
                            <h5 style="color: #094281; font-weight: 600; border-bottom: 2px solid #ffc107; padding-bottom: 0.5rem;">
                                <i class="fas fa-arrow-right me-2"></i>Droit à la portabilité
                            </h5>
                            <p class="mt-2 text-justify">
                                À tout moment, vous pouvez demander que les données personnelles que vous avez déposées sur le Site, 
                                à l'exclusion des données dérivées ou inférées par nos systèmes, vous soient remises ou soient transmises 
                                au tiers de votre choix. Par défaut, le langage de restitution sera celui dans lequel les ont été 
                                transmises à CLUB DSI BENIN. Ce droit ne s'applique que si vos Données sont traitées de manière 
                                automatisée et sur la base de votre consentement préalable ou de l'exécution d'un contrat.
                            </p>
                        </div>

                        <div class="rights-item">
                            <h5 style="color: #094281; font-weight: 600; border-bottom: 2px solid #ffc107; padding-bottom: 0.5rem;">
                                <i class="fas fa-dove me-2"></i>Droit de donner des directives post-mortem
                            </h5>
                            <p class="mt-2 text-justify">
                                À tout moment, vous avez le droit de nous donner vos instructions quant à l'effacement, la conservation 
                                ou la transmission de vos données après votre mort.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Navigation -->
        <div class="col-lg-3 mt-5 mt-lg-0">
            <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 10px; position: sticky; top: 100px;">
                <h5 style="color: #094281; font-weight: 600; margin-bottom: 1.5rem;">
                    <i class="fas fa-bookmark me-2" style="color: #ffc107;"></i>Table des matières
                </h5>
                <nav class="nav flex-column">
                    <a href="#engagements-club-dsi-benin" class="nav-link px-0 py-2" style="color: #555; border-left: 3px solid transparent;">
                        <i class="fas fa-chevron-right me-2" style="color: #094281; font-size: 0.8rem;"></i>Engagements
                    </a>
                    <a href="#un-traitement-loyal-et-transparent" class="nav-link px-0 py-2" style="color: #555; border-left: 3px solid transparent;">
                        <i class="fas fa-chevron-right me-2" style="color: #094281; font-size: 0.8rem;"></i>Traitement loyal
                    </a>
                    <a href="#un-traitement-pertinent-et-limité" class="nav-link px-0 py-2" style="color: #555; border-left: 3px solid transparent;">
                        <i class="fas fa-chevron-right me-2" style="color: #094281; font-size: 0.8rem;"></i>Traitement pertinent
                    </a>
                    <a href="#un-traitement-confidentiel-et-sécurisé" class="nav-link px-0 py-2" style="color: #555; border-left: 3px solid transparent;">
                        <i class="fas fa-chevron-right me-2" style="color: #094281; font-size: 0.8rem;"></i>Confidentialité
                    </a>
                    <a href="#des-transferts-strictement-encadrés" class="nav-link px-0 py-2" style="color: #555; border-left: 3px solid transparent;">
                        <i class="fas fa-chevron-right me-2" style="color: #094281; font-size: 0.8rem;"></i>Transferts de données
                    </a>
                    <a href="#données-des-utilisateurs-du-site" class="nav-link px-0 py-2" style="color: #555; border-left: 3px solid transparent;">
                        <i class="fas fa-chevron-right me-2" style="color: #094281; font-size: 0.8rem;"></i>Données collectées
                    </a>
                    <a href="#droits-des-personnes-concernées" class="nav-link px-0 py-2" style="color: #555; border-left: 3px solid transparent;">
                        <i class="fas fa-chevron-right me-2" style="color: #094281; font-size: 0.8rem;"></i>Vos droits
                    </a>
                </nav>

                <!-- Contact CTA -->
                <div style="margin-top: 2rem; padding: 1rem; background: linear-gradient(135deg, #094281 0%, #0a2b5c 100%); border-radius: 8px; text-align: center;">
                    <p style="color: #fff; font-size: 0.9rem; margin-bottom: 1rem;">Des questions ?</p>
                    <a href="{{ route('contact') }}" class="btn btn-sm" style="background-color: #ffc107; color: #094281; font-weight: 600; border: none;">
                        <i class="fas fa-headset me-2"></i>Nous contacter
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Back to Top Button -->
<a href="#" class="btn btn-primary btn-lg-square rounded back-to-top" style="background-color: #094281; position: fixed; bottom: 30px; right: 30px; display: none; z-index: 99;">
    <i class="bi bi-arrow-up"></i>
</a>

<style>
    .policy-content {
        font-family: 'Inter', sans-serif;
    }

    .policy-content h3 {
        transition: all 0.3s ease;
    }

    .policy-content h3:hover {
        padding-left: 1.5rem;
        color: #0a2b5c;
    }

    .nav-link {
        transition: all 0.2s ease;
    }

    .nav-link:hover {
        background-color: rgba(9, 66, 129, 0.1);
        border-left: 3px solid #ffc107 !important;
        padding-left: 0.75rem !important;
        color: #094281 !important;
    }

    .rights-item {
        transition: all 0.2s ease;
    }

    .rights-item:hover {
        background-color: rgba(255, 199, 7, 0.05);
        padding: 1rem;
        border-radius: 6px;
    }

    @media (max-width: 991px) {
        .hero-protection-donnees {
            height: 30vh !important;
        }

        .col-lg-3 {
            margin-top: 2rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Show/hide back-to-top button
        const backToTopBtn = document.querySelector('.back-to-top');
        
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopBtn.style.display = 'block';
            } else {
                backToTopBtn.style.display = 'none';
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    });
</script>
@endsection

