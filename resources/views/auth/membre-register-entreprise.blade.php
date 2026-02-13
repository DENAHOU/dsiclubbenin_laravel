<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adhésion Entreprise - Club DSI Bénin</title>
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
            padding: 4rem 1.5rem;
            background: linear-gradient(rgba(9, 66, 129, 0.85), rgba(9, 66, 129, 0.85)), url('https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=1200');
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
    <h1>Formulaire d'Adhésion Entreprise</h1>
    <p class="lead opacity-75">Rejoignez l'écosystème en tant qu'Entité Utilisatrice.</p>
</section>

<div class="container my-5">
    <div class="register-form-box">
        <div class="alert alert-info">
            <strong>Pour les membres DSI :</strong> La méthode de connexion privilégiée est via votre compte Microsoft 365. Si vous en avez un, nous vous recommandons de vous connecter directement.
            <div class="text-center mt-3">
                <a href="{{ route('login.microsoft.redirect') }}" class="btn btn-lg btn-outline-primary"><i class="fab fa-microsoft me-2"></i> Se Connecter avec Microsoft</a>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('register.company.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- SECTION 1 : Informations sur l'Entreprise -->
            <h4 class="form-section-title"><i class="fas fa-building"></i> Informations sur l'Entreprise</h4>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="company_name" class="form-label">Nom de la structure *</label>
                    <input type="text" name="company_name" class="form-control" id="company_name" value="{{ old('company_name') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="ifu" class="form-label">Numéro IFU</label>
                    <input type="text" name="ifu" class="form-control" id="ifu" value="{{ old('ifu') }}">
                </div>
                <div class="col-md-6">
                    <label for="company_address" class="form-label">Adresse de la structure *</label>
                    <input type="text" name="company_address" class="form-control" id="company_address" value="{{ old('company_address') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="company_phone" class="form-label">Numéro de téléphone (Entreprise) *</label>
                    <input type="tel" name="company_phone" class="form-control" id="company_phone" value="{{ old('company_phone') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="sectorSelect" class="form-label">Secteur d'activité *</label>
                    <select class="form-select" name="sector" id="sectorSelect" required>
                        <option value="" selected disabled>Choisissez un secteur...</option>
                        <option value="Public" {{ old('sector') == 'Public' ? 'selected' : '' }}>Public</option>
                        <option value="Privé" {{ old('sector') == 'Privé' ? 'selected' : '' }}>Privé</option>
                        <option value="Multinationale" {{ old('sector') == 'Multinationale' ? 'selected' : '' }}>Multinationale</option>
                        <option value="Organisme international" {{ old('sector') == 'Organisme international' ? 'selected' : '' }}>Organisme international</option>
                        <option value="ONG" {{ old('sector') == 'ONG' ? 'selected' : '' }}>ONG</option>
                        <option value="Autre" {{ old('sector') == 'Autre' ? 'selected' : '' }}>Autre...</option>
                    </select>
                </div>
                <div class="col-md-6" id="sectorOtherDiv" style="display: none;">
                    <label for="sectorOtherInput" class="form-label">Veuillez préciser votre secteur *</label>
                    <input type="text" name="sector_other" class="form-control" id="sectorOtherInput" value="{{ old('sector_other') }}">
                </div>
                <div class="col-md-6">
                    <label for="categorySelect" class="form-label">Catégorie de service *</label>
                    <select class="form-select" name="category_of_service" id="categorySelect" required>
                        <option value="" selected disabled>Choisissez une catégorie...</option>
                        <option value="Industrie" {{ old('category_of_service') == 'Industrie' ? 'selected' : '' }}>Industrie</option>
                        <option value="Banque" {{ old('category_of_service') == 'Banque' ? 'selected' : '' }}>Banque</option>
                        <option value="Assurance" {{ old('category_of_service') == 'Assurance' ? 'selected' : '' }}>Assurance</option>
                        <option value="Microfinance" {{ old('category_of_service') == 'Microfinance' ? 'selected' : '' }}>Microfinance</option>
                        <option value="Santé" {{ old('category_of_service') == 'Santé' ? 'selected' : '' }}>Santé</option>
                        <option value="Agroalimentaire" {{ old('category_of_service') == 'Agroalimentaire' ? 'selected' : '' }}>Agroalimentaire</option>
                        <option value="Finance" {{ old('category_of_service') == 'Finance' ? 'selected' : '' }}>Finance</option>
                        <option value="Humanitaire" {{ old('category_of_service') == 'Humanitaire' ? 'selected' : '' }}>Humanitaire</option>
                        <option value="Ministère" {{ old('category_of_service') == 'Ministère' ? 'selected' : '' }}>Ministère</option>
                        <option value="Agence Gouvernementale" {{ old('category_of_service') == 'Agence Gouvernementale' ? 'selected' : '' }}>Agence Gouvernementale</option>
                        <option value="Commerce" {{ old('category_of_service') == 'Commerce' ? 'selected' : '' }}>Commerce</option>
                        <option value="Logistique" {{ old('category_of_service') == 'Logistique' ? 'selected' : '' }}>Logistique</option>
                        <option value="Autre" {{ old('category_of_service') == 'Autre' ? 'selected' : '' }}>Autre...</option>
                    </select>
                </div>
                <div class="col-md-6" id="categoryOtherDiv" style="display: none;">
                    <label for="categoryOtherInput" class="form-label">Veuillez préciser votre catégorie *</label>
                    <input type="text" name="category_other" class="form-control" id="categoryOtherInput" value="{{ old('category_other') }}">
                </div>
                <div class="col-md-6">
                    <label for="typeMemberSelect" class="form-label">Type d'adhésion *</label>
                    <select class="form-select" id="typeMemberSelect" name="type_members" required>
                        <option value="">Choisissez...</option>
                        <option value="entite" {{ old('type_members', $membershipType ?? '') == 'entite' ? 'selected' : '' }}>Membre entité utilisatrice</option>
                        <option value="college_it" {{ old('type_members', $membershipType ?? '') == 'college_it' ? 'selected' : '' }}>Membre entreprise du Collège IT</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="chiffreAffaireSelect" class="form-label">Chiffre d'affaires (estimation N-1)</label>
                    <select class="form-select" name="chiffre_affaire" id="chiffreAffaireSelect">
                        <option value="" selected disabled>Sélectionnez une tranche...</option>
                        <option value="<30M" {{ old('chiffre_affaire') == '<30M' ? 'selected' : '' }}>≤ 30 millions FCFA</option>
                        <option value="30-150M" {{ old('chiffre_affaire') == '30-150M' ? 'selected' : '' }}>30 à 150 millions FCFA</option>
                        <option value="300M" {{ old('chiffre_affaire') == '300M' ? 'selected' : '' }}>300 millions FCFA</option>
                        <option value=">1MM" {{ old('chiffre_affaire') == '>1MM' ? 'selected' : '' }}>≥ 1 milliard FCFA</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="company_logo" class="form-label">Logo de l'entreprise *</label>
                    <input class="form-control" type="file" name="company_logo" id="company_logo" required>
                </div>
            </div>

            <!-- SECTION 2 : Votre Contact Principal -->
            <h4 class="form-section-title mt-4"><i class="fas fa-user-tie"></i> Votre Contact Principal</h4>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="contact_name" class="form-label">Nom et Prénom(s) du contact *</label>
                    <input type="text" name="contact_name" class="form-control" id="contact_name" value="{{ old('contact_name') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="contact_position" class="form-label">Poste du contact *</label>
                    <input type="text" name="contact_position" class="form-control" id="contact_position" value="{{ old('contact_position') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="contact_phone" class="form-label">Numéro de téléphone (Contact) *</label>
                    <input type="tel" name="contact_phone" class="form-control" id="contact_phone" value="{{ old('contact_phone') }}" required>
                </div>
            </div>

            <!-- SECTION 3 : Votre Compte Entreprise -->
            <h4 class="form-section-title mt-4"><i class="fas fa-shield-alt"></i> Votre Compte Entreprise</h4>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="username" class="form-label">Nom d'utilisateur *</label>
                    <input type="text" name="username" class="form-control" id="username" value="{{ old('username') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">E-mail de connexion *</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="password" class="form-label">Mot de passe *</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>
                <div class="col-md-6">
                    <label for="password_confirmation" class="form-label">Confirmer le mot de passe *</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                </div>
            </div>

            <div class="col-12 text-center mt-5">
                <button type="submit" class="btn btn-submit">Soumettre l'Adhésion</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const sectorSelect = document.getElementById('sectorSelect');
    const sectorOtherDiv = document.getElementById('sectorOtherDiv');
    const sectorOtherInput = document.getElementById('sectorOtherInput');

    sectorSelect.addEventListener('change', function() {
        if (this.value === 'Autre') {
            sectorOtherDiv.style.display = 'block';
            sectorOtherInput.required = true;
        } else {
            sectorOtherDiv.style.display = 'none';
            sectorOtherInput.required = false;
            sectorOtherInput.value = '';
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

    // Pour pré-remplir le champ "Autre" en cas d'erreur de validation
    document.addEventListener('DOMContentLoaded', function() {
        if (sectorSelect.value === 'Autre') {
            sectorOtherDiv.style.display = 'block';
            sectorOtherInput.required = true;
        }
        if (categorySelect.value === 'Autre') {
            categoryOtherDiv.style.display = 'block';
            categoryOtherInput.required = true;
        }
    });
</script>
</body>
</html>
