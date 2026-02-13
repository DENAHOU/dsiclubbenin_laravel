@extends('layouts.app-shell-superadmin')

@section('title', 'Ajouter au bureau')

@section('content')

<div class="card shadow-sm p-4 col-md-6 mx-auto">

    <h4 class="mb-3 text-center">Ajouter au Bureau</h4>

    <form action="{{ route('admin.board.store') }}" method="POST">
        @csrf

        <input type="hidden" name="member_type" value="{{ $type }}">
        <input type="hidden" name="member_id" value="{{ $id }}">

        <div class="mb-3">
            <label>Rôle</label>
            <select class="form-select" name="role_id" required>
                @foreach($roles as $r)
                    <option value="{{ $r->id }}">{{ $r->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Date de début</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100">
            Ajouter
        </button>
    </form>

</div>

@endsection
