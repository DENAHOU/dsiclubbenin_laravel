@extends('layouts.app-shell-superadmin')

@section('content')
<div class="admin-header">
    <h1>Types d'Évènements</h1>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTypeModal">
        <i class="fas fa-plus me-2"></i>Ajouter un type
    </button>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Couleur</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($eventTypes as $type)
                    <tr>
                        <td>{{ $type->id }}</td>
                        <td>{{ $type->nom }}</td>
                        <td>{{ $type->description }}</td>
                        <td>
                            <span class="badge" style="background-color: {{ $type->couleur }}">
                                {{ $type->couleur }}
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary" onclick="editType({{ $type->id }})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form method="POST" action="{{ route('admin.events.type.delete', $type->id) }}" style="display: inline;">
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
                        <td colspan="5" class="text-center">Aucun type trouvé</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Ajouter/Modifier Type -->
<div class="modal fade" id="addTypeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un Type d'Évènement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.events.type.store') }}" id="typeForm">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <input type="hidden" name="id" id="typeId">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="typeName" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="typeName" name="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="typeDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="typeDescription" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="typeColor" class="form-label">Couleur</label>
                        <input type="color" class="form-control" id="typeColor" name="couleur" value="#007bff">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editType(id) {
    fetch(`/admin/events/type/${id}/edit`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('typeId').value = data.id;
            document.getElementById('typeName').value = data.nom;
            document.getElementById('typeDescription').value = data.description || '';
            document.getElementById('typeColor').value = data.couleur;
            document.getElementById('formMethod').value = 'PUT';
            document.getElementById('typeForm').action = `/admin/events/type/${id}`;
            document.querySelector('.modal-title').textContent = 'Modifier un Type d\'Évènement';
            document.getElementById('submitBtn').textContent = 'Mettre à jour';
            
            const modal = new bootstrap.Modal(document.getElementById('addTypeModal'));
            modal.show();
        })
        .catch(error => console.error('Error:', error));
}

// Réinitialiser le formulaire à la fermeture du modal
document.getElementById('addTypeModal').addEventListener('hidden.bs.modal', function () {
    document.getElementById('typeForm').reset();
    document.getElementById('formMethod').value = 'POST';
    document.getElementById('typeForm').action = '{{ route("admin.events.type.store") }}';
    document.querySelector('.modal-title').textContent = 'Ajouter un Type d\'Évènement';
    document.getElementById('submitBtn').textContent = 'Enregistrer';
    document.getElementById('typeId').value = '';
    document.getElementById('typeColor').value = '#007bff';
});
</script>
@endsection
