<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adhésion Membre - Club DSI Bénin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <style>
        :root {
            --dsi-blue: #094281;
            --dsi-green: #29963a;
            --light-bg: #f4f7fc;
            --ink: #0e1a2b;
            --muted-ink: #5c6b81;
            --border-color: #e5eaf2;
        }
        body { font-family: 'Inter', sans-serif; background-color: var(--light-bg); }

        .hero-register {
            padding: 10rem 1.5rem;
            background: linear-gradient(rgba(9, 32, 58, 0.87)), url('https://images.unsplash.com/photo-1552664730-d307ca884978?w=1200');
            background-size: cover; background-position: center;
            text-align: center; color: white;
        }
        .hero-register h1 { font-weight: 800; }

        .register-form-box {
            background: white; border-radius: 16px;
            box-shadow: 0 15px 40px -15px rgba(11, 63, 122, 0.15);
            padding: clamp(1.5rem, 4vw, 3rem);
            margin-top: -4rem; position: relative; z-index: 10;
        }

        .form-section-title {
            font-weight: 700; color: var(--dsi-blue);
            border-bottom: 2px solid var(--dsi-green);
            padding-bottom: 0.75rem; margin: 2rem 0 1.5rem 0;
            display: flex; align-items: center; gap: 0.75rem;
        }

        .form-label { font-weight: 500; }
        .form-control, .form-select {
            height: 50px;
            border-color: var(--border-color);
            box-shadow: none !important;
        }
        .form-control:focus, .form-select:focus { border-color: var(--dsi-blue); }
        .form-check-input { width: 1.25em; height: 1.25em; }

        .btn-submit {
            font-size: 1.1rem; font-weight: 700;
            padding: 0.8rem 2rem; border-radius: 10px;
            background: linear-gradient(95deg, var(--dsi-blue), var(--dsi-green));
            color: white; border: none;
        }
    </style>
</head>
<body>

<section class="hero-register">
    <h1>Formulaire d'Adhésion Membre</h1>
    <p class="lead opacity-75">Rejoignez l'élite des décideurs IT du Bénin.</p>
</section>

<div class="container my-5">
    <div class="register-form-box">
        <!--<div class="alert alert-info">
            <strong>Pour les membres DSI :</strong> La méthode de connexion privilégiée est via votre compte Microsoft 365. Si vous en avez un, nous vous recommandons de vous connecter directement.
            <div class="text-center mt-3">
                <a href="{{ route('login.microsoft.redirect') }}" class="btn btn-lg btn-outline-primary"><i class="fab fa-microsoft me-2"></i> Se Connecter avec Microsoft</a>
            </div>
        </div>-->

        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.membre.store') }}" method="POST" class="row g-4" enctype="multipart/form-data">
            
            @csrf

            <!-- SECTION 1 : Informations Personnelles -->
            <h4 class="form-section-title"><i class="fas fa-user-circle"></i> Informations Personnelles</h4>
            <div class="col-md-6"><label for="lastname" class="form-label">Nom *</label><input type="text" name="lastname" class="form-control" id="lastname" required></div>
            <div class="col-md-6"><label for="firstname" class="form-label">Prénom(s) *</label><input type="text" name="firstname" class="form-control" id="firstname" required></div>
            <div class="col-md-6"><label for="sexe" class="form-label">Sexe *</label><select class="form-select" name="sexe" required><option value="">Choisir...</option><option value="M">Masculin</option><option value="F">Féminin</option></select></div>
            <div class="col-md-6"><label for="birthday" class="form-label">Date de naissance *</label><input type="date" name="birthday" class="form-control" id="birthday" required></div>
            <div class="col-md-6"><label for="phone" class="form-label">Numéro de téléphone *</label><input type="tel" name="phone" class="form-control" id="phone" required></div>
            <div class="col-md-6"><label for="medias_id" class="form-label">Votre Photo *</label><input class="form-control" type="file" name="medias_id" required></div>
            <div class="col-12"><label for="description" class="form-label">Décrivez-vous en quelques mots</label><textarea name="description" class="form-control" id="description" rows="3"></textarea></div>

            <!-- SECTION 2 : Parcours Professionnel -->
            <h4 class="form-section-title"><i class="fas fa-briefcase"></i> Parcours Professionnel</h4>
            <div class="col-md-6"><label for="current_employer" class="form-label">Employeur actuel *</label><input type="text" name="current_employer" class="form-control" id="current_employer" required></div>
            <div class="col-md-6"><label for="employer_contact" class="form-label">Contact Employeur *</label><input type="text" name="employer_contact" class="form-control" id="employer_contact" required></div>
            <div class="col-md-6"><label for="current_position" class="form-label">Poste de responsabilité actuel *</label><select class="form-select" name="current_position" required><option value="">Choisir...</option><option>Directeur des Systèmes d'Information (DSI)</option><option>Responsable des Systèmes d'Information (RSI)</option><option>Responsable de la Sécurité des SI (RSSI)</option><option>Directeur Technique (DT)</option><option>Responsable Technique (RT)</option></select></div>

            <!-- Champ Secteur avec logique "Autre" -->
            <div class="col-md-6">
                <label for="sector" class="form-label">Secteur *</label>
                <select class="form-select" name="sector" id="sectorSelect" required>
                    <option value="">Choisir...</option>
                    <option value="Public">Public</option>
                    <option value="Privé">Privé</option>
                    <option value="Multinationale">Multinationale</option>
                    <option value="Organisme international">Organisme international</option>
                    <option value="ONG">ONG</option>
                    <option value="Autre">Autre</option>
                </select>
            </div>
            <div class="col-md-6" id="sectorOtherDiv" style="display: none;">
                <label for="sector_other" class="form-label">Veuillez préciser votre secteur *</label>
                <input type="text" name="sector_other" class="form-control" id="sectorOtherInput">
            </div>

            <!-- Champ Catégorie de service avec logique "Autre" -->
            <div class="col-md-6">
                <label for="category_of_service" class="form-label">Catégorie de service *</label>
                <select class="form-select" name="category_of_service" id="categorySelect" required>
                    <option value="">Choisir la catégorie</option>
                    <option value="Industrie">Industrie</option><option value="Banque">Banque</option>
                    <option value="Assurance">Assurance</option><option value="Microfinance">Microfinance</option>
                    <option value="Santé">Santé</option><option value="Agroalimentaire">Agroalimentaire</option>
                    <option value="Finance">Finance</option><option value="Humanitaire">Humanitaire</option>
                    <option value="Ministère">Ministère</option><option value="Agence Gouvernementale">Agence Gouvernementale</option>
                    <option value="Commerce">Commerce</option><option value="Logistique">Logistique</option>
                    <option value="Autre">Autre</option>
                </select>
            </div>
            <div class="col-md-6" id="categoryOtherDiv" style="display: none;">
                <label for="category_other" class="form-label">Veuillez préciser votre catégorie *</label>
                <input type="text" name="category_other" class="form-control" id="categoryOtherInput">
            </div>

            <div class="col-md-6"><label for="area_of_expertise" class="form-label">Domaine d'expertise *</label><input type="text" name="area_of_expertise" class="form-control" id="area_of_expertise" required></div>
            <div class="col-md-6"><label for="initial_training" class="form-label">Formation initiale *</label><input type="text" name="initial_training" class="form-control" id="initial_training" required></div>

            <!-- SECTION 3 : Votre Compte au Club (Simplifié) -->
            <h4 class="form-section-title"><i class="fas fa-shield-alt"></i> Votre Compte au Club</h4>
            <div class="col-md-6"><label for="username" class="form-label">Nom d'utilisateur *</label><input type="text" name="username" class="form-control" id="username" required></div>
            <div class="col-md-6"><label for="email" class="form-label">E-mail de connexion *</label><input type="email" name="email" class="form-control" id="email" required></div>
            <div class="col-md-6"><label for="password" class="form-label">Mot de passe *</label><input type="password" name="password" class="form-control" id="password" required></div>
            <div class="col-md-6"><label for="password_confirmation" class="form-label">Confirmer le mot de passe *</label><input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required></div>

            <div class="col-md-6">
                <label for="type_members" class="form-label">Type de Membre *</label>
                <select name="type_members" id="type_members" class="form-control" required>
                    <option value="individuel" {{ $type == 'individuel' ? 'selected' : '' }}>Membre Individuel</option>
                    <option value="entite" {{ $type == 'entite' ? 'selected' : '' }}>Entité Utilisatrice</option>
                    <option value="admin_publique" {{ $type == 'admin_publique' ? 'selected' : '' }}>Administration Publique</option>
                    <option value="it" {{ $type == 'it' ? 'selected' : '' }}>Collège IT</option>
                </select>
            </div>

            <div class="col-12 mt-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="cgv" required>
                    <label class="form-check-label" for="cgv">
                        J'ai lu et j'approuve les <a href="#" data-bs-toggle="modal" data-bs-target="#conditionsModal">conditions générales d'adhésion</a>.*
                    </label>
                </div>
            </div>

            <div class="col-12 text-center mt-4">
                <button type="submit" class="btn btn-submit">Finaliser mon Adhésion</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal pour les conditions -->
<div class="modal fade" id="conditionsModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nos Conditions Générales</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>
            En créant un compte, vous accédez à une gamme étendue de services exclusifs.
            Vos informations sont utilisées pour personnaliser votre expérience en
            recevant des newsletters et des services adaptés à vos besoins. Elles nous
            permettent également de vous informer sur les événements et les services
            correspondant à vos attentes.
        </p>
        <p>
            L'accès à nos contenus est entièrement gratuit. En acceptant de partager vos
            données avec nous, vous nous autorisez à vous envoyer des informations
            relatives aux évènements de la communauté des décideurs des systèmes
            d'informations au Bénin, des mises à jour ou d'autres informations
            liées à notre communauté.
        </p>
        <p>
            Conformément à notre politique de confidentialité, vous avez le droit
            d'accéder à vos données à tout moment, de demander leur correction ou leur
            suppression. Pour exercer ce droit, envoyez un email à
            <a href=https://clubdsibenin.bj/contact>Contact</a>.
            Pour en savoir plus sur la manière dont nous
            traitons les données personnelles, consultez notre <a
                href=https://clubdsibenin.bj/politique-protection-donnees>Charte de
                confidentialité.</a>
        </p>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Lu et approuvé</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- SCRIPT POUR LA LOGIQUE CONDITIONNELLE (À AJOUTER À LA FIN DE VOTRE PAGE) -->
<script>
    const sectorSelect = document.getElementById('sectorSelect');
    const sectorOtherDiv = document.getElementById('sectorOtherDiv');
    const sectorOtherInput = document.getElementById('sectorOtherInput');

    sectorSelect.addEventListener('change', function() {
        if (this.value === 'Autre') {
            sectorOtherDiv.style.display = 'block';
            sectorOtherInput.required = true; // Rend le champ obligatoire
        } else {
            sectorOtherDiv.style.display = 'none';
            sectorOtherInput.required = false; // Rend le champ non obligatoire
            sectorOtherInput.value = ''; // Vide le champ si on change d'avis
        }
    });

    const categorySelect = document.getElementById('categorySelect');
    const categoryOtherDiv = document.getElementById('categoryOtherDiv');
    const categoryOtherInput = document.getElementById('categoryOtherInput');

    categorySelect.addEventListener('change', function() {
        if (this.value === 'Autre') {
            categoryOtherDiv.style.display = 'block';
            categoryOtherInput.required = true;
        } else {
            categoryOtherDiv.style.display = 'none';
            categoryOtherInput.required = false;
            categoryOtherInput.value = '';
        }
    });
</script>
</body>
</html>
