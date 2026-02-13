@extends('layouts.app-shell-superadmin')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Ajouter un type de partenaire</h4>

    <form action="{{ route('admin.partners.types.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nom du type</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <button class="btn btn-success">💾 Enregistrer</button>
        <a href="{{ route('admin.partners.types') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
