@extends('layouts.guest')

@section('title', 'Rejoindre l\'Écosystème')

@section('content')


    <style>
        :root {
            --dsi-blue: #094281;
            --dsi-green: #29963a;
            --light-bg: #f4f7fc;
            --ink: #0e1a2b;
            --muted-ink: #5c6b81;
        }
        body { font-family: 'Inter', sans-serif; background-color: var(--light-bg); }

        .hero-conditions {
            padding: 15rem 1.5rem;
            background: linear-gradient(rgba(9, 31, 56, 0.829)), url('https://images.unsplash.com/photo-1556761175-b413da4baf72?w=1200');
            background-size: cover; background-position: center;
            text-align: center;
            color: white;
        }
        .hero-conditions h1 { font-weight: 800; color: #fff; }

        .conditions-box {
            background: white; border-radius: 16px;
            box-shadow: 0 15px 40px -15px rgba(11, 63, 122, 0.15);
            margin-top: -4rem; position: relative; z-index: 10;
        }

        .conditions-content { padding: clamp(1.5rem, 4vw, 3rem); }

        .section-heading {
            display: flex; align-items: center; gap: 1rem;
            border-bottom: 1px solid #e5eaf2;
            padding-bottom: 1rem; margin-bottom: 1.5rem;
        }
        .heading-icon {
            width: 50px; height: 50px; border-radius: 12px;
            display: grid; place-items: center;
            background: var(--light-bg); color: var(--dsi-blue);
            font-size: 1.5rem;
        }
        .section-heading h3 { font-weight: 700; color: var(--dsi-blue); margin: 0; }

        .conditions-box ul { padding-left: 1.5rem; }
        .conditions-box li { margin-bottom: 0.5rem; }


   /* --- NOUVEAU STYLE POUR LES CARTES D'AVANTAGES --- */
        .membership-types { margin-top: 3rem; }
        .membership-card {
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 2rem;
            height: 100%;
            display: flex; flex-direction: column;
            background: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .membership-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px -15px rgba(9, 66, 129, 0.2);
        }
        .membership-card .card-icon {
            font-size: 2rem;
            color: var(--dsi-blue);
            margin-bottom: 1rem;
        }
        .membership-card .card-title { font-size: 1.3rem; font-weight: 700; }
        .membership-card .card-price { font-size: 1.8rem; font-weight: 800; color: var(--ink); margin-bottom: 1.5rem; }
        .membership-card .card-price small { font-size: 0.9rem; font-weight: 500; color: var(--muted-ink); display: block; }
        .advantages-list { list-style: none; padding-left: 0; margin: 0; flex-grow: 1; }
        .advantages-list li { position: relative; padding-left: 25px; margin-bottom: 0.75rem; font-size: 0.95rem; }
        .advantages-list li::before {
            content: '\f058'; font-family: "Font Awesome 6 Free"; font-weight: 900;
            position: absolute; left: 0; top: 4px; color: var(--dsi-green);
        }


        .checklist-section {
            background-color: var(--light-bg);
            padding: 2rem;
            border-radius: 12px;
            margin-top: 2rem;
        }
        .checklist-section h4 { font-weight: 700; }
        .checklist .form-check { padding: 1rem; border-radius: 10px; transition: background-color 0.2s ease; }
        .checklist .form-check:not(:last-child) { margin-bottom: 1rem; }
        .checklist .form-check:hover { background-color: #e9ecef; }
        .checklist .form-check-input { width: 1.5em; height: 1.5em; margin-top: 0; }
        .checklist .form-check-label { padding-left: 0.75rem; }

        .btn-proceed {
            font-size: 1.2rem; font-weight: 700;
            padding: 0.8rem 2rem; border-radius: 10px;
            transition: all 0.3s ease;
        }
    </style>


    <section class="hero-conditions">
        <h1>Rejoindre le Club</h1>
        <p class="lead opacity-75">Veuillez lire attentivement nos conditions avant de poursuivre votre inscription.</p>
    </section>

    <div class="conditions-content">

        <!-- ACTE 1: Qui peut adhérer ? -->
        <div class="mb-5">
            <div class="section-heading">
                <div class="heading-icon"><i class="fas fa-users"></i></div>
                <h3>1. Adhésion</h3>
            </div>
            <p>L’Association Club des Décideurs des Systèmes d’Information (Club DSI) du Bénin est ouverte à toute personne physique ou morale répondant aux critères suivants :</p>
            <ul>
                <li>Toute personne physique occupant un poste de <strong>Responsable Informatique (RI), Responsable des Systèmes d’Information (RSI), Directeur des Systèmes d’Information (DSI), Responsable de Sécurité des Systèmes d’Information (RSSI), Responsable Technique (RT), Directeur Technique (DT)</strong> au sein d’une entreprise privée, de l’administration publique, du secteur parapublic ou d’organismes internationaux.</li>
                <li>Toute personne disposant d’atouts pouvant influencer l’écosystème numérique au Bénin ou à l’étranger.</li>
                <li>Toute entité utilisatrice de services numériques, administration publique, ou entreprise IT souhaitant contribuer au développement de l’écosystème numérique.</li>
            </ul>
        </div>

        <!-- ACTE 2: Conditions Financières -->
        <div class="mb-5">
            <div class="section-heading">
                <div class="heading-icon"><i class="fas fa-wallet"></i></div>
                <h3>2. Conditions d’Adhésion</h3>
            </div>
            <p>Pour devenir membre, il est requis de :</p>
            <ul>
                <li>Être de nationalité béninoise ou résident étranger au Bénin.</li>
                <li>Adhérer aux statuts et au règlement intérieur du Club.</li>
                <li>S’acquitter des frais d’adhésion fixés à <strong>10 000 FCFA</strong> (payables une seule fois).</li>
                <li>Régler la cotisation annuelle, selon la catégorie de membre.</li>
            </ul>

                        <div class="accordion mt-4" id="cotisationsAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            <strong>Cliquez ici pour voir le détail des cotisations annuelles</strong>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#cotisationsAccordion">
                        <div class="accordion-body">
                            <strong>a) Membres individuels :</strong> 60 000 FCFA.<br><br>
                            <strong>b) Membres entités utilisatrices (selon CA N-1) :</strong>
                            <ul>
                                <li>≤ 30M FCFA : 150 000 FCFA</li>
                                <li>30M à 150M FCFA : 500 000 FCFA</li>
                                <li>300M FCFA : 1 000 000 FCFA</li>
                            </ul>
                            <strong>c) Administrations publiques :</strong> 100 000 FCFA.<br><br>
                            <strong>d) Membres entreprises du Collège IT (selon CA N-1) :</strong>
                            <ul>
                                <li>≤ 30M FCFA : 100 000 FCFA</li>
                                <li>30M à 150M FCFA : 250 000 FCFA</li>
                                <li>300M FCFA : 1 000 000 FCFA</li>
                            </ul>
                            <strong>e) Membres d’honneur :</strong> Contribution volontaire.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- NOUVEAU : ACTE 2: Types de Membres & Avantages (Version Complète) -->
            <div class="mb-5">
                <div class="section-heading"><div class="heading-icon"><i class="fas fa-star"></i></div><h3>2. Types de Membres, Cotisations & Avantages</h3></div>
                <p>Choisissez la formule d'adhésion qui correspond le mieux à votre profil. Chaque statut offre un accès privilégié à notre réseau et à nos ressources.</p>

                <div class="row g-4 membership-types">
                    <!-- Carte 1: Membre Individuel -->
                    <div class="col-lg-4 col-md-6">
                        <div class="membership-card">
                            <div class="card-icon"><i class="fas fa-user"></i></div>
                            <h4 class="card-title">Membre Individuel </h4>
                            <div class="card-price">60 000 <small>FCFA / an</small></div>

                            <h4 class="card-title">Administration Publique</h4>
                            <div class="card-price">100 000 <small>FCFA / an</small></div>
                            <ul class="advantages-list">
                                <li>Accès privilégié aux événements</li>
                                <li>Opportunités de Keynotes & panels</li>
                                <li>Réseautage avec les DSI et experts</li>
                                <li>Accès à l'École des DSI à coûts réduits</li>
                                <li>Participation à des projets (Consultant IT)</li>
                            </ul>
                        </div>
                    </div>
                    <!-- Carte 2: Entité Utilisatrice -->
                    <div class="col-lg-4 col-md-6">
                        <div class="membership-card">
                            <div class="card-icon"><i class="fas fa-building"></i></div>
                            <h4 class="card-title">Membre Entité Utilisatrice</h4>
                            <div class="card-price">Dès 150 000 <small>FCFA / an (selon CA)</small></div>
                            <ul class="advantages-list">
                                <li><strong>Tous les avantages "Individuel"</strong> pour vos représentants</li>
                                <li>Conseils pour la transformation numérique</li>
                                <li>Participation aux comités de réflexion IT</li>
                                <li>Partenariats avec des prestataires</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Carte 4: Collège IT -->
                    <div class="col-lg-4 col-md-6">
                        <div class="membership-card">
                            <div class="card-icon"><i class="fas fa-laptop-code"></i></div>
                            <h4 class="card-title">Membre Collège IT</h4>
                            <div class="card-price">Dès 100 000 <small>FCFA / an (selon CA)</small></div>
                            <ul class="advantages-list">
                                <li>Visibilité directe auprès d'un public de décideurs qualifiés</li>
                                <li>Opportunités d'affaires et de mises en relation</li>
                                <li>Démonstration de votre expertise (ateliers, webinaires)</li>
                                <li>Participation aux communautés de pratique</li>
                            </ul>
                        </div>
                    </div>
                    <!-- Carte 5: Membre d'Honneur -->
                    <div class="col-lg-4 col-md-6">
                        <div class="membership-card">
                            <div class="card-icon"><i class="fas fa-award"></i></div>
                            <h4 class="card-title">Membre d'Honneur</h4>
                            <div class="card-price">Contribution <small>Volontaire</small></div>
                            <ul class="advantages-list">
                                <li>Statut prestigieux au sein du Club</li>
                                <li>Invitation à des événements exclusifs</li>
                                <li>Reconnaissance pour votre soutien à l'écosystème numérique</li>
                                <li>Influence sur les orientations stratégiques</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        <!-- ACTE 3: Engagement & Checklist -->
        <div>
            <div class="section-heading">
                <div class="heading-icon"><i class="fas fa-handshake"></i></div>
                <h3>3. Votre Engagement</h3>
            </div>
            <p>En adhérant, le membre s’engage à respecter les statuts, participer aux activités et contribuer activement à la promotion du numérique au Bénin.</p>

            <div class="checklist-section">
                <h4>Approbation Requise</h4>
                <p class="text-muted">En cochant les cases ci-dessous, vous confirmez avoir lu, compris et accepté les conditions pour rejoindre le Club DSI Bénin.</p>
                <div class="checklist mt-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="check1">
                        <label class="form-check-label" for="check1">J’occupe un poste éligible (RI, RSI, DSI, RSSI, RT, DT) ou je dispose d’atouts pouvant influencer l’écosystème numérique.</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="check2">
                        <label class="form-check-label" for="check2">J’ai pris connaissance et j’approuve les <a href="#" target="_blank">Statuts et le Règlement Intérieur</a> du Club DSI Bénin.</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="check3">
                        <label class="form-check-label" for="check3">Je m’engage à payer les frais d’adhésion (10 000 FCFA).</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="check4">
                        <label class="form-check-label" for="check4">Je m’engage à régler ma cotisation annuelle, selon ma catégorie d’adhésion.</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <a href="" id="proceedBtnLink" class="btn btn-primary btn-lg btn-proceed disabled" aria-disabled="true">
                Lu et Approuvé, Continuer
                <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const checkboxes = document.querySelectorAll('.checklist .form-check-input');
        const proceedBtn = document.getElementById('proceedBtnLink');
        // C'est ici que vous mettrez le lien vers le formulaire d'inscription pour les MEMBRES
        const registrationUrl = "{{ route('register.choice_type') }}"; // Exemple avec une route Laravel

        function validateCheckboxes() {
            // 'every' vérifie si TOUS les éléments d'un tableau respectent une condition
            const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);

            if (allChecked) {
                proceedBtn.classList.remove('disabled');
                proceedBtn.setAttribute('aria-disabled', 'false');
                proceedBtn.href = registrationUrl;
            } else {
                proceedBtn.classList.add('disabled');
                proceedBtn.setAttribute('aria-disabled', 'true');
                proceedBtn.href = '#';
            }
        }

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', validateCheckboxes);
        });

        // Appel initial pour définir l'état du bouton au chargement de la page
        validateCheckboxes();
    </script>

@endsection
