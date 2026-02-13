@extends('layouts.app-shell-superadmin')

@section('content')
<div class="container">
    <h4 class="mb-4">➕ Ajouter une formule de partenariat</h4>

    <form method="POST" action="{{ route('admin.partners.formules.store') }}">
        @csrf

        <!-- Nom -->
        <div class="mb-3">
            <label class="form-label">Nom de la formule</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <!-- Prix -->
        <div class="mb-3">
            <label class="form-label">Montant (FCFA)</label>
            <input type="number" name="amount" class="form-control" required>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label class="form-label">Avantages</label>
            <textarea name="description" class="form-control" rows="4"></textarea>
        </div>

        <button class="btn btn-success">
            💾 Enregistrer la formule
        </button>
    </form>
</div>
@endsection
