<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créez Votre Profil Talent - Club DSI Bénin</title>
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
            max-width: 500px;
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
            padding: 2rem; 
            text-align: center;
            cursor: pointer; 
            transition: all 0.3s ease;
            background: var(--light-bg);
        }
        .upload-box:hover { 
            background-color: #e8f0fe;
            border-color: var(--dsi-blue);
        }
        .upload-box i { font-size: 2.5rem; color: var(--dsi-blue); margin-bottom: 1rem; }
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
        <h2>Créez Votre Profil Talent</h2>
        <p>Rejoignez notre place de marché des compétences et laissez les opportunités venir à vous.</p>
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
        <form action="{{ route('register.candidate.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Informations de Base -->
            <div class="mb-3">
                <label for="name" class="form-label">Nom et Prénom(s) *</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Adresse e-mail *</label>
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
                <label for="current_position" class="form-label">Titre / Poste actuel *</label>
                <input type="text" name="current_position" class="form-control" id="current_position" value="{{ old('current_position') }}" required>
                @error('current_position')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="linkedin_url" class="form-label">URL LinkedIn (optionnel)</label>
                <input type="url" name="linkedin_url" class="form-control" id="linkedin_url" value="{{ old('linkedin_url') }}" placeholder="https://linkedin.com/in/votre-profil">
                @error('linkedin_url')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Upload CV -->
            <div class="mb-3">
                <label class="form-label">Votre CV *</label>
                <label for="cv_file" class="upload-box">
                    <i class="fas fa-file-arrow-up"></i>
                    <h6>Cliquez pour téléverser votre CV</h6>
                    <small>PDF, DOC, DOCX (Max 5Mo)</small>
                </label>
                <input type="file" name="cv_file" id="cv_file" class="d-none" accept=".pdf,.doc,.docx" required>
                @error('cv_file')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
                <div class="form-text">Votre CV sera visible par les recruteurs qualifiés</div>
            </div>

            <!-- Mot de passe -->
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe *</label>
                <input type="password" name="password" class="form-control" id="password" required>
                @error('password')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="form-label">Confirmer le mot de passe *</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-register">
                <i class="fas fa-user-plus me-2"></i>
                Créer mon Profil Talent
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
    // Affichage du nom du fichier CV sélectionné
    document.getElementById('cv_file').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name || '';
        const uploadBox = document.querySelector('.upload-box');
        if (fileName) {
            uploadBox.innerHTML = `
                <i class="fas fa-file-check text-success"></i>
                <h6 class="text-success">${fileName}</h6>
                <small>Cliquez pour changer de fichier</small>
            `;
        }
    });
</script>

</body>
</html>
