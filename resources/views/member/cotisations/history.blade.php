@extends('layouts.app-shell')

@section('title', 'Historique des paiements')

@section('content')
<div class="container-fluid py-4">

    {{-- TITRE --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">📜 Historique des cotisations</h4>
            <small class="text-muted">Tous vos paiements effectués</small>
        </div>

        <div class="bg-success-subtle px-4 py-2 rounded-3">
            <strong>Total payé :</strong>
            <span class="text-success fw-bold">
                {{ number_format($totalPaid, 0, ',', ' ') }} FCFA
            </span>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">

            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Mois</th>
                        <th>Montant</th>
                        <th>Référence</th>
                        <th>Statut</th>
                        <th>Facture</th> {{-- ✅ AJOUT --}}
                    </tr>
                </thead>

                <tbody>
                @forelse($payments as $index => $pay)
                    <tr>
                        <td>{{ $index + 1 }}</td>

                        <td>
                            {{ $pay->created_at->format('d/m/Y') }}
                            <br>
                            <small class="text-muted">
                                {{ $pay->created_at->format('H:i') }}
                            </small>
                        </td>

                        <td>
                            <span class="badge bg-primary">
                                {{ $pay->months }} mois
                            </span>
                        </td>

                        <td class="fw-bold">
                            {{ number_format($pay->amount, 0, ',', ' ') }} FCFA
                        </td>

                        <td>
                            <small class="text-muted">
                                {{ $pay->payment_reference }}

                            </small>
                        </td>

                        <td>
                            @if($pay->status === 'paid')
                                <span class="badge bg-success">Payé</span>
                            @elseif($pay->status === 'pending')
                                <span class="badge bg-warning text-dark">En attente</span>
                            @else
                                <span class="badge bg-danger">Échoué</span>
                            @endif
                        </td>
                        <td>
                            @if($pay->invoice_path)
                                <a href="{{ asset('storage/'.$pay->invoice_path) }}"
                                class="btn btn-sm btn-outline-success"
                                target="_blank">
                                    📄 Télécharger la facture
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            Aucun paiement enregistré.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection
