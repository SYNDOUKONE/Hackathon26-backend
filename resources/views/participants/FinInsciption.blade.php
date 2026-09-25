<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inscriptions fermées | Hackathon 2026</title>
  <link rel="icon" href="{{asset('images/app/logoSDI-PhotoRoom.png')}}" type="image/png">
  <link rel="stylesheet" href="{{ mix('css/hackathon-theme.css') }}">
  <style>
    body {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 24px;
      text-align: center;
    }
    .fin-card {
      max-width: 560px;
      width: 100%;
      background: rgba(10, 22, 40, 0.75);
      backdrop-filter: blur(24px);
      border: 1px solid rgba(255, 107, 53, 0.2);
      border-radius: 24px;
      padding: 60px 48px;
      position: relative;
      overflow: hidden;
    }
    .fin-card::before {
      content: '';
      position: absolute;
      top: 0; left: 20%; right: 20%;
      height: 2px;
      background: linear-gradient(90deg, transparent, var(--neon-orange), transparent);
    }
  </style>
</head>
<body>
  <div class="hk-grid-bg" aria-hidden="true"></div>
  <div class="hk-gradient-orb orb-1" aria-hidden="true"></div>
  <div class="hk-gradient-orb orb-2" aria-hidden="true"></div>

  <div class="fin-card fade-in-up" style="position:relative;z-index:1;">
    <div style="font-size:4rem;margin-bottom:24px;" aria-hidden="true">⏳</div>
    <div class="hk-badge" style="margin-bottom:20px;display:inline-block;border-color:rgba(255,107,53,0.3);background:rgba(255,107,53,0.1);color:var(--neon-orange);">
      Inscriptions fermées
    </div>
    <h1 style="font-family:var(--font-display);font-size:1.8rem;font-weight:800;color:var(--text-primary);margin-bottom:16px;line-height:1.2;">
      Les inscriptions sont<br>
      <span style="color:var(--neon-orange);">terminées</span>
    </h1>
    <p style="color:var(--text-muted);font-size:1rem;line-height:1.7;margin-bottom:36px;">
      La phase d'inscriptions pour le <strong style="color:var(--text-primary);">Technovore Hackathon 2026</strong> est terminée. Rendez-vous sur votre espace pour consulter les résultats de la présélection.
    </p>
    <div style="display:flex;flex-direction:column;gap:12px;align-items:center;">
      @if(Route::has('login'))
        @auth
          <a href="{{ route('dashboard', null, false) }}" class="btn-primary" id="fin-dashboard-btn">
            Mon espace →
          </a>
        @else
          <a href="{{ route('login', null, false) }}" class="btn-primary" id="fin-login-btn">
            Se connecter →
          </a>
        @endauth
      @endif
      <a href="{{ route('welcome', null, false) }}" class="btn-ghost" id="fin-home-btn">← Retour à l'accueil</a>
    </div>
  </div>
</body>
</html>