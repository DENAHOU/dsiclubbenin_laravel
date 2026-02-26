@extends('layouts.app-shell')

@section('title', 'Rapport Dettes')

@section('content')

<div class="container py-4">

    <h4 class="fw-bold mb-4">⚠ Membres en retard de cotisation</h4>

    <div class="card shadow-sm border-0 mb-3">
        <div class="card-body">

            <h5>Total des dettes :</h5>
            <h3 class="fw-bold text-danger">
                {{ number_format($totalDebt, 0, ',', ' ') }} FCFA
            </h3>

        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Membre</th>
                        <th>Email</th>
                        <th>Mois payés</th>
                        <th>Mois dus</th>
                        <th>Excédent</th>
                        <th>Dette estimée</th>
                        <th>Dernier paiement</th>
                        <th>Prochaine échéance</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($debtMembers as $member)
                        <tr>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->email }}</td>
                            <td class="fw-bold text-success">{{ $member->months_paid }}</td>
                            <td class="fw-bold text-warning">{{ $member->months_late }}</td>
                            <td class="fw-bold text-info">{{ $member->months_added }}</td>
                            <td class="fw-bold text-danger">{{ number_format($member->estimated_debt, 0, ',', ' ') }} FCFA</td>
                            <td>{{ $member->last_payment_date ?? '-' }}</td>
                            <td>{{ $member->next_due_date ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-3">
                                Aucun membre en retard 🎉
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
