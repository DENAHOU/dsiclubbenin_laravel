@extends('layouts.guest')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 p-4">
                <h2 class="fw-bold text-center mb-4">Inscription : {{ $formation->titre }}</h2>
                
                <form action="{{ route('activites.formations.register.store', $formation->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nom Complet *</label>
                        <input type="text" name="full_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Professionnel *</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Téléphone *</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Entreprise (Optionnel)</label>
                        <input type="text" name="company" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">Confirmer l'inscription</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
