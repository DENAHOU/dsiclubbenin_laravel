@extends('layouts.app-shell-superadmin')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-4">Partenaires rejetés</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">

        <thead class="table">
            <tr>
                <th>#</th>
                <th>Type</th>
                <th>Entreprise</th>
                <th>Domaine</th>
                <th>Spécialité</th>
                <th>Responsable</th>
                <th>Pays</th>
                <th>Email</th>
                <th>logo</th>
                <th>Formule d'adhésion</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($partners as $partner)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $partner->partnerType->name ?? '-' }}</td>

                    <td>{{ $partner->company_name }}</td>

                    <td>{{ $partner->domain }}</td>

                    <td>{{ $partner->specialty }}</td>

                    <td>{{ $partner->manager_name }}</td>

                    <td>{{ $partner->country }}</td>

                    <td>{{ $partner->email }}</td>

                    <td>
                        @if($partner->logo_path)
                            <img src="{{ asset('storage/' . $partner->logo_path) }}"
                                 alt="Logo de {{ $partner->company_name }}"
                                 style="max-width: 150px; max-height: 150px;">
                        @else
                            -
                        @endif
                    </td>

                    <td>{{ $partner->partnerFormule->name ?? '-' }}</td>

                    <td>
                        @if($partner->status === 'rejected')
                            <span class="badge bg-danger">Rejeté</span>
                        @endif
                    </td>

                    <td class="text-center">
                        <!-- VOIR -->
                        <a href="{{ route('admin.partners.show', $partner->id) }}"
                           class="btn btn-sm btn-info"><i class="fas fa-eye"></i>
                        </a>

                        <!-- EDIT -->
                        <a href="{{ route('admin.partners.edit', $partner->id) }}"
                           class="btn btn-sm btn-primary"><i class="fas fa-edit"></i>
                        </a>

                        <!-- DELETE -->
                        <form action="{{ route('admin.partners.delete', $partner->id) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Supprimer ce partenaire ?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>
                            </button>
                        </form>

                        <!-- APPROUVER / REJETER -->
                        {{-- @if($partner->status === 'pending')
                            <form action="{{ route('admin.partners.approve', $partner) }}" method="POST">
                                @csrf
                                <button class="btn btn-success btn-sm">Approuver</button>
                            </form>

                            <form action="{{ route('admin.partners.reject', $partner) }}" method="POST">
                                @csrf
                                <button class="btn btn-danger btn-sm">Rejeter</button>
                            </form>
                        @endif --}}

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">
                        Aucun partenaire trouvé
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection
