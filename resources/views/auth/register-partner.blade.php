<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devenir Partenaire - Club DSI Bénin</title>
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
        body { font-family: 'Inter', sans-serif; background-color: var(--light-bg); }

        .hero-partners-form {
            padding: 4rem 1.5rem;
            background: linear-gradient(rgba(9, 66, 129, 0.8), rgba(9, 66, 129, 0.8)), url('https://images.unsplash.com/photo-1521791136064-7986c2920216?w=1200');
            background-size: cover; background-position: center;
            text-align: center; color: white;
        }
        .hero-partners-form h1 { font-weight: 800; }

        .form-wizard-container {
            max-width: 900px;
            margin: -4rem auto 4rem auto;
            background: white; border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(9, 66, 129, 0.2);
            overflow: hidden; position: relative; z-index: 10;
        }

        /* Barre de Progression */
        .progress-bar-container { display: flex; background-color: var(--light-bg); padding: 1.5rem 2rem; }
        .progress-step { flex: 1; text-align: center; position: relative; color: var(--muted-ink); font-weight: 600; }
        .progress-step.active { color: var(--dsi-blue); }
        .progress-step::before { content: ''; position: absolute; top: 50%; left: -50%; width: 100%; height: 3px; background-color: #e5eaf2; z-index: 0; transform: translateY(-50%); }
        .progress-step:first-child::before { display: none; }
        .progress-step .step-circle { width: 40px; height: 40px; border-radius: 50%; background-color: #e5eaf2; color: var(--muted-ink); display: inline-flex; align-items: center; justify-content: center; font-size: 1.2rem; margin-bottom: 0.5rem; position: relative; z-index: 1; transition: all 0.4s ease; }
        .progress-step.active .step-circle { background-color: var(--dsi-blue); color: white; }
        .progress-step.completed .step-circle { background-color: var(--dsi-green); color: white; }

        /* Formulaire */
        /* Updated width for 4 steps */
        .form-wizard-content { position: relative; display: flex; width: 400%; transition: transform 0.6s cubic-bezier(0.76, 0, 0.24, 1); }
        /* Updated width for 4 steps */
        .form-step { width: calc(100% / 4); padding: 2.5rem; }
        .form-section-title { font-weight: 700; color: var(--dsi-blue); margin-bottom: 1.5rem; }
        .form-control, .form-select { height: 50px; border-color: #e5eaf2; box-shadow: none !important; }

        .form-navigation { display: flex; justify-content: space-between; margin-top: 2rem; }
        .btn-wizard { font-size: 1rem; font-weight: 600; padding: 0.8rem 2rem; border-radius: 10px; border: none; }
        .btn-prev { background-color: var(--light-bg); color: var(--muted-ink); }
        .btn-next { background: var(--dsi-blue); color: white; }
        .btn-submit { background: linear-gradient(95deg, var(--dsi-blue), var(--dsi-green)); color: white; }
    </style>
</head>
<body>

    <section class="hero-partners-form">
        <h1>Devenir Partenaire</h1>
        <p class="lead opacity-75">Rejoignez un réseau d'excellence et contribuez à façonner l'avenir du numérique.</p>
    </section>

    <div class="form-wizard-container">
        <div class="progress-bar-container">
            <div class="progress-step active" data-step="1"><div class="step-circle">1</div>Organisation</div>
            <div class="progress-step" data-step="2"><div class="step-circle">2</div>Coordonnées</div>
            <div class="progress-step" data-step="3"><div class="step-circle">3</div>Mot de passe</div>
            <div class="progress-step" data-step="4"><div class="step-circle">4</div>Motivation</div>
        </div>

        <form action="{{ route('register.partner.store') }}" method="POST" id="partner-form" enctype="multipart/form-data">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger m-4"><strong>Oups !</strong> Veuillez corriger les erreurs.</div>
            @endif

            <div class="form-wizard-content">
                <!-- ÉTAPE 1: Organisation -->
                <div class="form-step">
                    <h3 class="form-section-title">1. Votre Organisation</h3>
                    <div class="row g-3">

                        <div class="col-12"><label class="form-label">Type de partenaire *</label><select name="partner_type_id" class="form-select" required><option value="" selected disabled>Choisissez...</option>@foreach($types as $type)<option value="{{ $type->id }}">{{ $type->name }}</option>@endforeach</select></div>

                        <div class="col-12"><label class="form-label">Formule de partenariat *</label><select name="partner_formule_id" class="form-select" required><option value="" selected disabled>Choisissez...</option>@foreach($formules as $formule)<option value="{{ $formule->id }}">{{ $formule->name }}</option>@endforeach</select></div>

                        <div class="col-md-6"><label class="form-label">Raison sociale *</label><input type="text" name="company_name" class="form-control" required></div>
                        <div class="col-md-6"><label class="form-label">Domaine *</label><input type="text" name="domain" class="form-control" required></div>
                        <div class="col-md-6"><label class="form-label">Spécialité *</label><input type="text" name="specialty" class="form-control" required></div>
                        <div class="col-md-6"><label class="form-label">Pays *</label><select name="country" class="form-select" required><option value="Benin">Bénin</option><option value="France">France</option><option value="Togo">Togo</option><option value="Côte d'Ivoire">Côte d'Ivoire</option><option value="Nigeria">Nigéria</option><!-- ... etc ... --></select></div>
                        <div class="col-12"><label class="form-label">Adresse Géographique *</label><input type="text" name="address" class="form-control" required></div>
                        <div class="col-12"><label class="form-label">Site web *</label><input class="form-control" type="url" name="url" placeholder="https://example.com" required></div>
                    </div>
                    <div class="form-navigation"><div></div><button type="button" class="btn-wizard btn-next">Suivant <i class="fas fa-arrow-right ms-2"></i></button></div>
                </div>

                <!-- ÉTAPE 2: Coordonnées -->
                <div class="form-step">
                    <h3 class="form-section-title">2. Vos Coordonnées</h3>
                    <div class="row g-3">
                        <div class="col-12"><label class="form-label">Nom du 1er responsable *</label><input type="text" name="name_responsability" class="form-control" required></div>
                        <div class="col-md-6"><label class="form-label">E-mail *</label><input type="email" name="email" class="form-control" required></div>
                        <div class="col-md-6"><label class="form-label">Numéro de téléphone *</label><input type="tel" name="phone" class="form-control" required></div>
                        <div class="col-12"><label class="form-label">Logo de votre organisation *</label><input class="form-control" type="file" name="medias" required></div>
                    </div>
                    <div class="form-navigation"><button type="button" class="btn-wizard btn-prev"><i class="fas fa-arrow-left me-2"></i> Précédent</button><button type="button" class="btn-wizard btn-next">Suivant <i class="fas fa-arrow-right ms-2"></i></button></div>
                </div>

                <!-- NOUVELLE ÉTAPE 3: Mot de passe -->
                <div class="form-step">
                    <h3 class="form-section-title">3. Créez votre mot de passe</h3>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Mot de passe *</label>
                            <input type="password" name="password" class="form-control" required minlength="8">
                            <div class="form-text">Minimum 8 caractères.</div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Confirmer le mot de passe *</label>
                            <input type="password" name="password_confirmation" class="form-control" required minlength="8">
                        </div>
                    </div>
                    <div class="form-navigation">
                        <button type="button" class="btn-wizard btn-prev"><i class="fas fa-arrow-left me-2"></i> Précédent</button>
                        <button type="button" class="btn-wizard btn-next">Suivant <i class="fas fa-arrow-right ms-2"></i></button>
                    </div>
                </div>

                <!-- ÉTAPE 4 (Anciennement 3): Motivation -->
                <div class="form-step">
                    <h3 class="form-section-title">4. Votre Motivation</h3>
                    <div class="row g-3">
                        <div class="col-12"><label class="form-label">Motivation *</label><textarea name="reason_motivation" class="form-control" rows="8" placeholder="Expliquez en quelques mots pourquoi vous souhaitez devenir partenaire..." required></textarea></div>
                        <div class="col-12 mt-3"><div class="form-check"><input class="form-check-input" type="checkbox" name="cgv" required><label class="form-check-label">J'ai lu et j'approuve les <a href="#" data-bs-toggle="modal" data-bs-target="#conditionsModal">conditions générales de partenariat</a>.*</label></div></div>
                    </div>
                    <div class="form-navigation"><button type="button" class="btn-wizard btn-prev"><i class="fas fa-arrow-left me-2"></i> Précédent</button><button type="submit" class="btn-wizard btn-submit">Soumettre ma Demande</button></div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal pour les conditions -->
    <div class="modal fade" id="conditionsModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
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
            const nextButtons = document.querySelectorAll('.btn-next');
            const prevButtons = document.querySelectorAll('.btn-prev');
            const formContent = document.querySelector('.form-wizard-content');
            const progressSteps = document.querySelectorAll('.progress-step');
            let currentStep = 1;
            const totalSteps = 4; // Updated from 3 to 4

            nextButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Add validation here before moving to the next step
                    if (validateStep(currentStep)) {
                        if (currentStep < totalSteps) { // Use totalSteps here
                            currentStep++;
                            updateFormState();
                        }
                    }
                });
            });
            prevButtons.forEach(button => {
                button.addEventListener('click', () => {
                    if (currentStep > 1) { currentStep--; updateFormState(); }
                });
            });

            function updateFormState() {
                // Updated translateX percentage for 4 steps
                formContent.style.transform = `translateX(-${(currentStep - 1) * (100 / totalSteps)}%)`;
                progressSteps.forEach((step, index) => {
                    const stepElement = step;
                    const stepNum = index + 1;
                    if (stepNum < currentStep) {
                        stepElement.classList.add('completed');
                        stepElement.classList.remove('active');
                    } else if (stepNum === currentStep) {
                        stepElement.classList.add('active');
                        stepElement.classList.remove('completed');
                    } else {
                        stepElement.classList.remove('active', 'completed');
                    }
                });
            }

            // Basic validation function (you'll want to enhance this for production)
            function validateStep(step) {
                let isValid = true;
                const currentFormStep = document.querySelector(`.form-step:nth-child(${step})`);
                const requiredInputs = currentFormStep.querySelectorAll('[required]');

                requiredInputs.forEach(input => {
                    if (!input.value.trim()) {
                        input.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        input.classList.remove('is-invalid');
                    }
                });

                // Specific validation for password step
                if (step === 3) {
                    const password = currentFormStep.querySelector('input[name="password"]');
                    const passwordConfirmation = currentFormStep.querySelector('input[name="password_confirmation"]');

                    if (password.value.length < 8) {
                        password.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        password.classList.remove('is-invalid');
                    }

                    if (password.value !== passwordConfirmation.value) {
                        passwordConfirmation.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        passwordConfirmation.classList.remove('is-invalid');
                    }
                }

                return isValid;
            }

            // Add event listeners for input changes to clear validation
            document.querySelectorAll('.form-control, .form-select').forEach(input => {
                input.addEventListener('input', () => {
                    if (input.value.trim()) {
                        input.classList.remove('is-invalid');
                    }
                });
            });
        });
    </script>

</body>
</html>
