@extends('layouts.app-shell-superadmin')

@section('title', 'Membres du Bureau')

@section('content')

<div class="d-flex justify-content-between mb-4">
    <h3>👥 Membres du Bureau</h3>
    <a href="{{ route('admin.board.create') }}" class="btn btn-primary">+ Ajouter</a>
</div>

<div class="card shadow-sm">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Type</th>
                <th>Rôle</th>
                <th>Date début</th>
                <th>Date fin</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach($members as $m)
                <tr>
                    <td>{{ $m->member()->name ?? '—' }}</td>
                    <td>{{ $m->memberType() }}</td>
                    <td>{{ $m->role->name }}</td>
                    <td>{{ $m->start_date }}</td>
                    <td>{{ $m->end_date }}</td>
                    <td class="text-end d-flex gap-2 justify-content-end">

                        {{-- VOIR --}}
                        <a href="{{ route('admin.board.show',$m->id) }}"
                        class="btn btn-outline-primary btn-sm">
                            👁️ Voir
                        </a>

                        {{-- MODIFIER MANDAT --}}
                        <a href="{{ route('admin.board.edit', $m->id) }}"
                        class="btn btn-outline-warning btn-sm">
                            ✏️ Modifier
                        </a>

                        {{-- DISCOURS --}}
                        <a href="{{ route('admin.board.speech', $m->id) }}"
                        class="btn btn-outline-success btn-sm">
                            📝 Discours
                        </a>

                        {{-- RETIRER --}}
                        <form action="{{ route('admin.board.delete', $m->id) }}" method="POST"
                            onsubmit="return confirm('Retirer ce membre du bureau ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm">
                                🗑️ Retirer
                            </button>
                        </form>

                    </td>

                </tr>
            @endforeach
        </tbody>

    </table>
</div>

@endsection

