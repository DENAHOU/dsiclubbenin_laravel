@extends('layouts.app-shell-admin')

@section('title', 'Modifier Informations - Administration Publique')

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
    }

    .navbar {
        background: linear-gradient(180deg, #f6f7f8 0%, #fafcfc 100%);
        width: 100%;
    }

    .navbar-brand {
        font-weight: 800;
        color: white !important;
    }

    .edit-container {
        background-color: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        max-width: 900px;
        margin: 0 auto;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        font-weight: 600;
        color: var(--ink);
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-control {
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        width: 100%;
    }

    .form-control:focus {
        border-color: var(--dsi-blue);
        box-shadow: 0 0 0 3px rgba(9, 66, 129, 0.1);
        outline: none;
    }

    .form-section {
        margin-bottom: 2.5rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid var(--border-color);
    }

    .form-section:last-of-type {
        border-bottom: none;
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--dsi-blue);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .section-title i {
        color: var(--dsi-green);
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .btn-container {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid var(--border-color);
    }

    .btn-save {
        background: linear-gradient(95deg, var(--dsi-blue), var(--dsi-green));
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
        display: flex;
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
        background-color: transparent;
        color: var(--muted-ink);
        border: 1px solid var(--border-color);
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-cancel:hover {
        background-color: var(--light-bg);
        color: var(--ink);
        border-color: var(--muted-ink);
    }

    .alert {
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .error-message {
        font-size: 0.85rem;
        color: #dc3545;
        margin-top: 0.25rem;
    }

    .required-asterisk {
        color: #dc3545;
    }
</style>

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light sticky-top" style="background: linear-gradient(180deg, #f6f7f8 0%, #fafcfc 100%); box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <div class="container-fluid px-4">
            <a class="fw-bold" href="#" style="color: #094281; font-size: 1.3rem; text-decoration: none; font-weight: bold;">
                <i class="fas fa-briefcase me-2" style="color: #094281;"></i> Club DSI - Modifier Informations
            </a>
        </div>
    </nav>

    <div class="container-fluid mt-4 mb-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="edit-container">

                    {{-- Messages de Succès --}}
                    @if($errors->any())
                        <div class="alert alert-error">
                            <i class="fas fa-exclamation-circle"></i>
                            <div>
                                <strong>Erreur lors de la sauvegarde :</strong>
                                <ul style="margin-bottom: 0; margin-top: 0.5rem;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    {{-- Formulaire de Modification --}}
                    <form action="{{ route('administration.update', $administration->id) }}" method="POST" novalidate>
                        @csrf
                        @method('PUT')

                        {{-- Section Informations Générales --}}
                        <div class="form-section">
                            <div class="section-title">
                                <i class="fas fa-building"></i>
                                Informations Générales
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="name" class="form-label">
                                        Nom de l'Administration <span class="required-asterisk">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        id="name"
                                        name="name"
                                        value="{{ old('name', $administration->name) }}"
                                        required
                                        placeholder="Ex: Ministère des Affaires Étrangères"
                                    >
                                    @error('name')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="entity_type" class="form-label">
                                        Type d'Entité <span class="required-asterisk">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control @error('entity_type') is-invalid @enderror"
                                        id="entity_type"
                                        name="entity_type"
                                        value="{{ old('entity_type', $administration->entity_type) }}"
                                        required
                                        placeholder="Ex: Ministère, Collectivité, Établissement"
                                    >
                                    @error('entity_type')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address" class="form-label">
                                    Adresse <span class="required-asterisk">*</span>
                                </label>
                                <input
                                    type="text"
                                    class="form-control @error('address') is-invalid @enderror"
                                    id="address"
                                    name="address"
                                    value="{{ old('address', $administration->address) }}"
                                    required
                                    placeholder="Ex: 123 Boulevard Saint-Germain, 75006 Paris"
                                >
                                @error('address')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="website_url" class="form-label">
                                    Site Web
                                </label>
                                <input
                                    type="url"
                                    class="form-control @error('website_url') is-invalid @enderror"
                                    id="website_url"
                                    name="website_url"
                                    value="{{ old('website_url', $administration->website_url) }}"
                                    placeholder="https://example.fr"
                                >
                                @error('website_url')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Section Informations de Contact --}}
                        <div class="form-section">
                            <div class="section-title">
                                <i class="fas fa-user-tie"></i>
                                Informations de Contact
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="contact_name" class="form-label">
                                        Nom du Contact <span class="required-asterisk">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control @error('contact_name') is-invalid @enderror"
                                        id="contact_name"
                                        name="contact_name"
                                        value="{{ old('contact_name', $administration->contact_name) }}"
                                        required
                                        placeholder="Ex: Jean Dupont"
                                    >
                                    @error('contact_name')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="contact_position" class="form-label">
                                        Poste <span class="required-asterisk">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control @error('contact_position') is-invalid @enderror"
                                        id="contact_position"
                                        name="contact_position"
                                        value="{{ old('contact_position', $administration->contact_position) }}"
                                        required
                                        placeholder="Ex: Responsable DSI, Directeur"
                                    >
                                    @error('contact_position')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="contact_email" class="form-label">
                                        Email de Contact <span class="required-asterisk">*</span>
                                    </label>
                                    <input
                                        type="email"
                                        class="form-control @error('contact_email') is-invalid @enderror"
                                        id="contact_email"
                                        name="contact_email"
                                        value="{{ old('contact_email', $administration->contact_email) }}"
                                        required
                                        placeholder="exemple@administration.fr"
                                    >
                                    @error('contact_email')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="contact_phone" class="form-label">
                                        Téléphone de Contact <span class="required-asterisk">*</span>
                                    </label>
                                    <input
                                        type="tel"
                                        class="form-control @error('contact_phone') is-invalid @enderror"
                                        id="contact_phone"
                                        name="contact_phone"
                                        value="{{ old('contact_phone', $administration->contact_phone) }}"
                                        required
                                        placeholder="Ex: +33 1 23 45 67 89"
                                    >
                                    @error('contact_phone')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Boutons d'Action --}}
                        <div class="btn-container">
                            <a href="{{ route('administration.dahbord') }}" class="btn-cancel">
                                <i class="fas fa-times"></i> Annuler
                            </a>
                            <button type="submit" class="btn-save">
                                <i class="fas fa-save"></i> Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Validation côté client
        document.querySelector('form').addEventListener('submit', function(e) {
            const requiredFields = this.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('is-invalid');
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('Veuillez remplir tous les champs obligatoires');
            }
        });

        // Supprimer l'indicateur d'erreur quand l'utilisateur commence à taper
        document.querySelectorAll('.form-control').forEach(field => {
            field.addEventListener('input', function() {
                this.classList.remove('is-invalid');
            });
        });
    </script>
@endsection
