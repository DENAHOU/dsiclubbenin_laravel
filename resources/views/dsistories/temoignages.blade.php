@extends('layouts.guest')

@section('title', 'Témoignages')

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
        body { font-family: 'Inter', sans-serif; background-color: var(--light-bg); color: var(--ink); margin: 0; }

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


        /* --- Conteneur principal --- */
        .testimonials-container { padding: 4rem 1.5rem; }
        .section-header { text-align: center; max-width: 800px; margin: 0 auto 3rem auto; }
        .section-header h2 { font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 800; }

        /* --- Onglets --- */
        .testimonial-tabs { border-bottom: 1px solid var(--border-color); margin-bottom: 3rem; }
        .testimonial-tabs .nav-link { font-size: 1.1rem; font-weight: 600; color: var(--muted-ink); border: none; border-bottom: 3px solid transparent; padding: 1rem 1.5rem; }
        .testimonial-tabs .nav-link.active { color: var(--dsi-blue); border-bottom-color: var(--dsi-blue); }

        /* --- Grille de Témoignages --- */
        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
            max-width: 1400px;
            margin: auto;
        }

        .testimonial-card {
            background: white; border-radius: 16px;
            box-shadow: 0 10px 30px -15px rgba(11, 63, 122, 0.1);
            display: flex; flex-direction: column;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .testimonial-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px -15px rgba(11, 66, 129, 0.2); }

        .card-media { position: relative; height: 220px; background-color: #eee; border-radius: 16px 16px 0 0; overflow: hidden; cursor: pointer; }
        .card-media img { width: 100%; height: 100%; object-fit: cover; }
        .play-icon {
            position: absolute; inset: 0; display: grid; place-items: center;
            font-size: 3rem; color: white; background: rgba(0,0,0,0.4);
            opacity: 0; transition: opacity 0.3s ease;
        }
        .testimonial-card:hover .play-icon { opacity: 1; }

        .card-content { padding: 1.5rem; flex-grow: 1; position: relative; }
        .card-content .fa-quote-left {
            position: absolute; top: 1.5rem; right: 1.5rem;
            font-size: 3rem; color: var(--light-bg);
        }
        .card-content p { color: var(--muted-ink); line-height: 1.7; }

        .card-author {
            display: flex; align-items: center; gap: 1rem;
            border-top: 1px solid var(--border-color);
            padding: 1rem 1.5rem; background-color: var(--light-bg);
        }
        .author-avatar { width: 50px; height: 50px; border-radius: 50%; object-fit: cover; }
        .author-name { font-weight: 700; color: var(--ink); }
        .author-title { font-size: 0.85rem; color: var(--muted-ink); }
    </style>


    <section class="hero-testimonials">
        <div class="hero-content">
            <h1>Les Voix de Notre Communauté</h1>
            <blockquote>
                “Le Club DSI est devenu mon premier réflexe pour benchmarker des décisions IT et trouver des experts compétents rapidement.”
            </blockquote>
        </div>
    </section>

    <main class="testimonials-container">
        <ul class="nav nav-tabs justify-content-center testimonial-tabs" id="testimonialTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="membres-tab" data-bs-toggle="tab" data-bs-target="#membres" type="button">Témoignages & Interviews des Membres</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="partenaires-tab" data-bs-toggle="tab" data-bs-target="#partenaires" type="button">Témoignages des Partenaires</button>
            </li>
        </ul>

        <div class="tab-content" id="testimonialTabContent">
            <!-- Onglet 1: Membres -->
            <div class="tab-pane fade show active" id="membres" role="tabpanel">
                <div class="testimonials-grid">
                    <!-- Témoignage Écrit -->
                    <div class="testimonial-card">
                        <div class="card-content">
                            <i class="fas fa-quote-left"></i>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida.</p>
                        </div>
                        <div class="card-author">
                            <img class="author-avatar" src="https://clubdsibenin.bj/storage/programme/v9Vv6EttSK3q1MRn.jpg" alt="Abdias ATCHADE">
                            <div>
                                <div class="author-name">Abdias ATCHADE</div>
                                <div class="author-title">DSI, Exemple Corp</div>
                            </div>
                        </div>
                    </div>
                    <!-- Interview Vidéo -->
                    <div class="testimonial-card" data-bs-toggle="modal" data-bs-target="#videoModal" data-youtube-id="rsdMj5N9BAQ">
                        <div class="card-media">
                            <img src="https://img.youtube.com/vi/rsdMj5N9BAQ/hqdefault.jpg" alt="Interview">
                            <div class="play-icon"><i class="fas fa-play-circle"></i></div>
                        </div>
                        <div class="card-author">
                            <img class="author-avatar" src="https://i.pravatar.cc/150?u=interview1" alt="Portrait">
                            <div>
                                <div class="author-name">Interview Membre</div>
                                <div class="author-title">Directeur SI, Secteur Public</div>
                            </div>
                        </div>
                    </div>
                    <!-- Témoignage Écrit -->
                    <div class="testimonial-card">
                        <div class="card-content">
                            <i class="fas fa-quote-left"></i>
                            <p>Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
                        </div>
                        <div class="card-author">
                            <img class="author-avatar" src="https://clubdsibenin.bj/storage/programme/zum7yB2XQK10cLUg.png" alt="Ouanilo MEDEGAN">
                            <div>
                                <div class="author-name">Ouanilo MEDEGAN</div>
                                <div class="author-title">CTO, Startup XYZ</div>
                            </div>
                        </div>
                    </div>
                    <!-- ... Ajoutez les autres interviews et témoignages ici ... -->
                </div>
            </div>

            <!-- Onglet 2: Partenaires -->
            <div class="tab-pane fade" id="partenaires" role="tabpanel">
                <div class="testimonials-grid">
                    <!-- Témoignage Partenaire -->
                    <div class="testimonial-card">
                        <div class="card-content">
                            <i class="fas fa-quote-left"></i>
                            <p>Collaborer avec le Club DSI Bénin nous a ouvert des portes incroyables sur le marché local. Un réseau d'une qualité et d'un professionnalisme rares.</p>
                        </div>
                        <div class="card-author">
                            <img class="author-avatar" src="https://clubdsibenin.bj/storage/programme/nWOgdlVWabHm39TI.jpg" alt="Partenaire">
                            <div>
                                <div class="author-name">Nom du Partenaire</div>
                                <div class="author-title">Directeur Afrique, Tech Corp</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal pour les Vidéos -->
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
        // Script pour la Lightbox Vidéo
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
                iframe.src = ""; // Arrête la vidéo à la fermeture
            });
        }
    </script>

@endsection
