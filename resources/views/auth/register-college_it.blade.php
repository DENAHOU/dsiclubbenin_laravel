<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adhésion Collège IT - Club DSI Bénin</title>
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
            background: linear-gradient(rgba(9, 66, 129, 0.85), rgba(9, 66, 129, 0.85)), url('https://images.unsplash.com/photo-1517048676732-d65bc937f952?w=1200');
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
            display: flex; align-items: center; gap: 0.75rem; font-size: 1.3rem;
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
    <h1>Activez Vos Avantages</h1>
    <p class="lead opacity-75">Configurez votre profil pour débloquer toutes les opportunités du Collège IT.</p>
</section>

<div class="container my-5">
    <div class="register-form-box">
        <div class="alert alert-info">
            <strong>Pour les membres DSI :</strong> La méthode de connexion privilégiée est via votre compte Microsoft 365. Si vous en avez un, nous vous recommandons de vous connecter directement.
            <div class="text-center mt-3">
                <a href="{{ route('login.microsoft.redirect') }}" class="btn btn-lg btn-outline-primary"><i class="fab fa-microsoft me-2"></i> Se Connecter avec Microsoft</a>
            </div>
        </div>
        <form action="{{ route('register.college.store') }}" method="POST" class="row g-4" enctype="multipart/form-data">
            @csrf

            <!-- SECTION 1 : Visibilité & Reconnaissance -->
            <h4 class="form-section-title"><i class="fas fa-bullhorn"></i> Visibilité & Reconnaissance</h4>
            <div class="col-md-6"><label class="form-label">Nom de votre Société *</label><input type="text" name="company_name" class="form-control" required></div>
            <div class="col-md-6"><label class="form-label">Votre Logo (pour l'annuaire) *</label><input type="file" name="logo_path" class="form-control" required></div>
            <div class="col-12"><label class="form-label">Votre Slogan (1 phrase d'accroche) *</label><input type="text" name="slogan" class="form-control" required></div>
            <div class="col-12"><label class="form-label">Brève description (pour l'annuaire) *</label><textarea name="description" class="form-control" rows="3" required></textarea></div>
            <div class="col-md-6"><label class="form-label">Site Web</label><input type="url" name="website_url" class="form-control"></div>
            <div class="col-md-6"><label class="form-label">Page LinkedIn</label><input type="url" name="linkedin_url" class="form-control"></div>

            <!-- SECTION 2 : Réseau & Opportunités -->
            <h4 class="form-section-title"><i class="fas fa-network-wired"></i> Réseau & Opportunités</h4>
            <div class="col-12">
                <label class="form-label">Vos 3 domaines d'expertise principaux (séparés par des virgules) *</label>
                <input type="text" name="expertise_tags" class="form-control" placeholder="Ex: Cybersécurité, Développement Web, Cloud AWS" required>
            </div>
            <div class="col-12">
                <label class="form-label">Quels décideurs IT ciblez-vous en priorité ? *</label>
                <div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="target_profiles[]" value="banque"><label class="form-check-label">Secteur Bancaire</label></div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="target_profiles[]" value="telco"><label class="form-check-label">Télécoms</label></div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="target_profiles[]" value="gouvernement"><label class="form-check-label">Administration</label></div>
                </div>
            </div>
            <div class="col-12"><label class="form-label">Votre Innovation Technologique Phare *</label><textarea name="main_innovation" class="form-control" rows="2" placeholder="Ex: Notre nouvelle plateforme SaaS de gestion..." required></textarea></div>

            <!-- SECTION 3 : Votre Contribution -->
            <h4 class="form-section-title"><i class="fas fa-lightbulb"></i> Votre Contribution</h4>
            <div class="col-12">
                <label class="form-label">Comment souhaitez-vous contribuer ?</label>
                <div>
                    <div class="form-check"><input class="form-check-input" type="checkbox" name="contributions[]" value="keynote"><label class="form-check-label">Présenter nos innovations (Keynotes, Afterworks)</label></div>
                    <div class="form-check"><input class="form-check-input" type="checkbox" name="contributions[]" value="atelier"><label class="form-check-label">Animer des ateliers ou forums techniques</label></div>
                </div>
            </div>

            <!-- SECTION 4 : Compte de Gestion -->
            <h4 class="form-section-title"><i class="fas fa-user-circle"></i> Votre Compte de Gestion</h4>
            <div class="col-md-6"><label class="form-label">Nom du contact principal *</label><input type="text" name="contact_name" class="form-control" required></div>
            <div class="col-md-6"><label class="form-label">E-mail de connexion *</label><input type="email" name="email" class="form-control" required></div>
            <div class="col-md-6"><label class="form-label">Mot de passe *</label><input type="password" name="password" class="form-control" required></div>
            <div class="col-md-6"><label class="form-label">Confirmer le mot de passe *</label><input type="password" name="password_confirmation" class="form-control" required></div>

            <div class="col-12 text-center mt-5">
                <button type="submit" class="btn btn-submit">Activer mes Avantages & M'inscrire</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
