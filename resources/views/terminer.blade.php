<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Validée | Technovore Hackathon 2026</title>
    <link rel="stylesheet" href="{{ mix('css/hackathon-theme.css') }}">
    <link rel="icon" href="{{asset('images/app/logoSDI-PhotoRoom.png')}}" type="image/png">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            text-align: center;
            margin: 0;
        }
        .term-card {
            max-width: 600px;
            width: 100%;
            background: rgba(10, 22, 40, 0.75);
            backdrop-filter: blur(24px);
            border: 1px solid rgba(0, 245, 255, 0.2);
            border-radius: 24px;
            padding: 60px 48px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 0 40px rgba(0,0,0,0.5);
        }
        .term-card::before {
            content: '';
            position: absolute;
            top: 0; left: 20%; right: 20%;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--neon-cyan), transparent);
        }
        .password-box {
            background: rgba(0, 0, 0, 0.3);
            border: 1px dashed var(--neon-cyan);
            padding: 20px;
            border-radius: 12px;
            margin: 24px 0;
            font-family: monospace;
        }
    </style>
</head>
<body>
    <div class="hk-grid-bg" aria-hidden="true"></div>
    <div class="hk-gradient-orb orb-1" aria-hidden="true"></div>
    <div class="hk-gradient-orb orb-2" aria-hidden="true"></div>

    <div class="term-card fade-in-up" style="position:relative;z-index:1;">
        <div style="font-size:5rem;margin-bottom:24px;" aria-hidden="true">✅</div>

        <h1 style="font-family:var(--font-display);font-size:2rem;font-weight:800;color:var(--text-primary);margin-bottom:16px;line-height:1.2;">
            Votre inscription est <span style="color:var(--neon-cyan);">validée</span>
        </h1>

        <p style="color:var(--text-muted);font-size:1.1rem;margin-bottom:24px;">
            Félicitations <strong style="color:var(--text-primary);">{{ session('registered_nom', 'Capitaine') }}</strong>, votre équipe a été enregistrée avec succès.
        </p>

        <div class="password-box">
            <p style="color:var(--text-muted);font-size:0.9rem;margin-bottom:8px;text-transform:uppercase;letter-spacing:0.1em;">Mot de passe par défaut</p>
            <h2 style="color:var(--neon-cyan);font-size:1.8rem;font-weight:800;margin:0;">{{ session('registered_password', 'sdi23@TH12345') }}</h2>
        </div>

        <p style="color:var(--text-muted);font-size:1rem;margin-bottom:36px;line-height:1.6;">
            Utilisez vos identifiants pour accéder à votre espace et commencer la compétition.
        </p>

        <div style="display:flex;flex-direction:column;gap:12px;align-items:center;">
            <a href="{{ route('login', null, false) }}" class="btn-primary" style="padding:12px 24px;background:var(--neon-cyan);color:#0a1628;border-radius:8px;font-weight:700;text-decoration:none;text-transform:uppercase;letter-spacing:0.05em;width:fit-content;">
                Se connecter maintenant →
            </a>
            <a href="{{ route('welcome', null, false) }}" class="btn-ghost" style="color:var(--text-muted);text-decoration:none;font-size:0.9rem;transition:var(--transition);" onmouseover="this.style.color='var(--neon-cyan)'" onmouseout="this.style.color='var(--text-muted)'">
                ← Retour à l'accueil
            </a>
        </div>
    </div>
</body>
</html>