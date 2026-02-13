@extends('layouts.guest')

@section('title', 'Nos Interviews')

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


           /* --- Héros --- */
.hero-testimonials {
    position: relative;
    height: 100vh;
    display: flex;               /* active flexbox */
    flex-direction: column;      /* empile titre + blockquote */
    justify-content: center;     /* centre verticalement */
    align-items: center;         /* centre horizontalement */
    text-align: center;
    color: white;
    background-image: linear-gradient(#101d34e0), url("{{ asset('img/even2.jpg') }}");
    background-size: cover;
    background-position: center;
}

.hero-testimonials h1 {
    font-size: clamp(2.5rem, 6vw, 4rem);
    font-weight: 800;
    color: white;
}

.hero-testimonials blockquote {
    font-size: clamp(1.1rem, 2vw, 1.25rem);
    max-width: 700px;
    margin: 1.5rem auto 0 auto;
    opacity: 0.9;
    font-style: italic;
}

        /* --- Héros "À la Une" --- */
        .hero-interviews {
            position: relative;
            background-color: var(--light-bg);
            padding: 4rem 1.5rem;
        }
        .featured-interview {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
            max-width: 1200px;
            margin: auto;
        }
        @media (max-width: 992px) { .featured-interview { grid-template-columns: 1fr; } }

        .featured-video {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            cursor: pointer;
            box-shadow: 0 25px 50px -12px rgba(9, 66, 129, 0.25);
        }
        .featured-video img { width: 100%; display: block; }
        .featured-video .play-icon {
            position: absolute; inset: 0; display: grid; place-items: center;
            font-size: 4rem; color: white; background: rgba(0,0,0,0.3);
            transition: background-color 0.3s ease;
        }
        .featured-video:hover .play-icon { background: rgba(0,0,0,0.5); }

        .featured-text .eyebrow { color: var(--dsi-green); font-weight: 700; letter-spacing: .1em; text-transform: uppercase; }
        .featured-text h1 { font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 800; margin: 0.5rem 0 1rem 0; }
        .featured-text blockquote {
            font-size: 1.1rem;
            color: var(--muted-ink);
            border-left: 4px solid var(--dsi-blue);
            padding-left: 1.5rem;
            margin: 0 0 1.5rem 0;
            font-style: italic;
        }
        .author-info .author-name { font-weight: 700; font-size: 1.1rem; }
        .author-info .author-title { color: var(--muted-ink); }

        /* --- Conteneur principal --- */
        .interviews-container { padding: 4rem 1.5rem; }
        .section-header { text-align: center; max-width: 800px; margin: 0 auto 3rem auto; }
        .section-header h2 { font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 800; }

        /* --- Grille d'Interviews --- */
        .interviews-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
            max-width: 1400px;
            margin: auto;
        }
        .interview-card {
            background: white; border-radius: 16px;
            box-shadow: 0 10px 30px -15px rgba(11, 63, 122, 0.1);
            display: flex; flex-direction: column;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }
        .interview-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px -15px rgba(11, 66, 129, 0.2); }

        .card-media { position: relative; height: 200px; background-color: #eee; border-radius: 16px 16px 0 0; overflow: hidden; }
        .card-media img { width: 100%; height: 100%; object-fit: cover; }
        .interview-card:hover .play-icon { opacity: 1; }

        .card-content { padding: 1.5rem; flex-grow: 1; }
        .card-title {
            font-size: 1.2rem; font-weight: 700; color: var(--ink);
            text-decoration: none; display: -webkit-box; -webkit-line-clamp: 2;
            -webkit-box-orient: vertical; overflow: hidden; height: 3.6rem;
        }
        .card-footer { font-size: 0.85rem; color: var(--muted-ink); border-top: 1px solid var(--border-color); padding: 1rem 1.5rem; background-color: var(--light-bg); }

    </style>


    <section class="hero-testimonials">
        <div class="hero-content">
            <h1>Les Voix de Notre Communauté</h1>
            <blockquote>
                “Le Club DSI est devenu mon premier réflexe pour benchmarker des décisions IT et trouver des experts compétents rapidement.”
            </blockquote>
        </div>
    </section>

    <!-- ================= HÉROS "À LA UNE" ================= -->
    <section class="hero-interviews">
        <div class="container">
            <div class="featured-interview">
                <div class="featured-video" data-bs-toggle="modal" data-bs-target="#videoModal" data-youtube-id="ENo6KVGm9fI">
                    <img src="https://img.youtube.com/vi/ENo6KVGm9fI/maxresdefault.jpg" alt="Interview sur l'identité numérique">
                    <div class="play-icon"><i class="fas fa-play-circle"></i></div>
                </div>
                <div class="featured-text">
                    <p class="eyebrow">Interview à la Une</p>
                    <h1>L'Identité Numérique : Enjeux et Perspectives</h1>
                    <blockquote>
                        "La maîtrise de l'identité numérique est le socle de la confiance dans notre économie digitalisée. C'est un défi stratégique pour chaque DSI."
                    </blockquote>
                    <div class="author-info">
                        <div class="author-name">Nom de l'Interviewé</div>
                        <div class="author-title">Directeur des Systèmes d'Information, ANIP</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= CONTENU PRINCIPAL ================= -->
    <main class="interviews-container">
        <div class="section-header">
            <h2>Toutes les Interviews</h2>
        </div>

        <div class="interviews-grid">
            <!-- Interview 1 -->
            <div class="interview-card" data-bs-toggle="modal" data-bs-target="#videoModal" data-youtube-id="rsdMj5N9BAQ">
                <div class="card-media">
                    <img src="https://img.youtube.com/vi/rsdMj5N9BAQ/hqdefault.jpg" alt="Interview">
                    <div class="play-icon"><i class="fas fa-play-circle"></i></div>
                </div>
                <div class="card-content">
                    <a href="#" class="card-title">Le Rôle Clé du DSI dans la Transformation Numérique</a>
                </div>
                <div class="card-footer">Interview de : Jean Dupont</div>
            </div>
            <!-- Interview 2 -->
            <div class="interview-card" data-bs-toggle="modal" data-bs-target="#videoModal" data-youtube-id="4Ru86ZRBh70">
                <div class="card-media">
                    <img src="https://img.youtube.com/vi/4Ru86ZRBh70/hqdefault.jpg" alt="Interview">
                    <div class="play-icon"><i class="fas fa-play-circle"></i></div>
                </div>
                <div class="card-content">
                    <a href="#" class="card-title">Cybersécurité : Anticiper les Menaces de Demain</a>
                </div>
                <div class="card-footer">Interview de : Marie Claire EKO</div>
            </div>
            <!-- ... Ajoutez d'autres cartes d'interviews sur le même modèle ... -->
        </div>
    </main>

    <!-- Modal pour les Vidéos (identique à la page Témoignages) -->
    <div class="modal fade" id="videoModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="background: transparent; border: none;">
        <div class="modal-body p-0">
            <div class="ratio ratio-16x9">
            <iframe src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
        </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const videoModal = document.getElementById('videoModal');
        if (videoModal) {
            videoModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;
                const youtubeId = button.getAttribute('data-youtube-id');
                const iframe = videoModal.querySelector('iframe');
                iframe.src = `https://www.youtube.com/embed/${youtubeId}?autoplay=1`;
            });
            videoModal.addEventListener('hide.bs.modal', event => {
                const iframe = videoModal.querySelector('iframe');
                iframe.src = "";
            });
        }
    </script>


@endsection
