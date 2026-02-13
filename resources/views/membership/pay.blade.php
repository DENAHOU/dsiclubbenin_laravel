@extends($layout)

@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5 text-center">

                    <img src="{{ Auth::guard('company')->user()->logo_path ? asset('storage/' . Auth::guard('company')->user()->logo_path) : asset('img/logo-dsi.png') }}"
                         class="mb-4"
                         width="120"
                         alt="Logo" >

                    <h3 class="fw-bold mb-1">Cotisation annuelle</h3>
                    <p class="text-muted">{{ $label }}</p>

                    <hr>

                    <div class="my-4">
                        <h1 class="text-success fw-bold">
                            {{ number_format($amount, 0, ',', ' ') }} FCFA
                        </h1>
                        <small class="text-muted">Valable pour 1 an</small>
                    </div>

                    <button id="payBtn" class="btn btn-success btn-lg px-5 rounded-pill">
                        <i class="fa fa-credit-card"></i> Payer maintenant
                    </button>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.kkiapay.me/k.js"></script>

<script>
    document.getElementById('payBtn').addEventListener('click', function () {
        // ✅ ÉTAPE 1: Créer le paiement d'abord
        fetch("{{ route('membership.process') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.text().then(text => {
                    throw new Error(`HTTP ${response.status}: ${text}`);
                });
            }
            return response.json();
        })
        .then(data => {
            console.log('Payment created:', data);
            // ✅ ÉTAPE 2: Ouvrir KKiaPay avec le payment_id
            openKkiapayWidget({
                amount: {{ $amount }},
                key: "{{ config('services.kkiapay.public_key') }}",
                sandbox: true,

                callback: "{{ route('membership.notify') }}?payment_id=" + data.payment_id,

                name: "Club DSI Bénin",

                email: "{{ $entity->email ?? '' }}",
                phone: "{{ $entity->phone ?? '' }}",

                position: "center",
                theme: "green"
            });
        })
        .catch(error => {
            console.error('Erreur complète:', error);
            alert('Erreur: ' + error.message);
        });
    });
</script>

@endpush

