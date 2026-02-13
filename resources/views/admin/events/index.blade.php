@extends('layouts.app-shell-superadmin')

@section('content')
<div class="admin-header">
    <h1>Liste des Évènements</h1>
    <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Ajouter un évènement
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
                        <th>Type</th>
                        <th>Date</th>
                        <th>Lieu</th>
                        <th>Média</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($events as $event)
                    <tr>
                        <td>{{ $event->id }}</td>
                        <td>{{ $event->titre }}</td>
                        <td>{{ $event->typeEvent->nom ?? '-' }}</td>
                        <td>{{ $event->date ? $event->date->format('d/m/Y') : '-' }}</td>
                        <td>{{ $event->location ?? '-' }}</td>
                        <td>
                            @if($event->image)
                                <img src="{{ asset($event->image) }}" alt="Image" style="max-width: 50px; max-height: 50px; object-fit: cover;">
                            @elseif($event->video_url)
                                <i class="fas fa-video text-primary"></i>
                                <small class="d-block">Vidéo</small>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-{{ $event->status == 'actif' ? 'success' : 'secondary' }}">
                                {{ $event->status }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.events.delete', $event->id) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Aucun évènement trouvé</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
