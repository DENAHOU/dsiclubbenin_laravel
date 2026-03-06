@extends('layouts.guest')

@section('title', 'Espace Membre')



@section('content')

<style>
    :root {
        --dsi-blue: #094281;
        --dsi-green: #29963a;
        --light-bg: #f4f7fc;
        --ink: #0e1a2b;
        --muted-ink: #5c6b81;
        --border-color: #e5eaf2;
    }
    body { font-family: 'Inter', sans-serif; background-color: var(--light-bg); color: var(--ink); margin: 0; }

    /* HERO SECTION */
    .hero-members-v2 { position: relative; height: 100vh; min-height: 500px; display: grid; place-items: center; text-align: center; color: white; overflow: hidden; }
    .hero-members-v2 .hero-background { position: absolute; inset: 0; background-image: url("{{ asset('img/IMG_1966.jpg') }}"); background-size: cover; background-position: center; animation: ken-burns 20s infinite alternate ease-in-out; }
    .hero-members-v2::after { content: ''; position: absolute; inset: 0; background: linear-gradient(#101d34bd); z-index: 1; }
    #particles-js { position: absolute; inset: 0; z-index: 2; }
    .hero-content { position: relative; z-index: 3; }
    .hero-content h1 { font-size: clamp(2.5rem, 6vw, 4.5rem); font-weight: 800; color: #fff; opacity: 0; transform: translateY(20px); animation: slideUpFade 1s 0.2s ease-out forwards; }
    .hero-actions { margin-top: 2rem; opacity: 0; transform: translateY(20px); animation: slideUpFade 1s 0.5s ease-out forwards; }
    .btn.hero-btn { padding: 0.9rem 2rem; border-radius: 10px; font-weight: 700; font-size: 1.1rem; text-decoration: none; border: 2px solid transparent; transition: all 0.3s ease; display: inline-flex; align-items: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
    .btn.hero-btn.primary { background: linear-gradient(95deg, var(--dsi-blue), var(--dsi-green)); color: white; }
    .btn.hero-btn.primary:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.2); }
    .btn.hero-btn.secondary { background-color: rgba(255,255,255,0.2); backdrop-filter: blur(10px); color: white; border-color: rgba(255,255,255,0.4); }
    .btn.hero-btn.secondary:hover { background-color: rgba(255,255,255,0.3); border-color: white; transform: translateY(-3px); }

    /* MAIN CONTENT */
    .members-main-content { padding: 4rem 1.5rem; }
    .toolbar-container { max-width: 900px; margin: -8rem auto 3rem auto; position: relative; z-index: 10; background: white; border-radius: 16px; padding: 2rem; box-shadow: 0 20px 60px -10px rgba(9,66,129,0.2); }
    .search-bar { display: flex; gap: 1rem; margin-bottom: 2rem; }
    .search-bar .input-group-text { background: none; border: 1px solid var(--border-color); border-right: none; }
    .search-bar .form-control, .search-bar .form-select { border: 1px solid var(--border-color); box-shadow: none !important; }
    .member-tabs { border-bottom: 1px solid var(--border-color); }
    .member-tabs .nav-link { font-size: 1.1rem; font-weight: 600; color: var(--muted-ink); border: none; border-bottom: 3px solid transparent; padding: 1rem 1.5rem; }
    .member-tabs .nav-link.active { color: var(--dsi-blue); border-bottom-color: var(--dsi-blue); }

    /* MEMBERS GRID */
    .members-grid { display: grid; grid-template-columns: repeat(auto-fill,minmax(220px,1fr)); gap: 2.5rem 1.5rem; perspective: 1000px; }
    .member-card-v2 { text-align: center; opacity: 0; transform: rotateX(-20deg) translateY(50px); animation: card-appear 0.8s ease-out forwards; }
    .member-card-v2:nth-child(1) { animation-delay: 0.1s; } .member-card-v2:nth-child(2) { animation-delay: 0.2s; } .member-card-v2:nth-child(3) { animation-delay: 0.3s; }

    .member-photo-v2 { position: relative; width: 180px; height: 180px; margin: 0 auto 1rem; border-radius: 50%; overflow: hidden; box-shadow: 0 10px 30px -10px rgba(9,66,129,0.4); transition: transform 0.4s ease; }
    .member-card-v2:hover .member-photo-v2 { transform: scale(1.05); }
    .member-photo-v2 img { width: 100%; height: 100%; object-fit: cover; }
    .member-overlay { position: absolute; inset: 0; border-radius: 50%; background: rgba(9,66,129,.8); display: flex; align-items: center; justify-content: center; gap: 0.75rem; opacity: 0; transition: opacity 0.4s ease; }
    .member-card-v2:hover .member-overlay { opacity: 1; }
    .member-overlay .social-btn { width: 45px; height: 45px; border-radius: 50%; background: white; color: var(--dsi-blue); display: grid; place-items: center; font-size: 1.1rem; transition: all 0.3s ease; }
    .member-overlay .social-btn:hover { background: var(--dsi-green); color: white; }
    .member-info-v2 .member-name { font-weight: 700; font-size: 1.2rem; color: var(--ink); }
    .member-info-v2 .member-role { color: var(--muted-ink); }
    @keyframes ken-burns { 0% { transform: scale(1.1); } 100% { transform: scale(1); } }
    @keyframes slideUpFade { to { opacity: 1; transform: translateY(0); } }
    @keyframes card-appear { to { opacity: 1; transform: rotateX(0) translateY(0); } }

    .bureau-structure {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 2.5rem;
    }

    .bureau-row {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 2rem;
    }

    .member-card-v2 {
        text-align: center;
        position: relative;
        transition: transform 0.3s ease;
    }

    .member-photo-v2 {
        position: relative;
        width: 180px;
        height: 180px;
        margin: 0 auto 1rem auto;
        border-radius: 50%;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        transition: transform 0.4s ease;
    }

    .member-card-v2:hover .member-photo-v2 {
        transform: scale(1.05);
    }

    .member-overlay {
        position: absolute;
        inset: 0;
        border-radius: 50%;
        background: rgba(9,66,129,0.85);
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.75rem;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    /* show overlay when hovering the image container or card */
    .position-relative:hover .member-overlay,
    .card:hover .member-overlay {
        opacity: 1;
    }

    /* gradient style for icons when inside bureau */
    .social-gradient {
        background: linear-gradient(95deg, var(--dsi-blue), var(--dsi-green)) !important;
        color: white !important;
        box-shadow: 0 6px 18px rgba(9,66,129,0.25) !important;
    }

    .social-gradient i {
        color: white !important;
    }

    /* Custom tooltip styling */
    .tooltip-inner {
        background-color: var(--dsi-blue) !important;
        color: white !important;
        font-weight: 500;
        padding: 8px 12px !important;
        border-radius: 6px !important;
    }

    .tooltip.show {
        opacity: 1 !important;
    }

    .bs-tooltip-top .tooltip-arrow::before,
    .bs-tooltip-bottom .tooltip-arrow::before,
    .bs-tooltip-left .tooltip-arrow::before,
    .bs-tooltip-right .tooltip-arrow::before {
        border-top-color: var(--dsi-blue) !important;
        border-bottom-color: var(--dsi-blue) !important;
        border-left-color: var(--dsi-blue) !important;
        border-right-color: var(--dsi-blue) !important;
    }
        opacity: 1;
    }

    .social-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: white;
        color: #094281;
        display: grid;
        place-items: center;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .social-btn:hover {
        background: #29963a;
        color: white;
    }

    .badge-role {
        position: absolute;
        bottom: 8px;
        right: 8px;
        background: #29963a;
        color: white;
        font-weight: 700;
        padding: 6px 10px;
        border-radius: 8px;
        font-size: 0.75rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.25);
    }

    .avatar-placeholder {
            border-radius: 50%;
    }

    .avatar-placeholder {
        width: 100%;
        height: 220px;
        background: linear-gradient(135deg, #094281, #29963a);
        color: white;
        font-size: 28px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
    }

</style>

<section class="hero-members-v2">
    <div class="hero-background"></div>
    <div id="particles-js"></div>
    <div class="hero-content">
        <h1>Les Visages de l'Innovation</h1>
        <div class="hero-actions">
            <a href="{{ route('login') }}" class="btn hero-btn primary"><i class="fas fa-sign-in-alt me-2"></i> Accéder à l'espace membre</a>
            <a href="{{ route('register') }}" class="btn hero-btn secondary">Devenir membre</a>
        </div>
    </div>
</section>

<main class="members-main-content">
    <div class="toolbar-container mb-4">
        <div class="search-bar mb-3 d-flex gap-2">
            <div class="input-group flex-grow-1">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Rechercher un membre par nom..." id="search-member">
            </div>
            <select class="form-select" style="max-width: 200px;">
                <option selected>Toutes les catégories</option>
                <option value="bureau">Bureau Actuel</option>
                <option value="individuel">Membres Individuels</option>
                <option value="entreprise">Membres Entreprises</option>
                <option value="college">Membres Collèges-IT</option>
                <option value="administration">Membres Administration publique</option>
            </select>
        </div>

        <ul class="nav nav-tabs justify-content-center member-tabs" id="memberTab" role="tablist">
            <li class="nav-item"><button class="nav-link active" id="bureau-tab" data-bs-toggle="tab" data-bs-target="#bureau">Bureau Actuel</button></li>
            <li class="nav-item"><button class="nav-link" id="individuel-tab" data-bs-toggle="tab" data-bs-target="#individuel">Membres Individuels</button></li>
            <li class="nav-item"><button class="nav-link" id="entreprise-tab" data-bs-toggle="tab" data-bs-target="#entreprise">Membres Entreprises</button></li>
            <li class="nav-item"><button class="nav-link" id="college-tab" data-bs-toggle="tab" data-bs-target="#college">Membres Collèges-IT</button></li>
            <li class="nav-item"><button class="nav-link" id="administration-tab" data-bs-toggle="tab" data-bs-target="#administration">Membres Administration publique</button></li>
        </ul>
    </div>

    <div class="tab-content mt-4">

            <!-- BUREAU ACTUEL -->
            <div class="tab-pane fade show active" id="bureau">
                <div class="row g-4 justify-content-center">

                    @forelse($boardMembers as $member)

                        @php
                            $user = $member->user;
                            $company = $member->company;
                            $college = $member->college;
                            $administration = $member->administration;

                            $roleName = optional($member->role)->name;
                            $phone = optional($user)->phone
                                  ?? optional($company)->phone
                                  ?? optional($college)->phone
                                  ?? optional($administration)->phone;
                            $email = optional($user)->email
                                  ?? optional($company)->email
                                  ?? optional($college)->email
                                  ?? optional($administration)->email;

                            // Photo URL
                            $photoUrl = asset('images/default-user.png');
                            if ($roleName) {
                                foreach (['jpg','jpeg','png'] as $ext) {
                                    $path = storage_path("app/public/profile/{$roleName}.{$ext}");
                                    if (file_exists($path)) {
                                        $photoUrl = asset("storage/profile/{$roleName}.{$ext}");
                                        break;
                                    }
                                }
                            }

                            // Badge sigle mapping
                            $badgeMap = [
                                'Président' => 'PRE',
                                'Trésorier Général' => 'TG',
                                'Trésorier Général Adjoint' => 'TGA',
                                'Secrétaire Général' => 'SG',
                                'Secrétaire Général Adjoint' => 'SGA',
                                'Sécrétaire Général Communication' => 'SGCom',
                                'Sécrétaire Général Communication Adjoint' => 'SGACom',
                            ];
                            $sigle = $badgeMap[$roleName] ?? '';
                        @endphp

                        <div class="col-md-3 col-sm-6">
                            <div class="card shadow-sm text-center h-100">

                                <div class="p-3">
                                    <div class="position-relative d-inline-block">
                                        <img src="{{ $photoUrl }}"
                                            class="rounded-circle"
                                            width="120"
                                            height="120"
                                            style="object-fit:cover;">

                                        <div class="member-overlay">
                                            {{-- phone icon --}}
                                            @auth
                                                @if($phone)
                                                    <a href="tel:{{ $phone }}" class="social-btn social-gradient"><i class="fas fa-phone"></i></a>
                                                @else
                                                    <span class="social-btn social-gradient"><i class="fas fa-phone"></i></span>
                                                @endif
                                            @else
                                                <a href="{{ route('login') }}" class="social-btn social-gradient" data-bs-toggle="modal" data-bs-target="#loginRequiredModal"><i class="fas fa-phone"></i></a>
                                            @endauth

                                            {{-- email icon --}}
                                            @auth
                                                @if($email)
                                                    <a href="mailto:{{ $email }}" class="social-btn social-gradient"><i class="fas fa-envelope"></i></a>
                                                @else
                                                    <span class="social-btn social-gradient"><i class="fas fa-envelope"></i></span>
                                                @endif
                                            @else
                                                <a href="{{ route('login') }}" class="social-btn social-gradient" data-bs-toggle="modal" data-bs-target="#loginRequiredModal"><i class="fas fa-envelope"></i></a>
                                            @endauth
                                        </div>

                                        {{-- sigle badge --}}
                                        @if($sigle)
                                            <span class="badge-role">{{ $sigle }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="card-body">
                                    <h5 class="mb-2">
                                        @if($user)
                                            {{ optional($user)->firstname ?? '—' }} {{ optional($user)->lastname ?? '' }}
                                        @elseif($company)
                                            {{ $company->name ?? '—' }}
                                        @elseif($college)
                                            {{ $college->name ?? '—' }}
                                        @elseif($administration)
                                            {{ $administration->name ?? '—' }}
                                        @else
                                            —
                                        @endif
                                    </h5>
                                    <div class="text-muted small">{{ $roleName }}</div>
                                </div>

                            </div>
                        </div>

                        @empty
                        <div class="text-center py-5"><h5>Aucun membre du bureau trouvé</h5></div>
                    @endforelse

                </div>
            </div>

        <!-- MEMBRES INDIVIDUELS -->
        <div class="tab-pane fade" id="individuel">
            <div class="members-grid">
                @forelse($individualMembers as $user)
                    <div class="member-card-v2">
                        <div class="member-photo-v2">
                            @php
                                $photoFile = $user->photo_path ?? null;
                                $initials = strtoupper(substr($user->firstname ?? '',0,1)) . strtoupper(substr($user->lastname ?? '',0,1));
                            @endphp
                            @if($photoFile && file_exists(storage_path('app/public/'.$photoFile)))
                                <img src="{{ asset('storage/'.$photoFile) }}" alt="{{ $user->firstname }} {{ $user->lastname }}">
                            @else
                                <div class="avatar-placeholder">{{ $initials }}</div>
                            @endif

                            <div class="member-overlay">
                                @auth
                                    @if($user->phone)
                                        <a href="tel:{{ $user->phone }}" class="social-btn social-gradient"><i class="fas fa-phone"></i></a>
                                    @else
                                        <span class="social-btn social-gradient"><i class="fas fa-phone"></i></span>
                                    @endif
                                    @if($user->email)
                                        <a href="mailto:{{ $user->email }}" class="social-btn social-gradient"><i class="fas fa-envelope"></i></a>
                                    @else
                                        <span class="social-btn social-gradient"><i class="fas fa-envelope"></i></span>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="social-btn social-gradient" data-bs-toggle="modal" data-bs-target="#loginRequiredModal"><i class="fas fa-phone"></i></a>
                                    <a href="{{ route('login') }}" class="social-btn social-gradient" data-bs-toggle="modal" data-bs-target="#loginRequiredModal"><i class="fas fa-envelope"></i></a>
                                @endauth
                            </div>
                        </div>

                        <div class="member-info-v2">
                            <div class="member-name">{{ $user->firstname }} {{ $user->lastname }}</div>
                            <div class="member-role">DSI de {{ $user->current_employer ?? 'N/A' }}</div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5"><h5>Aucun membre individuel trouvé</h5></div>
                @endforelse
            </div>

            <div class="mt-4 d-flex justify-content-center gap-2">
                @if ($individualMembers->onFirstPage())
                    <span class="btn btn-secondary disabled">← Précédent</span>
                @else
                    <a href="{{ $individualMembers->previousPageUrl() }}" class="btn btn-primary">← Précédent</a>
                @endif

                @if ($individualMembers->hasMorePages())
                    <a href="{{ $individualMembers->nextPageUrl() }}" class="btn btn-primary">Suivant →</a>
                @else
                    <span class="btn btn-secondary disabled">Suivant →</span>
                @endif
            </div>
        </div>

        <!-- MEMBRES ENTREPRISES -->
        <div class="tab-pane fade" id="entreprise">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach($companyMembers as $company)
                    <div class="col">
                        <div class="card text-center">
                            <img src="{{ $company->logo_path ? asset('storage/'.$company->logo_path) : asset('images/default-company.png') }}" class="card-img-top" alt="{{ $company->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $company->name }}</h5>
                                <div class="member-overlay">
                                    @auth
                                        @if($company->phone)<a href="tel:{{ $company->phone }}" class="social-btn"><i class="fas fa-phone"></i></a>@endif
                                        @if($company->email)<a href="mailto:{{ $company->email }}" class="social-btn"><i class="fas fa-envelope"></i></a>@endif
                                    @else
                                        <a href="{{ route('login') }}" class="social-btn" data-bs-toggle="modal" data-bs-target="#loginRequiredModal"><i class="fas fa-phone"></i></a>
                                        <a href="{{ route('login') }}" class="social-btn" data-bs-toggle="modal" data-bs-target="#loginRequiredModal"><i class="fas fa-envelope"></i></a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- MEMBRES COLLÈGE -->
        <div class="tab-pane fade" id="college">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach($collegeMembers as $college)
                    <div class="col">
                        <div class="card text-center">
                            <img src="{{ $college->logo_path ? asset('storage/'.$college->logo_path) : asset('images/default-college.png') }}" class="card-img-top" alt="{{ $college->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $college->name }}</h5>
                                <div class="member-overlay">
                                    @auth
                                        @if($college->phone)<a href="tel:{{ $college->phone }}" class="social-btn"><i class="fas fa-phone"></i></a>@endif
                                        @if($college->email)<a href="mailto:{{ $college->email }}" class="social-btn"><i class="fas fa-envelope"></i></a>@endif
                                    @else
                                        <a href="{{ route('login') }}" class="social-btn" data-bs-toggle="modal" data-bs-target="#loginRequiredModal"><i class="fas fa-phone"></i></a>
                                        <a href="{{ route('login') }}" class="social-btn" data-bs-toggle="modal" data-bs-target="#loginRequiredModal"><i class="fas fa-envelope"></i></a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- MEMBRES ADMINISTRATION -->
        <div class="tab-pane fade" id="administration">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach($adminMembers as $admin)
                    <div class="col">
                        <div class="card text-center">
                            <img src="{{ $admin->logo_path ? asset('storage/'.$admin->logo_path) : asset('images/default-admin.png') }}" class="card-img-top" alt="{{ $admin->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $admin->name }}</h5>
                                <div class="member-overlay">
                                    @auth
                                        @if($admin->phone)<a href="tel:{{ $admin->phone }}" class="social-btn"><i class="fas fa-phone"></i></a>@endif
                                        @if($admin->email)<a href="mailto:{{ $admin->email }}" class="social-btn"><i class="fas fa-envelope"></i></a>@endif
                                    @else
                                        <a href="{{ route('login') }}" class="social-btn" data-bs-toggle="modal" data-bs-target="#loginRequiredModal"><i class="fas fa-phone"></i></a>
                                        <a href="{{ route('login') }}" class="social-btn" data-bs-toggle="modal" data-bs-target="#loginRequiredModal"><i class="fas fa-envelope"></i></a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

    <!-- Modal unique pour demande de connexion -->
    <div class="modal fade" id="loginRequiredModal" tabindex="-1" aria-labelledby="loginRequiredModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginRequiredModalLabel">Connexion requise</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">Vous devez vous connecter pour accéder aux informations d'un membre.</div>
                <div class="modal-footer">
                    <a href="{{ route('login') }}" class="btn btn-primary">Se connecter</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script>
    if (document.getElementById('particles-js')) {
        particlesJS("particles-js", { particles: { number: { value: 40, density: { enable: true, value_area: 800 } }, color: { value: "#ffffff" }, shape: { type: "circle" }, opacity: { value: 0.3, random: true }, size: { value: 2, random: true }, line_linked: { enable: false }, move: { enable: true, speed: 1, direction: "none", out_mode: "out" } }, retina_detect: true });
    }
</script>

<script>
    // Bootstrap tooltips init for dynamic page
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipElems = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"], [data-tooltip="true"]'));
        tooltipElems.map(function (el) { return new bootstrap.Tooltip(el); });
    });
</script>

@endsection

