@extends('layouts.guest')

@section('title', 'ESN')

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
        body { font-family: 'Inter', sans-serif; background-color: white; color: var(--ink); margin: 0; }
        .animated-section { opacity: 0; transform: translateY(50px); transition: opacity 0.8s ease-out, transform 0.8s ease-out; }
        .animated-section.is-visible { opacity: 1; transform: translateY(0); }

        /* --- Héros --- */
        .hero-esn-banner {
            position: relative; height: 100vh; display: grid; place-items: center; text-align: center; color: white;
            background-image: linear-gradient(#101d34bd), url("{{ asset('img/IMG_1966.jpg') }}");
            background-size: cover; background-position: center;
        }
        .hero-esn-banner h1 { font-size: clamp(2.5rem, 6vw, 4rem); font-weight: 800; color: rgba(255, 254, 254, 0.952); }

        /* --- Section Titre Générale --- */
        .section-header { text-align: center; padding: 5rem 1.5rem 4rem 1.5rem; }
        .section-header h2 { font-size: clamp(2.2rem, 4vw, 3rem); font-weight: 800; }
        .section-header p { color: var(--muted-ink); max-width: 700px; margin: 0.75rem auto 0 auto; font-size: 1.125rem; line-height: 1.6; }

        /* --- Section Triptyque --- */
        .triptyque-section { padding: 4rem 1.5rem; background-color: var(--light-bg); }
        .triptyque-container { max-width: 1100px; margin: auto; }
        .triptyque-tabs { display: flex; justify-content: center; margin-bottom: 3rem; background: white; padding: 0.5rem; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.07); }
        .tab-button { background: none; border: none; font-size: 1.1rem; font-weight: 600; padding: 0.8rem 1.5rem; border-radius: 8px; cursor: pointer; color: var(--muted-ink); transition: all 0.3s ease; }
        .tab-button.active { background: var(--dsi-blue); color: white; box-shadow: 0 5px 15px rgba(9, 66, 129, 0.3); }
        .triptyque-content { position: relative; min-height: 450px; }
        .tab-panel { display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center; transition: opacity 0.5s ease-out, transform 0.5s ease-out; position: absolute; width: 100%; }
        .tab-panel.hidden { opacity: 0; pointer-events: none; transform: translateY(20px); }
        @media(max-width: 768px){ .tab-panel { grid-template-columns: 1fr; } }
        .panel-text .panel-eyebrow { color: var(--dsi-blue); font-weight: 700; }
        .panel-text h3 { font-size: 2rem; font-weight: 800; margin: 0.25rem 0 1rem 0; }
        .panel-text ul { list-style: none; padding: 0; }
        .panel-text li { position: relative; padding-left: 30px; margin-bottom: 1rem; color: var(--muted-ink); line-height: 1.6; }
        .panel-text li::before { content: '\f058'; font-family: "Font Awesome 6 Free"; font-weight: 900; position: absolute; left: 0; top: 4px; color: var(--dsi-green); }
        .panel-image img { width: 100%; border-radius: 16px; box-shadow: 0 25px 50px -12px rgba(11, 63, 122, 0.25); }
        .btn-custom { background: var(--dsi-blue); color: white; border: none; padding: 0.8rem 1.5rem; border-radius: 10px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; margin-top: 1rem; }

        /* --- Section Communautés --- */
        .community-section { padding: 4rem 1.5rem; }
        .community-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem; max-width: 1200px; margin: auto; }
        .community-card { position: relative; border-radius: 16px; overflow: hidden; box-shadow: 0 15px 40px -15px rgba(11, 63, 122, 0.2); transition: transform 0.4s ease; cursor: pointer; }
        .community-card:hover { transform: translateY(-10px); }
        .community-card img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease; }
        .community-card:hover img { transform: scale(1.1); }
        .community-card-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, transparent 60%); padding: 1.5rem; display: flex; flex-direction: column; justify-content: flex-end; color: white; }
        .community-card-overlay h3 { font-size: 1.8rem; font-weight: 800; text-shadow: 0 2px 5px rgba(0,0,0,0.5); }
        .btn-join { background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.3); color: white; padding: 0.7rem 1.5rem; border-radius: 10px; font-weight: 600; text-decoration: none; align-self: flex-start; }
        .modal-header-custom { height: 150px; background-size: cover; background-position: center; position: relative; display: flex; align-items: flex-end; padding: 1.5rem; border-bottom: none; }
        .modal-header-custom::before { content: ''; position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); }
        .modal-header-custom .modal-title { color: white; font-weight: 800; font-size: 1.8rem; position: relative; z-index: 1; }
        .modal-body .modal-subtitle { font-weight: 700; color: var(--dsi-blue); border-bottom: 2px solid var(--dsi-green); padding-bottom: 0.5rem; margin-top: 1.5rem; margin-bottom: 1rem; }
        .modal-footer .btn-success { background-color: var(--dsi-green); border-color: var(--dsi-green); }

        /* --- Annuaire "Explorateur" --- */
        .directory-section { padding: 4rem 1.5rem; background-color: var(--light-bg); }
        .toolbar { display: flex; flex-wrap: wrap; gap: 1rem; padding: 1.5rem; background: white; border-radius: 16px; box-shadow: 0 20px 50px -20px rgba(9, 66, 129, 0.25); position: relative; z-index: 2; }
        .search-group { flex-grow: 1; position: relative; }
        .search-group i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: var(--muted-ink); }
        .search-group input { height: 50px; padding-left: 40px; border-radius: 10px; background: #f8fafd; border-color: var(--border-color); }
        .directory-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 1.5rem; margin-top: 3rem; }
        .esn-card { background: white; border: 1px solid var(--border-color); border-radius: 16px; padding: 1.5rem; display: flex; gap: 1.5rem; transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .esn-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px -10px rgba(9, 66, 129, 0.15); }
        .esn-logo img { width: 70px; height: 70px; border-radius: 50%; object-fit: cover; border: 3px solid var(--light-bg); }
        .esn-info h3 { font-size: 1.25rem; font-weight: 700; margin: 0 0 0.25rem 0; }
        .esn-info h3 a { color: var(--ink); text-decoration: none; }
        .esn-info .esn-desc { font-size: 0.9rem; color: var(--muted-ink); margin-bottom: 0.75rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .esn-meta { font-size: 0.85rem; color: var(--muted-ink); }
        .esn-tag { font-size: 0.75rem; font-weight: 600; padding: 0.25rem 0.75rem; border-radius: 20px; color: white; background: var(--dsi-blue); }
        .esn-tag.startup { background: var(--dsi-green); }
        .chatbot-fab { position: fixed; bottom: 25px; left: ;: 25px; width: 60px; height: 60px; background-color: var(--dsi-blue); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; box-shadow: 0 5px 20px rgba(0,0,0,0.2); cursor: pointer; z-index: 1000; }
    </style>

<!-- ================= ACTE I : LA PROMESSE ================= -->
    <section class="hero-esn-banner animated-section is-visible">
        <h1>L'Écosystème des Partenaires ESN</h1>
    </section>

    <section class="triptyque-section animated-section">
        <div class="section-header">
            <h2>Un Écosystème Conçu pour Votre Croissance</h2>
            <p>Que vous soyez une startup innovante, un partenaire stratégique ou une ESN établie, le Club DSI vous offre une plateforme unique pour accélérer votre développement.</p>
        </div>
        <div class="triptyque-container">
            <div class="triptyque-tabs">
                <button class="tab-button active" data-target="startups">Pour les Startups</button>
                <button class="tab-button" data-target="partenaires">Pour les Partenaires</button>
                <button class="tab-button" data-target="esn">Pour les ESN</button>
            </div>
            <div class="triptyque-content">
                <div class="tab-panel" id="startups"><div class="panel-text"><p class="panel-eyebrow">Pensé pour les startups</p><h3>Apparaissez au cœur de l'action</h3><ul><li>Augmentez votre visibilité en vous positionnant de manière stratégique.</li><li>Profitez de notre base de données pour explorer les préférences d'investisseurs.</li><li>Enregistrez gratuitement votre startup et attirez l'attention sur vos besoins.</li></ul><a href="{{ route('register.esn') }}" class="btn-custom">J'ajoute ma Startup <i class="fas fa-plus-circle ms-2"></i></a></div><div class="panel-image"><img src="https://clubdsibenin.bj/assets/images/dsi-get-it/screen_01.png" alt="Interface pour startups"></div></div>
                <div class="tab-panel hidden" id="partenaires"><div class="panel-text"><p class="panel-eyebrow">Pensé pour les partenaires</p><h3>Accompagner l'innovation</h3><ul><li>Utilisez nos indicateurs pour choisir les meilleures opportunités.</li><li>Obtenez un accès privilégié à une gamme triée sur le volet de startups.</li><li>Améliorez votre visibilité et attirez l'attention des startups.</li></ul></div><div class="panel-image"><img src="https://clubdsibenin.bj/assets/images/dsi-get-it/screen_02.png" alt="Interface pour partenaires"></div></div>
                <div class="tab-panel hidden" id="esn"><div class="panel-text"><p class="panel-eyebrow">Pensé pour les ESN</p><h3>Figurez au cœur de l'action</h3><ul><li>Augmentez la visibilité de votre entreprise grâce à notre analyse de tendances.</li><li>Profitez de notre base de données pour explorer les préférences d'investisseurs.</li><li>Enregistrez gratuitement votre ESN et mettez à jour son profil.</li></ul><a href="{{ route('register.esn') }}" class="btn-custom">J'ajoute mon ESN <i class="fas fa-plus-circle ms-2"></i></a></div><div class="panel-image"><img src="https://clubdsibenin.bj/assets/images/dsi-get-it/screen_01.png" alt="Interface pour ESN"></div></div>
            </div>
        </div>
    </section>

<!-- ================= ACTE II : LA COMMUNAUTÉ ================= -->
    <section class="community-section animated-section">
        <div class="section-header">
            <h2>Découvrez nos Communautés de Pratique</h2>
            <p>Chaque groupe est un hub d'expertise dédié à un segment clé de notre écosystème, animé par des experts pour favoriser l'innovation et les synergies.</p>
        </div>
        <div class="community-grid">
            <div class="community-card" data-bs-toggle="modal" data-bs-target="#photonModal"><img src="https://clubdsibenin.bj/assets/images/groupe/photon2.jpeg" alt=""><div class="community-card-overlay"><h3>Groupe Photon</h3><span class="btn-join">Voir les détails</span></div></div>
            <div class="community-card" data-bs-toggle="modal" data-bs-target="#electronModal"><img src="https://clubdsibenin.bj/assets/images/groupe/electron.jpeg" alt=""><div class="community-card-overlay"><h3>Groupe Electron</h3><span class="btn-join">Voir les détails</span></div></div>
            <div class="community-card" data-bs-toggle="modal" data-bs-target="#bosonModal"><img src="https://clubdsibenin.bj/assets/images/groupe/bos.jpeg" alt=""><div class="community-card-overlay"><h3>Groupe Boson</h3><span class="btn-join">Voir les détails</span></div></div>
            <div class="community-card" data-bs-toggle="modal" data-bs-target="#carbonModal"><img src="https://clubdsibenin.bj/assets/images/groupe/carbon.jpeg" alt=""><div class="community-card-overlay"><h3>Groupe Carbon</h3><span class="btn-join">Voir les détails</span></div></div>
        </div>
    </section>

<!-- ================= ACTE III : L'EXPLORATION ================= -->
    <section class="directory-section animated-section">
        <div class="section-header">
            <h2>Explorez l'Annuaire</h2>
            <p>Découvrez, filtrez et connectez-vous avec les entreprises du service numérique qui façonnent l'avenir technologique du Bénin.</p>
        </div>
        <div class="container">
            <div class="toolbar"><div class="search-group"><i class="fas fa-search"></i><input type="text" class="form-control" placeholder="Rechercher une entreprise..."></div></div>
            <main class="directory-grid">
                <div class="esn-card"><div class="esn-logo"><img src="https://clubdsibenin.bj/storage/registre_commerce/logo/pm5F6bXo4RYQ50bq.png" alt="Logo 41DEVS"></div><div class="esn-info"><div class="d-flex justify-content-between align-items-start"><h3><a href="#">Groupe 41DEVS</a></h3><span class="esn-tag">Entreprise</span></div><p class="esn-desc">Aide les entreprises à devenir plus productives et identifier des leviers...</p><div class="esn-meta"><i class="fas fa-map-marker-alt me-1 text-danger"></i> Cotonou, Gbèdjromédé</div></div></div>
                <div class="esn-card"><div class="esn-logo"><img src="https://clubdsibenin.bj/storage/registre_commerce/logo/neiHyUdT63XxBNMj.jpg" alt="Logo CyberSpector"></div><div class="esn-info"><div class="d-flex justify-content-between align-items-start"><h3><a href="#">CyberSpector</a></h3><span class="esn-tag startup">Startup</span></div><p class="esn-desc">Entreprise innovante dans le domaine de la CyberSécurité et la Cyber-Intelligence...</p><div class="esn-meta"><i class="fas fa-map-marker-alt me-1 text-danger"></i> Cotonou, St-Jean</div></div></div>
                <div class="esn-card"><div class="esn-logo"><img src="https://clubdsibenin.bj/storage/registre_commerce/logo/zydBVYAcvnoHndBl.png" alt="Logo 3D Techlogis"></div><div class="esn-info"><div class="d-flex justify-content-between align-items-start"><h3><a href="#">3D Techlogis BENIN</a></h3><span class="esn-tag">Entreprise</span></div><p class="esn-desc">Société innovante qui se distingue par des solutions technologiques adaptées au contexte africain.</p><div class="esn-meta"><i class="fas fa-map-marker-alt me-1 text-danger"></i> Cotonou, Menontin</div></div></div>
            </main>
            <nav aria-label="Page navigation" class="d-flex justify-content-center mt-4"><ul class="pagination"><li class="page-item disabled"><a class="page-link" href="#">Précédent</a></li><li class="page-item active"><a class="page-link" href="#">1</a></li><li class="page-item"><a class="page-link" href="#">2</a></li><li class="page-item"><a class="page-link" href="#">Suivant</a></li></ul></nav>
        </div>
    </section>

    <div class="chatbot-fab" title="Besoin d'aide ?"><i class="fa-solid fa-comment-dots"></i></div>

    <!-- ================= MODALS ================= -->
    <div class="modal fade" id="photonModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered modal-lg"><div class="modal-content"><div class="modal-header-custom" style="background-image: url('https://clubdsibenin.bj/assets/images/groupe/photon2.jpeg');"><h5 class="modal-title">Groupe Photon</h5></div><div class="modal-body p-4"><h6 class="modal-subtitle">Description</h6><p>Le Groupe Photon symbolise l'énergie et la lumière, reflétant l'innovation et la rapidité des startups dans le secteur numérique.</p><h6 class="modal-subtitle">Conditions d'Adhésion</h6><ul><li>Être une start-up avec au plus 2 ans d'expérience.</li><li>Capital entre 0 - 999 999 FCFA.</li><li>Compte vérifié et approuvé par le Club DSI Bénin.</li></ul></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button><a href="#" class="btn btn-success">Rejoindre Maintenant</a></div></div></div></div>
    <div class="modal fade" id="electronModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered modal-lg"><div class="modal-content"><div class="modal-header-custom" style="background-image: url('https://clubdsibenin.bj/assets/images/groupe/electron.jpeg');"><h5 class="modal-title">Groupe Electron</h5></div><div class="modal-body p-4"><h6 class="modal-subtitle">Description</h6><p>Dédié aux startups dynamiques, capables d'apporter rapidement des changements positifs dans le secteur numérique.</p><h6 class="modal-subtitle">Conditions d'Adhésion</h6><ul><li>Être une start-up avec minimum 2 ans d'expérience.</li><li>Capital entre 999 999 - 25 000 000 FCFA.</li><li>Compte vérifié et approuvé.</li></ul></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button><a href="#" class="btn btn-success">Rejoindre Maintenant</a></div></div></div></div>
    <div class="modal fade" id="bosonModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered modal-lg"><div class="modal-content"><div class="modal-header-custom" style="background-image: url('https://clubdsibenin.bj/assets/images/groupe/bos.jpeg');"><h5 class="modal-title">Groupe Boson</h5></div><div class="modal-body p-4"><h6 class="modal-subtitle">Description</h6><p>Inspiré par le boson de Higgs, ce groupe représente les startups qui apportent une masse significative au secteur numérique.</p><h6 class="modal-subtitle">Conditions d'Adhésion</h6><ul><li>Être une start-up avec minimum 4 ans d'expérience.</li><li>Capital entre 25 000 000 - 50 000 000 FCFA.</li><li>Compte vérifié et approuvé.</li></ul></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button><a href="#" class="btn btn-success">Rejoindre Maintenant</a></div></div></div></div>
    <div class="modal fade" id="carbonModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered modal-lg"><div class="modal-content"><div class="modal-header-custom" style="background-image: url('https://clubdsibenin.bj/assets/images/groupe/carbon.jpeg');"><h5 class="modal-title">Groupe Carbon</h5></div><div class="modal-body p-4"><h6 class="modal-subtitle">Description</h6><p>Le Carbon, élément fondamental, symbolise les entreprises commerciales établies qui forment l'épine dorsale du secteur.</p><h6 class="modal-subtitle">Conditions d'Adhésion</h6><ul><li>Être une entreprise commerciale avec minimum 5 ans d'expérience.</li><li>Capital entre 50 000 000 - 100 000 000 FCFA.</li><li>Compte vérifié et approuvé.</li></ul></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button><a href="#" class="btn btn-success">Rejoindre Maintenant</a></div></div></div></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const animatedSections = document.querySelectorAll('.animated-section');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => { if (entry.isIntersecting) { entry.target.classList.add('is-visible'); observer.unobserve(entry.target); } });
        }, { threshold: 0.15 });
        animatedSections.forEach(section => { observer.observe(section); });
        const tabs = document.querySelectorAll('.tab-button');
        const panels = document.querySelectorAll('.tab-panel');
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                const targetId = tab.getAttribute('data-target');
                panels.forEach(panel => { panel.classList.toggle('hidden', panel.id !== targetId); });
            });
        });
    </script>

@endsection
