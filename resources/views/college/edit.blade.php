@extends('layouts.app-shell-college')

@section('title', 'Modifier le Profil - College IT')

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

    .edit-header {
        background: linear-gradient(135deg, #094281 0%, #29963a 100%);
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
        color: var(--dsi-blue);
        margin-bottom: 1.5rem;
        border-bottom: 3px solid var(--dsi-green);
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
        border-color: var(--dsi-blue);
        box-shadow: 0 0 0 3px rgba(9, 66, 129, 0.1);
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
        background: linear-gradient(95deg, var(--dsi-blue), var(--dsi-green));
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
        box-shadow: 0 8px 20px rgba(9, 66, 129, 0.2);
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
        border-color: var(--dsi-green);
        background: rgba(41, 150, 58, 0.05);
    }

    .upload-area i {
        font-size: 2.5rem;
        color: var(--dsi-green);
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

    <form action="{{ route('college.update', $college->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Logo du College -->
        <div class="edit-card">
            <h2 class="section-title">
                <i class="fas fa-image me-2" style="color: var(--dsi-green);"></i> Logo du College
            </h2>

            <div class="form-group">
                @if($college->logo_path)
                    <div style="margin-bottom: 1.5rem;">
                        <img src="{{ asset('storage/' . $college->logo_path) }}" alt="Logo" style="max-width: 200px; height: auto; border-radius: 8px;">
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
                <i class="fas fa-information-circle me-2" style="color: var(--dsi-green);"></i> Informations Générales
            </h2>

            <div class="form-grid">
                <div class="form-group">
                    <label for="company_name" class="form-label">
                        Nom du College *
                        <small>Le nom officiel de votre institution</small>
                    </label>
                    <input
                        type="text"
                        class="form-control @error('company_name') is-invalid @enderror"
                        id="company_name"
                        name="company_name"
                        value="{{ old('company_name', $college->company_name) }}"
                        required
                    >
                    @error('company_name')
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
                        value="{{ old('slogan', $college->slogan) }}"
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
                    <small>Décrivez votre institution et sa mission</small>
                </label>
                <textarea
                    class="form-control @error('description') is-invalid @enderror"
                    id="description"
                    name="description"
                >{{ old('description', $college->description) }}</textarea>
                @error('description')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-grid">
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
                        value="{{ old('website_url', $college->website_url) }}"
                    >
                    @error('website_url')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="linkedin_url" class="form-label">
                        Profil LinkedIn
                        <small>URL de votre profil LinkedIn</small>
                    </label>
                    <input
                        type="url"
                        class="form-control @error('linkedin_url') is-invalid @enderror"
                        id="linkedin_url"
                        name="linkedin_url"
                        value="{{ old('linkedin_url', $college->linkedin_url) }}"
                    >
                    @error('linkedin_url')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Contact -->
        <div class="edit-card">
            <h2 class="section-title">
                <i class="fas fa-user-tie me-2" style="color: var(--dsi-green);"></i> Informations de Contact
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
                        value="{{ old('contact_name', $college->contact_name) }}"
                        required
                    >
                    @error('contact_name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

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
                        value="{{ old('email', $college->email) }}"
                        required
                    >
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Domaines d'Excellence -->
        <div class="edit-card">
            <h2 class="section-title">
                <i class="fas fa-star me-2" style="color: var(--dsi-green);"></i> Domaines d'Excellence
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
                >{{ old('expertise_tags', $college->expertise_tags) }}</textarea>
                @error('expertise_tags')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Innovation Principale -->
        <div class="edit-card">
            <h2 class="section-title">
                <i class="fas fa-lightbulb me-2" style="color: var(--dsi-green);"></i> Innovation Principale
            </h2>

            <div class="form-group">
                <label for="main_innovation" class="form-label">
                    Innovation Principale
                    <small>Décrivez votre innovation clé</small>
                </label>
                <textarea
                    class="form-control @error('main_innovation') is-invalid @enderror"
                    id="main_innovation"
                    name="main_innovation"
                >{{ old('main_innovation', $college->main_innovation) }}</textarea>
                @error('main_innovation')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Boutons d'Action -->
        <div class="button-group">
            <button type="submit" class="btn-save">
                <i class="fas fa-save"></i> Enregistrer les modifications
            </button>
            <a href="{{ route('college.profil', $college->id) }}" class="btn-cancel">
                <i class="fas fa-times"></i> Annuler
            </a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
