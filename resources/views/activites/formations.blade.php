@extends('layouts.guest')

@section('title', 'Nos Formations')

@php
    function getYouTubeId($url) {
        if (!$url) return null;
        $pattern = '/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([^&\n?#]+)/';
        preg_match($pattern, $url, $matches);
        return $matches[1] ?? null;
    }
@endphp


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
        .hero-formations {
            position: relative; height: 100vh; display: grid; place-items: center; text-align: center; color: white;
            background-image: linear-gradient(rgba(11, 24, 39, 0.836), rgba(10, 27, 48, 0.733)), url('https://images.unsplash.com/photo-1516321497487-e288fb19713f?w=1200');
            background-size: cover; background-position: center;
        }
        .hero-formations h1 { font-size: clamp(2.5rem, 6vw, 4rem); font-weight: 800; color: #fff; }

        /* --- Section Titre --- */
        .section-header { text-align: center; padding: 4rem 1.5rem 3rem 1.5rem; }
        .section-header h2 { font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 800; }
        .section-header p { color: var(--muted-ink); max-width: 700px; margin: 0.5rem auto 0 auto; font-size: 1.125rem; }

        /* --- Catégories Thématiques --- */
        .categories-section { padding-bottom: 4rem; }
        .categories-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 3rem; max-width: 1500px; margin: auto;
        }
        .category-card {
            position: relative; border-radius: 16px; padding: 2rem;
            height: 250px; width: 350px; display: flex; flex-direction: column; justify-content: flex-end;
            color: white; text-decoration: none; overflow: hidden;
            transition: transform 0.3s ease;
        }
        .category-card:hover { transform: scale(1.05); }
        .category-card::before {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 110%);
            z-index: 1;
        }
        .category-card img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
        .category-card-content { position: relative; z-index: 2; }
        .category-card h3 { font-size: 1.5rem; font-weight: 700; color: #fff; }

        /* --- Catalogue des Formations --- */
        .catalog-section { padding: 4rem 1.5rem; }
        .catalog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }
        .formation-card {
            background: white; border-radius: 16px; overflow: hidden;
            box-shadow: 0 10px 30px -15px rgba(11, 63, 122, 0.1);
            display: flex; flex-direction: column;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .formation-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px -15px rgba(11, 66, 129, 0.2); }
        .card-header-img { height: 180px; background-size: cover; background-position: center; }
        .card-body { padding: 1.5rem; flex-grow: 1; }
        .card-tag { display: inline-block; font-size: 0.8rem; font-weight: 600; padding: 0.3rem 0.8rem; border-radius: 20px; margin-bottom: 1rem; color: white; background-color: var(--dsi-blue); }
        .card-title { font-size: 1.2rem; font-weight: 700; color: var(--ink); text-decoration: none; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 3.6rem; }
        /* --- Section Premium Formations Actuelles --- */
        .premium-formations-section {
            padding: 4rem 0;
            position: relative;
            overflow: hidden;
        }

        .premium-formations-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="gold-pattern" width="30" height="30" patternUnits="userSpaceOnUse"><circle cx="15" cy="15" r="2" fill="rgba(255,215,0,0.08)"/><circle cx="0" cy="0" r="1" fill="rgba(255,215,0,0.05)"/><circle cx="30" cy="30" r="1" fill="rgba(255,215,0,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23gold-pattern)"/></svg>');
            pointer-events: none;
        }

        .premium-formations-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            position: relative;
            z-index: 1;
        }

        .premium-formations-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .premium-formations-header h2 {
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

        .premium-formations-header p {
            font-size: 1.2rem;
            color: #2c3e50;
            line-height: 1.8;
            max-width: 600px;
            margin: 0 auto;
        }

        .premium-formations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.2rem;
            margin-bottom: 1.5rem;
        }

        .premium-formation-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            border: 2px solid transparent;
            background-clip: padding-box;
        }

        .premium-formation-card::before {
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

        .premium-formation-card:hover::before {
            transform: scaleX(1);
        }

        .premium-formation-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 25px 50px rgba(255,215,0,0.15);
            border-color: #ffd700;
        }

        .premium-card-header {
            height: 140px;
            background-size: cover;
            background-position: center;
            position: relative;
            overflow: hidden;
        }

        .premium-card-header::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.3) 100%);
        }

        .premium-card-body {
            padding: 1.2rem;
        }

        .premium-card-tag {
            display: inline-block;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            margin-bottom: 1rem;
            color: white;
            background: var(--dsi-blue);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .premium-card-title {
            font-size: 1.2rem;
            font-weight: 800;
            color: #2c3e50;
            margin-bottom: 0.8rem;
            line-height: 1.3;
        }

        .premium-card-description {
            color: #6c757d;
            line-height: 1.6;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .premium-card-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid #e9ecef;
        }

        .premium-card-date {
            font-size: 0.9rem;
            color: var(--dsi-blue);
            font-weight: 600;
        }

        .premium-card-status {
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

        .premium-card-status.upcoming {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        }

        .premium-card-location {
            margin-bottom: 1rem;
            font-size: 0.9rem;
            color: #6c757d;
        }

        .premium-card-action {
            margin-top: 1.5rem;
        }

        .btn-premium {
            display: inline-block;
            padding: 0.8rem 2rem;
            background: linear-gradient(135deg, var(--dsi-blue) 0%, #0056b3 100%);
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(9, 66, 129, 0.3);
            background: linear-gradient(135deg, #0056b3 0%, var(--dsi-blue) 100%);
        }

        .video-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.3);
            transition: all 0.3s ease;
        }

        .premium-card-header:hover .video-overlay {
            background: rgba(0,0,0,0.5);
        }

        .premium-card-header:hover .video-overlay i {
            transform: scale(1.1);
            opacity: 1;
        }

        .premium-card-inscriptions {
            margin-top: 1rem;
            padding-top: 0.8rem;
            border-top: 1px solid #e9ecef;
        }

        .inscription-options h4 {
            font-size: 0.9rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 0.8rem;
            text-align: center;
        }

        .inscription-option {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 0.8rem;
            margin-bottom: 0.6rem;
            border-left: 4px solid var(--dsi-blue);
            transition: all 0.3s ease;
        }

        .inscription-option.online {
            border-left-color: #007bff;
        }

        .inscription-option.onsite {
            border-left-color: #28a745;
        }

        .inscription-option:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .option-label {
            display: inline-block;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .inscription-option.online .option-label {
            display: inline-block;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.25rem 0.6rem;
            border-radius: 12px;
            margin-bottom: 0.4rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .inscription-option.onsite .option-label {
            background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
            color: white;
        }

        .option-price {
            display: block;
            font-size: 1rem;
            font-weight: 800;
            color: var(--dsi-blue);
            margin-bottom: 0.6rem;
        }

        .btn-inscription {
            display: inline-block;
            padding: 0.5rem 1.2rem;
            background: linear-gradient(135deg, var(--dsi-blue) 0%, #0056b3 100%);
            color: white;
            text-decoration: none;
            border-radius: 18px;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-inscription:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(9, 66, 129, 0.3);
            background: linear-gradient(135deg, #0056b3 0%, var(--dsi-blue) 100%);
        }

        .inscription-option.onsite .btn-inscription {
            background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
        }

        .inscription-option.onsite .btn-inscription:hover {
            background: linear-gradient(135deg, #1e7e34 0%, #28a745 100%);
            box-shadow: 0 8px 15px rgba(40, 167, 69, 0.3);
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

    <section class="hero-formations">
        <h1>L'Académie des Leaders Numériques</h1>
    </section>

    <main>
            <section class="categories-section animated-section">
                <div class="container">
                    <div class="section-header">
                        <h2>Explorez nos Pôles d'Expertise</h2>
                        <p>Naviguez à travers nos grandes thématiques pour trouver les formations adaptées à vos objectifs de carrière.</p>
                    </div>
                    <div class="categories-grid">
                        <a href="#gouvernance" class="category-card"><img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=800" alt=""><div class="category-card-content"><h3>Gouvernance & Architecture</h3></div></a>
                        <a href="#gestion-it" class="category-card"><img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=800" alt=""><div class="category-card-content"><h3>Gestion des Services IT</h3></div></a>
                        <a href="#projets" class="category-card"><img src="https://images.unsplash.com/photo-1543286386-713bdd548da4?w=800" alt=""><div class="category-card-content"><h3>Gestion de Projet & Programme</h3></div></a>
                        <a href="#securite" class="category-card"><img src="{{ asset('img/OIP.webp') }}" alt=""><div class="category-card-content"><h3>Sécurité & Management SI</h3></div></a>
                    </div>
                </div>
            </section>

            <section class="catalog-section">
                <div class="container">
                    <!-- SECTION PREMIUM FORMATIONS ACTUELLES -->
                    <section class="premium-formations-section animated-section">
                        <div class="premium-formations-content">
                            <div class="premium-formations-header">
                                <h2>Nouvelles Formations</h2>
                                <p>Découvrez nos formations exclusives conçues par des experts pour vous propulser vers l'excellence numérique.</p>
                            </div>
                            
                            @if(isset($formations) && $formations->count() > 0)
                                <div class="premium-formations-grid">
                                    @foreach($formations as $formation)
                                        <div class="premium-formation-card">
                                            @if($formation->image)
                                   <div class="premium-card-header" style="background-image: url('{{ asset('storage/formations/'.$formation->image) }}');"></div>
                               @elseif($formation->video_url)
                                   <div class="premium-card-header" style="background-image: url('https://img.youtube.com/vi/{{ getYouTubeId($formation->video_url) }}/maxresdefault.jpg');">
                                       <div class="video-overlay">
                                           <i class="fas fa-play-circle" style="font-size: 3rem; color: white; opacity: 0.8;"></i>
                                       </div>
                                   </div>
                               @else
                                   <div class="premium-card-header" style="background-image: url('https://images.unsplash.com/photo-1516321497487-e288fb19713f?w=800');"></div>
                               @endif
                                            <div class="premium-card-body">
                                                <span class="premium-card-tag">{{ $formation->categoryFormation ? $formation->categoryFormation->nom : ($formation->type_formation ?? 'Premium') }}</span>
                                                <h3 class="premium-card-title">{{ $formation->titre }}</h3>
                                                <p class="premium-card-description">{{ Str::limit($formation->description ?? 'Formation exclusive conçue par les experts du DSI CLUB pour développer vos compétences.', 150) }}</p>
                                                
                                                @if($formation->lieu)
                                                    <div class="premium-card-location">
                                                        <i class="fas fa-map-marker-alt me-1" style="color: var(--dsi-blue);"></i>
                                                        <span>{{ $formation->lieu }}</span>
                                                    </div>
                                                @endif
                                                
                                                <div class="premium-card-meta">
                                                    <span class="premium-card-date">
                                                        <i class="fas fa-calendar-alt me-1"></i>
                                                        {{ $formation->date_debut ? \Carbon\Carbon::parse($formation->date_debut)->format('d/m/Y') : 'À venir' }}
                                                    </span>
                                                    <span class="premium-card-status {{ $formation->status == 'upcoming' ? 'upcoming' : '' }}">
                                                        {{ $formation->status == 'actif' ? 'Active' : ($formation->status == 'upcoming' ? 'À venir' : 'Complète') }}
                                                    </span>
                                                </div>
                                                
                                                <!-- Section Inscriptions -->
                                                <div class="premium-card-inscriptions">
                                                    @if($formation->type_formation == 'en_ligne' || $formation->type_formation == 'presentiel')
                                                        <div class="inscription-options">
                                                            <h4>Options d'inscription</h4>
                                                            
                                                            @if($formation->type_formation == 'en_ligne' && $formation->lien_inscription_en_ligne)
                                                                <div class="inscription-option online">
                                                                    <span class="option-label">En ligne</span>
                                                                    @if($formation->prix_en_ligne)
                                                                        <span class="option-price">{{ number_format($formation->prix_en_ligne, 0, ',', ' ') }} FCFA</span>
                                                                    @endif
                                                                    <a href="{{ $formation->lien_inscription_en_ligne }}" class="btn-inscription" target="_blank">
                                                                        <i class="fas fa-laptop me-2"></i>S'inscrire
                                                                    </a>
                                                                </div>
                                                            @endif
                                                            
                                                            @if($formation->type_formation == 'presentiel' && $formation->lien_inscription_presentiel)
                                                                <div class="inscription-option onsite">
                                                                    <span class="option-label">Présentiel</span>
                                                                    @if($formation->prix_presentiel)
                                                                        <span class="option-price">{{ number_format($formation->prix_presentiel, 0, ',', ' ') }} FCFA</span>
                                                                    @endif
                                                                    <a href="{{ $formation->lien_inscription_presentiel }}" class="btn-inscription" target="_blank">
                                                                        <i class="fas fa-building me-2"></i>S'inscrire
                                                                    </a>
                                                                </div>
                                                            @endif
                                                            
                                                            @if($formation->type_formation == 'presentiel' && $formation->lien_inscription_en_ligne)
                                                                <div class="inscription-option online">
                                                                    <span class="option-label">En ligne</span>
                                                                    @if($formation->prix_en_ligne)
                                                                        <span class="option-price">{{ number_format($formation->prix_en_ligne, 0, ',', ' ') }} FCFA</span>
                                                                    @endif
                                                                    <a href="{{ $formation->lien_inscription_en_ligne }}" class="btn-inscription" target="_blank">
                                                                        <i class="fas fa-laptop me-2"></i>S'inscrire
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endif
                                                    
                                                    <!-- @if($formation->lien_formation)
                                                        <div class="premium-card-action">
                                                            <a href="{{ $formation->lien_formation }}" class="btn-premium" target="_blank">
                                                                <i class="fas fa-external-link-alt me-2"></i>
                                                                Suivre
                                                            </a>
                                                        </div>
                                                    @endif -->
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center">
                                    <div style="background: white; border-radius: 20px; padding: 3rem; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                                        <i class="fas fa-graduation-cap" style="font-size: 4rem; color: var(--dsi-blue); margin-bottom: 1.5rem;"></i>
                                        <h3 style="color: #2c3e50; font-size: 1.5rem; margin-bottom: 1rem;">Nouvelles formations bientôt disponibles</h3>
                                        <p class="text-muted fs-5">Nos experts préparent actuellement des formations premium exclusives pour vous.</p>
                                        <p>Revenez bientôt ou abonnez-vous à notre newsletter pour être informé des prochaines sessions.</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </section>

                    <!-- Formations Cloturées -->
                    <div class="animated-section">
                        <div class="section-header">
                            <h2><i class="fas fa-archive me-2"></i> Formations Clôturées</h2>
                        </div>
                        <div class="catalog-grid">
                            <!-- Carte 1 -->
                            <div class="formation-card">
                                <div class="card-header-img" style="background-image: url('https://clubdsibenin.bj/storage/formations/aHtssd8iLHxbMhOe.jpg');"></div>
                                <div class="card-body">
                                    <span class="card-tag">Gestion de Projet</span>
                                    <a href="#" class="card-title">Project Management Professional (PMP)</a>
                                </div>
                                <div class="card-footer">Clôturée le : <i>01-12-2023</i></div>
                            </div>
                            <!-- Carte 2 -->
                            <div class="formation-card">
                                <div class="card-header-img" style="background-image: url('https://clubdsibenin.bj/storage/formations/myetYQ6VyAmpjSoe.jpg');"></div>
                                <div class="card-body">
                                    <span class="card-tag">Gestion de Projet</span>
                                    <a href="#" class="card-title">Project Management Professional (Session 2)</a>
                                </div>
                                <div class="card-footer">Clôturée le : <i>05-09-2023</i></div>
                            </div>
                            <!-- Carte 3 -->
                            <div class="formation-card">
                                <div class="card-header-img" style="background-image: url('https://clubdsibenin.bj/storage/formations/poMdP1sTSB54PvC6.jpg');"></div>
                                <div class="card-body">
                                    <span class="card-tag">Gestion de Projet</span>
                                    <a href="#" class="card-title">DSI : L'impact de l'agilité</a>
                                </div>
                                <div class="card-footer">Clôturée le : <i>25-08-2023</i></div>
                            </div>
                            <!-- Carte 4 -->
                            <div class="formation-card">
                                <div class="card-header-img" style="background-image: url('https://clubdsibenin.bj/storage/formations/AXqATiB38OraWbl9.jpg');"></div>
                                <div class="card-body">
                                    <span class="card-tag">Management de la Sécurité SI</span>
                                    <a href="#" class="card-title">L’ISO 27035 « Gestion des incidents de sécurité »</a>
                                </div>
                                <div class="card-footer">Clôturée le : <i>26-09-2023</i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    </main>

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


@endsection
