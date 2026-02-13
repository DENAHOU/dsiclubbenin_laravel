@extends('layouts.app-shell-superadmin')

@section('title', 'Modifier membre du Bureau')

@section('content')

<div class="container-fluid">

    <h3 class="fw-bold mb-4">✏️ Modifier le mandat</h3>

    <div class="card shadow-sm p-4 col-md-8">

        <form method="POST" action="{{ route('admin.board.update', $board->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Rôle</label>
                <select name="role_id" class="form-select" required>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}"
                            {{ $board->role_id == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Date de début</label>
                    <input type="date" name="start_date"
                           value="{{ $board->start_date }}"
                           class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Date de fin</label>
                    <input type="date" name="end_date"
                           value="{{ $board->end_date }}"
                           class="form-control">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Statut</label>
                <select name="status" class="form-select">
                    <option value="active" {{ $board->status=='active'?'selected':'' }}>Actif</option>
                    <option value="inactive" {{ $board->status=='inactive'?'selected':'' }}>Inactif</option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-success">💾 Enregistrer</button>
                <a href="{{ route('admin.board.index') }}" class="btn btn-outline-secondary">Annuler</a>
            </div>

        </form>
    </div>
</div>

@endsection
