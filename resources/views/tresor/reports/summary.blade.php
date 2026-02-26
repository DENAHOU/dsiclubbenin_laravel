@extends('layouts.app-shell-tresor')

@section('title', 'Rapport Résumé')

@section('content')

<div class="container py-4">

    <h4 class="mb-4 fw-bold">📊 Tableau de bord Trésorerie</h4>

    <div class="row g-3 mb-4">

        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-center p-3">
                <h6>Total membres</h6>
                <h3 class="fw-bold text-primary">{{ $totalMembers }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-center p-3">
                <h6>Membres ayant payé</h6>
                <h3 class="fw-bold text-success">{{ $paidMembers }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-center p-3">
                <h6>Membres en retard</h6>
                <h3 class="fw-bold text-danger">{{ $lateMembers }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-center p-3">
                <h6>Recettes totales</h6>
                <h3 class="fw-bold text-dark">
                    {{ number_format($totalRevenue, 0, ',', ' ') }} FCFA
                </h3>
            </div>
        </div>

    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">💰 Recettes du mois</h5>
            <h3 class="text-success fw-bold">
                {{ number_format($thisMonthRevenue, 0, ',', ' ') }} FCFA
            </h3>
        </div>
    </div>


    <div class="card shadow-sm border-0">
        <div class="card-header bg-white fw-bold">
            Paiements récents
        </div>

        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Membre</th>
                        <th>Montant</th>
                        <th>Mois</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($recentPayments as $payment)
                        <tr>
                            <td>{{ $payment->user->name ?? '-' }}</td>
                            <td class="fw-bold text-success">
                                {{ number_format($payment->amount, 0, ',', ' ') }} FCFA
                            </td>
                            <td>{{ $payment->months }} mois</td>
                            <td>{{ $payment->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-3">
                                Aucun paiement trouvé
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
