@extends('layouts.app-shell-superadmin')

@section('title', 'Adhésions en attente')

@section('content')

<style>
.pending-card {
    border-radius: 18px;
    background: #ffffff;
    padding: 0;
    box-shadow: 0 8px 28px rgba(0,0,0,0.08);
    overflow: hidden;
}

.pending-header {
    background: linear-gradient(135deg, #0a3d62, #0a4f8a);
    padding: 22px 30px;
    color: white;
}

.pending-header h3 {
    font-size: 22px;
    font-weight: 700;
}

.pending-table tbody tr:hover {
    background: #f3f8ff;
}

.btn-approve {
    background: #037432;
    border: none;
    padding: 6px 10px;
    border-radius: 8px;
    color: white;
    font-size: .85rem;
}

.btn-reject {
    background: #8d1306;
    border: none;
    padding: 6px 10px;
    border-radius: 8px;
    color: white;
    font-size: .85rem;
}
</style>

<div class="pending-card">

    <div class="pending-header d-flex justify-content-between align-items-center">
        <h3>⏳ Adhésions en attente ({{ $pendingTotal }})</h3>
        <span class="opacity-75">Validation – Gestion rapide</span>
    </div>

    <table class="table pending-table mb-0">
        <thead class="bg-light">
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Type</th>
                <th>Date</th>
                <th width="200">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($recentPending as $p)
                <tr id="row-{{ $p['table'] }}-{{ $p['id'] }}">
                    <td class="fw-bold">{{ $p['name'] }}</td>
                    <td>{{ $p['email'] }}</td>
                    <td class="text-capitalize">{{ $p['type'] }}</td>
                    <td>{{ \Carbon\Carbon::parse($p['created_at'])->format('d/m/Y H:i') }}</td>

                    <td>
                        <button class="btn-approve me-1 btn-action"
                                data-type="{{ $p['table'] }}"
                                data-id="{{ $p['id'] }}">
                            Approuver
                        </button>

                        <button class="btn-reject me-1 btn-action"
                                data-type="{{ $p['table'] }}"
                                data-id="{{ $p['id'] }}">
                            Rejeter
                        </button>

                        <a href="{{ route('admin.members.show', ['type'=>$p['table'],'id'=>$p['id']]) }}"
                           class="btn btn-sm btn-outline-primary">
                           Détails
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {

    document.querySelectorAll('.btn-action').forEach(btn => {
        btn.addEventListener('click', () => {

            const type = btn.dataset.type;
            const id   = btn.dataset.id;
            const action = btn.classList.contains('btn-approve') ? 'approve' : 'reject';

            if (!confirm("Confirmer l'action ?")) return;

            fetch(`/admin/members/${type}/${id}/${action}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`row-${type}-${id}`).remove();
                }
            });

        });
    });

});
</script>
@endpush
