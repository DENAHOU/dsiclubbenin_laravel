@extends('layouts.app-shell-superadmin')

@section('content')
<style>
.member-card {
    background: #fff;
    border-radius: 14px;
    padding: 25px;
    box-shadow: 0 8px 24px rgba(9,66,129,0.08);
}
.member-title {
    font-size: 1.7rem;
    font-weight: 800;
    color: #094281;
}
.info-label {
    font-weight: 600;
    color: #094281;
}
.info-box {
    background: #f4f9ff;
    padding: 12px;
    border-radius: 10px;
}
.badge-type {
    background: #094281;
    padding: 6px 14px;
    border-radius: 12px;
    color: white;
}
</style>

<div class="container-fluid">

    <a href="{{ route('admin.members.list') }}" class="btn btn-secondary mb-3">
        <i class="fa fa-arrow-left"></i> Retour à la liste
    </a>

    <div class="member-card">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="member-title">Détails du Membre</h2>
            <span class="badge-type">{{ ucfirst($type) }}</span>
        </div>

        {{-- PHOTO --}}
        @if(isset($item->photo_path))
            <div class="text-center mb-4">
                <img src="{{ asset('storage/' . $item->photo_path) }}"
                     alt="photo"
                     class="rounded-circle"
                     width="120">
            </div>
        @endif

        <div class="row g-4">

            {{-- NOM COMPLET --}}
            <div class="col-md-6">
                <label class="info-label">Nom complet :</label>
                <div class="info-box">
                    {{ $item->name ?? ($item->firstname . ' ' . $item->lastname) }}
                </div>
            </div>

            {{-- EMAIL --}}
            <div class="col-md-6">
                <label class="info-label">Email :</label>
                <div class="info-box">
                    {{ $item->email ?? $item->contact_email ?? '—' }}
                </div>
            </div>

            {{-- TYPE MEMBRE (si USER) --}}
            @if($type === 'user')
            <div class="col-md-6">
                <label class="info-label">Type du membre :</label>
                <div class="info-box">
                    {{ $item->type_members }}
                </div>
            </div>
            @endif

            {{-- GÉNÉRIQUE : Boucle sur les champs --}}
            @php
                $fields = [
                    'phone' => 'Téléphone',
                    'sexe' => 'Sexe',
                    'birthday' => 'Date de naissance',
                    'current_employer' => 'Employeur',
                    'employer_contact' => 'Contact employeur',
                    'current_position' => 'Poste actuel',
                    'sector' => 'Secteur',
                    'sector_other' => 'Secteur (Autre)',
                    'category_of_service' => 'Catégorie de service',
                    'category_other' => 'Catégorie (Autre)',
                    'area_of_expertise' => 'Domaine d’expertise',
                    'initial_training' => 'Formation',
                    'description' => 'Description',
                    // COMPANIES
                    'address' => 'Adresse',
                    'ifu' => 'IFU',
                    'service_category' => 'Catégorie',
                    'membership_type' => 'Type d’adhésion',
                    // ADMINISTRATION
                    'entity_type' => 'Type d’entité',
                    'main_project' => 'Projet principal',
                    'tech_challenges' => 'Défis technologiques',
                    // COLLEGE
                    'slogan' => 'Slogan',
                    'website_url' => 'Site web',
                    'linkedin_url' => 'LinkedIn',
                    'expertise_tags' => 'Tags d’expertise',
                    'main_innovation' => 'Innovation principale',
                ];
            @endphp

            @foreach($fields as $key => $label)
                @if(!empty($item->$key))
                <div class="col-md-6">
                    <label class="info-label">{{ $label }} :</label>
                    <div class="info-box">
                        {{ $item->$key }}
                    </div>
                </div>
                @endif
            @endforeach

        </div>

    </div>
</div>

@endsection
