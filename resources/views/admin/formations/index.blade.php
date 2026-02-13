@extends('layouts.app-shell-superadmin')

@section('content')
<div class="admin-header">
    <h1>Liste des Formations</h1>
    <a href="{{ route('admin.formations.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Ajouter une formation
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Catégorie</th>
                        <th>Type</th>
                        <th>Date début</th>
                        <th>Date fin</th>
                        <th>Média</th>
                        <th>Prix en ligne</th>
                        <th>Prix présentiel</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($formations as $formation)
                    <tr>
                        <td>{{ $formation->id }}</td>
                        <td>{{ $formation->titre }}</td>
                        <td>{{ $formation->categoryFormation->nom ?? '-' }}</td>
                        <td>
                            <span class="badge bg-{{ $formation->type_formation == 'presentiel' ? 'primary' : 'info' }}">
                                {{ $formation->type_formation == 'presentiel' ? 'Présentiel' : 'En ligne' }}
                            </span>
                        </td>
                        <td>{{ $formation->date_debut ? $formation->date_debut->format('d/m/Y') : '-' }}</td>
                        <td>{{ $formation->date_fin ? $formation->date_fin->format('d/m/Y') : '-' }}</td>
                        <td>
                            @if($formation->image)
                                <img src="{{ asset($formation->image) }}" alt="Image" style="max-width: 50px; max-height: 50px; object-fit: cover;">
                            @elseif($formation->video_url)
                                <i class="fas fa-video text-primary"></i>
                                <small class="d-block">Vidéo</small>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($formation->prix_en_ligne)
                                <span class="badge bg-info">{{ number_format($formation->prix_en_ligne, 0, ',', ' ') }} FCFA</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($formation->prix_presentiel)
                                <span class="badge bg-success">{{ number_format($formation->prix_presentiel, 0, ',', ' ') }} FCFA</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-{{ $formation->status == 'actif' ? 'success' : 'secondary' }}">
                                {{ $formation->status }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.formations.edit', $formation->id) }}" class="btn btn-sm btn-outline-primary" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                @if($formation->lien_inscription_en_ligne)
                                    <a href="{{ $formation->lien_inscription_en_ligne }}" target="_blank" class="btn btn-sm btn-outline-info" title="Voir inscription en ligne">
                                        <i class="fas fa-laptop"></i>
                                    </a>
                                @endif
                                
                                @if($formation->lien_inscription_presentiel)
                                    <a href="{{ $formation->lien_inscription_presentiel }}" target="_blank" class="btn btn-sm btn-outline-success" title="Voir inscription présentiel">
                                        <i class="fas fa-building"></i>
                                    </a>
                                @endif
                                
                                <form method="POST" action="{{ route('admin.formations.delete', $formation->id) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette formation?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="text-center">Aucune formation trouvée</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
