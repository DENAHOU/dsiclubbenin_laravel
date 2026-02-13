@extends('layouts.app-shell-superadmin')
@section('content')
<div class="container">
    <h4 class="mb-4">🗑️ Supprimer la formule de partenariat</h4>
    <p>Êtes-vous sûr de vouloir supprimer la formule <strong>{{ $formule->name }}</strong> ? Cette action est irréversible.</p>
    <form method="POST" action="{{ route('admin.partners.formules.delete', $formule->id) }}">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger">Supprimer la formule</button>
        <a href="{{ route('admin.partners.formules') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection

























