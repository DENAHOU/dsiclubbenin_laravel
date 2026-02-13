@extends('layouts.app-shell-superadmin')

@section('title', 'Profil Administrateur')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card shadow-sm p-4 text-center">
            <i class="fa fa-user-circle fa-4x text-primary mb-3"></i>

            <h4 class="fw-bold">{{ $admin->name }}</h4>
            <p class="text-muted">{{ $admin->email }}</p>

            <hr>

            <div class="text-start">
                <p><strong>Rôle :</strong> Administrateur</p>
                <p><strong>Compte créé le :</strong>
                    {{ $admin->created_at->format('d/m/Y') }}
                </p>
            </div>

            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-3">
                ⬅ Retour au dashboard
            </a>
        </div>

    </div>
</div>

@endsection
