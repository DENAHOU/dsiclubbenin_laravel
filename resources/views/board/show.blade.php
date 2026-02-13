@extends('layouts.app-shell-superadmin')

@section('title', 'Détails du membre du Bureau')

@section('content')

<div class="row g-4">

    {{-- PROFIL --}}
    <div class="col-md-4">
        <div class="card shadow-sm text-center p-4">
            <img src="{{ $boardMember->memberPhoto() }}"
                 class="rounded-circle mb-3"
                 width="140" height="140">

            <h5 class="fw-bold mb-1">
                {{ $boardMember->member()->name ?? '—' }}
            </h5>

            <span class="badge bg-primary mb-2">
                {{ $boardMember->role->name }}
            </span>

            <p class="text-muted">
                {{ $boardMember->memberType() }}
            </p>
        </div>
    </div>

    {{-- INFOS + DISCOURS --}}
    <div class="col-md-8">

        {{-- INFOS MANDAT --}}
        <div class="card shadow-sm p-4 mb-4">
            <h5 class="mb-3">📌 Informations du mandat</h5>

            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <strong>Date de début :</strong>
                    {{ \Carbon\Carbon::parse($boardMember->start_date)->format('d/m/Y') }}
                </li>

                <li class="list-group-item">
                    <strong>Date de fin :</strong>
                    {{ $boardMember->end_date
                        ? \Carbon\Carbon::parse($boardMember->end_date)->format('d/m/Y')
                        : 'En cours' }}
                </li>

                <li class="list-group-item">
                    <strong>Statut :</strong>
                    <span class="badge bg-success">
                        {{ ucfirst($boardMember->status) }}
                    </span>
                </li>
            </ul>

            <div class="mt-4 d-flex gap-2">
                <a href="{{ route('admin.board.edit', $boardMember->id) }}"
                   class="btn btn-warning">
                    ✏️ Modifier
                </a>

                <a href="{{ route('admin.board.speech', $boardMember->id) }}"
                   class="btn btn-info">
                    🗣️ Gérer le discours
                </a>
            </div>
        </div>

        {{-- DISCOURS --}}
        <div class="card shadow-sm p-4">
            <h5 class="mb-3">🗣️ Discours officiel</h5>

            @if($boardMember->speech)
                <blockquote class="blockquote mb-0">
                    <p class="fst-italic">
                        “{{ $boardMember->speech }}”
                    </p>

                    <footer class="blockquote-footer mt-2">
                        {{ $boardMember->member()->name }}
                        — {{ $boardMember->role->name }}
                    </footer>
                </blockquote>
            @else
                <div class="alert alert-secondary mb-0">
                    Aucun discours n’a encore été enregistré pour ce membre.
                </div>
            @endif
        </div>

    </div>

</div>

@endsection
