@extends('layouts.app-shell-superadmin')

@section('content')
<div class="container">
    <h1 class="mb-4">Modifier le partenaire</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.partners.update', $partner->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Raison sociale</label>
                <input type="text" name="company_name" class="form-control"
                       value="{{ $partner->company_name }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Domaine</label>
                <input type="text" name="domain" class="form-control"
                       value="{{ $partner->domain }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Responsable</label>
                <input type="text" name="manager_name" class="form-control"
                       value="{{ $partner->manager_name }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Téléphone</label>
                <input type="text" name="phone" class="form-control"
                       value="{{ $partner->phone }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Type de partenaire</label>
                <input type="text" name="type" class="form-control"
                       value="{{$partner->partnerType->name ?? '-' }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Formule d'adhésion</label>
                <input type="text" name="formule" class="form-control"
                       value="{{  $partner->partnerFormule->name ?? '-'  }}" required>
            </div>


            <div class="col-md-6 mb-3">
                <label class="form-label">Statut</label>
                <select name="status" class="form-select">
                    <option value="pending" {{ $partner->status == 'pending' ? 'selected' : '' }}>En attente</option>
                    <option value="approved" {{ $partner->status == 'approved' ? 'selected' : '' }}>Approuvé</option>
                    <option value="rejected" {{ $partner->status == 'rejected' ? 'selected' : '' }}>Rejeté</option>
                </select>
            </div>
        </div>

        <button class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary">Retour</a>
    </form>
</div>
@endsection
