@extends('layouts.app')

@section('content')
<style>
    :root {
        --dsi-blue: #0b3f7a;
        --dsi-green: #29963a;
        --light-bg: #f4f7fc;
        --muted-ink: #5c6b81;
        --ink: #0e1a2b;
    }

    body {
        background-color: var(--light-bg);
        font-family: 'Inter', sans-serif;
        margin: 0;
    }

    .coming-soon-section {
        min-height: 80vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 4rem 1.5rem;
        background: linear-gradient(160deg, #f4f7fc 60%, rgba(11,63,122,0.05));
    }

    .coming-logo img {
        width: 200px;
        height: 100px;
        margin-bottom: 2rem;
    }

    .coming-eyebrow {
        color: var(--dsi-green);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .coming-title {
        font-size: clamp(2.2rem, 4vw, 3rem);
        font-weight: 800;
        color: var(--dsi-blue);
        margin-bottom: 1rem;
    }

    .coming-text {
        color: var(--muted-ink);
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto 2rem;
        line-height: 1.7;
    }

    .countdown {
        display: flex;
        justify-content: center;
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .countdown div {
        background-color: white;
        border: 1px solid #e5eaf2;
        border-radius: 12px;
        padding: 1rem 1.5rem;
        box-shadow: 0 10px 20px -10px rgba(11,63,122,0.15);
    }

    .countdown span {
        display: block;
        font-size: 2rem;
        font-weight: 700;
        color: var(--dsi-blue);
    }

    .countdown small {
        font-size: 0.8rem;
        color: var(--muted-ink);
    }

    .notify-input {
        display: flex;
        justify-content: center;
        margin-top: 1rem;
    }

    .notify-input input {
        padding: 0.8rem 1rem;
        border: 1px solid #d0d8e6;
        border-radius: 8px 0 0 8px;
        outline: none;
        width: 250px;
        font-size: 1rem;
    }

    .notify-input button {
        background: linear-gradient(95deg, var(--dsi-blue), var(--dsi-green));
        border: none;
        color: white;
        font-weight: 600;
        padding: 0.8rem 1.2rem;
        border-radius: 0 8px 8px 0;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .notify-input button:hover {
        opacity: 0.9;
    }

    .back-home {
        margin-top: 2rem;
    }

    .back-home a {
        color: var(--dsi-blue);
        text-decoration: none;
        font-weight: 600;
    }

    .back-home a:hover {
        text-decoration: underline;
    }
</style>

<section class="coming-soon-section">
    <div class="coming-logo">
        <img src="{{ asset('img/logo-dsi.png') }}" alt="Logo Club DSI Bénin">
    </div>

    <p class="coming-eyebrow">Innovation & Collaboration</p>
    <h1 class="coming-title">🚀 NexusDSI Hub arrive bientôt</h1>
    <p class="coming-text">
        Le nouvel espace numérique du <strong>Club DSI Bénin</strong> dédié à la <strong>valorisation des experts membres</strong>,
        à la <strong>mise en relation avec les entreprises</strong> et à la <strong>promotion de l’expertise béninoise</strong> est en cours de finalisation.
    </p>

    {{-- <div class="countdown">
        <div><span id="days">30</span><small>jours</small></div>
        <div><span id="hours">12</span><small>heures</small></div>
        <div><span id="minutes">45</span><small>minutes</small></div>
        <div><span id="seconds">10</span><small>secondes</small></div>
    </div>

    <div class="notify-input">
        <input type="email" placeholder="Entrez votre e-mail pour être notifié">
        <button>S’inscrire</button>
    </div> --}}

    <div class="back-home">
        <a href="{{ route('home') }}">← Retour à l’accueil</a>
    </div>
</section>

{{-- <script>
    // Exemple d’un petit compte à rebours fictif
    const targetDate = new Date().getTime() + 15 * 24 * 60 * 60 * 1000; // dans 15 jours

    const countdown = setInterval(() => {
        const now = new Date().getTime();
        const distance = targetDate - now;

        if (distance < 0) {
            clearInterval(countdown);
            document.querySelector(".countdown").innerHTML = "<p>Le Hub est en ligne 🎉</p>";
            return;
        }

        document.getElementById("days").innerText = Math.floor(distance / (1000 * 60 * 60 * 24));
        document.getElementById("hours").innerText = Math.floor((distance / (1000 * 60 * 60)) % 24);
        document.getElementById("minutes").innerText = Math.floor((distance / (1000 * 60)) % 60);
        document.getElementById("seconds").innerText = Math.floor((distance / 1000) % 60);
    }, 1000);
</script> --}}

@endsection
