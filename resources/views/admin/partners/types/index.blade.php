@extends('layouts.app-shell-superadmin')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">📌 Types de partenaires</h4>

        <a href="{{ route('admin.partners.types.create') }}"
           class="btn btn-success">
            ➕ Ajouter un type
        </a>
    </div>

    {{-- Messages --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            @if($types->count() > 0)
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nom du type</th>
                            <th class="text-center" width="180">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($types as $index => $type)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <strong>{{ $type->name }}</strong>
                                </td>

                                <td class="text-center">
                                    <a href="{{ route('admin.partners.types.edit', $type->id) }}"
                                       class="btn btn-sm btn-warning">
                                        ✏️ Modifier
                                    </a>

                                    <form action="{{ route('admin.partners.types.delete', $type->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Supprimer ce type ?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger">
                                            🗑️ Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center text-muted py-4">
                    Aucun type de partenaire enregistré.
                </div>
            @endif

        </div>
    </div>

</div>
@endsection
