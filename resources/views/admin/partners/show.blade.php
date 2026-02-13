@extends('layouts.app-shell-superadmin')

@section('content')
<div class="container">
    <h3 class="mb-4">👁️ Détails du partenaire</h3>

    <table class="table table-bordered">
        <tr>
            <th>Entreprise</th>
            <td>{{ $partner->company_name }}</td>
        </tr>

        <tr>
            <th>Email</th>
            <td>{{ $partner->email }}</td>
        </tr>

        <tr>
            <th>Téléphone</th>
            <td>{{ $partner->phone }}</td>
        </tr>

        <tr>
            <th>Type</th>
            <td>{{ $partner->partnerType->name ?? '-' }}</td>
        </tr>

        <tr>
            <th>Formule</th>
            <td>{{ $partner->partnerFormule->name ?? '-' }}</td>
        </tr>

        <tr>
            <th>Statut</th>
            <td>
                @if($partner->status === 'approved')
                    <span class="badge bg-success">Validé</span>
                @elseif($partner->status === 'rejected')
                    <span class="badge bg-danger">Rejeté</span>
                @else
                    <span class="badge bg-warning">En attente</span>
                @endif
            </td>
        </tr>
    </table>

    <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary">Retour</a>
<a href="{{ route('admin.partners.edit', $partner->id) }}" class="btn btn-primary btn-sm">
    Modifier
</a>
</div>
@endsection
