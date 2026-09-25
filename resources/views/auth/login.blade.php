<x-guest-layout>
  <div style="text-align:center;margin-bottom:36px;">
    <a href="{{ route('welcome', null, false) }}">
      <img src="{{ asset('images/app/logoSDI-PhotoRoom.png') }}" alt="Hackathon 2026" style="height:56px;filter:drop-shadow(0 0 16px rgba(0,245,255,0.4));margin-bottom:16px;">
    </a>
    <h1 style="font-family:var(--font-display);font-size:1.5rem;font-weight:800;background:linear-gradient(135deg,#ffffff,var(--neon-cyan));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;letter-spacing:0.05em;">
      TECHNOVORE 2026
    </h1>
    <p style="color:var(--text-muted);font-size:0.85rem;margin-top:6px;letter-spacing:0.05em;">
      Connectez-vous à votre espace
    </p>
  </div>

  <!-- Card -->
  <div class="glass-card neon-border-cyan" style="padding:40px 36px;">

    <x-jet-validation-errors style="margin-bottom:20px;padding:14px 18px;background:rgba(255,64,96,0.08);border:1px solid rgba(255,64,96,0.3);border-radius:8px;color:#ff4060;font-size:0.875rem;" />

    @if(session('status'))
      <div style="margin-bottom:20px;padding:14px 18px;background:rgba(0,245,255,0.08);border:1px solid rgba(0,245,255,0.3);border-radius:8px;color:var(--neon-cyan);font-size:0.875rem;">
        {{ session('status') }}
      </div>
    @endif

    <form method="POST" action="{{ route('login', null, false) }}" id="login-form">
      @csrf

      <div style="margin-bottom:24px;">
        <label class="hk-label" for="email">Adresse Email</label>
        <input
          id="email"
          class="hk-input"
          type="email"
          name="email"
          value="{{ old('email') }}"
          required
          autofocus
          autocomplete="username"
          placeholder="votre@email.com"
        >
      </div>

      <div style="margin-bottom:32px;">
        <label class="hk-label" for="password">Mot de passe</label>
        <input
          id="password"
          class="hk-input"
          type="password"
          name="password"
          required
          autocomplete="current-password"
          placeholder="••••••••"
        >
      </div>

      <button type="submit" class="btn-primary" style="width:100%;justify-content:center;" id="login-submit-btn">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4M10 17l5-5-5-5M15 12H3"/>
        </svg>
        Se connecter
      </button>
    </form>
  </div>

  <!-- Footer link -->
  <p style="text-align:center;margin-top:20px;color:var(--text-muted);font-size:0.85rem;">
    <a href="{{ route('welcome', null, false) }}" style="color:var(--neon-cyan);text-decoration:none;transition:var(--transition);"
       onmouseover="this.style.textShadow='var(--glow-cyan)'" onmouseout="this.style.textShadow='none'">
      ← Retour à l'accueil
    </a>
  </p>
</x-guest-layout>
