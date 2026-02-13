@extends('layouts.app-shell')

@section('content')

<div class="container-fluid py-4">

    {{-- TITRE --}}
    <div class="mb-4">
        <h3 class="fw-bold mb-1">👤 Mon Profil</h3>
        <p class="text-muted">Gérez vos informations personnelles et la sécurité de votre compte</p>
    </div>

    <div class="row g-4">

        {{-- ================= PROFIL CARD ================= --}}
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 text-center p-4">
                <img src="{{ Auth::user()->photo_url ?? asset('img/avatar.png') }}"
                     class="rounded-circle mx-auto mb-3"
                     width="120" height="120"
                     style="object-fit: cover;">

                <h5 class="fw-bold mb-0">{{ Auth::user()->name }}</h5>
                <small class="text-muted">{{ Auth::user()->email }}</small>

                <hr>

                <span class="badge bg-primary px-3 py-2">
                    Membre individuel
                </span>
            </div>
        </div>

        {{-- ================= INFORMATIONS ================= --}}
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 p-4 mb-4">
                <h5 class="fw-bold mb-3">📝 Informations personnelles</h5>

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nom complet</label>
                            <input type="text"
                                   name="name"
                                   value="{{ old('name', Auth::user()->name) }}"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Adresse email</label>
                            <input type="email"
                                   name="email"
                                   value="{{ old('email', Auth::user()->email) }}"
                                   class="form-control"
                                   required>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button class="btn btn-primary px-4">
                            💾 Enregistrer les modifications
                        </button>

                        @if (session('status') === 'profile-updated')
                            <span class="text-success ms-3 fw-semibold">
                                ✔ Modifications enregistrées
                            </span>
                        @endif
                    </div>
                </form>
            </div>

            {{-- ================= MOT DE PASSE ================= --}}
            <div class="card shadow-sm border-0 p-4 mb-4">
                @include('profile.partials.update-password-form')
            </div>

            {{-- ================= SUPPRESSION ================= --}}
            <div class="card shadow-sm border-danger p-4">
                <h5 class="fw-bold text-danger mb-3">⚠️ Zone sensible</h5>

                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>

</div>

@endsection
