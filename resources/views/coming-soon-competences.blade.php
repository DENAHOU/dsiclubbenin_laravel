<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bientôt disponible — Plateforme de Gestion des Compétences</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <style>
        :root {
            --dsi-blue: #0b3f7a;
            --dsi-green: #29963a;
            --ink: #0e1a2b;
            --muted: #5c6b81;
            --bg: #f4f7fc;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--ink);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            text-align: center;
            overflow: hidden;
        }

        .coming-container {
            max-width: 700px;
            background: white;
            border-radius: 20px;
            padding: 3rem 2rem;
            box-shadow: 0 15px 45px -15px rgba(11,63,122,0.15);
            border: 1px solid rgba(11,63,122,0.08);
            animation: fadeIn 1s ease-out;
        }

        .coming-container h1 {
            font-size: clamp(2.5rem, 5vw, 3.5rem);
            font-weight: 800;
            background: linear-gradient(95deg, var(--dsi-blue), var(--dsi-green));
            -webkit-background-clip: text;
            color: transparent;
            margin-bottom: 1rem;
        }

        .coming-container p {
            color: var(--muted);
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }

        .countdown {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .countdown div {
            background: var(--bg);
            border-radius: 12px;
            padding: 1rem 1.2rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .countdown span {
            display: block;
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--dsi-blue);
        }

        .countdown small {
            color: var(--muted);
            font-size: 0.9rem;
        }

        .btn-primary {
            background: linear-gradient(95deg, var(--dsi-blue), var(--dsi-green));
            color: white;
            border: none;
            border-radius: 10px;
            padding: 0.9rem 1.8rem;
            font-weight: 700;
            text-decoration: none;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px -5px rgba(11,63,122,0.3);
        }

        footer {
            margin-top: 3rem;
            font-size: 0.9rem;
            color: var(--muted);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="coming-container">
        <h1><i class="fas fa-rocket me-2"></i>Plateforme de Gestion des Compétences</h1>
        <p>Nous finalisons cette innovation pour valoriser les experts, renforcer les partenariats et créer de nouvelles opportunités professionnelles.</p>

        {{-- <div class="countdown" id="countdown">
            <div><span id="days">--</span><small>Jours</small></div>
            <div><span id="hours">--</span><small>Heures</small></div>
            <div><span id="minutes">--</span><small>Minutes</small></div>
            <div><span id="seconds">--</span><small>Secondes</small></div>
        </div> --}}

        <a href="{{ route('home') }}" class="btn-primary"><i class="fas fa-home me-2"></i>Retour à l’accueil</a>

        <footer>
            &copy; {{ date('Y') }} Club DSI Bénin — Tous droits réservés.
        </footer>
    </div>

    {{-- <script>
        const launchDate = new Date("{{ $launchDate->format('Y-m-d') }}").getTime();
        const countdown = document.getElementById('countdown');

        const timer = setInterval(() => {
            const now = new Date().getTime();
            const distance = launchDate - now;

            if (distance < 0) {
                clearInterval(timer);
                countdown.innerHTML = "<strong>Lancement en cours 🚀</strong>";
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("days").innerText = days;
            document.getElementById("hours").innerText = hours;
            document.getElementById("minutes").innerText = minutes;
            document.getElementById("seconds").innerText = seconds;
        }, 1000);
    </script> --}}
</body>
</html>
