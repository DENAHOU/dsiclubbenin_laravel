@extends('layouts.app-shell-superadmin')

@section('content')
<div class="container">
    <h4>Modifier la formule</h4>

    <form method="POST" action="{{ route('admin.partners.formules.update', $formule->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="name" class="form-control" value="{{ $formule->name }}">
        </div>

        <div class="mb-3">
            <label>Montant</label>
            <input type="number" name="amount" class="form-control" value="{{ $formule->amount }}">
        </div>

        <div class="mb-3">
            <label>Avantages</label>
            <textarea name="description" class="form-control">{{ $formule->description }}</textarea>
        </div>

        <button class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('admin.partners.formules') }}" class="btn btn-secondary">Retour</a>
    </form>
</div>
@endsection
