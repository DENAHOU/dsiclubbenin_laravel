@extends($layout)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-success text-white py-4">
                    <h3 class="mb-0">
                        <i class="fa fa-history me-2"></i> Historique des paiements
                    </h3>
                </div>

                <div class="card-body p-4">
                    @if($payments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="fw-bold">#</th>
                                        <th class="fw-bold">Date</th>
                                        <th class="fw-bold">Montant</th>
                                        <th class="fw-bold">Période</th>
                                        <th class="fw-bold">Référence</th>
                                        <th class="fw-bold">Statut</th>
                                        <th class="fw-bold text-center">Facture</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($payments as $payment)
                                        <tr>
                                            <td class="text-muted">#{{ $payment->id }}</td>
                                            <td>
                                                <span class="badge bg-info text-dark">
                                                    {{ $payment->created_at->format('d/m/Y H:i') }}
                                                </span>
                                            </td>
                                            <td>
                                                <strong class="text-success">
                                                    {{ number_format($payment->amount, 0, ',', ' ') }} FCFA
                                                </strong>
                                            </td>
                                            <td>
                                                {{ ucfirst($payment->period ?? 'Annuel') }}
                                            </td>
                                            <td>
                                                @if($payment->transaction_reference)
                                                    <code class="text-muted">{{ substr($payment->transaction_reference, 0, 10) }}...</code>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($payment->status === 'paid')
                                                    <span class="badge bg-success">
                                                        <i class="fa fa-check-circle me-1"></i> Payé
                                                    </span>
                                                @elseif($payment->status === 'pending')
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="fa fa-clock me-1"></i> En attente
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger">
                                                        <i class="fa fa-times-circle me-1"></i> Annulé
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($payment->status === 'paid')
                                                    @if($payment->invoice_path && Storage::disk('public')->exists($payment->invoice_path))
                                                        <a href="{{ route('membership.invoice.download', $payment->id) }}"
                                                           class="btn btn-sm btn-outline-success"
                                                           title="Télécharger la facture">
                                                            <i class="fa fa-download me-1"></i> Télécharger
                                                        </a>
                                                    @else
                                                        <span class="text-muted text-sm">
                                                            <i class="fa fa-info-circle"></i> Non disponible
                                                        </span>
                                                    @endif
                                                @else
                                                    <span class="text-muted text-sm">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $payments->links() }}
                        </div>
                    @else
                        <div class="alert alert-info text-center py-5" role="alert">
                            <i class="fa fa-inbox fa-3x text-info mb-3 d-block"></i>
                            <h5 class="fw-bold">Aucun paiement enregistré</h5>
                            <p class="text-muted mb-3">Vous n'avez pas encore effectué de paiement de cotisation.</p>
                            <a href="{{ route('membership.pay') }}" class="btn btn-success">
                                <i class="fa fa-credit-card me-2"></i> Effectuer un paiement
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Optionnel: Ajouter une confirmation avant téléchargement
    document.querySelectorAll('.btn-outline-success').forEach(btn => {
        btn.addEventListener('click', function(e) {
            console.log('Téléchargement de la facture...');
        });
    });
</script>
@endpush
