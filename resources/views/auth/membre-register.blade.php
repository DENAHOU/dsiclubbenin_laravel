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
        .form-control, .form-select { height: 50px; border-color: var(--border-color); box-shadow: none !important; }
        .form-control:focus, .form-select:focus { border-color: var(--dsi-blue); }
        .form-check-input { width: 1.25em; height: 1.25em; }

        .btn-submit {
            font-size: 1.1rem; font-weight: 700;
            padding: 0.8rem 2rem; border-radius: 10px;
            background: linear-gradient(95deg, var(--dsi-blue), var(--dsi-green));
            color: white; border: none;
        }

        .form-step { display: none; animation: fadeInSlide 0.5s ease forwards; }
        .form-step.step-active { display: block; }
        @keyframes fadeInSlide { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

        .step-indicator { font-size: 0.85rem; font-weight: bold; color: #ccc; transition: color 0.3s; }
        .step-indicator.active { color: #0d6efd; }

        .is-invalid { border-color: #dc3545 !important; background-color: #fff8f8; }
        .invalid-feedback { font-weight: 500; animation: shake 0.4s ease-in-out; }
        @keyframes shake { 0%, 100% { transform: translateX(0); } 25% { transform: translateX(-5px); } 75% { transform: translateX(5px); } }

        .form-control:focus { box-shadow: 0 0 0 0.25rem rgba(41, 150, 58, 0.25) !important; }
        .is-invalid:focus { box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25) !important; }

        /* Prévisualisation photo */
        #photo-preview { display: none; width: 100px; height: 100px; object-fit: cover; border: 3px solid var(--dsi-green); border-radius: 50%; margin-bottom: 10px; }

    </style>
</head>
<body>

<section class="hero-register">
    <h1>Formulaire d'Adhésion Membre</h1>
    <p class="lead opacity-75">Rejoignez l'élite des décideurs IT du Bénin.</p>
</section>

<div class="container my-5">
    <div class="register-form-box shadow-lg p-4 rounded-4 bg-white">

        <div class="progress-container mb-5">
            <div class="progress" style="height: 8px;">
                <div class="progress-bar bg-primary" id="progressBar" role="progressbar" style="width: 33%;"></div>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <span class="step-indicator active">Info personnelles</span>
                <span class="step-indicator">Professionnelle</span>
                <span class="step-indicator">Votre Compte</span>
            </div>
        </div>

        <form action="{{ route('register.membre.store') }}" method="POST" id="multiStepForm" class="needs-validation" enctype="multipart/form-data" novalidate>
            @csrf

            {{-- ================== ETAPE 1 ================== --}}
            <div class="form-step step-active" id="step-1">
                <h4 class="form-section-title mb-4"><i class="fas fa-user-circle me-2"></i>Informations Personnelles</h4>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nom *</label>
                        <input type="text" name="lastname" class="form-control @error('lastname') is-invalid @enderror" value="{{ old('lastname') }}" required>
                        @error('lastname') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Prénom(s) *</label>
                        <input type="text" name="firstname" class="form-control @error('firstname') is-invalid @enderror" value="{{ old('firstname') }}" required>
                        @error('firstname') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Sexe *</label>
                        <select class="form-select @error('sexe') is-invalid @enderror" name="sexe" required>
                            <option value="">Choisir...</option>
                            <option value="M" {{ old('sexe') == 'M' ? 'selected' : '' }}>Masculin</option>
                            <option value="F" {{ old('sexe') == 'F' ? 'selected' : '' }}>Féminin</option>
                        </select>
                        @error('sexe') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Date de naissance *</label>
                        <input type="date" name="birthday" class="form-control @error('birthday') is-invalid @enderror" value="{{ old('birthday') }}" required>
                        @error('birthday') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Votre Photo (Max 5 Mo) *</label>
                        <div class="text-center">
                            <img id="photo-preview" src="#" alt="Aperçu">
                        </div>
                        <input class="form-control @error('medias_id') is-invalid @enderror" type="file" name="medias_id" id="photoInput" accept="image/*" required>
                        @error('medias_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="2">{{ old('description') }}</textarea>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="button" class="btn btn-primary next-step px-4">Suivant <i class="fas fa-arrow-right ms-2"></i></button>
                </div>
            </div>

            {{-- ================== ETAPE 2 ================== --}}
            <div class="form-step" id="step-2">
                <h4 class="form-section-title mb-4"><i class="fas fa-briefcase me-2"></i>Parcours Professionnel</h4>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Employeur actuel *</label>
                        <input type="text" name="current_employer" class="form-control @error('current_employer') is-invalid @enderror" value="{{ old('current_employer') }}" required>
                        @error('current_employer') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Contact Employeur *</label>
                        <input type="text" name="employer_contact" class="form-control @error('employer_contact') is-invalid @enderror" value="{{ old('employer_contact') }}" required>
                        @error('employer_contact') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Poste actuel *</label>
                        <select name="current_position" class="form-select @error('current_position') is-invalid @enderror" required>
                            <option value="">Choisir...</option>
                            <option {{ old('current_position') == "Directeur des Systèmes d'Information (DSI)" ? 'selected' : '' }}>Directeur des Systèmes d'Information (DSI)</option>
                            <option {{ old('current_position') == "Responsable des Systèmes d'Information (RSI)" ? 'selected' : '' }}>Responsable des Systèmes d'Information (RSI)</option>
                            <option {{ old('current_position') == "Responsable de la Sécurité des SI (RSSI)" ? 'selected' : '' }}>Responsable de la Sécurité des SI (RSSI)</option>
                            <option {{ old('current_position') == "Directeur Technique (DT)" ? 'selected' : '' }}>Directeur Technique (DT)</option>
                            <option {{ old('current_position') == "Responsable Technique (RT)" ? 'selected' : '' }}>Responsable Technique (RT)</option>
                        </select>
                        @error('current_position') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Secteur *</label>
                        <select name="sector" id="sectorSelect" class="form-select @error('sector') is-invalid @enderror" required>
                            <option value="">Choisir...</option>
                            <option value="Public" {{ old('sector') == 'Public' ? 'selected' : '' }}>Public</option>
                            <option value="Privé" {{ old('sector') == 'Privé' ? 'selected' : '' }}>Privé</option>
                            <option value="Multinationale" {{ old('sector') == 'Multinationale' ? 'selected' : '' }}>Multinationale</option>
                            <option value="Organisme international" {{ old('sector') == 'Organisme international' ? 'selected' : '' }}>Organisme international</option>
                            <option value="ONG" {{ old('sector') == 'ONG' ? 'selected' : '' }}>ONG</option>
                            <option value="Autre" {{ old('sector') == 'Autre' ? 'selected' : '' }}>Autre</option>
                        </select>
                        @error('sector') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6" id="sectorOtherDiv" style="display: none;">
                        <label class="form-label">Veuillez préciser votre secteur *</label>
                        <input type="text" name="sector_other" id="sectorOtherInput" class="form-control @error('sector_other') is-invalid @enderror" value="{{ old('sector_other') }}">
                        @error('sector_other') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Catégorie de service *</label>
                        <select name="category_of_service" id="categorySelect" class="form-select @error('category_of_service') is-invalid @enderror" required>
                            <option value="">Choisir...</option>
                            <option value="Industrie" {{ old('category_of_service') == 'Industrie' ? 'selected' : '' }}>Industrie</option>
                            <option value="Banque" {{ old('category_of_service') == 'Banque' ? 'selected' : '' }}>Banque</option>
                            <option value="Autre" {{ old('category_of_service') == 'Autre' ? 'selected' : '' }}>Autre</option>
                        </select>
                        @error('category_of_service') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6" id="categoryOtherDiv" style="display: none;">
                        <label class="form-label">Veuillez préciser votre catégorie *</label>
                        <input type="text" name="category_other" id="categoryOtherInput" class="form-control @error('category_other') is-invalid @enderror" value="{{ old('category_other') }}">
                        @error('category_other') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Domaine d'expertise *</label>
                        <input type="text" name="area_of_expertise" class="form-control @error('area_of_expertise') is-invalid @enderror" value="{{ old('area_of_expertise') }}" required>
                        @error('area_of_expertise') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Formation initiale *</label>
                        <input type="text" name="initial_training" class="form-control @error('initial_training') is-invalid @enderror" value="{{ old('initial_training') }}" required>
                        @error('initial_training') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-secondary prev-step">Précédent</button>
                    <button type="button" class="btn btn-primary next-step px-4">Suivant <i class="fas fa-arrow-right ms-2"></i></button>
                </div>
            </div>

            {{-- ================== ETAPE 3 ================== --}}
            <div class="form-step" id="step-3">
                <h4 class="form-section-title mb-4"><i class="fas fa-shield-alt me-2"></i>Votre Compte</h4>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nom d'utilisateur *</label>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}">
                        @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">E-mail *</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Mot de passe *</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Confirmer le mot de passe *</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Type de Membre *</label>
                        <select name="type_members" id="type_members" class="form-control" required>

                            <option value="individuel" {{ $type == 'individuel' ? 'selected' : '' }}>Membre Individuel</option>

                            <option value="entite" {{ $type == 'entite' ? 'selected' : '' }}>Entité Utilisatrice</option>

                            <option value="admin_publique" {{ $type == 'admin_publique' ? 'selected' : '' }}>Administration Publique</option>

                            <option value="it" {{ $type == 'it' ? 'selected' : '' }}>Collège IT</option>

                        </select>
                    </div>

                    <div class="col-12 mt-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="termsCheck" required>
                            <label class="form-check-label" for="termsCheck">
                                J'ai lu et j'approuve les
                                <a href="#" data-bs-toggle="modal" data-bs-target="#conditionsModal">
                                    conditions générales d'adhésion</a>.*
                            </label>
                            <div class="invalid-feedback">Vous devez accepter avant de continuer.</div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="button" class="btn btn-outline-secondary prev-step">Précédent</button>
                    <button type="submit" class="btn-submit">S'inscrire</button>
                </div>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nextBtns = document.querySelectorAll('.next-step');
    const prevBtns = document.querySelectorAll('.prev-step');
    const steps = document.querySelectorAll('.form-step');
    const progressBar = document.getElementById('progressBar');
    const indicators = document.querySelectorAll('.step-indicator');
    let currentStep = 0;

    function showStep(index) {
        steps.forEach((step, i) => {
            step.classList.toggle('step-active', i === index);
            indicators[i].classList.toggle('active', i <= index);
        });
        progressBar.style.width = `${((index+1)/steps.length)*100}%`;
        currentStep = index;
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    nextBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            if (currentStep < steps.length -1) showStep(currentStep+1);
        });
    });
    prevBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            if (currentStep > 0) showStep(currentStep-1);
        });
    });

    // Photo preview
    const photoInput = document.getElementById('photoInput');
    const photoPreview = document.getElementById('photo-preview');
    photoInput.addEventListener('change', function(e){
        if(this.files && this.files[0]){
            const reader = new FileReader();
            reader.onload = function(ev){
                photoPreview.src = ev.target.result;
                photoPreview.style.display = 'block';
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Champs Autres
    const sectorSelect = document.getElementById('sectorSelect');
    const sectorOtherDiv = document.getElementById('sectorOtherDiv');
    sectorSelect.addEventListener('change', () => {
        sectorOtherDiv.style.display = sectorSelect.value === 'Autre' ? 'block' : 'none';
    });
    const categorySelect = document.getElementById('categorySelect');
    const categoryOtherDiv = document.getElementById('categoryOtherDiv');
    categorySelect.addEventListener('change', () => {
        categoryOtherDiv.style.display = categorySelect.value === 'Autre' ? 'block' : 'none';
    });

    // Si Laravel renvoie des erreurs, reste à la bonne étape
    @if ($errors->any())
        @if ($errors->hasAny(['current_employer','employer_contact','current_position']))
            showStep(1);
        @elseif ($errors->hasAny(['username','email','password']))
            showStep(2);
        @endif
    @endif
});
</script>

</body>
</html>



