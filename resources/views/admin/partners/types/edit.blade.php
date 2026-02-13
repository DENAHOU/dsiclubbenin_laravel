@extends('layouts.app-shell-superadmin')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Modifier le type</h4>

    <form action="{{ route('admin.partners.types.update', $type->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nom du type</label>
            <input type="text" name="name" class="form-control"
                   value="{{ $type->name }}" required>
        </div>

        <button class="btn btn-primary">🔄 Mettre à jour</button>
        <a href="{{ route('admin.partners.types') }}" class="btn btn-secondary">Retour</a>
    </form>
</div>
@endsection
