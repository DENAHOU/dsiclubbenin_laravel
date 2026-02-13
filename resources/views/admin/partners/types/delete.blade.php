@extends('layouts.app-shell-superadmin')
@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Supprimer le type de partenaire</h4>
    <p>Êtes-vous sûr de vouloir supprimer le type de partenaire <strong>{{ $type->name }}</strong> ? Cette action est irréversible.</p>
    <form action="{{ route('admin.partners.types.delete', $type->id) }}" method="POST">
        @csrf
        @method('DELETE')

        <button class="btn btn-danger">🗑️ Supprimer</button>
        <a href="{{ route('admin.partners.types') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection

