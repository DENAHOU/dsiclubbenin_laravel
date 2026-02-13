@extends('layouts.app')

@section('content')
<div class="container text-center py-5">
    <h2>Paiement réussi 🎉</h2>
    <p>Merci ! Votre adhésion est maintenant active.</p>

    <a href="{{ $dashboardRoute }}" class="btn btn-success mt-3">
        Accéder à mon tableau de bord
    </a>

</div>
@endsection
