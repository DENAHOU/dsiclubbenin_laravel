@extends('layouts.app-shell-superadmin')

@section('content')
<div class="container">
    <h1 class="mb-4">Ajouter un partenaire</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Type de partenaire</label>
                <select name="partner_type_id" class="form-select" required>
                    <option value="">-- Choisir --</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Formule</label>
                <select name="partner_formule_id" class="form-select" required>
                    <option value="">-- Choisir --</option>
                    @foreach($formules as $formule)
                        <option value="{{ $formule->id }}">{{ $formule->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Nom de l'entreprise</label>
                <input type="text" name="company_name" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Pays</label>
                <input type="text" name="country" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Téléphone</label>
                <input type="text" name="phone" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Logo</label>
                <input type="file" name="logo_path" class="form-control">
            </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Statut</label>
                    <select name="status" class="form-select" required>
                        <option value="pending">En attente</option>
                        <option value="approved">Approuvé</option>
                    </select>
                </div>
        </div>

        <button class="btn btn-success">Enregistrer</button>
        <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary">Retour</a>
    </form>
</div>
@endsection
