@extends('layouts.app-shell')

@section('title', 'Modifier mon profil')

@section('content')
<div class="container-fluid">

    <div class="card shadow-sm p-4 col-md-10 mx-auto">
        <h4 class="fw-bold mb-4">✏️ Modifier mon profil</h4>

        <form method="POST" action="{{ route('member.profile.update') }}">
            @csrf
            @method('PUT')

            <div class="row g-3">

                <div class="col-md-6">
                    <label>Prénom</label>
                    <input type="text" name="firstname" class="form-control" value="{{ $user->firstname }}">
                </div>

                <div class="col-md-6">
                    <label>Nom</label>
                    <input type="text" name="lastname" class="form-control" value="{{ $user->lastname }}">
                </div>

                <div class="col-md-6">
                    <label>Téléphone</label>
                    <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                </div>

                <div class="col-md-6">
                    <label>Date de naissance</label>
                    <input type="date" name="birthday" class="form-control" value="{{ $user->birthday }}">
                </div>

                <div class="col-md-6">
                    <label>Poste actuel</label>
                    <input type="text" name="current_position" class="form-control" value="{{ $user->current_position }}">
                </div>

                <div class="col-md-6">
                    <label>Employeur</label>
                    <input type="text" name="current_employer" class="form-control" value="{{ $user->current_employer }}">
                </div>

                <div class="col-md-12">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="4">{{ $user->description }}</textarea>
                </div>

            </div>

            <div class="mt-4 d-flex justify-content-end gap-2">
                <a href="{{ route('member.profile.show') }}" class="btn btn-outline-secondary">Annuler</a>
                <button class="btn btn-primary">💾 Enregistrer</button>
            </div>
        </form>
    </div>

</div>
@endsection
