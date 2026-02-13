<?php $__env->startSection('title', 'Espace Membre'); ?>

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
        body { font-family: 'Inter', sans-serif; background-color: var(--light-bg); color: var(--ink); margin: 0; }

        /* --- Héros "Focus Animé" --- */
        .hero-members-v2 {
            position: relative; height: 100vh; min-height: 500px;
            display: grid; place-items: center; text-align: center;
            color: white; overflow: hidden;
        }
        .hero-members-v2 .hero-background {
            position: absolute; inset: 0;
            background-image: url("<?php echo e(asset('img/IMG_1966.jpg')); ?>");
            background-size: cover; background-position: center;
            animation: ken-burns 20s infinite alternate ease-in-out;
        }
        .hero-members-v2::after {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(#101d34bd);
            z-index: 1;
        }
        #particles-js { position: absolute; inset: 0; z-index: 2; }
        .hero-content { position: relative; z-index: 3; }
        .hero-content h1 {
            font-size: clamp(2.5rem, 6vw, 4.5rem); font-weight: 800;
            color: #fff;
            opacity: 0; transform: translateY(20px);
            animation: slideUpFade 1s 0.2s ease-out forwards;
        }
        .hero-actions {
            margin-top: 2rem; opacity: 0; transform: translateY(20px);
            animation: slideUpFade 1s 0.5s ease-out forwards;
        }
        .btn.hero-btn { padding: 0.9rem 2rem; border-radius: 10px; font-weight: 700; font-size: 1.1rem; text-decoration: none; border: 2px solid transparent; transition: all 0.3s ease; display: inline-flex; align-items: center; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); }
        .btn.hero-btn.primary { background: linear-gradient(95deg, var(--dsi-blue), var(--dsi-green)); color: white; }
        .btn.hero-btn.primary:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); }
        .btn.hero-btn.secondary { background-color: rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); color: white; border-color: rgba(255, 255, 255, 0.4); }
        .btn.hero-btn.secondary:hover { background-color: rgba(255, 255, 255, 0.3); border-color: white; transform: translateY(-3px); }

        /* --- Conteneur principal & Barre d'outils flottante --- */
        .members-main-content { padding: 4rem 1.5rem; }
        .toolbar-container {
            max-width: 900px; margin: -8rem auto 3rem auto;
            position: relative; z-index: 10;
            background: white; border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 20px 60px -10px rgba(9, 66, 129, 0.2);
        }
        .search-bar { display: flex; gap: 1rem; margin-bottom: 2rem; }
        .search-bar .input-group-text { background: none; border: 1px solid var(--border-color); border-right: none; }
        .search-bar .form-control, .search-bar .form-select { border: 1px solid var(--border-color); box-shadow: none !important; }
        .member-tabs { border-bottom: 1px solid var(--border-color); }
        .member-tabs .nav-link { font-size: 1.1rem; font-weight: 600; color: var(--muted-ink); border: none; border-bottom: 3px solid transparent; padding: 1rem 1.5rem; }
        .member-tabs .nav-link.active { color: var(--dsi-blue); border-bottom-color: var(--dsi-blue); }

        /* --- Grille des Membres avec Animation 3D --- */
        .members-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 2.5rem 1.5rem;
            perspective: 1000px;
        }
        .member-card-v2 {
            text-align: center; opacity: 0;
            transform: rotateX(-20deg) translateY(50px);
            animation: card-appear 0.8s ease-out forwards;
        }
        /* Décalage de l'animation en cascade */
        .member-card-v2:nth-child(1) { animation-delay: 0.1s; } .member-card-v2:nth-child(2) { animation-delay: 0.2s; } .member-card-v2:nth-child(3) { animation-delay: 0.3s; } .member-card-v2:nth-child(4) { animation-delay: 0.4s; }
        .member-card-v2:nth-child(5) { animation-delay: 0.5s; } .member-card-v2:nth-child(6) { animation-delay: 0.6s; } .member-card-v2:nth-child(7) { animation-delay: 0.7s; } .member-card-v2:nth-child(8) { animation-delay: 0.8s; }

        .member-photo-v2 { position: relative; width: 180px; height: 180px; margin: 0 auto 1rem auto; border-radius: 50%; overflow: hidden; box-shadow: 0 10px 30px -10px rgba(9, 66, 129, 0.4); transition: transform 0.4s ease; }
        .member-card-v2:hover .member-photo-v2 { transform: scale(1.05); }
        .member-photo-v2 img { width: 100%; height: 100%; object-fit: cover; }
        .member-overlay { position: absolute; inset: 0; border-radius: 50%; background: rgba(9, 66, 129, .8); display: flex; align-items: center; justify-content: center; gap: 0.75rem; opacity: 0; transition: opacity 0.4s ease; }
        .member-card-v2:hover .member-overlay { opacity: 1; }
        .member-overlay .social-btn { width: 45px; height: 45px; border-radius: 50%; background: white; color: var(--dsi-blue); display: grid; place-items: center; text-decoration: none; font-size: 1.1rem; transform: translateY(20px); transition: transform 0.4s ease, background-color 0.3s ease, color 0.3s ease; }
        .member-card-v2:hover .social-btn { transform: translateY(0); }
        .member-card-v2:hover .social-btn:nth-child(2) { transition-delay: 0.1s; }
        .member-overlay .social-btn:hover { background: var(--dsi-green); color: white; }
        .member-info-v2 .member-name { font-weight: 700; font-size: 1.2rem; color: var(--ink); }
        .member-info-v2 .member-role { color: var(--muted-ink); }
        .bureau-structure { display: flex; flex-direction: column; align-items: center; gap: 3rem; }
        .bureau-row { display: flex; justify-content: center; flex-wrap: wrap; gap: 3rem; }
        .pagination-container { display: none; }
        .pagination-container.visible { display: flex; justify-content: center; margin-top: 3rem; }

        @keyframes ken-burns { 0% { transform: scale(1.1); } 100% { transform: scale(1); } }
        @keyframes slideUpFade { to { opacity: 1; transform: translateY(0); } }
        @keyframes card-appear { to { opacity: 1; transform: rotateX(0) translateY(0); } }
    </style>


    <section class="hero-members-v2">
        <div class="hero-background"></div>
        <div id="particles-js"></div>
        <div class="hero-content">
            <h1>Les Visages de l'Innovation</h1>
            <div class="hero-actions">
                <a href="<?php echo e(route('login')); ?>" class="btn hero-btn primary"><i class="fas fa-sign-in-alt me-2"></i> Accéder à l'Espace Membre</a>
                <a href="<?php echo e(route('register')); ?>" class="btn hero-btn secondary">Devenir Membre</a>
            </div>
        </div>
    </section>

    <main class="members-main-content">
        <div class="toolbar-container">
            <div class="search-bar">
                <div class="input-group"><span class="input-group-text"><i class="fas fa-search"></i></span><input type="text" class="form-control" placeholder="Rechercher un membre par nom..."></div>
                <select class="form-select" style="max-width: 200px;"><option selected>Toutes les catégories</option><option value="bureau">Bureau Actuel</option><option value="fondateurs">Membres Fondateurs</option><option value="individuel">Membres Individuels</option><option value="galerie">Galerie Publique</option></select>
            </div>
            <ul class="nav nav-tabs justify-content-center member-tabs" id="memberTab" role="tablist">
                <li class="nav-item" role="presentation"><button class="nav-link active" id="bureau-tab" data-bs-toggle="tab" data-bs-target="#bureau" type="button" role="tab">Bureau Actuel</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" id="fondateurs-tab" data-bs-toggle="tab" data-bs-target="#fondateurs" type="button" role="tab">Membres Fondateurs</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" id="sympathisants-tab" data-bs-toggle="tab" data-bs-target="#sympathisants" type="button" role="tab">Membres Individuels</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" id="sympathisants-tab" data-bs-toggle="tab" data-bs-target="#sympathisants" type="button" role="tab">Membres Entreprises</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" id="sympathisants-tab" data-bs-toggle="tab" data-bs-target="#sympathisants" type="button" role="tab">Membres Collèges-IT</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" id="sympathisants-tab" data-bs-toggle="tab" data-bs-target="#sympathisants" type="button" role="tab">Membres Administration publique</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" id="galerie-tab" data-bs-toggle="tab" data-bs-target="#galerie" type="button" role="tab">Galerie Publique</button></li>
            </ul>
        </div>

        <div class="container" style="max-width: 1200px;">
            <div class="tab-content" id="memberTabContent">
                <!-- Onglet 1: Bureau Actuel -->
                <div class="tab-pane fade show active" id="bureau" role="tabpanel">
                    <div class="bureau-structure">
                        <div class="bureau-row"><div class="member-card-v2"><div class="member-photo-v2"><img src="https://clubdsibenin.bj/storage/membre/FqorSxnsZfwFi88p.png" alt="G. Fabrice DAKO"><div class="member-overlay"><a href="#" class="social-btn" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a><a href="#" class="social-btn" title="Contacter"><i class="fas fa-envelope"></i></a></div></div><div class="member-info-v2"><div class="member-name">G. Fabrice DAKO</div><div class="member-role">Président</div></div></div></div>
                        <div class="bureau-row"><div class="member-card-v2"><div class="member-photo-v2"><img src="https://clubdsibenin.bj/storage/membre/p6e779Z4RvY8AF3X.jpg" alt="HERMANN BOKPE"><div class="member-overlay"><a href="#" class="social-btn" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a><a href="#" class="social-btn" title="Contacter"><i class="fas fa-envelope"></i></a></div></div><div class="member-info-v2"><div class="member-name">HERMANN BOKPE</div><div class="member-role">Trésorier Général</div></div></div><div class="member-card-v2"><div class="member-photo-v2"><img src="https://clubdsibenin.bj/storage/membre/lu9ht2zzleaAhlOk.jpeg" alt="Afiss BILEOMA"><div class="member-overlay"><a href="#" class="social-btn" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a><a href="#" class="social-btn" title="Contacter"><i class="fas fa-envelope"></i></a></div></div><div class="member-info-v2"><div class="member-name">Afiss BILEOMA</div><div class="member-role">Secrétaire Général</div></div></div><div class="member-card-v2"><div class="member-photo-v2"><img src="https://clubdsibenin.bj/storage/membre/kwReRV02BQSxeI7Z.jpg" alt="Youssouf ABOUBAKARI"><div class="member-overlay"><a href="#" class="social-btn" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a><a href="#" class="social-btn" title="Contacter"><i class="fas fa-envelope"></i></a></div></div><div class="member-info-v2"><div class="member-name">Youssouf ABOUBAKARI</div><div class="member-role">SG Communication</div></div></div></div>
                        <div class="bureau-row"><div class="member-card-v2"><div class="member-photo-v2"><img src="https://clubdsibenin.bj/storage/membre/3DGOxKsJG7ugqEWF.jpg" alt="ADANLIN TOUPE MIREILLE"><div class="member-overlay"><a href="#" class="social-btn" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a><a href="#" class="social-btn" title="Contacter"><i class="fas fa-envelope"></i></a></div></div><div class="member-info-v2"><div class="member-name">ADANLIN TOUPE MIREILLE</div><div class="member-role">TG Adjointe</div></div></div><div class="member-card-v2"><div class="member-photo-v2"><img src="https://clubdsibenin.bj/storage/membre/QDhsjMoYoLTFinuB.jpg" alt="A. Olivier TOBOSSI"><div class="member-overlay"><a href="#" class="social-btn" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a><a href="#" class="social-btn" title="Contacter"><i class="fas fa-envelope"></i></a></div></div><div class="member-info-v2"><div class="member-name">A. Olivier TOBOSSI</div><div class="member-role">SG Adjoint</div></div></div><div class="member-card-v2"><div class="member-photo-v2"><img src="https://clubdsibenin.bj/storage/membre/vxlvV27hmQMThKzz.jpg" alt="Marthe BANKOLE"><div class="member-overlay"><a href="#" class="social-btn" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a><a href="#" class="social-btn" title="Contacter"><i class="fas fa-envelope"></i></a></div></div><div class="member-info-v2"><div class="member-name">Marthe BANKOLE</div><div class="member-role">SGA Communication</div></div></div></div>
                    </div>
                </div>

                <div class="tab-pane fade" id="fondateurs" role="tabpanel"><div class="members-grid">
                    <div class="member-card-v2"><div class="member-photo-v2"><img src="https://clubdsibenin.bj/storage/membre/IqOm47cxzURgPcyI.jpg" alt="Abdias ATCHADE"><div class="member-overlay"><a href="#" class="social-btn" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a></div></div><div class="member-info-v2"><div class="member-name">Abdias ATCHADE</div></div></div>
                    <div class="member-card-v2"><div class="member-photo-v2"><img src="https://clubdsibenin.bj/storage/membre/QDhsjMoYoLTFinuB.jpg" alt="A. Olivier TOBOSSI"><div class="member-overlay"><a href="#" class="social-btn" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a></div></div><div class="member-info-v2"><div class="member-name">A. Olivier TOBOSSI</div></div></div>
                    <div class="member-card-v2"><div class="member-photo-v2"><img src="https://clubdsibenin.bj/storage/membre/niJRYikbNAxEUjVD.jpeg" alt="MEGNIGBETO Vincent de Paul"><div class="member-overlay"><a href="#" class="social-btn" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a></div></div><div class="member-info-v2"><div class="member-name">MEGNIGBETO Vincent de Paul</div></div></div>
                </div></div>

                <div class="tab-pane fade" id="sympathisants" role="tabpanel"><div class="members-grid">
                    <div class="member-card-v2"><div class="member-photo-v2"><img src="https://clubdsibenin.bj/storage/membre/hTSrlntXXtBArfNp.jpeg" alt="Merveille HOUESSOU"><div class="member-overlay"><a href="#" class="social-btn" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a></div></div><div class="member-info-v2"><div class="member-name">Merveille HOUESSOU</div></div></div>
                    <div class="member-card-v2"><div class="member-photo-v2"><img src="https://clubdsibenin.bj/storage/membre/9CiJR2eV6KaukKG1.jpg" alt="Astrid DANDJINOU"><div class="member-overlay"><a href="#" class="social-btn" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a></div></div><div class="member-info-v2"><div class="member-name">Astrid DANDJINOU</div></div></div>
                </div></div>

                <div class="tab-pane fade" id="galerie" role="tabpanel"><div class="members-grid">
                    <div class="member-card-v2"><div class="member-photo-v2"><img src="https://clubdsibenin.bj/storage/membre/Xh8Fb8NqZOD4zZdI.jpeg" alt="Serge EGNONSE"><div class="member-overlay"><a href="#" class="social-btn" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a></div></div><div class="member-info-v2"><div class="member-name">Serge EGNONSE</div></div></div>
                    <div class="member-card-v2"><div class="member-photo-v2"><img src="https://clubdsibenin.bj/storage/membre/Km6fU7t4dAZpOOmo.png" alt="AUREL GUIDI"><div class="member-overlay"><a href="#" class="social-btn" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a></div></div><div class="member-info-v2"><div class="member-name">AUREL GUIDI</div></div></div>
                    <div class="member-card-v2"><div class="member-photo-v2"><img src="https://clubdsibenin.bj/storage/membre/2cGrVv6OleVdpKDZ.jpg" alt="Jean-Carmel AKPACA"><div class="member-overlay"><a href="#" class="social-btn" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a></div></div><div class="member-info-v2"><div class="member-name">Jean-Carmel AKPACA</div></div></div>
                </div></div>
            </div>
            <div class="pagination-container" id="pagination-galerie">
                <nav aria-label="Page navigation"><ul class="pagination"><li class="page-item disabled"><a class="page-link" href="#">Précédent</a></li><li class="page-item active"><a class="page-link" href="#">1</a></li><li class="page-item"><a class="page-link" href="#">2</a></li><li class="page-item"><a class="page-link" href="#">3</a></li><li class="page-item"><a class="page-link" href="#">Suivant</a></li></ul></nav>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script>
        if (document.getElementById('particles-js')) {
            particlesJS("particles-js", { particles: { number: { value: 40, density: { enable: true, value_area: 800 } }, color: { value: "#ffffff" }, shape: { type: "circle" }, opacity: { value: 0.3, random: true }, size: { value: 2, random: true }, line_linked: { enable: false }, move: { enable: true, speed: 1, direction: "none", out_mode: "out" } }, retina_detect: true });
        }
        const memberTabs = document.querySelectorAll('#memberTab .nav-link');
        const paginationGalerie = document.getElementById('pagination-galerie');
        memberTabs.forEach(tab => {
            tab.addEventListener('shown.bs.tab', event => {
                paginationGalerie.classList.toggle('visible', event.target.id === 'galerie-tab');
            });
        });
    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/membre/espace.blade.php ENDPATH**/ ?>