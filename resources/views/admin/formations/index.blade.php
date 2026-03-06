@extends('layouts.app-shell-superadmin')

@section('title', 'Gestion des Formations')

@push('styles')
<style>
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }
    .status-badge {
        font-size: 0.8rem;
        font-weight: 600;
        padding: 0.3em 0.6em;
        border-radius: 20px;
    }
    .status-published { background-color: #d1fae5; color: #065f46; }
    .status-draft { background-color: #feefc3; color: #92400e; }
    .status-archived { background-color: #e5e7eb; color: #374151; }
</style>
@endpush

@section('content')
    <div class="container-fluid py-4">
        <!-- Header de la page -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 fw-bold mb-0">Gestion des Formations</h1>
                <p class="text-muted">Créez, modifiez et gérez toutes les formations du Club DSI.</p>
            </div>
            <a href="{{ route('admin.formations.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-2"></i> Ajouter une Formation
            </a>
        </div>

        <!-- Alerte de succès -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Tableau des formations -->
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Titre</th>
                                <th scope="col">Catégorie</th>
                                <th scope="col">Type</th>
                                <th scope="col">Date de Début</th>
                                <th scope="col">Statut</th>
                                <th scope="col" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($formations as $formation)
                                <tr>
                                    <td>
                                        <strong class="text-dark">{{ $formation->titre }}</strong>
                                    </td>
                                    <td>{{ $formation->categoryFormation->nom ?? 'N/A' }}</td>
                                    <td>{{ $formation->type_formation }}</td>
                                    {{-- Remplacez la ligne 66 par ceci --}}
                                    <td>{{ $formation->start_date ? \Carbon\Carbon::parse($formation->start_date)->format('d/m/Y') : 'N/A' }}</td>
                                    <td>
                                        <span class="status-badge status-{{ $formation->status }}">{{ ucfirst($formation->status) }}</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.formations.edit', $formation->id) }}" class="btn btn-sm btn-outline-primary" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.formations.destroy', $formation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette formation ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Aucune formation trouvée.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white">
                {{ $formations->links() }}
            </div>
        </div>
    </div>
@endsection