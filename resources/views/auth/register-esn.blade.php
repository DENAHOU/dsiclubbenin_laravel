<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrer votre ESN - Club DSI Bénin</title>
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
        }
        body { font-family: 'Inter', sans-serif; margin: 0; }

        .esn-register-container {
            display: flex;
            min-height: 100vh;
        }

        /* --- COLONNE DE GAUCHE : MOTIVATION --- */
        .motivation-panel {
            width: 45%;
            background: linear-gradient(160deg, var(--dsi-blue) 0%, #0a2b5c 100%);
            color: white;
            padding: 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: sticky;
            top: 0;
            height: 100vh;
        }
        @media (max-width: 992px) { .motivation-panel { display: none; } }

        .motivation-content { position: relative; height: 250px; }
        .motivation-slide {
            position: absolute; inset: 0;
            opacity: 0; transform: translateY(20px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        .motivation-slide.active { opacity: 1; transform: translateY(0); }
        .motivation-panel .icon { font-size: 3rem; margin-bottom: 1.5rem; color: var(--dsi-green); }
        .motivation-panel h2 { font-size: 2.5rem; font-weight: 800; }
        .motivation-panel p { font-size: 1.1rem; opacity: 0.8; }

        /* --- COLONNE DE DROITE : FORMULAIRE --- */
        .form-panel {
            width: 55%;
            padding: 4rem clamp(1.5rem, 5vw, 4rem);
            background-color: white;
        }
        @media (max-width: 992px) { .form-panel { width: 100%; } }

        .form-header { text-align: center; margin-bottom: 2rem; }
        .form-header img { max-height: 60px; margin-bottom: 1rem; }
        .form-header h1 { font-weight: 800; color: var(--dsi-blue); }

        .form-section-title { font-weight: 700; color: var(--dsi-blue); margin-top: 2.5rem; margin-bottom: 1.5rem; border-bottom: 2px solid var(--dsi-green); padding-bottom: 0.5rem; font-size: 1.3rem; }
        .form-control, .form-select { height: 50px; border-color: #e5eaf2; box-shadow: none !important; }
        .form-control:focus, .form-select:focus { border-color: var(--dsi-blue); }
        .form-check-input { width: 1.2em; height: 1.2em; }

        .btn-submit {
            font-size: 1.1rem; font-weight: 700;
            padding: 0.8rem 2rem; border-radius: 10px;
            background: linear-gradient(95deg, var(--dsi-blue), var(--dsi-green));
            color: white; border: none; width: 100%;
        }
    </style>
</head>
<body>

<div class="esn-register-container">
    <!-- COLONNE DE GAUCHE : MOTIVATION -->
    <div class="motivation-panel">
        <div class="motivation-content">
            <div class="motivation-slide active" data-section="identity">
                <div class="icon"><i class="fas fa-building"></i></div>
                <h2>Votre Identité</h2>
                <p>Présentez votre entreprise à l'écosystème. Votre histoire commence ici.</p>
            </div>
            <div class="motivation-slide" data-section="expertise">
                <div class="icon"><i class="fas fa-cogs"></i></div>
                <h2>Votre Expertise</h2>
                <p>Mettez en avant vos compétences et vos forces pour attirer les bonnes opportunités.</p>
            </div>
            <div class="motivation-slide" data-section="account">
                <div class="icon"><i class="fas fa-shield-alt"></i></div>
                <h2>Votre Compte</h2>
                <p>Finalisez votre dossier et créez votre accès pour gérer votre profil au sein du Club.</p>
            </div>
        </div>
    </div>

    <!-- COLONNE DE DROITE : FORMULAIRE -->
    <div class="form-panel">
        <div class="form-header">
            <a href="/"><img src="{{ asset('img/logo-dsi.png') }}" alt="Logo Club DSI Bénin"></a>
            <h1>Enregistrement ESN</h1>
        </div>

        <form action="{{ route('register.esn.store') }}" method="POST" class="row g-3" enctype="multipart/form-data">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- SECTION 1 : Identité -->
            <h4 class="form-section-title" id="identity">Identité de l'Entreprise</h4>
            <div class="col-md-6"><label class="form-label">Nom du promoteur *</label><input type="text" name="NomPromotteur" class="form-control" value="{{ old('NomPromotteur') }}" required></div>
            <div class="col-md-6"><label class="form-label">Civilité *</label><select name="Civilite" class="form-select" required><option value="Mr" {{ old('Civilite') == 'Mr' ? 'selected' : '' }}>Monsieur</option><option value="Mme" {{ old('Civilite') == 'Mme' ? 'selected' : '' }}>Madame</option></select></div>
            <div class="col-12"><label class="form-label">Nom de l'entreprise *</label><input type="text" name="NomEntreprise" class="form-control" value="{{ old('NomEntreprise') }}" required></div>
            <div class="col-md-6"><label class="form-label">Email Professionnel *</label><input type="email" name="EmailPro" class="form-control" value="{{ old('EmailPro') }}" required></div>
            <div class="col-md-6"><label class="form-label">Contact professionnel *</label><input type="tel" name="PhonePro" class="form-control" value="{{ old('PhonePro') }}" required></div>
            <div class="col-md-6"><label class="form-label">Localisation géographique *</label><input type="text" name="Emplacement" class="form-control" value="{{ old('Emplacement') }}" required></div>
            <div class="col-md-6"><label class="form-label">Forme juridique *</label><select name="FormeJuridique" class="form-select" required><option value="" selected disabled>Choisir...</option><option value="SARL" {{ old('FormeJuridique') == 'SARL' ? 'selected' : '' }}>SARL</option><option value="SA" {{ old('FormeJuridique') == 'SA' ? 'selected' : '' }}>SA</option><option value="SAS" {{ old('FormeJuridique') == 'SAS' ? 'selected' : '' }}>SAS</option><option value="SNC" {{ old('FormeJuridique') == 'SNC' ? 'selected' : '' }}>SNC</option><option value="SCS" {{ old('FormeJuridique') == 'SCS' ? 'selected' : '' }}>SCS</option></select></div>
            <div class="col-12"><label class="form-label">Site web *</label><input class="form-control" type="url" name="Url" placeholder="https://example.com" value="{{ old('Url') }}" required></div>

            <!-- SECTION 2 : Expertise -->
            <h4 class="form-section-title" id="expertise">Expertise & Capacités</h4>
            <div class="col-12"><label class="form-label">Domaine d'activité *</label><input type="text" name="DomaineActivite" class="form-control" value="{{ old('DomaineActivite') }}" required></div>
            <div class="col-md-6"><label class="form-label">Date de création *</label><input class="form-control" type="date" name="DateCreation" value="{{ old('DateCreation') }}" required></div>
            <div class="col-md-6"><label class="form-label">Années d'expérience *</label><select name="AnneeExperience" class="form-select" required><option value="" selected disabled>Choisir...</option><option value="0-5 ans" {{ old('AnneeExperience') == '0-5 ans' ? 'selected' : '' }}>0-5 ans</option><option value="5-10 ans" {{ old('AnneeExperience') == '5-10 ans' ? 'selected' : '' }}>5-10 ans</option><option value="10-15 ans" {{ old('AnneeExperience') == '10-15 ans' ? 'selected' : '' }}>10-15 ans</option><option value="15-20+ ans" {{ old('AnneeExperience') == '15-20+ ans' ? 'selected' : '' }}>15-20+ ans</option></select></div>
            <div class="col-md-6"><label class="form-label">Nombre de personnel *</label><select name="NombrePersonnel" class="form-select" required><option value="" selected disabled>Choisir...</option><option value="0-5" {{ old('NombrePersonnel') == '0-5' ? 'selected' : '' }}>0-5</option><option value="5-10" {{ old('NombrePersonnel') == '5-10' ? 'selected' : '' }}>5-10</option><option value="10-15" {{ old('NombrePersonnel') == '10-15' ? 'selected' : '' }}>10-15</option><option value="15-20+" {{ old('NombrePersonnel') == '15-20+' ? 'selected' : '' }}>15-20+</option></select></div>
            <div class="col-md-6"><label class="form-label">Chiffre d'affaires *</label><select name="ChiffreAffaire" class="form-select" required><option value="" selected disabled>Choisir...</option><option value="0-900 000" {{ old('ChiffreAffaire') == '0-900 000' ? 'selected' : '' }}>0 - 900 000 FCFA</option><option value="900 000-50 000 000" {{ old('ChiffreAffaire') == '900 000-50 000 000' ? 'selected' : '' }}>900K - 50M FCFA</option><option value="50 000 000-100 000 000" {{ old('ChiffreAffaire') == '50 000 000-100 000 000' ? 'selected' : '' }}>50M - 100M FCFA</option><option value="100 000 000-500 000 000" {{ old('ChiffreAffaire') == '100 000 000-500 000 000' ? 'selected' : '' }}>100M - 500M FCFA</option></select></div>
            <div class="col-12"><label class="form-label">Type d'ESN *</label><select name="TypeEsn" class="form-select" required><option value="" selected disabled>Choisir...</option><option value="Startup" {{ old('TypeEsn') == 'Startup' ? 'selected' : '' }}>Startup</option><option value="Entreprise commerciale" {{ old('TypeEsn') == 'Entreprise commerciale' ? 'selected' : '' }}>Entreprise commerciale</option></select></div>
            <div class="col-12"><label class="form-label">Description de l'entreprise *</label><textarea name="description" class="form-control" rows="3" required>{{ old('description') }}</textarea></div>

            <!-- SECTION 3 : Finalisation -->
            <h4 class="form-section-title" id="account">Finalisation & Compte</h4>
            <div class="col-md-6"><label class="form-label">Registre de commerce *</label><input class="form-control" type="file" name="RegistreCommerce" required></div>
            <div class="col-md-6"><label class="form-label">Logo de l'entreprise *</label><input class="form-control" type="file" name="LogoEntreprise" required></div>
            <div class="col-md-6"><label class="form-label">Mot de passe *</label><input type="password" name="password" class="form-control" required></div>
            <div class="col-md-6"><label class="form-label">Confirmer votre mot de passe *</label><input type="password" name="password_confirmation" class="form-control" required></div>
            <div class="col-12 mt-3"><div class="form-check"><input class="form-check-input" type="checkbox" name="cgv" required><label class="form-check-label">J'ai lu et j'approuve les <a href="#" data-bs-toggle="modal" data-bs-target="#conditionsModal">conditions générales</a>.*</label></div></div>

            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-submit">Soumettre mon Enregistrement</button>
            </div>
            <div class="col-12 text-center mt-3">
                <a href="#" class="text-muted">Déjà un compte ? Se connecter</a>
            </div>
        </form>
    </div>
</div>

<!-- Modal pour les conditions -->
<div class="modal fade" id="conditionsModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title">Conditions générales</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
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
      <div class="modal-footer"><button type="button" class="btn btn-primary" data-bs-dismiss="modal">Lu et approuvé</button></div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const formPanel = document.querySelector('.form-panel');
        const motivationSlides = document.querySelectorAll('.motivation-slide');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const sectionId = entry.target.id;
                    motivationSlides.forEach(slide => {
                        slide.classList.toggle('active', slide.dataset.section === sectionId);
                    });
                }
            });
        }, { root: formPanel, threshold: 0.5 });
        document.querySelectorAll('.form-section-title').forEach(title => {
            observer.observe(title);
        });
    });
</script>

</body>
</html>
