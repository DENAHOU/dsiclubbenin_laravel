@extends('layouts.app-shell-college')

@section('title', 'Paramètres du Compte - College IT')

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

    .settings-header {
        background: linear-gradient(135deg, #094281 0%, #29963a 100%);
        color: white;
        padding: 3rem 2rem;
        border-radius: 0 0 20px 20px;
    }

    .settings-header h1 {
        font-size: 2.5rem;
        font-weight: 800;
        margin: 0;
    }

    .settings-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 2rem;
    }

    .settings-card {
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
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .section-title i {
        color: var(--dsi-green);
    }

    .section-description {
        color: var(--muted-ink);
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
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
        font-family: 'Inter', sans-serif;
    }

    .form-control:focus {
        border-color: var(--dsi-blue);
        box-shadow: 0 0 0 3px rgba(9, 66, 129, 0.1);
        outline: none;
    }

    .error-message {
        font-size: 0.85rem;
        color: #dc3545;
        margin-top: 0.25rem;
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

    .btn-save {
        background: linear-gradient(95deg, var(--dsi-blue), var(--dsi-green));
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
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

    .btn-delete {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-delete:hover {
        background-color: #c82333;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(220, 53, 69, 0.2);
        color: white;
    }

    .btn-back {
        background-color: transparent;
        color: var(--muted-ink);
        border: 1px solid var(--border-color);
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-back:hover {
        background-color: var(--light-bg);
        color: var(--ink);
        border-color: var(--muted-ink);
    }

    .button-group {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .modal-delete {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        align-items: center;
        justify-content: center;
    }

    .modal-delete.show {
        display: flex;
    }

    .modal-content-delete {
        background-color: white;
        padding: 2rem;
        border-radius: 12px;
        max-width: 400px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.3);
    }

    .modal-content-delete h3 {
        color: #dc3545;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .modal-content-delete p {
        color: var(--muted-ink);
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .modal-buttons {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
    }

    .btn-confirm-delete {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-confirm-delete:hover {
        background-color: #c82333;
    }

    .btn-cancel-delete {
        background-color: var(--light-bg);
        color: var(--ink);
        border: 1px solid var(--border-color);
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-cancel-delete:hover {
        background-color: #e5eaf2;
    }

    .danger-zone {
        border: 2px solid #dc3545;
        border-radius: 12px;
        padding: 1.5rem;
        background: rgba(220, 53, 69, 0.05);
    }

    .danger-zone .section-title {
        color: #dc3545;
        border-bottom-color: #dc3545;
    }

    .danger-zone .section-description {
        color: #721c24;
    }
</style>

@section('content')
<div class="settings-header">
    <div style="text-align: center;">
        <h1><i class="fas fa-cogs me-3"></i>Paramètres du Compte</h1>
    </div>
</div>

<div class="settings-container">
    @if(session('success'))
        <div class="success-message">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Modification du Mot de Passe -->
    <div class="settings-card">
        <div class="section-title">
            <i class="fas fa-key"></i>
            Modifier le Mot de Passe
        </div>

        <p class="section-description">
            Changez votre mot de passe régulièrement pour sécuriser votre compte.
        </p>

        <form action="{{ route('college.update-password', $college->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="current_password" class="form-label">Mot de passe actuel</label>
                <input
                    type="password"
                    class="form-control @error('current_password') is-invalid @enderror"
                    id="current_password"
                    name="current_password"
                    required
                    placeholder="Entrez votre mot de passe actuel"
                >
                @error('current_password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Nouveau mot de passe</label>
                <input
                    type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    id="password"
                    name="password"
                    required
                    placeholder="Entrez un nouveau mot de passe (min. 8 caractères)"
                >
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirmez le nouveau mot de passe</label>
                <input
                    type="password"
                    class="form-control"
                    id="password_confirmation"
                    name="password_confirmation"
                    required
                    placeholder="Confirmez votre nouveau mot de passe"
                >
            </div>

            <button type="submit" class="btn-save">
                <i class="fas fa-save"></i> Enregistrer le nouveau mot de passe
            </button>
        </form>
    </div>

    <!-- Zone de Danger - Suppression du Compte -->
    <div class="settings-card danger-zone">
        <div class="section-title">
            <i class="fas fa-trash-alt"></i>
            Zone de Danger
        </div>

        <p class="section-description">
            ⚠️ La suppression de votre compte est définitive et irréversible. Toutes vos données seront supprimées.
        </p>

        <button type="button" class="btn-delete" onclick="openDeleteModal()">
            <i class="fas fa-trash-alt"></i> Supprimer définitivement mon compte
        </button>
    </div>

    <!-- Bouton Retour -->
    <div class="button-group" style="margin-top: 2rem;">
        <a href="{{ route('college.dashboard') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Retour au Tableau de Bord
        </a>
    </div>
</div>

<!-- Modal de Confirmation de Suppression -->
<div id="deleteModal" class="modal-delete">
    <div class="modal-content-delete">
        <h3>
            <i class="fas fa-exclamation-triangle"></i> Confirmer la suppression
        </h3>
        <p>
            Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est <strong>définitive et irréversible</strong>. Tous vos données et vos informations seront supprimées de nos serveurs.
        </p>
        <div class="modal-buttons">
            <button type="button" class="btn-cancel-delete" onclick="closeDeleteModal()">
                Annuler
            </button>
            <form action="{{ route('college.delete-account', $college->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-confirm-delete">
                    Oui, supprimer mon compte
                </button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function openDeleteModal() {
        document.getElementById('deleteModal').classList.add('show');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('show');
    }

    // Fermer le modal en cliquant en dehors
    window.onclick = function(event) {
        const modal = document.getElementById('deleteModal');
        if (event.target === modal) {
            modal.classList.remove('show');
        }
    }
</script>
@endsection
