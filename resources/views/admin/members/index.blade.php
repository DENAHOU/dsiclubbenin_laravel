@extends('layouts.app-shell-superadmin')

@section('content')

<style>
    .admin-wrapper {
        min-height: 100vh;
        padding: 30px;
        background: #f0f5fa;
    }

    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: #094281;
        margin-bottom: 25px;
    }

    /* Card Table */
    .card-table {
        background: white;
        border-radius: 14px;
        padding: 25px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.07);
        border: 1px solid rgba(9,66,129,0.08);
    }

    .table thead th {
        font-size: 14px;
        text-transform: uppercase;
        color: #6c7a91;
        border-bottom-width: 2px;
        border-color: #e2e8f0 !important;
    }

    .table tbody tr:hover {
        background: #f6fbff;
    }

    /* Buttons */
    .btn-approve {
        background:#28a745;
        color:white !important;
        padding:6px 10px;
        font-size: 13px;
        border-radius:6px;
        border:none;
        transition:0.2s;
    }
    .btn-approve:hover { background:#21923c; }

    .btn-reject {
        background:#e55353;
        color:white !important;
        padding:6px 10px;
        font-size: 13px;
        border-radius:6px;
        border:none;
        transition:0.2s;
    }
    .btn-reject:hover { background:#cc4747; }

    .btn-view {
        background:#094281;
        color:white !important;
        padding:6px 12px;
        font-size: 13px;
        border-radius:6px;
    }

    .status-tag {
        background:#094281;
        color:white;
        padding:4px 10px;
        border-radius:8px;
        font-size:12px;
        font-weight:600;
    }
</style>



<div class="admin-wrapper">

    <h1 class="page-title">💼 Adhésions en attente</h1>

    <div class="card-table">

        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Soumis le</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
            @forelse($pending as $p)
                <tr id="row-{{ $p['type'] }}-{{ $p['id'] }}">
                    <td class="fw-bold">{{ $p['name'] }}</td>

                    <td>{{ $p['email'] ?? '—' }}</td>

                    <td>
                        <span class="status-tag">
                            {{ ucfirst($p['type']) }}
                        </span>
                    </td>

                    <td>{{ \Carbon\Carbon::parse($p['created_at'])->format('d/m/Y H:i') }}</td>

                    <td class="text-center">

                        <button class="btn-approve btn-action"
                            data-type="{{ $p['type'] }}"
                            data-id="{{ $p['id'] }}">
                             Approuver
                        </button>

                        <button class="btn-reject btn-action"
                            data-type="{{ $p['type'] }}"
                            data-id="{{ $p['id'] }}">
                             Rejeter
                        </button>

                        <a href="{{ route('admin.members.show', ['type'=>$p['type'], 'id'=>$p['id']]) }}"
                           class="btn-view"> Voir
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center p-4">
                        <strong>Aucune adhésion en attente</strong>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>

</div>
@endsection



@push('scripts')
<script>
document.querySelectorAll('.btn-action').forEach(btn => {
    btn.addEventListener('click', function() {

        const type = this.dataset.type;
        const id = this.dataset.id;
        const action = this.classList.contains('btn-approve') ? 'approve' : 'reject';

        if (!confirm(`Confirmer ${action} de ${type} #${id} ?`)) return;

        fetch(`/admin/members/${type}/${id}/${action}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                document.getElementById(`row-${type}-${id}`).remove();
            }
            alert(data.message || "Opération réussie.");
        });
    });
});
</script>
@endpush
