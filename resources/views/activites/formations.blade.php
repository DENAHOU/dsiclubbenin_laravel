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


        /* --- Section Premium Nouvelles formations --- */
        .premium-section {
            color: var(--ink);
            margin: 1.5rem 0;
            border-radius: 30px;
        }
        .premium-badge {
            background: linear-gradient(45deg, #ffd700, #ffae00);
            color: #05264a;
            padding: 0.5rem 1.2rem;
            border-radius: 50px;
            font-weight: 800;
            font-size: 0.9rem;
            text-transform: uppercase;
            display: inline-block;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 15px rgba(255, 174, 0, 0.3);
        }
        .premium-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2.5rem;
            margin-top: 3rem;
        }
        .premium-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s ease;
        }
        .premium-card:hover {
            transform: translateY(-12px);
            background: rgba(255, 255, 255, 0.1);
            border-color: #ffd700;
        }
        .premium-img {
            height: 200px;
            width: 100%;
            object-fit: cover;
        }
        .premium-body { padding: 2rem; }
        .premium-price {
            font-size: 1.5rem;
            font-weight: 800;
            color: #ffd700;
        }

    </style>

    <section class="hero-formations">
        <h1>L'Académie des Leaders Numériques</h1>
    </section>

    <main>
        <section class="categories-section animated-section">
            <div class="container">
                <div class="section-header">
                    <h2>Explorez nos pôles d'expertise</h2>
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

                <!-- Section nouvelles formations -->
                <section class="premium-section container">
                    <div class="text-center">
                        <h2 class="fw-bold display-5">Découvrez nos formations les plus récentes</h2>
                        <p class="fs-5">Accédez à nos dernières formations et enrichissez vos compétences.</p>
                    </div>

                    <div class="premium-grid">
                        @foreach($newFormations as $formation)
                        <div class="premium-card">
                            @if($formation->image_path)
                                <img src="{{ asset('storage/' . $formation->image_path) }}" class="premium-img" alt="{{ $formation->titre }}">
                            @else
                                <img src="https://images.unsplash.com" class="premium-img" alt="Default">
                            @endif
                            
                            <div class="premium-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="badge bg-light text-dark">{{ $formation->categoryFormation->nom ?? 'IT' }}</span>
                                    <span class="premium-price">{{ number_format($formation->price, 0, ',', ' ') }} FCFA</span>
                                </div>
                                <h3 class="h4 fw-bold mb-3">{{ $formation->titre }}</h3>
                                <p class="text-white-50 small mb-4">{{ Str::limit($formation->description, 100) }}</p>
                                
                                <div class="d-grid">
                                    <a href="{{ route('activites.formations.show', $formation->id) }}" class="btn btn-warning fw-bold py-2">
                                        En savoir plus <i class="fas fa-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>

                <!-- Formations Cloturées -->
                <div class="animated-section">
                    <div class="section-header">
                        <h2><i class="fas fa-archive me-2"></i> Formations clôturées</h2>
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
