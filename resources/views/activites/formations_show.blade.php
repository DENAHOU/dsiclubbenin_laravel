@extends('layouts.guest')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('activites.formations') }}">Formations</a></li>
                    <li class="breadcrumb-item active">{{ $formation->titre }}</li>
                </ol>
            </nav>
            
            <h1 class="fw-bold mb-4">{{ $formation->titre }}</h1>
            
            @if($formation->image_path)
                <img src="{{ asset('storage/' . $formation->image_path) }}" class="img-fluid rounded-4 mb-4" alt="{{ $formation->titre }}">
            @endif

            <div class="description-content fs-5 leading-relaxed">
                {!! nl2br(e($formation->description)) !!}
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-lg sticky-top" style="top: 100px; border-radius: 20px;">
                <div class="card-body p-4">
                    <div class="mb-4">
                        <span class="badge bg-primary px-3 py-2 mb-2">{{ ucfirst($formation->type_formation) }}</span>
                        <h2 class="text-primary fw-bold">{{ number_format($formation->price, 0, ',', ' ') }} FCFA</h2>
                    </div>

                    <ul class="list-unstyled mb-4">
                        <li class="mb-2"><i class="fas fa-calendar-alt text-muted me-2"></i> Début : <strong>{{ \Carbon\Carbon::parse($formation->start_date)->format('d/m/Y') }}</strong></li>
                        <li class="mb-2"><i class="fas fa-clock text-muted me-2"></i> Fin : <strong>{{ \Carbon\Carbon::parse($formation->end_date)->format('d/m/Y') }}</strong></li>
                        @if($formation->location)
                            <li class="mb-2"><i class="fas fa-map-marker-alt text-muted me-2"></i> {{ $formation->location }}</li>
                        @endif
                    </ul>

                    <div class="d-grid gap-2">
                        <a href="{{ route('activites.formations.register', $formation->id) }}" class="btn btn-success btn-lg fw-bold shadow-sm">
                            S'inscrire maintenant
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
