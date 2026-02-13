@extends('layouts.app-shell-superadmin')

@section('title', 'Adhésions Rejetées')

@section('content')

<h3 class="mb-4">Adhésions Rejetées</h3>

<div class="card">
    <div class="card-header">
        <strong>Liste des adhésions rejetées</strong>
    </div>

    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Détails</th>
                </tr>
            </thead>

            <tbody>
                @forelse($rejected as $r)
                    <tr>
                        <td>{{ $r['name'] }}</td>
                        <td>{{ $r['email'] ?? '—' }}</td>
                        <td>{{ ucfirst($r['type']) }}</td>
                        <td>{{ \Carbon\Carbon::parse($r['created_at'])->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.members.show', ['type'=>$r['type'],'id'=>$r['id']]) }}"
                               class="btn btn-sm btn-secondary">
                               Voir
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center p-3">Aucune adhésion rejetée.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
