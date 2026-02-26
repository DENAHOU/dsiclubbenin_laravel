<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Club DSI Bénin - @yield('title', 'Le Hub du Numérique')</title>

    <!-- Balise Viewport (Essentielle pour la responsivité) -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta content="Club DSI Bénin, DSI, Bénin, Numérique, Tech, Innovation" name="keywords">
    <meta content="Le Hub des leaders de la Tech au Bénin pour partager, innover et construire un écosystème digital d'excellence." name="description">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- ======================================================= -->
    <!--       NOTRE CSS PERSONNALISÉ & RESPONSIVE             -->
    <!-- ======================================================= -->
    <style>
        /* --- Variables & Styles Généraux --- */
        :root {
            --dsi-blue-dark: #0a2b5c;
            --dsi-blue: #094281;
            --dsi-green: #29963a;
            --dsi-gold: #ffc107;
            --ink: #121f2d;
            --muted-ink: #5a6b81;
            --light-ink: #f0f4f8;
            --muted-ink-dark: #dae2ec;
        }
        body { font-family: 'Inter', sans-serif; color: var(--ink); margin: 0; }

        /* --- Navbar & Boutons (Desktop) --- */
        .navbar { position: absolute; width: 100%; top: 10px; left: 0; z-index: 999; }
        .sticky-top.navbar { top: 0 !important; }
        .navbar .navbar-brand, .navbar .navbar-nav .nav-link { font-family: 'Inter', sans-serif; font-weight: 600; }
        .navbar-dark .navbar-brand, .navbar-dark .navbar-nav .nav-link { color: white !important; }
        .sticky-top.navbar-dark .navbar-brand, .sticky-top.navbar-dark .navbar-nav .nav-link { color: var(--dsi-blue-dark) !important; }

        .btn-cta-primary { background-color: var(--dsi-gold); color: var(--dsi-blue-dark) !important; border-radius: 10px; font-weight: bold; padding: .6rem 1.2rem; border: none; }
        .btn-cta-primary:hover { background-color: #ffd043; }
        .btn-cta-secondary { background-color: transparent; border: 2px solid rgba(255,255,255,0.5); color: white !important; font-weight: bold; border-radius: 10px; padding: .6rem 1.2rem; }
        .btn-cta-secondary:hover { background-color: white; color: var(--dsi-blue-dark) !important; border-color: white; }
        .sticky-top.navbar-dark .btn-cta-secondary { border-color: var(--dsi-blue-dark); color: var(--dsi-blue-dark) !important; }
        .sticky-top.navbar-dark .btn-cta-secondary:hover { background-color: var(--dsi-blue-dark); color: white !important; }

        /* Le logo sticky est caché par défaut */
.logo-sticky {
    display: none;
}

/* Quand la navbar devient sticky → on inverse */
.sticky-top .logo-default {
    display: none !important;
}

.sticky-top .logo-sticky {
    display: block !important;
}


/* --- FOOTER GLOBAL --- */
/* ===============================
   FOOTER PREMIUM CLUB DSI
================================ */

.site-footer-dark {
    background: linear-gradient(135deg, #0f2b52, #123a6b);
    color: #c9d4e5;
    padding: 70px 0 20px;
    font-family: 'Inter', sans-serif;
}

/* GRID */
.footer-top {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1.3fr;
    gap: 60px;
    padding-bottom: 40px;
    border-bottom: 1px solid rgba(255,255,255,0.08);
}

/* LOGO */
.footer-logo-img {
    max-width: 230px;
    margin-bottom: 18px;
}

.footer-desc {
    font-size: 0.9rem;
    line-height: 1.6;
    color: #a9b8cf;
    max-width: 320px;
}

/* COLONNES */
.footer-col h5 {
    color: #ffffff;
    font-size: 1.05rem;
    font-weight: 600;
    margin-bottom: 20px;
    position: relative;
}

.footer-col h5::after {
    content: "";
    width: 30px;
    height: 2px;
    background: #25b66f;
    display: block;
    margin-top: 8px;
}

/* LISTES */
.footer-col ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.footer-col ul li a {
    color: #b7c6dc;
    text-decoration: none;
    transition: 0.3s;
    font-size: 0.92rem;
}

.footer-col ul li a:hover {
    color: #ffffff;
    transform: translateX(4px);
}

/* CONTACT */
.footer-contact ul li {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 0.92rem;
}

/* ICONES CONTACT PREMIUM */
.contact-icon {
    width: 34px;
    height: 34px;
    border-radius: 8px;
    background: rgba(255,255,255,0.08);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #25b66f;
    font-size: 14px;
    flex-shrink: 0;
}

/* FOOTER SOCIALS (NE TOUCHE PAS TOPBAR) */

/* --- ICONES RESEAUX --- */
.footer-socials {
    display: flex;
    gap: 0.8rem;
    flex-wrap: wrap;
}
.footer-socials a {
    width: 38px;
    height: 38px;
    display: grid;
    place-items: center;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.08);
    color: #dce3ee;
    font-size: 1rem;
    transition: all 0.3s ease;
}
.footer-socials a:hover {
    background-color: #25b66f;
    color: #fff;
    transform: translateY(-3px);
}

/* RESPONSIVE */
@media (max-width: 992px) {

    .footer-top {
        grid-template-columns: repeat(2, 1fr);
        gap: 40px;
    }

}

@media (max-width: 600px) {

    .footer-top {
        grid-template-columns: 1fr;
        text-align: center;
    }

    .footer-desc {
        margin: auto;
    }

    .footer-contact ul li {
        justify-content: center;
    }

}

/* --- BAS DU FOOTER --- */
.footer-bottom {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    margin-top: 2rem;
    font-size: 0.9rem;
    color: #aab6c5;
}
.footer-bottom a {
    color: #aab6c5;
    text-decoration: none;
}
.footer-bottom a:hover {
    color: #fff;
}

/* --- RESPONSIVE --- */
/* @media (max-width: 992px) {
    .footer-top {
        grid-template-columns: repeat(2, 1fr);
    }
}
@media (max-width: 576px) {
    .footer-top {
        grid-template-columns: 1fr;
        text-align: center;
    }
    .footer-socials {
        justify-content: center;
    }
}
@media (max-width: 768px) {
    .footer-col .list-unstyled a {
        white-space: normal; /* ✅ autorise à nouveau la coupure sur petits écrans */
    }
} */


        /* --- Règles pour la Responsivité --- */
        @media (max-width: 991.98px) {
            .navbar { position: relative; top: auto; }
            .navbar-dark .navbar-nav .nav-link, .navbar-dark .navbar-brand { color: var(--dsi-blue-dark) !important; }
            .navbar-dark .btn-cta-secondary { color: var(--dsi-blue-dark) !important; border-color: var(--dsi-blue-dark); margin-top: 1rem; }
            .navbar-dark .btn-cta-primary { margin-top: 0.5rem; }
            .footer-top { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 767.98px) {
            .footer-top { grid-template-columns: 1fr; text-align: center; }
            .footer-logo, .footer-col .list-unstyled, .footer-contact-list { margin: 0 auto; }
            .footer-bottom { flex-direction: column; gap: 1rem; text-align: center; }
        }

        /* Forcer les icônes réseaux du topbar à être parfaitement circulaires */
        .container-fluid.bg-dark .btn-sm-square,
        .container-fluid.bg-dark .btn-sm-square i,
        .footer-socials a {
            width: 40px;
            height: 40px;
            display: inline-grid;
            place-items: center;
            padding: 0 !important;
            border-radius: 50% !important;
            line-height: 1;
        }


        /* Ajuster selon besoin (desktop / mobile) */
        @media (max-width: 767.98px) {
            .container-fluid.bg-dark .btn-sm-square,
            .footer-socials a { width: 36px; height: 36px; }
        }


        /* Forcer cercle blanc + bordure blanche autour des icônes du topbar (toutes pages) */
        .container-fluid.bg-dark a.btn.btn-sm.btn-sm-square,
        .container-fluid.bg-dark a.btn.btn-sm.btn-sm-square.rounded-circle {
            color: var(--light-ink) !important;  /* couleur icône */
            border: 2px solid #ffffff !important;    /* bordure blanche visible */
            box-shadow: 0 1px 3px rgba(0,0,0,0.08) !important;
            width: 40px !important;
            height: 40px !important;
            padding: 0 !important;
            display: inline-grid !important;
            place-items: center !important;
            border-radius: 50% !important;
        }

        .container-fluid.bg-dark a.btn.btn-sm.btn-sm-square i {
            font-size: 1rem;
            line-height: 1;
        }

        .container-fluid.bg-dark a.btn.btn-sm.btn-sm-square:hover {
            background-color: #f0f0f0 !important;
            transform: translateY(-2px);
            color: var(--dsi-blue-dark) !important; /* icône devient bleu au hover si souhaité */
        }


        /* LOGO RESPONSIVE */
.logo-default {
    height: 80px;
    transition: 0.3s;
}

.logo-sticky {
    height: 60px;
    display: none;
}

/* MOBILE */
@media (max-width: 991px) {

    .logo-default {
        height: 55px;
    }


    .navbar-nav .nav-link {
        padding: 10px 0;
    }

    .dropdown-menu {
        background: transparent;
        border: none;
    }

}

/* ===== NAVBAR MOBILE ===== */

@media (max-width: 991px) {

    /* Fond blanc navbar */
    .navbar {
        background: #ffffff !important;
        padding: 10px 15px !important;
    }

    /* Afficher seulement logo sticky */
    .logo-default {
        display: none !important;
    }

    .logo-sticky {
        display: block !important;
        height: 50px !important;
    }

    /* Bouton menu bleu */
    .navbar-toggler {
        border: none;
        color: #094281 !important;
    }

    .navbar-toggler .fa-bars {
        color: #094281 !important;
        font-size: 22px;
    }

    /* Menu ouvert fond blanc */
    .navbar-collapse {
        background: #ffffff;
        margin-top: 10px;
        padding: 10px;
        border-radius: 10px;
    }

    /* Liens menu */
    .navbar-nav .nav-link {
        color: #0d1b2a !important;
        padding: 10px 0;
    }

    /* Bouton Se connecter */
    .btn-cta-secondary {
        background: #ffffff !important;
        color: #0d6efd !important;
        border: 2px solid #0d6efd !important;
    }

    .btn-cta-secondary:hover {
        background: #ffffff !important;
        color: #0d6efd !important;
    }

    /* Devenir membre reste intact */
}


.chatbot-fab {
    position: fixed;
    bottom: 25px;
    left: 25px;
    width: 60px;
    height: 60px;
    background: #094281;
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    cursor: pointer;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    z-index: 9999;
    transition: 0.3s;
}

.chatbot-fab:hover {
    transform: scale(1.08);
}

/* ===== MOBILE ===== */
@media (max-width: 768px) {

    .chatbot-fab {
        width: 50px;
        height: 50px;
        font-size: 18px;
        bottom: 15px;
        left: 15px;
    }

}

.chatbot-fab {
    animation: pulseChat 2s infinite;
}
@keyframes pulseChat {
    0% { box-shadow: 0 0 0 0 rgba(9,66,129, 0.7); }
    70% { box-shadow: 0 0 0 10px rgba(9,66,129, 0); }
    100% { box-shadow: 0 0 0 0 rgba(9,66,129, 0); }
}

.chatbot-fab i {
    pointer-events: none;
}


    </style>
    @stack('styles')
</head>
<body class="font-sans antialiased">

    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner"></div>
    </div>

    <!-- Topbar -->
    <div class="container-fluid bg-dark px-5 d-none d-lg-block">
        <div class="row gx-0">
            <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <small class="me-3 text-light"><i class="fa fa-map-marker-alt me-2"></i>Cotonou, Bénin</small>
                    <small class="text-light"><i class="fa fa-envelope-open me-2"></i>contact@clubdsibenin.bj</small>
                    <small class="text-light ms-3"><i class="fas fa-phone me-2"></i>+229 0191475555 | 0199200404</small>

                </div>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href="https://www.youtube.com/channel/UC3QC-KaaPvaA4pac8cz9r8g/" target="_blank" title="YouTube"><i class="fab fa-youtube fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href="https://www.facebook.com/clubdsibenin" target="_blank" title="Facebook"><i class="fab fa-facebook-f fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href="https://www.linkedin.com/company/club-dsi-b%C3%A9nin/?viewAsMember=true" target="_blank" title="LinkedIn"><i class="fab fa-linkedin-in fw-normal"></i></a>
                    <!-- Instagram -->
<a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2"
   href="https://www.instagram.com/club_dsi_benin/"
   target="_blank"
   title="Instagram">
   <i class="fab fa-instagram fw-normal"></i>
</a>

<!-- Flickr -->
<a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2"
   href="https://www.flickr.com/photos/190251416@N08/albums"
   target="_blank"
   title="Flickr">
   <i class="fab fa-flickr fw-normal"></i>
</a>

<!-- Twitter -->
<a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2"
   href="https://twitter.com/clubdsibenin"
   target="_blank"
   title="Twitter">
   <i class="fab fa-twitter fw-normal"></i>
</a>

                </div>
            </div>
        </div>
    </div>

    <!-- Conteneur principal pour Navbar et Hero -->
<div class="container-fluid position-relative">
    <nav class="navbar navbar-expand-lg navbar-dark px-lg-5 px-3 py-2 py-lg-0">

        <a href="{{ route('home') }}" class="navbar-brand p-0 d-flex align-items-center">

            <!-- Logo normal -->
            <img src="{{ asset('img/logo.png') }}"
                 alt="Logo Club DSI Bénin"
                 class="logo-default img-fluid">

            <!-- Logo sticky -->
            <img src="{{ asset('img/logo-dsi.png') }}"
                 alt="Logo Sticky"
                 class="logo-sticky img-fluid">
        </a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">

            <div class="navbar-nav ms-auto py-3 py-lg-0">

                <a href="{{ route('home') }}" class="nav-item nav-link">Accueil</a>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        Le Club
                    </a>
                    <div class="dropdown-menu m-0">
                        <a href="{{ route('club.about') }}" class="dropdown-item">Qui sommes-nous ?</a>
                        <a href="{{ route('club.partners') }}" class="dropdown-item">Nos Partenaires</a>
                        <a href="{{ route('club.programme') }}" class="dropdown-item">Programmes Thématiques</a>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        Activités
                    </a>
                    <div class="dropdown-menu m-0">
                        <a href="{{ route('activites.evenements') }}" class="dropdown-item">Événements & Actualités</a>
                        <a href="{{ route('activites.formations') }}" class="dropdown-item">Nos Formations</a>
                        <a href="https://dsiawards.bj/" class="dropdown-item fw-bold" target="_blank">DSI AWARDS</a>
                    </div>
                </div>

                <a href="{{ route('recrutement') }}" class="nav-item nav-link">Recrutement</a>
                <a href="{{ route('esn') }}" class="nav-item nav-link">ESN</a>
                <a href="{{ route('membre.espace') }}" class="nav-item nav-link">Membres</a>

                <!-- Boutons visibles sur mobile -->
                <div class="d-lg-none mt-3">
                    <a href="{{ route('login') }}" class="btn btn-cta-secondary w-100 mb-2">
                        <i class="fas fa-sign-in-alt me-2"></i>Se Connecter
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-cta-primary w-100">
                        Devenir Membre
                    </a>
                </div>

            </div>

            <!-- Boutons Desktop -->
            <div class="d-none d-lg-flex align-items-center gap-2 ms-3">
                <a href="{{ route('login') }}" class="btn btn-cta-secondary px-3">
                    <i class="fas fa-sign-in-alt me-2"></i>Se Connecter
                </a>
                <a href="{{ route('register') }}" class="btn btn-cta-primary px-3">
                    Devenir Membre
                </a>
            </div>

        </div>
    </nav>

    @yield('hero')
</div>


    <main>
        @yield('content')
    </main>

<footer class="site-footer-dark">
    <div class="container">
        <!-- SECTION HAUTE -->
<!-- SECTION HAUTE -->
<div class="footer-top">

    <!-- LOGO ET DESCRIPTION -->
    <div class="footer-about">
        <img src="{{ asset('img/logo.png') }}" alt="Logo Club DSI Bénin" class="footer-logo-img">

        <p class="footer-desc">
            Le Club DSI Bénin réunit les décideurs IT pour favoriser la collaboration,
            l’innovation et le partage d’expériences.
        </p>
    </div>

    <!-- COLONNE LE CLUB -->
    <div class="footer-col">
        <h5>Le Club</h5>
        <ul>
            <li><a href="{{ route('home') }}">Accueil</a></li>
            <li><a href="{{ route('club.about') }}">À propos</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
        </ul>
    </div>

    <!-- COLONNE RESSOURCES -->
    <div class="footer-col">
        <h5>Ressources</h5>
        <ul>
            <li><a href="{{ route('protection-donnees') }}">Protection de données</a></li>
            <li><a href="{{ route('cookies') }}">Gestion des cookies</a></li>
            <li><a href="{{ route('conditions-generales') }}">Conditions générales</a></li>
        </ul>
    </div>

    <!-- COLONNE CONTACT -->
    <div class="footer-col footer-contact">
        <h5>Contact</h5>

        <ul>
            <li>
                <span class="contact-icon"><i class="fas fa-map-marker-alt"></i></span>
                <span>Cotonou, Benin</span>
            </li>

            <li>
                <span class="contact-icon"><i class="fas fa-envelope"></i></span>
                <span>contact@clubdsibenin.bj</span>
            </li>

            <li>
                <span class="contact-icon"><i class="fas fa-phone"></i></span>
                <span>+229 0191475555 | 0199200404</span>
            </li>
        </ul>
    </div>

</div>

        <!-- SECTION BASSE -->
        <div class="footer-bottom">
            <p class="mb-0">&copy; {{ date('Y') }} <strong>Club DSI Bénin</strong>. Tous droits réservés.</p>

                <div class="footer-socials mt-3">
                    <a href="https://linkedin.com/company/clubdsibenin" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="https://twitter.com/clubdsibenin" target="_blank" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="https://facebook.com/clubdsibenin" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://instagram.com/clubdsibenin" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://flickr.com/photos/clubdsibenin" target="_blank" aria-label="Flickr"><i class="fab fa-flickr"></i></a>
                    <a href="https://youtube.com/@clubdsibenin" target="_blank" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                </div>

            <a href="#" class="text-decoration-none">Mentions légales & Politique de confidentialité</a>
        </div>
    </div>
</footer>


    <div class="chatbot-fab" title="Besoin d'aide ?"><i class="fa-solid fa-comment-dots"></i></div>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top" style="background-color: var(--dsi-blue);"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @stack('scripts')
</body>
</html>
