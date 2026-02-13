@extends('layouts.app-shell-superadmin')

@section('content')
<div class="admin-header">
    <h1>Programmes Thématiques</h1>
    <a href="{{ route('admin.programs.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Ajouter un programme
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
                        <th>Description</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($programs as $program)
                    <tr>
                        <td>{{ $program->id }}</td>
                        <td>{{ $program->titre }}</td>
                        <td>{{ Str::limit($program->description, 100) }}</td>
                        <td>
                            <span class="badge bg-{{ $program->status == 'actif' ? 'success' : 'secondary' }}">
                                {{ $program->status }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.programs.edit', $program->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.programs.delete', $program->id) }}" style="display: inline;">
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
                        <td colspan="5" class="text-center">Aucun programme trouvé</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
