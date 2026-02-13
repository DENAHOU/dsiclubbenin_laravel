@extends('layouts.app-shell')

@section('title', 'Confirmer le paiement')

@section('content')
<div class="container py-4">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-lg border-0 mb-4">
                <div class="card-body text-center">
                    <img src="{{ Auth::user()->photo_path ? asset('storage/' . Auth::user()->photo_path) : asset('img/avatar.png') }}" 
                         class="rounded-circle mb-3" 
                         width="90"
                         alt="Photo de profil">

                    <h5 class="fw-bold">{{ $user->name }}</h5>
                    <p class="text-muted mb-1">{{ $user->phone }}</p>
                </div>
            </div>

            <div class="card shadow border-0">
                <div class="card-body text-center">

                    <h6 class="text-muted mb-2">Montant à payer</h6>
                    <h2 class="fw-bold text-success mb-4">
                        {{ number_format($amount, 0, ',', ' ') }} FCFA
                    </h2>

                    <p class="text-muted mb-3">
                        Durée: <strong>{{ $months }} mois</strong>
                    </p>

                    <div class="d-flex gap-2">
                        <a href="{{ route('member.cotisations.pay') }}" class="btn btn-outline-secondary btn-lg flex-grow-1">
                            Annuler
                        </a>

                        <button class="btn btn-success btn-lg flex-grow-1" id="confirmBtn" data-bs-toggle="modal" data-bs-target="#confirmModal">
                            ✅ Confirmer
                        </button>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>

{{-- MODAL DE CONFIRMATION --}}
<div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold">Confirmer le paiement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">
                <h5>Êtes-vous sûr de vouloir payer</h5>
                <h3 class="fw-bold text-success my-3">
                    {{ number_format($amount, 0, ',', ' ') }} FCFA
                </h3>
                <p class="text-muted">pour <strong>{{ $months }} mois</strong> de cotisation?</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Annuler
                </button>
                <button type="button" class="btn btn-success" id="proceedBtn">
                    Procéder au paiement
                </button>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')

    <script src="https://cdn.kkiapay.me/k.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const btn = document.getElementById('proceedBtn');

            btn.addEventListener('click', function () {

                console.log('✅ Bouton cliqué');

                if (typeof openKkiapayWidget === 'undefined') {
                    alert('❌ Kkiapay non chargé');
                    return;
                }

                fetch("{{ route('member.cotisations.process') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        number_of_months: {{ $months }},
                        amount: {{ $amount }}
                    })
                })
                .then(res => res.json())
                .then(data => {

                    console.log('📦 Données serveur', data);
                    console.log('🆔 Cotisation ID:', data.cotisation_id);

                    const callbackUrl = "{{ route('member.cotisations.notify') }}?cotisation_id=" + data.cotisation_id + "&transaction_id=";
                    console.log('🔗 Callback URL:', callbackUrl);

                    openKkiapayWidget({
                        amount: data.amount,
                        position: "center",
                        theme: "green",
                        sandbox: true,
                        key: "{{ config('services.kkiapay.public_key') }}",
                        callback: callbackUrl,
                        name: "Club DSI Bénin",
                        email: "{{ $user->email }}",
                        phone: "{{ $user->phone ?? '' }}"
                    });

                })
                .catch(err => {
                    console.error('❌ Erreur:', err);
                    alert('Erreur lors de la création de la cotisation');
                });

            });

        });
    </script>

@endpush
