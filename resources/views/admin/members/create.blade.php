@extends('layouts.app-shell-superadmin')

@section('content')
<div class="container my-5">
    <div class="register-form-box">

        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.members.store') }}" method="POST" class="row g-4" enctype="multipart/form-data">
            @csrf

            {{-- SECTION 1 : Informations Personnelles --}}
            <h4 class="form-section-title"><i class="fas fa-user-circle"></i> Informations Personnelles</h4>

            <div class="col-md-6">
                <label class="form-label">Nom *</label>
                <input type="text" name="lastname" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Prénom(s) *</label>
                <input type="text" name="firstname" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Sexe *</label>
                <select class="form-select" name="sexe" required>
                    <option value="">Choisir...</option>
                    <option value="M">Masculin</option>
                    <option value="F">Féminin</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Date de naissance *</label>
                <input type="date" name="birthday" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Numéro de téléphone *</label>
                <input type="tel" name="phone" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Votre Photo *</label>
                <input class="form-control" type="file" name="medias_id" required>
            </div>

            <div class="col-12">
                <label class="form-label">Décrivez-vous en quelques mots</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>

            {{-- SECTION 2 --}}
            <h4 class="form-section-title"><i class="fas fa-briefcase"></i> Parcours Professionnel</h4>

            <div class="col-md-6">
                <label class="form-label">Employeur actuel *</label>
                <input type="text" name="current_employer" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Contact Employeur *</label>
                <input type="text" name="employer_contact" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Poste actuel *</label>
                <select class="form-select" name="current_position" required>
                    <option value="">Choisir...</option>
                    <option>Directeur des Systèmes d'Information (DSI)</option>
                    <option>Responsable des Systèmes d'Information (RSI)</option>
                    <option>Responsable de la Sécurité des SI (RSSI)</option>
                    <option>Directeur Technique (DT)</option>
                    <option>Responsable Technique (RT)</option>
                </select>
            </div>

            {{-- Logique "Autre" --}}
            <div class="col-md-6">
                <label class="form-label">Secteur *</label>
                <select class="form-select" name="sector" id="sectorSelect" required>
                    <option value="">Choisir...</option>
                    <option>Public</option>
                    <option>Privé</option>
                    <option>Multinationale</option>
                    <option>Organisme international</option>
                    <option>ONG</option>
                    <option value="Autre">Autre</option>
                </select>
            </div>

            <div class="col-md-6" id="sectorOtherDiv" style="display: none;">
                <label class="form-label">Préciser secteur *</label>
                <input type="text" name="sector_other" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Catégorie de service *</label>
                <select class="form-select" name="category_of_service" required>
                    <option value="">Choisir...</option>
                    <option>Industrie</option>
                    <option>Banque</option>
                    <option>Assurance</option>
                    <option>Microfinance</option>
                    <option>Santé</option>
                    <option>Agroalimentaire</option>
                    <option>Finance</option>
                    <option>Humanitaire</option>
                    <option>Ministère</option>
                    <option>Agence Gouvernementale</option>
                    <option>Commerce</option>
                    <option>Logistique</option>
                    <option>Autre</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Domaine d'expertise *</label>
                <input type="text" name="area_of_expertise" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Formation initiale *</label>
                <input type="text" name="initial_training" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Type de membre *</label>
                <select name="type_members" class="form-select" required>
                    <option value="">Choisir...</option>
                    <option value="individuel">Individuel</option>
                    <option value="entite">Entité</option>
                    <option value="admin_publique">Administration publique</option>
                    <option value="it">Collège IT</option>
                </select>
            </div>


            {{-- Suite --}}
            <h4 class="form-section-title"><i class="fas fa-shield-alt"></i> Votre Compte</h4>

            <div class="col-md-6">
                <label class="form-label">Nom d'utilisateur *</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">E-mail *</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Mot de passe *</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Confirmer *</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <div class="col-12 text-center mt-4">
                <button type="submit" class="btn btn-primary btn-lg">Finaliser l’adhésion</button>
            </div>

        </form>
    </div>
</div>

@endsection
