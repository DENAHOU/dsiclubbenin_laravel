<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devenir Recruteur - Club DSI Bénin</title>
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
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: var(--light-bg); 
            margin: 0; 
            display: grid; 
            place-items: center; 
            min-height: 100vh; 
            padding: 2rem 1rem;
        }

        .register-container {
            width: 100%; 
            max-width: 550px;
            background: white; 
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(9, 66, 129, 0.15);
            overflow: hidden;
        }
        
        .register-header { 
            padding: 2rem; 
            text-align: center; 
            border-bottom: 1px solid var(--border-color); 
            background: linear-gradient(135deg, var(--dsi-blue) 0%, #0a2b5c 100%);
            color: white;
        }
        
        .register-header img { max-height: 50px; margin-bottom: 1rem; }
        .register-header h2 { font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem; }
        .register-header p { opacity: 0.9; margin: 0; font-size: 0.95rem; }
        
        .register-body { padding: 2rem; }

        .section-title {
            font-weight: 700; 
            color: var(--dsi-blue); 
            margin: 1.5rem 0 1rem 0; 
            padding-bottom: 0.5rem; 
            border-bottom: 2px solid var(--dsi-green); 
            font-size: 1.1rem;
        }

        .form-label { font-weight: 600; color: var(--ink); margin-bottom: 0.5rem; }
        .form-control, .form-select { 
            height: 50px; 
            border-color: var(--border-color); 
            border-radius: 10px;
            box-shadow: none !important; 
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus { 
            border-color: var(--dsi-blue); 
            box-shadow: 0 0 0 0.2rem rgba(9, 66, 129, 0.1) !important;
        }

        .btn-social {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            padding: 0.8rem 1.5rem;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            background: white;
            color: var(--ink);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }
        .btn-social:hover {
            border-color: var(--dsi-blue);
            color: var(--dsi-blue);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(9, 66, 129, 0.1);
        }

        .social-divider { 
            display: flex; 
            align-items: center; 
            text-align: center; 
            color: var(--muted-ink); 
            margin: 1.5rem 0; 
            font-size: 0.9rem;
        }
        .social-divider::before, .social-divider::after { 
            content: ''; 
            flex: 1; 
            border-bottom: 1px solid var(--border-color); 
        }
        .social-divider span { padding: 0 1rem; }

        .upload-box {
            border: 2px dashed var(--border-color);
            border-radius: 12px; 
            padding: 1.5rem; 
            text-align: center;
            cursor: pointer; 
            transition: all 0.3s ease;
            background: var(--light-bg);
        }
        .upload-box:hover { 
            background-color: #e8f0fe;
            border-color: var(--dsi-blue);
        }
        .upload-box i { font-size: 2rem; color: var(--dsi-blue); margin-bottom: 0.5rem; }
        .upload-box h6 { color: var(--ink); font-weight: 600; margin-bottom: 0.5rem; }
        .upload-box small { color: var(--muted-ink); }

        .btn-register {
            background: linear-gradient(135deg, var(--dsi-blue) 0%, var(--dsi-green) 100%);
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 10px;
            font-weight: 700;
            font-size: 1rem;
            width: 100%;
            transition: all 0.3s ease;
        }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(9, 66, 129, 0.2);
        }

        .form-text { font-size: 0.85rem; color: var(--muted-ink); }

        @media (max-width: 576px) {
            .register-container { margin: 1rem; }
            .register-header { padding: 1.5rem; }
            .register-body { padding: 1.5rem; }
        }
    </style>
</head>
<body>

<div class="register-container">
    <div class="register-header">
        <a href="/"><img src="{{ asset('img/logo-dsi.png') }}" alt="Logo Club DSI Bénin"></a>
        <h2>Portail Recruteur</h2>
        <p>Accédez à notre place de marché des talents et trouvez le profil idéal pour votre entreprise.</p>
    </div>
    
    <div class="register-body">
        <!-- Connexions Sociales -->
        <div class="d-grid gap-2 mb-3">
            <a href="#" class="btn-social">
                <i class="fab fa-linkedin"></i>
                <span>Continuer avec LinkedIn</span>
            </a>
            <a href="#" class="btn-social">
                <i class="fab fa-google"></i>
                <span>Continuer avec Google</span>
            </a>
        </div>

        <div class="social-divider">
            <span>OU</span>
        </div>

        <!-- Formulaire Simplifié -->
        <form action="{{ route('register.recruter.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Oups !</strong> Veuillez vérifier les champs du formulaire.
                </div>
            @endif

            <!-- SECTION 1 : Votre Entreprise -->
            <h4 class="section-title"><i class="fas fa-building me-2"></i>Votre Entreprise</h4>

            <div class="mb-3">
                <label for="nom" class="form-label">Nom de l'entreprise *</label>
                <input type="text" name="nom" class="form-control" id="nom" value="{{ old('nom') }}" required>
                @error('nom')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="secteur" class="form-label">Secteur d'activité *</label>
                <select name="secteur" class="form-select" id="secteur" required>
                    <option value="" selected disabled>Choisir...</option>
                    <option value="Public" {{ old('secteur') == 'Public' ? 'selected' : '' }}>Public</option>
                    <option value="Privé" {{ old('secteur') == 'Privé' ? 'selected' : '' }}>Privé</option>
                    <option value="Banque" {{ old('secteur') == 'Banque' ? 'selected' : '' }}>Banque</option>
                    <option value="Multinationale" {{ old('secteur') == 'Multinationale' ? 'selected' : '' }}>Multinationale</option>
                    <option value="Organisme international" {{ old('secteur') == 'Organisme international' ? 'selected' : '' }}>Organisme international</option>
                    <option value="ONG" {{ old('secteur') == 'ONG' ? 'selected' : '' }}>ONG</option>
                    <option value="Autre" {{ old('secteur') == 'Autre' ? 'selected' : '' }}>Autre</option>
                </select>
                @error('secteur')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="localisation" class="form-label">Localisation géographique *</label>
                <input type="text" name="localisation" class="form-control" id="localisation" value="{{ old('localisation') }}" required>
                @error('localisation')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Logo de l'entreprise (optionnel)</label>
                <label for="logo" class="upload-box">
                    <i class="fas fa-image"></i>
                    <h6>Ajouter votre logo</h6>
                    <small>PNG, JPG (Max 2Mo)</small>
                </label>
                <input type="file" name="logo" id="logo" class="d-none" accept="image/*">
                @error('logo')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- SECTION 2 : Votre Compte Recruteur -->
            <h4 class="section-title"><i class="fas fa-user-tie me-2"></i>Votre Compte Recruteur</h4>

            <div class="mb-3">
                <label for="username" class="form-label">Nom du responsable *</label>
                <input type="text" name="username" class="form-control" id="username" value="{{ old('username') }}" required>
                @error('username')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email de connexion *</label>
                <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Numéro de téléphone *</label>
                <input type="tel" name="phone" class="form-control" id="phone" value="{{ old('phone') }}" required>
                @error('phone')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe *</label>
                <input type="password" name="password" class="form-control" id="password" required>
                @error('password')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="form-label">Confirmer mot de passe *</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
            </div>

            <!-- Conditions -->
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="cgv" id="cgv" required>
                    <label class="form-check-label" for="cgv">
                        J'accepte les <a href="#" class="text-decoration-none">conditions d'utilisation</a> de la plateforme de recrutement.
                    </label>
                </div>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-register">
                <i class="fas fa-rocket me-2"></i>
                Créer mon Compte Recruteur
            </button>
        </form>

        <div class="text-center mt-3">
            <a href="#" class="text-muted text-decoration-none">
                <small>Déjà un compte ? Se connecter</small>
            </a>
        </div>
    </div>
</div>

<script>
    // Affichage du nom du fichier logo sélectionné
    document.getElementById('logo').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name || '';
        const uploadBox = document.querySelector('.upload-box');
        if (fileName) {
            uploadBox.innerHTML = `
                <i class="fas fa-image-check text-success"></i>
                <h6 class="text-success">${fileName}</h6>
                <small>Cliquez pour changer de fichier</small>
            `;
        }
    });
</script>

</body>
</html>
