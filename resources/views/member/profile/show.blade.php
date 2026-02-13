@extends('layouts.app-shell')

@section('title', 'Mon Profil')

@section('content')
<div class="container-fluid">

    <div class="card shadow-sm p-4 mb-4">
        <div class="d-flex align-items-center gap-4">
            <img src="{{ $user->photo_path ? asset('storage/'.$user->photo_path) : asset('img/avatar.png') }}"
                 class="rounded-circle"
                 width="120" height="120">

            <div>
                <h4 class="fw-bold mb-0">{{ $user->firstname }} {{ $user->lastname }}</h4>
                <span class="text-muted">{{ $user->email }}</span>
                <p class="mb-0 mt-2">
                    <span class="badge bg-primary">{{ ucfirst($user->type_members) }}</span>
                </p>
            </div>

            <div class="ms-auto">
                <a href="{{ route('member.profile.edit') }}" class="btn btn-outline-primary">
                    ✏️ Éditer
                </a>
            </div>
        </div>
    </div>

    {{-- INFORMATIONS --}}
    <div class="row g-4">

        <div class="col-md-6">
            <div class="card shadow-sm p-4">
                <h6 class="fw-bold mb-3">Informations personnelles</h6>
                <p><strong>Sexe :</strong> {{ $user->sexe }}</p>
                <p><strong>Téléphone :</strong> {{ $user->phone }}</p>
                <p><strong>Date de naissance :</strong> {{ $user->birthday }}</p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm p-4">
                <h6 class="fw-bold mb-3">Informations professionnelles</h6>
                <p><strong>Poste :</strong> {{ $user->current_position }}</p>
                <p><strong>Employeur :</strong> {{ $user->current_employer }}</p>
                <p><strong>Secteur :</strong> {{ $user->sector }}</p>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card shadow-sm p-4">
                <h6 class="fw-bold mb-3">Compétences & Description</h6>
                <p><strong>Expertise :</strong> {{ $user->area_of_expertise }}</p>
                <p>{{ $user->description }}</p>
            </div>
        </div>

    </div>

</div>
@endsection
