@extends('layouts.app-shell-entite')

@section('title', 'Modifier le Profil - Entreprise')

<style>
    :root {
        --dsi-blue: #094281;
        --dsi-blue-dark: #0a2b5c;
        --company-accent: #d4631a;
        --light-bg: #f4f7fc;
        --ink: #0e1a2b;
        --muted-ink: #5c6b81;
        --border-color: #e5eaf2;
    }

    body { font-family: 'Inter', sans-serif; background-color: var(--light-bg); }

    .edit-header {
        background: linear-gradient(135deg, #0a2b5c 0%, #d4631a 100%);
        color: white;
        padding: 3rem 2rem;
        border-radius: 0 0 20px 20px;
    }

    .edit-header h1 {
        font-size: 2.5rem;
        font-weight: 800;
        margin: 0;
    }

    .edit-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 2rem;
    }

    .edit-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .section-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--dsi-blue-dark);
        margin-bottom: 1.5rem;
        border-bottom: 3px solid var(--company-accent);
        padding-bottom: 0.75rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        font-weight: 600;
        color: var(--ink);
        margin-bottom: 0.75rem;
        display: block;
    }

    .form-label small {
        display: block;
        font-weight: 400;
        color: var(--muted-ink);
        margin-top: 0.25rem;
    }

    .form-control, .form-select, textarea {
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        font-family: 'Inter', sans-serif;
        transition: all 0.3s ease;
        width: 100%;
    }

    .form-control:focus, .form-select:focus, textarea:focus {
        border-color: var(--company-accent);
        box-shadow: 0 0 0 3px rgba(212, 99, 26, 0.1);
        outline: none;
    }

    textarea {
        resize: vertical;
        min-height: 100px;
    }

    .error-message {
        font-size: 0.85rem;
        color: #dc3545;
        margin-top: 0.25rem;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .button-group {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        margin-top: 2rem;
    }

    .btn-save {
        background: linear-gradient(95deg, #0a2b5c, #d4631a);
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-save:hover {
        opacity: 0.9;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(212, 99, 26, 0.2);
        color: white;
    }

    .btn-cancel {
        background: transparent;
        color: var(--muted-ink);
        border: 1px solid var(--border-color);
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-cancel:hover {
        background: var(--light-bg);
        color: var(--ink);
        border-color: var(--muted-ink);
    }

    .upload-area {
        border: 2px dashed var(--border-color);
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .upload-area:hover {
        border-color: var(--company-accent);
        background: rgba(212, 99, 26, 0.05);
    }

    .upload-area i {
        font-size: 2.5rem;
        color: var(--company-accent);
        margin-bottom: 1rem;
    }

    .upload-area input[type="file"] {
        display: none;
    }

    .success-message {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
</style>

@section('content')
<div class="edit-header">
    <div style="text-align: center;">
        <h1><i class="fas fa-edit me-3"></i>Modifier mon Profil</h1>
    </div>
</div>

<div class="edit-container">
    @if(session('success'))
        <div class="success-message">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <form action="{{ route('company.update', $company->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Logo de l'Entreprise -->
        <div class="edit-card">
            <h2 class="section-title">
                <i class="fas fa-image me-2"></i> Logo de l'Entreprise
            </h2>

            <div class="form-group">
                @if($company->logo_path)
                    <div style="margin-bottom: 1.5rem;">
                        <img src="{{ asset('storage/' . $company->logo_path) }}" alt="Logo" style="max-width: 200px; height: auto; border-radius: 8px;">
                    </div>
                @endif

                <label class="upload-area" onclick="document.querySelector('#logo').click();">
                    <input type="file" id="logo" name="logo_path" accept="image/*">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <div>
                        <strong>Cliquez pour télécharger</strong><br>
                        <small>ou glissez-déposez une image</small>
                    </div>
                </label>
                @error('logo_path')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Informations Générales -->
        <div class="edit-card">
            <h2 class="section-title">
                <i class="fas fa-information-circle me-2"></i> Informations Générales
            </h2>

            <div class="form-grid">
                <div class="form-group">
                    <label for="name" class="form-label">
                        Nom de l'Entreprise *
                        <small>Le nom officiel de votre entreprise</small>
                    </label>
                    <input
                        type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        id="name"
                        name="name"
                        value="{{ old('name', $company->name) }}"
                        required
                    >
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="slogan" class="form-label">
                        Slogan *
                        <small>Votre devise ou slogan</small>
                    </label>
                    <input
                        type="text"
                        class="form-control @error('slogan') is-invalid @enderror"
                        id="slogan"
                        name="slogan"
                        value="{{ old('slogan', $company->slogan) }}"
                        required
                    >
                    @error('slogan')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="description" class="form-label">
                    Description
                    <small>Décrivez votre entreprise et ses services</small>
                </label>
                <textarea
                    class="form-control @error('description') is-invalid @enderror"
                    id="description"
                    name="description"
                >{{ old('description', $company->description) }}</textarea>
                @error('description')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="sector" class="form-label">
                        Domaine d'Activité
                        <small>Ex: Technologie, Finance, Santé...</small>
                    </label>
                    <input
                        type="text"
                        class="form-control @error('sector') is-invalid @enderror"
                        id="sector"
                        name="sector"
                        value="{{ old('sector', $company->sector) }}"
                    >
                    @error('sector')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="website_url" class="form-label">
                        Site Web
                        <small>URL complète avec https://</small>
                    </label>
                    <input
                        type="url"
                        class="form-control @error('website_url') is-invalid @enderror"
                        id="website_url"
                        name="website_url"
                        value="{{ old('website_url', $company->website_url) }}"
                    >
                    @error('website_url')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Contact et Localisation -->
        <div class="edit-card">
            <h2 class="section-title">
                <i class="fas fa-map-pin me-2"></i> Contact et Localisation
            </h2>

            <div class="form-grid">
                <div class="form-group">
                    <label for="address" class="form-label">
                        Adresse
                        <small>Adresse complète du siège</small>
                    </label>
                    <input
                        type="text"
                        class="form-control @error('address') is-invalid @enderror"
                        id="address"
                        name="address"
                        value="{{ old('address', $company->address) }}"
                    >
                    @error('address')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone" class="form-label">
                        Téléphone Entreprise
                        <small>Numéro de téléphone principal</small>
                    </label>
                    <input
                        type="tel"
                        class="form-control @error('phone') is-invalid @enderror"
                        id="phone"
                        name="phone"
                        value="{{ old('phone', $company->phone) }}"
                    >
                    @error('phone')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Contact Principal -->
        <div class="edit-card">
            <h2 class="section-title">
                <i class="fas fa-user-tie me-2"></i> Contact Principal
            </h2>

            <div class="form-grid">
                <div class="form-group">
                    <label for="contact_name" class="form-label">
                        Nom du Contact *
                        <small>Personne à contacter</small>
                    </label>
                    <input
                        type="text"
                        class="form-control @error('contact_name') is-invalid @enderror"
                        id="contact_name"
                        name="contact_name"
                        value="{{ old('contact_name', $company->contact_name) }}"
                        required
                    >
                    @error('contact_name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="contact_position" class="form-label">
                        Poste du Contact
                        <small>Position/Titre du contact</small>
                    </label>
                    <input
                        type="text"
                        class="form-control @error('contact_position') is-invalid @enderror"
                        id="contact_position"
                        name="contact_position"
                        value="{{ old('contact_position', $company->contact_position) }}"
                    >
                    @error('contact_position')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="email" class="form-label">
                        Email *
                        <small>Adresse email de contact</small>
                    </label>
                    <input
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        id="email"
                        name="email"
                        value="{{ old('email', $company->email) }}"
                        required
                    >
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="contact_phone" class="form-label">
                        Téléphone Contact
                        <small>Téléphone du contact</small>
                    </label>
                    <input
                        type="tel"
                        class="form-control @error('contact_phone') is-invalid @enderror"
                        id="contact_phone"
                        name="contact_phone"
                        value="{{ old('contact_phone', $company->contact_phone) }}"
                    >
                    @error('contact_phone')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Domaines d'Excellence -->
        <div class="edit-card">
            <h2 class="section-title">
                <i class="fas fa-star me-2"></i> Domaines d'Excellence
            </h2>

            <div class="form-group">
                <label for="expertise_tags" class="form-label">
                    Domaines d'Excellence
                    <small>Séparez les tags par des virgules (ex: Python, Cloud, DevOps)</small>
                </label>
                <textarea
                    class="form-control @error('expertise_tags') is-invalid @enderror"
                    id="expertise_tags"
                    name="expertise_tags"
                    placeholder="Python, Cloud Computing, DevOps, Security..."
                >{{ old('expertise_tags', $company->expertise_tags) }}</textarea>
                @error('expertise_tags')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Boutons d'Action -->
        <div class="button-group">
            <button type="submit" class="btn-save">
                <i class="fas fa-save"></i> Enregistrer les modifications
            </button>
            <a href="{{ route('company.profil', $company->id) }}" class="btn-cancel">
                <i class="fas fa-times"></i> Annuler
            </a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
