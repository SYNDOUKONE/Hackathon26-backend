<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inscription | Technovore Hackathon 2026</title>
  <link rel="icon" href="{{asset('images/app/logoSDI-PhotoRoom.png')}}" type="image/png">

  <link rel="stylesheet" href="{{ mix('css/hackathon-theme.css') }}">
  <link rel="stylesheet" href="{{ mix('css/inscription.css') }}">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">

  @livewireStyles
  <script src="{{ mix('js/app.js') }}" defer></script>

  <style>
    .inscription-navbar {
      position: fixed;
      top: 0; left: 0; right: 0;
      z-index: 100;
      height: 68px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 32px;
      background: rgba(6, 11, 20, 0.9);
      backdrop-filter: blur(24px);
      border-bottom: 1px solid rgba(0, 245, 255, 0.1);
    }
    .inscription-nav-logo {
      display: flex;
      align-items: center;
      gap: 12px;
      text-decoration: none;
    }
    .inscription-nav-logo img { height: 38px; filter: drop-shadow(0 0 8px rgba(0,245,255,0.3)); }
    .inscription-nav-logo span {
      font-family: var(--font-display);
      font-size: 0.95rem;
      font-weight: 700;
      color: var(--neon-cyan);
      letter-spacing: 0.08em;
    }
    .inscription-nav-links {
      display: flex;
      align-items: center;
      gap: 24px;
      list-style: none;
    }
    .inscription-nav-links a {
      font-size: 0.85rem;
      color: var(--text-muted);
      text-decoration: none;
      transition: var(--transition);
      padding: 6px 12px;
      border-radius: 6px;
    }
    .inscription-nav-links a:hover {
      color: var(--neon-cyan);
      background: var(--neon-cyan-dim);
    }
    .inscription-main {
      padding-top: 100px;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding-bottom: 60px;
    }
    .inscription-header {
      text-align: center;
      margin-bottom: 40px;
      padding: 0 24px;
    }
    .inscription-header h1 {
      font-family: var(--font-display);
      font-size: clamp(1.8rem, 4vw, 2.8rem);
      font-weight: 800;
      background: linear-gradient(135deg, #ffffff, var(--neon-cyan));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      margin-bottom: 8px;
    }
    .inscription-header p {
      color: var(--text-muted);
      font-size: 1rem;
    }
    .inscription-content {
      width: 100%;
      max-width: 860px;
      padding: 0 24px;
    }
    .inscription-card {
      background: rgba(10, 22, 40, 0.75);
      backdrop-filter: blur(24px);
      border: 1px solid rgba(0, 245, 255, 0.15);
      border-radius: 20px;
      padding: 40px;
      position: relative;
      overflow: hidden;
    }
    .inscription-card::before {
      content: '';
      position: absolute;
      top: 0; left: 20%; right: 20%;
      height: 2px;
      background: linear-gradient(90deg, transparent, var(--neon-cyan), transparent);
    }
    @media (max-width: 640px) {
      .inscription-navbar { padding: 0 16px; }
      .inscription-nav-logo span { display: none; }
      .inscription-card { padding: 24px 16px; }
    }
  </style>
</head>
<body>
  <!-- Background -->
  <div class="hk-grid-bg" aria-hidden="true"></div>
  <div class="hk-gradient-orb orb-1" aria-hidden="true"></div>
  <div class="hk-gradient-orb orb-2" aria-hidden="true"></div>

  <!-- Navbar -->
  <nav class="inscription-navbar" role="navigation" aria-label="Navigation inscription">
    <a href="{{ route('welcome', null, false) }}" class="inscription-nav-logo">
      <img src="{{ asset('images/app/logoHackathon-PhotoRoom.png') }}" alt="Hackathon 2026">
      <span>HACKATHON 2026</span>
    </a>
    <ul class="inscription-nav-links">
      <li><a href="{{ route('welcome', null, false) }}">← Accueil</a></li>
      <li><a href="{{ route('login', null, false) }}">Connexion</a></li>
    </ul>
  </nav>

  <!-- Main content -->
  <main class="inscription-main" style="position:relative;z-index:1;">

    <div class="inscription-header fade-in-up">
      <div class="hk-divider" style="margin-bottom:16px;"><span class="hk-badge">Inscription équipe</span></div>
      <h1>S'inscrire au Hackathon</h1>
      <p>Créez votre équipe et rejoignez la compétition</p>
    </div>

    <div class="inscription-content fade-in-up delay-1">
      <div class="inscription-card">
        <div x-data="Tabsetup()">
          @livewire('participants.enregistrement')
        </div>
      </div>
    </div>

  </main>

  <script>
    function Tabsetup() {
      return {
        activeTab: 0,
        tabs: ['groupe', 'participants']
      };
    }
  </script>

  @livewireScripts
</body>
</html>
