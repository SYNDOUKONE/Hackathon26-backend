<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Technovore Hackathon 2026 | C2E × ESATIC</title>
  <meta name="description" content="La 6ème édition du Technovore Hackathon organisée par le Conseil Estudiantin de l'ESATIC. Inscriptions ouvertes pour l'édition 2026.">
  <link rel="icon" href="{{asset('images/app/logoSDI-PhotoRoom.png')}}" type="image/png">

  <!-- Styles -->
  <link rel="stylesheet" href="{{ mix('css/hackathon-theme.css') }}">
  <style>
    /* =============================================
       HERO SECTION
    ============================================= */
    .hero {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 100px 24px 60px;
      position: relative;
      z-index: 1;
      text-align: center;
    }
    .hero-logos {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 24px;
      margin-bottom: 48px;
      flex-wrap: wrap;
    }
    .hero-logos img { height: 56px; filter: drop-shadow(0 0 12px rgba(0,245,255,0.3)); }
    .hero-logos .logo-sep {
      width: 1px; height: 40px;
      background: linear-gradient(180deg, transparent, var(--neon-cyan), transparent);
    }
    .hero-eyebrow {
      font-family: var(--font-display);
      font-size: 0.75rem;
      font-weight: 700;
      letter-spacing: 0.25em;
      text-transform: uppercase;
      color: var(--neon-orange);
      margin-bottom: 20px;
    }
    .hero-title {
      font-family: var(--font-display);
      font-size: clamp(2.8rem, 8vw, 6rem);
      font-weight: 900;
      line-height: 1.0;
      margin-bottom: 8px;
      background: linear-gradient(135deg, #ffffff 0%, var(--neon-cyan) 50%, var(--neon-orange) 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      filter: drop-shadow(0 0 40px rgba(0,245,255,0.2));
    }
    .hero-subtitle-year {
      font-family: var(--font-display);
      font-size: clamp(1.2rem, 3vw, 2rem);
      font-weight: 400;
      color: var(--text-muted);
      letter-spacing: 0.3em;
      margin-bottom: 24px;
    }
    .hero-desc {
      font-size: 1.1rem;
      color: var(--text-muted);
      max-width: 580px;
      margin: 0 auto 48px;
      line-height: 1.7;
    }
    .hero-actions {
      display: flex;
      gap: 16px;
      justify-content: center;
      flex-wrap: wrap;
      margin-bottom: 72px;
    }
    .hero-divider {
      width: 100%;
      max-width: 800px;
      height: 1px;
      background: linear-gradient(90deg, transparent, var(--glass-border), transparent);
      margin: 0 auto 48px;
    }
    .hero-countdown-label {
      font-family: var(--font-display);
      font-size: 0.7rem;
      font-weight: 700;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: var(--text-muted);
      margin-bottom: 24px;
    }
    .hero-scroll-hint {
      position: absolute;
      bottom: 32px;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 8px;
      color: var(--text-muted);
      font-size: 0.75rem;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      animation: scrollBounce 2s ease-in-out infinite;
    }
    .scroll-mouse {
      width: 24px; height: 36px;
      border: 2px solid rgba(0,245,255,0.3);
      border-radius: 12px;
      position: relative;
    }
    .scroll-mouse::after {
      content: '';
      position: absolute;
      top: 6px; left: 50%; transform: translateX(-50%);
      width: 3px; height: 8px;
      background: var(--neon-cyan);
      border-radius: 2px;
      animation: scrollDot 2s ease-in-out infinite;
    }
    @keyframes scrollDot {
      0%, 100% { transform: translateX(-50%) translateY(0); opacity: 1; }
      80%       { transform: translateX(-50%) translateY(10px); opacity: 0; }
    }
    @keyframes scrollBounce {
      0%, 100% { transform: translateX(-50%) translateY(0); }
      50%       { transform: translateX(-50%) translateY(-6px); }
    }

    /* =============================================
       THEME SECTION
    ============================================= */
    .theme-section {
      padding: 100px 24px;
      position: relative;
      z-index: 1;
    }
    .theme-card {
      max-width: 900px;
      margin: 0 auto;
      background: var(--glass-bg);
      backdrop-filter: blur(24px);
      border: 1px solid var(--glass-border);
      border-radius: var(--radius-lg);
      padding: 60px 48px;
      text-align: center;
      position: relative;
      overflow: hidden;
    }
    .theme-card::before {
      content: '';
      position: absolute;
      top: -2px; left: 20%; right: 20%;
      height: 2px;
      background: linear-gradient(90deg, transparent, var(--neon-cyan), transparent);
    }
    .theme-icon {
      font-size: 4rem;
      margin-bottom: 24px;
      display: block;
    }
    .theme-name {
      font-family: var(--font-display);
      font-size: clamp(1.5rem, 4vw, 2.5rem);
      font-weight: 800;
      color: var(--neon-orange);
      margin-bottom: 20px;
      text-shadow: var(--glow-orange);
    }
    .theme-text {
      font-size: 1.05rem;
      line-height: 1.8;
      color: var(--text-muted);
      max-width: 640px;
      margin: 0 auto;
    }
    .theme-stats {
      display: flex;
      justify-content: center;
      gap: 48px;
      flex-wrap: wrap;
      margin-top: 48px;
      padding-top: 40px;
      border-top: 1px solid var(--glass-border);
    }
    .theme-stat-number {
      font-family: var(--font-display);
      font-size: 2.5rem;
      font-weight: 900;
      color: var(--neon-cyan);
      display: block;
    }
    .theme-stat-label {
      font-size: 0.8rem;
      color: var(--text-muted);
      text-transform: uppercase;
      letter-spacing: 0.1em;
    }

    /* =============================================
       TIMELINE SECTION
    ============================================= */
    .timeline-grid {
      max-width: 700px;
      margin: 0 auto;
    }

    /* =============================================
       PRIZES SECTION
    ============================================= */
    .prizes-section { background: rgba(10, 22, 40, 0.5); }
    .podium-wrapper {
      max-width: 900px;
      margin: 0 auto;
    }
    .hk-prize-card.gold  { transform: translateY(-20px); }
    .hk-prize-card.silver { order: -1; }
    .hk-prize-card.bronze { order: 1; }
    .prize-trophy { font-size: 3.5rem; margin-bottom: 12px; display: block; }
    .prize-position {
      font-family: var(--font-display);
      font-size: 0.7rem;
      font-weight: 700;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      margin-bottom: 16px;
    }
    .hk-prize-card.gold   .prize-position { color: var(--neon-orange); }
    .hk-prize-card.silver .prize-position { color: var(--neon-cyan); }
    .hk-prize-card.bronze .prize-position { color: var(--text-primary); }
    .prize-perks {
      list-style: none;
      margin-top: 16px;
      display: flex;
      flex-direction: column;
      gap: 8px;
    }
    .prize-perks li {
      font-size: 0.85rem;
      color: var(--text-muted);
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
    }
    .prize-perks li::before { content: '✦'; color: var(--neon-cyan); font-size: 0.6rem; }

    /* =============================================
       SPONSORS SECTION
    ============================================= */
    .sponsors-title-sm {
      font-size: 0.75rem;
      letter-spacing: 0.15em;
      text-transform: uppercase;
      color: var(--text-muted);
      text-align: center;
      margin-bottom: 28px;
    }

    /* =============================================
       FAQ SECTION
    ============================================= */
    .faq-grid {
      max-width: 780px;
      margin: 0 auto;
    }

    /* =============================================
       APP LAYOUT (dashboard)
    ============================================= */
    .dashboard-bg {
      min-height: 100vh;
      background: var(--bg-dark);
    }
  </style>
</head>
<body>
  <!-- Background -->
  <div class="hk-grid-bg" aria-hidden="true"></div>
  <div class="hk-gradient-orb orb-1" aria-hidden="true"></div>
  <div class="hk-gradient-orb orb-2" aria-hidden="true"></div>

  <!-- =============== NAVBAR =============== -->
  <nav class="hk-navbar" id="hk-navbar" role="navigation" aria-label="Navigation principale">
    <a href="#hero" class="hk-nav-logo">
      <img src="{{asset('images/app/logoSDI-PhotoRoom.png')}}" alt="SDI Hackathon">
    </a>
    <ul class="hk-nav-links">
      <li><a href="#about">Thème</a></li>
      <li><a href="#timeline">Programme</a></li>
      <li><a href="#prizes">Prix</a></li>
      <li><a href="#sponsors">Sponsors</a></li>
      <li><a href="#faq">FAQ</a></li>
    </ul>
    <div class="hk-nav-actions">
      @if(Route::has('login'))
        @auth
          @if($statut)
            <a href="{{route('Participants.inscription')}}" class="btn-secondary" style="padding:10px 20px;font-size:0.8rem">S'inscrire</a>
          @endif
          <a href="{{route('dashboard')}}" class="btn-primary" style="padding:10px 20px;font-size:0.8rem">Mon espace</a>
        @else
          @if($statut)
            <a href="{{route('Participants.inscription')}}" class="btn-secondary" style="padding:10px 20px;font-size:0.8rem">S'inscrire</a>
          @endif
          <a href="{{route('login')}}" class="btn-primary" style="padding:10px 20px;font-size:0.8rem">Connexion</a>
        @endauth
      @endif
    </div>
  </nav>

  <!-- =============== HERO =============== -->
  <section class="hero" id="hero">
    <div class="hero-logos fade-in-up">
      <img src="{{asset('images/app/logoEsatic-PhotoRoom.png')}}" alt="ESATIC">
      <div class="logo-sep" aria-hidden="true"></div>
      <img src="{{asset('images/app/logoC2E-PhotoRoom.png')}}" alt="C2E">
    </div>

    <p class="hero-eyebrow fade-in-up delay-1">6ème Édition · 2026</p>

    <h1 class="hero-title fade-in-up delay-1">TECHNOVORE</h1>
    <p class="hero-subtitle-year fade-in-up delay-1">HACKATHON</p>

    <p class="hero-desc fade-in-up delay-2">
      48h d'innovation non-stop. Des équipes de brillants développeurs, designers et entrepreneurs s'affrontent pour créer les solutions de demain.
    </p>

    <div class="hero-actions fade-in-up delay-2">
      @if(Route::has('login'))
        @auth
          @if($statut)
            <a href="{{route('Participants.inscription')}}" class="btn-primary" id="hero-cta-inscription">
              <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
              S'inscrire maintenant
            </a>
          @else
            <a href="{{route('finPreselection')}}" class="btn-primary" id="hero-cta-closed">
              Voir les résultats
            </a>
          @endif
          <a href="{{route('dashboard')}}" class="btn-secondary" id="hero-cta-dashboard">Mon espace →</a>
        @else
          @if($statut)
            <a href="{{route('Participants.inscription')}}" class="btn-primary" id="hero-cta-inscription-guest">
              <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
              S'inscrire maintenant
            </a>
          @else
            <a href="{{route('finPreselection')}}" class="btn-primary" id="hero-cta-closed-guest">
              Voir les résultats
            </a>
          @endif
          <a href="{{route('login')}}" class="btn-secondary" id="hero-cta-login">Se connecter →</a>
        @endauth
      @endif
    </div>

    <div class="hero-divider" aria-hidden="true"></div>

    <p class="hero-countdown-label fade-in-up delay-3">⚡ Compte à rebours — Début du hackathon</p>
    <div class="hk-countdown fade-in-up delay-3" id="countdown" aria-live="polite" aria-label="Compte à rebours avant le hackathon">
      <div class="hk-countdown-unit">
        <div class="hk-countdown-number" id="cd-days">--</div>
        <span class="hk-countdown-label">Jours</span>
      </div>
      <span class="hk-countdown-separator" aria-hidden="true">:</span>
      <div class="hk-countdown-unit">
        <div class="hk-countdown-number" id="cd-hours">--</div>
        <span class="hk-countdown-label">Heures</span>
      </div>
      <span class="hk-countdown-separator" aria-hidden="true">:</span>
      <div class="hk-countdown-unit">
        <div class="hk-countdown-number" id="cd-minutes">--</div>
        <span class="hk-countdown-label">Minutes</span>
      </div>
      <span class="hk-countdown-separator" aria-hidden="true">:</span>
      <div class="hk-countdown-unit">
        <div class="hk-countdown-number" id="cd-seconds">--</div>
        <span class="hk-countdown-label">Secondes</span>
      </div>
    </div>

    <div class="hero-scroll-hint" aria-hidden="true">
      <div class="scroll-mouse"></div>
      <span>Découvrir</span>
    </div>
  </section>

  <!-- =============== ABOUT / THÈME =============== -->
  <section class="theme-section" id="about" aria-labelledby="about-title">
    <div class="hk-container">
      <div class="hk-divider"><span class="hk-badge">L'édition 2026</span></div>
      <h2 class="hk-section-title" id="about-title">Le Thème de l'édition</h2>
      <p class="hk-section-subtitle">Une compétition d'élite pour les esprits les plus créatifs de l'ESATIC</p>

      <div class="theme-card">
        <span class="theme-icon">🤖</span>
        <h3 class="theme-name">IA & Innovation Africaine</h3>
        <p class="theme-text">
          Cette année, le Technovore Hackathon explore la frontière de l'intelligence artificielle appliquée aux défis africains. De la santé à l'agriculture, de l'éducation à la fintech — votre mission est de bâtir des solutions concrètes, scalables et impactantes pour l'Afrique de demain.
        </p>
        <div class="theme-stats">
          <div>
            <span class="theme-stat-number">48h</span>
            <span class="theme-stat-label">Non-stop</span>
          </div>
          <div>
            <span class="theme-stat-number">+100</span>
            <span class="theme-stat-label">Participants</span>
          </div>
          <div>
            <span class="theme-stat-number">3</span>
            <span class="theme-stat-label">Niveaux</span>
          </div>
          <div>
            <span class="theme-stat-number">6ème</span>
            <span class="theme-stat-label">Édition</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- =============== TIMELINE =============== -->
  <section class="hk-section" id="timeline" aria-labelledby="timeline-title">
    <div class="hk-container">
      <div class="hk-divider"><span class="hk-badge">Programme</span></div>
      <h2 class="hk-section-title" id="timeline-title">Chronologie de l'événement</h2>
      <p class="hk-section-subtitle">Toutes les étapes importantes du Technovore Hackathon 2026</p>

      <div class="timeline-grid">
        <div class="hk-timeline">
          <div class="hk-timeline-item active">
            <p class="hk-timeline-date">Octobre 2026</p>
            <h3 class="hk-timeline-title">📋 Inscriptions ouvertes</h3>
            <p class="hk-timeline-desc">Formation des équipes et dépôt des candidatures sur la plateforme. Chaque équipe constitue son groupe et enregistre ses membres.</p>
          </div>
          <div class="hk-timeline-item">
            <p class="hk-timeline-date">Novembre 2026</p>
            <h3 class="hk-timeline-title">📝 Quiz de présélection</h3>
            <p class="hk-timeline-desc">Les équipes passent un quiz en ligne sur la plateforme. Seules les meilleures équipes par niveau sont retenues pour la phase finale.</p>
          </div>
          <div class="hk-timeline-item">
            <p class="hk-timeline-date">Novembre 2026</p>
            <h3 class="hk-timeline-title">📧 Annonce des équipes sélectionnées</h3>
            <p class="hk-timeline-desc">Les résultats de la présélection sont communiqués par email. Les équipes retenues reçoivent leurs instructions pour la phase hackathon.</p>
          </div>
          <div class="hk-timeline-item">
            <p class="hk-timeline-date">Décembre 2026</p>
            <h3 class="hk-timeline-title">🚀 Lancement du Hackathon (J-Day)</h3>
            <p class="hk-timeline-desc">Coup d'envoi officiel du Technovore Hackathon. Les équipes reçoivent le sujet et ont exactement 48h pour développer leur solution.</p>
          </div>
          <div class="hk-timeline-item">
            <p class="hk-timeline-date">Décembre 2026</p>
            <h3 class="hk-timeline-title">🏆 Présentation finale & Remise des prix</h3>
            <p class="hk-timeline-desc">Chaque équipe présente son projet devant un jury d'experts. Les lauréats sont récompensés lors de la cérémonie de clôture.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- =============== PRIZES =============== -->
  <section class="hk-section prizes-section" id="prizes" aria-labelledby="prizes-title">
    <div class="hk-container">
      <div class="hk-divider"><span class="hk-badge">Récompenses</span></div>
      <h2 class="hk-section-title" id="prizes-title">Prix & Récompenses</h2>
      <p class="hk-section-subtitle">Des prix exceptionnels pour les équipes les plus méritantes</p>

      <div class="podium-wrapper">
        <div class="hk-podium">

          <!-- 2ème place -->
          <div class="hk-prize-card silver glass-card">
            <span class="prize-trophy">🥈</span>
            <p class="prize-position">2ème Place</p>
            <div class="hk-prize-rank">2</div>
            <div class="hk-prize-amount">150 000 FCFA</div>
            <ul class="prize-perks">
              <li>Certificats officiels</li>
              <li>Kit développeur</li>
              <li>Networking VIP</li>
            </ul>
          </div>

          <!-- 1ère place -->
          <div class="hk-prize-card gold glass-card">
            <span class="prize-trophy">🏆</span>
            <p class="prize-position">1ère Place</p>
            <div class="hk-prize-rank">1</div>
            <div class="hk-prize-amount">300 000 FCFA</div>
            <ul class="prize-perks">
              <li>Certifications officielles</li>
              <li>Accompagnement startup</li>
              <li>Accès réseau partenaires</li>
            </ul>
          </div>

          <!-- 3ème place -->
          <div class="hk-prize-card bronze glass-card">
            <span class="prize-trophy">🥉</span>
            <p class="prize-position">3ème Place</p>
            <div class="hk-prize-rank">3</div>
            <div class="hk-prize-amount">75 000 FCFA</div>
            <ul class="prize-perks">
              <li>Certificats officiels</li>
              <li>Kit développeur</li>
              <li>Mentorat</li>
            </ul>
          </div>

        </div>

        <!-- Mention spéciale -->
        <div class="glass-card" style="max-width:500px;margin:40px auto 0;padding:28px;text-align:center;">
          <p style="font-family:var(--font-display);font-size:0.7rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--neon-cyan);margin-bottom:8px;">Mention Spéciale</p>
          <p style="font-size:1rem;font-weight:600;color:var(--text-primary);margin-bottom:6px;">🌟 Prix Innovation</p>
          <p style="font-size:0.9rem;color:var(--text-muted);">Récompensant l'équipe ayant la solution la plus créative et à fort impact social.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- =============== SPONSORS =============== -->
  <section class="hk-section" id="sponsors" aria-labelledby="sponsors-title">
    <div class="hk-container">
      <div class="hk-divider"><span class="hk-badge">Organisateurs & Partenaires</span></div>
      <h2 class="hk-section-title" id="sponsors-title">Ils rendent tout possible</h2>
      <p class="hk-section-subtitle">Le Technovore Hackathon est organisé par le C2E avec le soutien de l'ESATIC et de ses partenaires</p>

      <p class="sponsors-title-sm">Organisateurs principaux</p>
      <div class="hk-sponsors-grid" style="margin-bottom:48px;">
        <div class="hk-sponsor-card neon-border-cyan">
          <img src="{{asset('images/app/logoEsatic-PhotoRoom.png')}}" alt="ESATIC — École Supérieure Africaine des TIC">
        </div>
        <div class="hk-sponsor-card neon-border-cyan">
          <img src="{{asset('images/app/logoC2E-PhotoRoom.png')}}" alt="C2E — Conseil Estudiantin de l'ESATIC">
        </div>
        <div class="hk-sponsor-card neon-border-cyan">
          <img src="{{asset('images/app/logoSDI-PhotoRoom.png')}}" alt="SDI — Hackathon">
        </div>
      </div>

      <p class="sponsors-title-sm">Partenaires</p>
      <div class="hk-sponsors-grid">
        <div class="hk-sponsor-card" style="min-width:160px;">
          <div style="text-align:center;">
            <div style="font-family:var(--font-display);font-size:1.2rem;font-weight:700;color:var(--text-muted);">Partenaire</div>
            <div style="font-size:0.7rem;color:var(--text-muted);letter-spacing:0.1em;">À venir</div>
          </div>
        </div>
        <div class="hk-sponsor-card" style="min-width:160px;">
          <div style="text-align:center;">
            <div style="font-family:var(--font-display);font-size:1.2rem;font-weight:700;color:var(--text-muted);">Partenaire</div>
            <div style="font-size:0.7rem;color:var(--text-muted);letter-spacing:0.1em;">À venir</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- =============== FAQ =============== -->
  <section class="hk-section" id="faq" aria-labelledby="faq-title" style="background:rgba(10,22,40,0.4);">
    <div class="hk-container">
      <div class="hk-divider"><span class="hk-badge">FAQ</span></div>
      <h2 class="hk-section-title" id="faq-title">Questions fréquentes</h2>
      <p class="hk-section-subtitle">Tout ce que vous devez savoir sur le Technovore Hackathon 2026</p>

      <div class="faq-grid" id="faq-list">

        <div class="hk-faq-item">
          <button class="hk-faq-question" aria-expanded="false" id="faq-q1" aria-controls="faq-a1">
            Qui peut participer au hackathon ?
            <span class="hk-faq-icon" aria-hidden="true">+</span>
          </button>
          <div class="hk-faq-answer" id="faq-a1" role="region" aria-labelledby="faq-q1">
            Le hackathon est ouvert à tous les étudiants de l'ESATIC, qu'ils soient en Licence ou en Master. Les participants doivent s'inscrire en équipe de 3 à 5 membres.
          </div>
        </div>

        <div class="hk-faq-item">
          <button class="hk-faq-question" aria-expanded="false" id="faq-q2" aria-controls="faq-a2">
            Comment se forme une équipe ?
            <span class="hk-faq-icon" aria-hidden="true">+</span>
          </button>
          <div class="hk-faq-answer" id="faq-a2" role="region" aria-labelledby="faq-q2">
            Un chef d'équipe crée le groupe lors de l'inscription et invite les autres membres. Chaque membre reçoit un accès à son espace personnel après l'inscription. Les équipes sont regroupées par niveau (Licence 1, Licence 2, Master, etc.).
          </div>
        </div>

        <div class="hk-faq-item">
          <button class="hk-faq-question" aria-expanded="false" id="faq-q3" aria-controls="faq-a3">
            Qu'est-ce que la phase de présélection ?
            <span class="hk-faq-icon" aria-hidden="true">+</span>
          </button>
          <div class="hk-faq-answer" id="faq-a3" role="region" aria-labelledby="faq-q3">
            Avant le hackathon proprement dit, chaque équipe doit passer un quiz en ligne sur la plateforme. Ce quiz permet de sélectionner les équipes les plus préparées pour participer à la compétition finale. Les résultats sont communiqués par email.
          </div>
        </div>

        <div class="hk-faq-item">
          <button class="hk-faq-question" aria-expanded="false" id="faq-q4" aria-controls="faq-a4">
            La restauration est-elle prise en charge ?
            <span class="hk-faq-icon" aria-hidden="true">+</span>
          </button>
          <div class="hk-faq-answer" id="faq-a4" role="region" aria-labelledby="faq-q4">
            Oui ! Pour toutes les équipes sélectionnées, la restauration est entièrement prise en charge : repas le vendredi soir, samedi (matin, midi, soir) et dimanche (matin, midi). Des collations nocturnes sont également prévues (22h30, 00h30, 03h30).
          </div>
        </div>

        <div class="hk-faq-item">
          <button class="hk-faq-question" aria-expanded="false" id="faq-q5" aria-controls="faq-a5">
            Comment est utilisé le QR Code de mon profil ?
            <span class="hk-faq-icon" aria-hidden="true">+</span>
          </button>
          <div class="hk-faq-answer" id="faq-a5" role="region" aria-labelledby="faq-q5">
            Chaque participant sélectionné dispose d'un QR Code unique accessible depuis son espace personnel. Ce code est scanné à chaque moment de restauration pour valider l'accès. Un code déjà utilisé ne peut pas être scanné deux fois pour le même repas.
          </div>
        </div>

        <div class="hk-faq-item">
          <button class="hk-faq-question" aria-expanded="false" id="faq-q6" aria-controls="faq-a6">
            Comment contacter l'organisation ?
            <span class="hk-faq-icon" aria-hidden="true">+</span>
          </button>
          <div class="hk-faq-answer" id="faq-a6" role="region" aria-labelledby="faq-q6">
            Vous pouvez contacter le Conseil Estudiantin de l'ESATIC (C2E) via les canaux officiels de l'association sur les réseaux sociaux ou en vous rendant au bureau des étudiants sur le campus ESATIC.
          </div>
        </div>

      </div><!-- /#faq-list -->
    </div>
  </section>

  <!-- =============== FOOTER =============== -->
  <footer class="hk-footer" role="contentinfo">
    <div class="hk-container">
      <div style="display:flex;align-items:center;justify-content:center;gap:20px;margin-bottom:24px;flex-wrap:wrap;">
        <img src="{{asset('images/app/logoEsatic-PhotoRoom.png')}}" alt="ESATIC" style="height:36px;filter:brightness(0.6);">
        <img src="{{asset('images/app/logoC2E-PhotoRoom.png')}}" alt="C2E" style="height:36px;filter:brightness(0.6);">
        <img src="{{asset('images/app/logoSDI-PhotoRoom.png')}}" alt="SDI" style="height:36px;filter:brightness(0.6);">
      </div>
      <p class="hk-footer-text">
        <strong style="color:var(--neon-cyan);">Technovore Hackathon 2026</strong><br>
        Organisé par le <strong>Conseil Estudiantin de l'ESATIC (C2E)</strong><br>
        <span style="margin-top:12px;display:block;opacity:0.5;">© 2026 C2E — ESATIC. Tous droits réservés.</span>
      </p>
    </div>
  </footer>

  <!-- =============== SCRIPTS =============== -->
  <script>
    // --- NAVBAR scroll effect ---
    const navbar = document.getElementById('hk-navbar');
    window.addEventListener('scroll', () => {
      navbar.classList.toggle('scrolled', window.scrollY > 50);
    }, { passive: true });

    // --- COUNTDOWN ---
    (function () {
      const hackathonDate = new Date('2026-12-04T08:00:00');

      function pad(n) { return String(n).padStart(2, '0'); }

      function tick() {
        const now = new Date();
        const diff = hackathonDate - now;

        if (diff <= 0) {
          document.getElementById('countdown').innerHTML =
            '<div style="font-family:var(--font-display);font-size:1.5rem;font-weight:700;color:var(--neon-orange);text-shadow:var(--glow-orange);">🚀 Le Hackathon a commencé !</div>';
          return;
        }

        const days    = Math.floor(diff / 86400000);
        const hours   = Math.floor((diff % 86400000) / 3600000);
        const minutes = Math.floor((diff % 3600000) / 60000);
        const seconds = Math.floor((diff % 60000) / 1000);

        document.getElementById('cd-days').textContent    = pad(days);
        document.getElementById('cd-hours').textContent   = pad(hours);
        document.getElementById('cd-minutes').textContent = pad(minutes);
        document.getElementById('cd-seconds').textContent = pad(seconds);
      }

      tick();
      setInterval(tick, 1000);
    })();

    // --- FAQ ACCORDION ---
    document.querySelectorAll('.hk-faq-question').forEach(btn => {
      btn.addEventListener('click', () => {
        const item     = btn.closest('.hk-faq-item');
        const isOpen   = item.classList.contains('open');

        document.querySelectorAll('.hk-faq-item').forEach(el => {
          el.classList.remove('open');
          el.querySelector('.hk-faq-question').setAttribute('aria-expanded', 'false');
        });

        if (!isOpen) {
          item.classList.add('open');
          btn.setAttribute('aria-expanded', 'true');
        }
      });
    });

    // --- INTERSECTION OBSERVER for fade-in on scroll ---
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });

    document.querySelectorAll('.hk-timeline-item, .hk-prize-card, .hk-sponsor-card, .hk-faq-item, .theme-card').forEach(el => {
      el.style.opacity = '0';
      el.style.transform = 'translateY(24px)';
      el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
      observer.observe(el);
    });
  </script>

</body>
</html>