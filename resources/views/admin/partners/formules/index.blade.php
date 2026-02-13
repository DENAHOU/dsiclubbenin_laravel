@extends('layouts.app-shell-superadmin')

@section('content')
<div class="container">
    <h4 class="mb-4">📦 Formules de partenariat</h4>

    <a href="{{ route('admin.partners.formules.create') }}" class="btn btn-primary mb-3">
        ➕ Nouvelle formule
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Montant</th>
                <th>Avantages</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($formules as $formule)
                <tr>
                    <td style="font-weight: bold;">{{ $formule->name }}</td>
                    <td>{{ number_format($formule->amount, 0, ',', ' ') }} FCFA</td>
                    <td style="font-weight: bold; white-space: pre-line;">{{ $formule->description }}</td>
                    <td>
                        <a href="{{ route('admin.partners.formules.edit', $formule->id) }}" class="btn btn-sm btn-warning">✏️</a>

                        <form method="POST" action="{{ route('admin.partners.formules.delete', $formule->id) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">🗑️</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
