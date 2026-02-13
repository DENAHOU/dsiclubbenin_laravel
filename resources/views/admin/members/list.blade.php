@extends('layouts.app-shell-superadmin')

@section('title', 'Liste des membres')

@section('content')

<style>
.table-card {
    border-radius: 14px;
    background: #fff;
    box-shadow: 0 8px 24px rgba(0,0,0,0.05);
    padding: 1.5rem;
}

.search-box input {
    height: 46px;
    border-radius: 10px;
}

.badge-type {
    padding: 6px 10px;
    border-radius: 8px;
    font-size: .75rem;
}
.badge-user { background:#e3f2fd; color:#0d47a1; }
.badge-company { background:#e8f5e9; color:#1b5e20; }
.badge-administration { background:#fff3e0; color:#e65100; }
.badge-college { background:#f3e5f5; color:#6a1b9a; }

.table-hover tbody tr:hover {
    background:#f8fbff;
}

.action-btn {
    padding: 4px 10px;
    border-radius: 6px;
    gap: 20px
}
.view-btn { background:#0d47a1; color:white; }
</style>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">📋 Liste des membres</h3>
        <a href="{{ route('admin.members.create') }}" class="btn btn-primary btn-lg">
            + Ajouter un membre
        </a>
    </div>

    {{-- FILTRES --}}
    <form method="GET" action="{{ route('admin.members.list') }}" class="row mb-4">
        <div class="col-md-4 mb-2">
            <div class="search-box">
                <input type="text" name="search" value="{{ request('search') }}"

                       class="form-control"
                       placeholder="Rechercher : nom, email…">
            </div>
        </div>

        <div class="col-md-4 mb-2">
            <select name="type" class="form-select" onchange="this.form.submit()">
                <option value="">Tous les types</option>
                <option value="users" {{ request('type')=='users' ? 'selected' : '' }}>Membre Individuel</option>
                <option value="companies" {{ request('type')=='companies' ? 'selected' : '' }}>Entité Utilisatrice</option>
                <option value="administrations" {{ request('type')=='administrations' ? 'selected' : '' }}>Administration publique</option>
                <option value="colleges" {{ request('type')=='colleges' ? 'selected' : '' }}>Collège IT</option>
                <option value="admins" {{ request('type')=='admins' ? 'selected' : '' }}>Administrateurs</option>
                {{-- <option value="tresor" {{ request('type')=='tresor' ? 'selected' : '' }}>Trésorerie</option> --}}
            </select>
        </div>

        {{-- SUBMIT BTN --}}
        <div class="col-md-2">
            <button class="btn btn-secondary w-100">Filtrer</button>
        </div>
    </form>

    <div class="table-card">

        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Date d'inscription</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($members as $m)
                    <tr>
                        <td class="fw-bold">{{ $m['name'] }}</td>
                        <td>{{ $m['email'] }}</td>

                        <td>
                            @if($m['type'] == 'Membre Individuel')
                                <span class="badge badge-type badge-user">{{ $m['type'] }}</span>
                            @elseif($m['type'] == 'Entreprise')
                                <span class="badge badge-type badge-company">{{ $m['type'] }}</span>
                            @elseif($m['type'] == 'Administration Publique')
                                <span class="badge badge-type badge-administration">{{ $m['type'] }}</span>
                            @elseif($m['type'] == 'Collège IT')
                                <span class="badge badge-type badge-college">{{ $m['type'] }}</span>
                            @elseif($m['type'] == 'Administrateur')
                                <span class="badge badge-type badge-college">{{ $m['type'] }}</span>
                            @else
                                <span class="badge badge-type badge-college">{{ $m['type'] }}</span>
                            @endif
                        </td>


                        <td>{{ \Carbon\Carbon::parse($m['created_at'])->format('d/m/Y H:i') }}</td>

                        <td class="text-end">

                            {{-- Voir --}}
                            <a href="{{ route('admin.members.view', ['type' => $m['slug'], 'id' => $m['id']]) }}"
                            class="btn btn-sm btn-primary me-2">
                                Voir
                            </a>

                            {{-- Bloquer --}}
                            <form action="{{ route('admin.members.block', ['type' => $m['slug'], 'id' => $m['id']]) }}"
                                method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-sm btn-warning">
                                    Bloquer
                                </button>
                            </form>

                            {{-- Supprimer --}}
                            <form action="{{ route('admin.members.delete', ['type' => $m['slug'], 'id' => $m['id']]) }}"
                                method="POST" class="d-inline"
                                onsubmit="return confirm('Supprimer ce membre ?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    Supprimer
                                </button>
                            </form>

                        </td>

                    </tr>

                @empty
                    <tr><td colspan="5" class="text-center py-3 text-muted">Aucun membre trouvé.</td></tr>
                @endforelse
            </tbody>
        </table>

        {{-- PAGINATION --}}
        <div class="mt-3">
            {{ $members->links('pagination::bootstrap-5') }}
        </div>

    </div>

</div>

@endsection
