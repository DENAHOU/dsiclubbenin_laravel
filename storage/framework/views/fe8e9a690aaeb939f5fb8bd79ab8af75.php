<?php $__env->startSection('title', 'Recrutements'); ?>

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
        body { font-family: 'Inter', sans-serif; background-color: white; color: var(--ink); margin: 0; }

        /* --- Héros Animé --- */
        .hero-recruitment-v2 {
            position: relative;
            padding: clamp(5rem, 20vh, 10rem) 1.5rem;
            background-color: #101d34f8;
            color: white;
            text-align: center;
            overflow: hidden;
        }
        #plexus-bg { position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 0; }
        .hero-content-v2 { position: relative; z-index: 1; }
        .hero-recruitment-v2 .eyebrow { color: var(--dsi-green); font-weight: 700; letter-spacing: .1em; text-transform: uppercase; }
        .hero-recruitment-v2 h1 { font-size: clamp(2.5rem, 6vw, 4.5rem); font-weight: 800; color: #fff; }
        .hero-recruitment-v2 p { font-size: clamp(1rem, 2vw, 1.25rem); max-width: 700px; margin: 1rem auto 0 auto; opacity: 0.9; }

        /* --- Section IA Core --- */
        .recruitment-section-light { background-color: white; padding: 4rem 1.5rem; }
        .recruitment-hub-light { max-width: 1100px; margin: auto; background: var(--light-bg); border: 1px solid var(--border-color); border-radius: 24px; padding: clamp(1.5rem, 4vw, 3rem); box-shadow: 0 25px 50px -12px rgba(11, 63, 122, 0.15); }
        .hub-toggle { display: flex; justify-content: center; background: #e9eef5; border-radius: 12px; padding: 5px; width: fit-content; margin: 0 auto 2rem auto; }
        .hub-toggle button { background: transparent; border: none; color: var(--muted-ink); padding: 0.75rem 1.5rem; font-size: 1rem; font-weight: 600; border-radius: 8px; cursor: pointer; transition: all 0.3s ease; }
        .hub-toggle button.active { background: var(--dsi-blue); color: white; box-shadow: 0 5px 15px rgba(11, 63, 122, 0.3); }
        .hub-content { display: grid; grid-template-columns: 1fr 1fr; align-items: center; gap: 2rem; }
        @media (max-width: 992px) { .hub-content { grid-template-columns: 1fr; } .ai-core-animation { order: -1; margin-bottom: 2rem; } }
        .hub-panel h3 { font-size: 2rem; font-weight: 700; margin-bottom: 1rem; }
        .hub-panel p { color: var(--muted-ink); line-height: 1.6; }
        .hub-panel ul { list-style: none; padding: 0; margin-top: 1.5rem; }
        .hub-panel li { margin-bottom: 0.75rem; display: flex; align-items: flex-start; }
        .hub-panel li .fa-check-circle { color: var(--dsi-green); margin-right: 0.75rem; margin-top: 5px; }
        .hub-actions { display: flex; gap: 1rem; flex-wrap: wrap; }
        .hub-actions .btn { font-weight: 600; text-decoration:none; padding: 0.7rem 1.2rem; border-radius: 10px; }
        .hub-actions .btn-primary { background: var(--dsi-blue); border-color: var(--dsi-blue); color:white; }
        .hub-actions .btn-secondary { background: white; color: var(--dsi-blue); border-color: var(--border-color); }

        .ai-core-animation { position: relative; display: grid; place-items: center; min-height: 300px; }
        .ai-core { width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, var(--dsi-green), var(--dsi-blue)); box-shadow: 0 0 30px color-mix(in oklab, var(--dsi-blue) 40%, transparent); display: grid; place-items: center; font-size: 2rem; color: white; animation: pulse 2s infinite ease-in-out; }
        .ring { position: absolute; width: 150px; height: 150px; border: 2px solid color-mix(in oklab, var(--dsi-blue) 20%, transparent); border-radius: 50%; animation: spin 8s linear infinite; }
        .ring:nth-child(2) { width: 220px; height: 220px; animation-duration: 12s; animation-direction: reverse; }
        .ring:nth-child(3) { width: 300px; height: 300px; animation-duration: 15s; }
        .ring .node { width: 12px; height: 12px; background: var(--dsi-blue); border-radius: 50%; box-shadow: 0 0 10px var(--dsi-blue); position: absolute; top: 50%; left: -6px; transform-origin: 75px 0; }
        .ring:nth-child(2) .node { transform-origin: 110px 0; }
        .ring:nth-child(3) .node { transform-origin: 150px 0; }

        .recruitment-stats-light { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; max-width: 1100px; margin: 3rem auto 0 auto; text-align: center; }
        @media (max-width: 576px) { .recruitment-stats-light { grid-template-columns: 1fr; } }
        .stat-item { padding: 1.5rem; background: white; border-radius: 16px; border: 1px solid var(--border-color); }
        .stat-item .stat-number { font-size: 2.5rem; font-weight: 800; color: var(--dsi-blue); }
        .stat-item .stat-label { font-size: 0.9rem; color: var(--muted-ink); }

        .chatbot-fab { position: fixed; bottom: 25px; left: 25px; width: 60px; height: 60px; background-color: var(--dsi-blue); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; box-shadow: 0 5px 20px rgba(0,0,0,0.2); cursor: pointer; z-index: 1000; }

        @keyframes pulse { 0%, 100% { transform: scale(1); box-shadow: 0 0 30px color-mix(in oklab, var(--dsi-blue) 40%, transparent); } 50% { transform: scale(1.1); box-shadow: 0 0 50px color-mix(in oklab, var(--dsi-blue) 60%, transparent); } }
        @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        /* --- Tableau de Bord des Offres --- */
        .job-board-container { padding: 4rem 1.5rem; background-color: var(--light-bg); }
        .filter-bar { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem; background: white; padding: 1.5rem; border-radius: 16px; box-shadow: 0 15px 40px -15px rgba(11, 63, 122, 0.1); margin-bottom: 2.5rem; border: 1px solid var(--border-color); }
        .filter-group { position: relative; }
        .filter-group i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: var(--muted-ink); }
        .filter-group .form-control, .filter-group .form-select { padding-left: 40px; height: 50px; border-radius: 10px; border: 1px solid var(--border-color); background-color: var(--light-bg); box-shadow: none !important; }
        .filter-group .btn-primary { width: 100%; height: 50px; border-radius: 10px; background: var(--dsi-blue); border: none; font-weight: 600; }
        .job-board-layout { display: grid; grid-template-columns: 1fr 320px; gap: 2rem; align-items: flex-start; }
        @media (max-width: 992px) { .job-board-layout { grid-template-columns: 1fr; } }
        .job-listings { display: grid; gap: 1.5rem; }
        .job-card { background: white; border: 1px solid var(--border-color); border-radius: 16px; padding: 1.5rem; box-shadow: 0 5px 15px -5px rgba(11, 63, 122, 0.05); transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .job-card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px -15px rgba(11, 63, 122, 0.15); }
        .job-card-header { display: flex; align-items: flex-start; gap: 1rem; }
        .company-logo { width: 50px; height: 50px; border-radius: 10px; flex-shrink: 0; background: var(--light-bg); display: grid; place-items:center; }
        .job-title { font-size: 1.25rem; font-weight: 700; color: var(--ink); margin: 0 0 0.25rem 0; }
        .company-name { font-weight: 500; color: var(--muted-ink); }
        .job-tags { display: flex; flex-wrap: wrap; gap: 0.5rem; margin: 1rem 0; }
        .tag { font-size: 0.8rem; font-weight: 600; padding: 0.3rem 0.7rem; border-radius: 20px; }
        .tag.tag-location { background-color: color-mix(in oklab, var(--dsi-green) 15%, transparent); color: var(--dsi-green); }
        .tag.tag-contract { background-color: color-mix(in oklab, var(--dsi-blue) 15%, transparent); color: var(--dsi-blue); }
        .tag.tag-remote { background-color: color-mix(in oklab, orange 15%, transparent); color: orange; }
        .job-card-footer { display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--border-color); padding-top: 1rem; margin-top: 1rem; }
        .posted-date { font-size: 0.85rem; color: var(--muted-ink); }
        .btn-details { background: var(--dsi-blue); color: white; border: none; padding: 0.6rem 1.2rem; border-radius: 10px; font-weight: 600; text-decoration: none; }
        .sidebar { position: sticky; top: 2rem; }
        @media (max-width: 992px) { .sidebar { position: static; top: auto; } }
        .sidebar-widget { background: white; border: 1px solid var(--border-color); border-radius: 16px; padding: 1.5rem; margin-bottom: 1.5rem; }
        .widget-title { font-size: 1.2rem; font-weight: 700; margin-bottom: 1rem; }
        .alert-form input { width: 100%; border-radius: 10px; border: 1px solid var(--border-color); height: 45px; margin-bottom: 0.75rem; padding: 0 1rem; }
        .btn-alert { width: 100%; background: var(--dsi-green); color: white; border: none; padding: 0.7rem; border-radius: 10px; font-weight: 600; }
        .ai-recommendation-card { background: linear-gradient(135deg, var(--dsi-blue), #0f172a); color: white; border-radius: 16px; padding: 2rem; text-align: center; }
        .ai-recommendation-card .fa-brain { font-size: 2.5rem; margin-bottom: 1rem; }
        .ai-recommendation-card h4 { font-weight: 700; }
        .ai-recommendation-card p { opacity: 0.8; font-size: 0.9rem; }
        .btn-profile { background: white; color: var(--dsi-blue); font-weight: 600; padding: 0.6rem 1.2rem; border-radius: 10px; margin-top: 1rem; border:none; text-decoration: none; }

        @keyframes pulse { 0%, 100% { transform: scale(1); box-shadow: 0 0 30px color-mix(in oklab, var(--dsi-blue) 40%, transparent); } 50% { transform: scale(1.1); box-shadow: 0 0 50px color-mix(in oklab, var(--dsi-blue) 60%, transparent); } }
        @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

        .job-board-container h1 {
            font-size: clamp(2.5rem, 5vw, 3.5rem);
            font-weight: 800;
            background: linear-gradient(95deg, var(--dsi-blue), var(--dsi-green));
            -webkit-background-clip: text; background-clip: text; color: transparent;
            text-align: center;
        }

        .job-board-container p {
            font-size: 1.125rem;
            color: var(--muted-ink);
            max-width: 600px;
            margin: 0.5rem auto 0 auto;
            text-align: center;
            padding: 15px;
        }
    </style>


    <section class="hero-recruitment-v2">
        <canvas id="plexus-bg"></canvas>
        <div class="hero-content-v2">
            <p class="eyebrow">Notre Plateforme de Recrutement</p>
            <h1>L'Intelligence Artificielle au service des Talents</h1>
            <p>Que vous soyez un talent à la recherche de votre prochain défi ou une entreprise en quête du profil idéal, notre plateforme intelligente est conçue pour vous.</p>
        </div>

        <!-- BANNIERE TEMPORAIRE -->
        <div class="container mt-4" style="position:relative; z-index:2;">
            <div class="alert alert-warning text-center mb-0">
                <strong>Info :</strong> Le service de recrutement est en cours de déploiement. Nous vous tiendrons informé très bientôt !
            </div>
        </div>
    </section>

    <section class="recruitment-section-light">
        <div class="container py-5">
            <div class="recruitment-hub-light">
                <div class="hub-toggle">
                    <button id="candidate-toggle" class="active">Je suis Candidat</button>
                    <button id="recruiter-toggle">Je suis Recruteur</button>
                </div>
                <div class="hub-content">
                    <div class="hub-panels">
                        <div class="hub-panel" id="candidate-panel">
                            <h3>Trouvez votre prochain défi</h3>
                            <p>Notre IA analyse votre profil pour vous connecter aux opportunités qui vous correspondent vraiment.</p>
                            <ul>
                                <li><i class="fas fa-check-circle"></i>Recevez des recommandations personnalisées.</li>
                                <li><i class="fas fa-check-circle"></i>Créez des alertes intelligentes.</li>
                                <li><i class="fas fa-check-circle"></i>Suivez les statistiques du marché.</li>
                            </ul>
                            <div class="hub-actions mt-4">
                                <a href="<?php echo e(route('login.candidat')); ?>" class="btn btn-primary">Se connecter</a>
                                <a href="<?php echo e(route('register.candidat')); ?>"" class="btn btn-secondary">Déposer mon CV</a>
                            </div>
                        </div>
                        <div class="hub-panel" id="recruiter-panel" style="display: none;">
                            <h3>Découvrez le profil idéal</h3>
                            <p>Gagnez un temps précieux. Notre plateforme vous présente des profils qualifiés grâce à un matching automatisé.</p>
                            <ul>
                                <li><i class="fas fa-check-circle"></i>Bénéficiez d'un matching automatisé.</li>
                                <li><i class="fas fa-check-circle"></i>Accédez à un vivier de talents qualifiés.</li>
                                <li><i class="fas fa-check-circle"></i>Utilisez nos statistiques pour recruter.</li>
                            </ul>
                            <div class="hub-actions mt-4">
                                <a href="<?php echo e(route('register.recruter')); ?>" class="btn btn-primary">Sinscrire</a>
                                <a href="<?php echo e(route('login.recruter')); ?>" class="btn btn-secondary">Accéder à la CVthèque</a>
                            </div>
                        </div>
                    </div>
                    <div class="ai-core-animation">
                        <div class="ring"><div class="node"></div></div>
                        <div class="ring"><div class="node"></div></div>
                        <div class="ring"><div class="node"></div></div>
                        <div class="ai-core"><i class="fas fa-brain"></i></div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>

    

    <script>
        const canvas = document.getElementById('plexus-bg');
        if(canvas) {
            const ctx = canvas.getContext('2d');
            let width = canvas.width = canvas.offsetWidth;
            let height = canvas.height = canvas.offsetHeight;
            let particles = [];
            const particleCount = 60;
            const maxDist = 120;
            class Particle {
                constructor() { this.x = Math.random() * width; this.y = Math.random() * height; this.vx = (Math.random() - 0.5) * 0.3; this.vy = (Math.random() - 0.5) * 0.3; this.radius = 2; }
                draw() { ctx.beginPath(); ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2); ctx.fillStyle = 'rgba(255, 255, 255, 0.5)'; ctx.fill(); }
                update() { this.x += this.vx; this.y += this.vy; if (this.x < 0 || this.x > width) this.vx *= -1; if (this.y < 0 || this.y > height) this.vy *= -1; }
            }
            function init() { for (let i = 0; i < particleCount; i++) { particles.push(new Particle()); } }
            function connect() {
                for (let i = 0; i < particles.length; i++) {
                    for (let j = i; j < particles.length; j++) {
                        const dist = Math.sqrt((particles[i].x - particles[j].x) ** 2 + (particles[i].y - particles[j].y) ** 2);
                        if (dist < maxDist) {
                            ctx.beginPath(); ctx.moveTo(particles[i].x, particles[i].y); ctx.lineTo(particles[j].x, particles[j].y);
                            ctx.strokeStyle = `rgba(41, 150, 58, ${1 - dist / maxDist})`; ctx.stroke();
                        }
                                    }
                }
            }
            function animate() { ctx.clearRect(0, 0, width, height); particles.forEach(p => { p.update(); p.draw(); }); connect(); requestAnimationFrame(animate); }
            init();
            animate();
            window.addEventListener('resize', () => { width = canvas.width = canvas.offsetWidth; height = canvas.height = canvas.offsetHeight; particles = []; init(); });
        }

        const candidateToggle = document.getElementById('candidate-toggle');
        const recruiterToggle = document.getElementById('recruiter-toggle');
        const candidatePanel = document.getElementById('candidate-panel');
        const recruiterPanel = document.getElementById('recruiter-panel');
        if(candidateToggle) {
            candidateToggle.addEventListener('click', () => { candidateToggle.classList.add('active'); recruiterToggle.classList.remove('active'); recruiterPanel.style.display = 'none'; candidatePanel.style.display = 'block'; });
            recruiterToggle.addEventListener('click', () => { recruiterToggle.classList.add('active'); candidateToggle.classList.remove('active'); candidatePanel.style.display = 'none'; recruiterPanel.style.display = 'block'; });
        }
    </script>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/pages/recrutement.blade.php ENDPATH**/ ?>