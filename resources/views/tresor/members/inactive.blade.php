@extends('layouts.app-shell-tresor')

@section('title', 'Membres Inactifs')

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">👥 Adhésion non payée</h2>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Adhésion</th>
                            <th>Inscription</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($inactiveMembers as $member)

                            <tr>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->email }}</td>
                                <td>{{ $member->phone ?? '-' }}</td>

                                <td>
                                    <span class="badge bg-danger">
                                        Non payé
                                    </span>
                                </td>

                                <td>
                                    {{ $member->created_at->format('d M Y') }}
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    Aucun membre en retard
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- Pagination --}}
            <div class="mt-3 d-flex justify-content-center">
                {{ $inactiveMembers->links('pagination::simple-bootstrap-5') }}
            </div>

        </div>
    </div>

</div>

@endsection
