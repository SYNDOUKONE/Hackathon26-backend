<x-app-layout>
  <x-slot name="header">
    <div style="display:flex;align-items:center;gap:12px;">
      <svg width="20" height="20" fill="none" stroke="var(--neon-cyan)" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
        <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
      </svg>
      <h2 style="font-family:var(--font-display);font-size:1rem;font-weight:700;color:var(--text-primary);letter-spacing:0.08em;text-transform:uppercase;">
        Espace SDI — Tableau de bord
      </h2>
    </div>
  </x-slot>

  <div style="padding:32px 24px;max-width:1200px;margin:0 auto;">

    <!-- Welcome Banner -->
    <div class="glass-card" style="padding:28px 32px;margin-bottom:28px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;border-color:rgba(0,245,255,0.2);">
      <div>
        <p style="font-size:0.75rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--neon-cyan);margin-bottom:6px;font-family:var(--font-display);">Bienvenue</p>
        <h1 style="font-family:var(--font-display);font-size:1.4rem;font-weight:800;color:var(--text-primary);">
          {{ Auth::user()->etudiant->nom ?? Auth::user()->name }}
          @if(Auth::user()->etudiant && Auth::user()->etudiant->currentEquipe())
            <span style="color:var(--neon-orange);">· {{ Auth::user()->etudiant->currentEquipe()->nom ?? '' }}</span>
          @endif
        </h1>
      </div>
      <div style="display:flex;align-items:center;gap:8px;">
        <div style="width:10px;height:10px;border-radius:50%;background:var(--neon-cyan);box-shadow:var(--glow-cyan);animation:pulse 2s ease-in-out infinite;" aria-hidden="true"></div>
        <span style="font-size:0.8rem;color:var(--text-muted);">Session active</span>
      </div>
    </div>

    <!-- Main grid -->
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:24px;">

      {{-- ---- CARD 1 : Infos équipe ---- --}}
      <div class="glass-card" style="padding:28px;">
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:20px;">
          <div style="width:36px;height:36px;border-radius:8px;background:var(--neon-cyan-dim);border:1px solid var(--glass-border);display:flex;align-items:center;justify-content:center;" aria-hidden="true">
            <svg width="18" height="18" fill="none" stroke="var(--neon-cyan)" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          </div>
          <h3 style="font-family:var(--font-display);font-size:0.85rem;font-weight:700;color:var(--text-primary);letter-spacing:0.08em;text-transform:uppercase;">Mon Équipe</h3>
        </div>

        @if(Auth::user()->etudiant && Auth::user()->etudiant->currentEquipe())
          <div style="margin-bottom:16px;">
            <p style="font-size:0.7rem;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.1em;">Équipe</p>
            <p style="font-size:1.3rem;font-weight:700;color:var(--neon-cyan);">{{ Auth::user()->etudiant->currentEquipe()->nom }}</p>
          </div>
          <div style="margin-bottom:20px;">
            <p style="font-size:0.7rem;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.1em;">Catégorie</p>
            <p style="font-size:0.9rem;color:var(--text-primary);">{{ Auth::user()->etudiant->currentEquipe()->libelle }}</p>
          </div>

          <div style="border-top:1px solid var(--glass-border);padding-top:16px;">
            <p style="font-size:0.7rem;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.1em;margin-bottom:12px;">Membres</p>
            @foreach(Auth::user()->etudiant->getEquipe()->participants as $participant)
              <div style="display:flex;align-items:center;gap:10px;padding:8px 0;border-bottom:1px solid rgba(255,255,255,0.04);">
                <div style="width:32px;height:32px;border-radius:50%;background:var(--neon-cyan-dim);border:1px solid var(--glass-border);display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-size:0.7rem;font-weight:700;color:var(--neon-cyan);flex-shrink:0;" aria-hidden="true">
                  {{ strtoupper(substr($participant->etudiant->nom ?? '?', 0, 1)) }}
                </div>
                <div style="min-width:0;">
                  <p style="font-size:0.9rem;font-weight:600;color:var(--text-primary);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                    {{ $participant->etudiant->nom ?? 'Inconnu' }} {{ $participant->etudiant->prenom ?? '' }}
                  </p>
                  <p style="font-size:0.75rem;color:var(--neon-orange);">{{ $participant->etudiant->matricule ?? 'N/A' }}</p>
                </div>
              </div>
            @endforeach
            <a href="{{ route('equipe.gestion') }}" style="display:block;text-align:center;margin-top:16px;font-size:0.75rem;color:var(--neon-cyan);font-weight:700;text-decoration:none;text-transform:uppercase;letter-spacing:0.05em;transition:var(--transition);border:1px solid rgba(0,245,255,0.2);padding:6px;border-radius:6px;">Gérer mon Équipe →</a>
          </div>
          </div>
        @else
          <div style="text-align:center;padding:20px 0;">
            <div style="font-size:3rem;margin-bottom:12px;" aria-hidden="true">🛡️</div>
            <p style="font-size:0.95rem;font-weight:600;color:var(--text-primary);margin-bottom:6px;">Espace Administrateur ou En attente d'équipe</p>
            <p style="font-size:0.85rem;color:var(--text-muted);">Bienvenue sur votre tableau de bord</p>
          </div>
        @endif
      </div>

      {{-- ---- CARD 2 : Statut / Quiz ---- --}}
      <div class="glass-card" style="padding:28px;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;min-height:280px;">

        @if(Auth::user()->etudiant && Auth::user()->etudiant->getEquipe())
          @php
            $equipe = Auth::user()->etudiant->getEquipe();
            $qsession = $equipe->qsession;
            $quiz = $equipe->niveau ? $equipe->niveau->quiz : null;
          @endphp

          <div style="display:flex;align-items:center;gap:10px;margin-bottom:20px;align-self:flex-start;">
            <div style="width:36px;height:36px;border-radius:8px;background:var(--neon-orange-dim);border:1px solid var(--glass-border-o);display:flex;align-items:center;justify-content:center;" aria-hidden="true">
              <svg width="18" height="18" fill="none" stroke="var(--neon-orange)" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
            </div>
            <h3 style="font-family:var(--font-display);font-size:0.85rem;font-weight:700;color:var(--text-primary);letter-spacing:0.08em;text-transform:uppercase;">Statut</h3>
          </div>

          @if($equipe->statut != 0)
            {{-- Sélectionné ! --}}
            <div style="font-size:3.5rem;margin-bottom:16px;" aria-hidden="true">🏆</div>
            <p style="font-family:var(--font-display);font-size:1.2rem;font-weight:800;color:var(--neon-orange);text-shadow:0 0 20px rgba(255,200,50,0.5);margin-bottom:8px;">Sélectionné !</p>
            <p style="font-size:0.9rem;color:var(--text-muted);">Félicitations ! Votre équipe est sélectionnée pour le Hackathon.</p>
          @else
            {{-- Pas encore sélectionné --}}
            @if($equipe->niveau && $equipe->niveau->quiz_available == 1)
              @if($quiz && $quiz->state == 1)
                {{-- Quiz Ouvert --}}
                @if(!$qsession || ($qsession->state == 0 && $qsession->score == 0))
                  <div style="font-size:2.5rem;margin-bottom:16px;" aria-hidden="true">📝</div>
                  <p style="font-family:var(--font-display);font-size:1rem;font-weight:700;color:var(--neon-cyan);margin-bottom:8px;">Quiz ouvert !</p>
                  <p style="font-size:0.9rem;color:var(--text-muted);line-height:1.6;">
                    Le quiz de présélection est disponible. Rendez-vous dans l'espace <span style="color:var(--neon-orange);font-weight:600;">Présélection</span> de votre chef d'équipe pour commencer le test.
                  </p>
                @elseif($qsession && $qsession->state == 1)
                  {{-- Quiz Soumis --}}
                  <div style="font-size:2.5rem;margin-bottom:16px;" aria-hidden="true">✅</div>
                  <p style="font-family:var(--font-display);font-size:1rem;font-weight:700;color:var(--neon-cyan);margin-bottom:8px;">Quiz terminé</p>
                  <p style="font-size:0.9rem;color:var(--text-muted);">Les résultats seront bientôt disponibles. Patience !</p>
                @endif
              @else
                {{-- Quiz Fermé --}}
                @if($qsession && $qsession->state == 1)
                  <div style="font-size:2.5rem;margin-bottom:16px;" aria-hidden="true">✅</div>
                  <p style="font-size:0.95rem;font-weight:600;color:var(--neon-cyan);margin-bottom:8px;">Quiz terminé !</p>
                  <p style="font-size:0.85rem;color:var(--text-muted);">Les résultats seront bientôt disponibles.</p>
                @else
                  <div style="font-size:2.5rem;margin-bottom:16px;" aria-hidden="true">🔒</div>
                  <p style="font-size:0.95rem;font-weight:600;color:var(--text-primary);">Les quiz sont fermés.</p>
                  <p style="font-size:0.85rem;color:var(--text-muted);">Veuillez patienter jusqu'à l'ouverture officielle.</p>
                @endif
              @endif
            @else
              {{-- Pas de quiz pour ce niveau --}}
              <div style="font-size:2.5rem;margin-bottom:16px;" aria-hidden="true">📋</div>
              <p style="font-size:0.9rem;color:var(--text-muted);line-height:1.7;">
                Chèr capitaine, munissez-vous avec votre équipe de <span style="color:var(--neon-orange);font-weight:600;">documents</span> attestant votre inscription en Master (reçu, certificat de scolarité, etc.).
                Ils seront contrôlés le <span style="color:var(--neon-orange);font-weight:600;">Jour J</span> du lancement.
              </p>
            @endif
          @endif
        @else
          <div style="font-size:3rem;margin-bottom:16px;" aria-hidden="true">🔐</div>
          <p style="font-size:0.95rem;font-weight:600;color:var(--text-primary);">Espace Administrateur ou Utilisateur sans profil étudiant</p>
        @endif
      </div>

      {{-- ---- CARD 3 : Infos Hackathon ---- --}}
      <div class="glass-card" style="padding:28px;">
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:20px;">
          <div style="width:36px;height:36px;border-radius:8px;background:rgba(255,107,53,0.1);border:1px solid rgba(255,107,53,0.2);display:flex;align-items:center;justify-content:center;" aria-hidden="true">
            <svg width="18" height="18" fill="none" stroke="var(--neon-orange)" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
          </div>
          <h3 style="font-family:var(--font-display);font-size:0.85rem;font-weight:700;color:var(--text-primary);letter-spacing:0.08em;text-transform:uppercase;">Infos Hackathon</h3>
        </div>

        <div style="display:flex;flex-direction:column;gap:16px;">
          <div style="background:rgba(0,245,255,0.04);border:1px solid rgba(0,245,255,0.1);border-radius:8px;padding:16px;">
            <div style="display:flex;align-items:center;gap:8px;margin-bottom:8px;">
              <span style="color:var(--neon-orange);font-weight:700;font-family:var(--font-display);font-size:0.8rem;">🍽️ HACKEAT</span>
            </div>
            <p style="font-size:0.85rem;color:var(--text-muted);line-height:1.6;">
              La restauration est assurée pour les équipes sélectionnées :
            </p>
            <ul style="list-style:none;margin-top:8px;display:flex;flex-direction:column;gap:4px;">
              <li style="font-size:0.8rem;color:var(--text-muted);display:flex;gap:6px;"><span style="color:var(--neon-cyan);">▸</span> Vendredi & Samedi — matin, midi, soir</li>
              <li style="font-size:0.8rem;color:var(--text-muted);display:flex;gap:6px;"><span style="color:var(--neon-cyan);">▸</span> Dimanche — matin et midi</li>
            </ul>
          </div>

          <div style="background:rgba(255,107,53,0.04);border:1px solid rgba(255,107,53,0.1);border-radius:8px;padding:16px;">
            <div style="display:flex;align-items:center;gap:8px;margin-bottom:8px;">
              <span style="color:var(--neon-orange);font-weight:700;font-family:var(--font-display);font-size:0.8rem;">🌙 HACKNIGHT</span>
            </div>
            <p style="font-size:0.85rem;color:var(--text-muted);line-height:1.6;">
              Collations nocturnes (Ven. & Sam.) :
            </p>
            <p style="font-size:0.85rem;color:var(--neon-cyan);font-weight:600;font-family:var(--font-display);margin-top:6px;letter-spacing:0.05em;">
              22h30 · 00h30 · 03h30
            </p>
          </div>
        </div>
      </div>

    <!-- Timeline Hackathon -->
    <div style="margin-top:32px;">
      <div style="display:flex;align-items:center;gap:10px;margin-bottom:24px;">
        <div style="width:36px;height:36px;border-radius:8px;background:var(--neon-orange-dim);border:1px solid var(--glass-border-o);display:flex;align-items:center;justify-content:center;" aria-hidden="true">
          <svg width="18" height="18" fill="none" stroke="var(--neon-orange)" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <h3 style="font-family:var(--font-display);font-size:0.85rem;font-weight:700;color:var(--text-primary);letter-spacing:0.08em;text-transform:uppercase;">Parcours du Hackathon</h3>
      </div>

      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:20px;">
        <!-- Step 1 -->
        <div class="glass-card" style="padding:24px;border-left:4px solid var(--neon-cyan);position:relative;overflow:hidden;">
          <div style="position:absolute;right:-10px;top:-10px;font-size:4rem;opacity:0.05;font-weight:900;color:var(--neon-cyan);" aria-hidden="true">01</div>
          <div style="display:flex;align-items:center;gap:12px;margin-bottom:12px;">
            <span style="background:var(--neon-cyan);color:#0a1628;font-weight:800;font-size:0.65rem;padding:2px 8px;border-radius:4px;text-transform:uppercase;">Ouvert</span>
            <h4 style="font-family:var(--font-display);font-size:1rem;font-weight:700;color:var(--text-primary);">📋 Inscriptions</h4>
          </div>
          <p style="font-size:0.9rem;color:var(--text-muted);line-height:1.6;">
            Formation des équipes et dépôt des candidatures sur la plateforme. Chaque équipe constitue son groupe et enregistre ses membres.
          </p>
        </div>

        <!-- Step 2 -->
        <div class="glass-card" style="padding:24px;border-left:4px solid var(--neon-orange);position:relative;overflow:hidden;">
          <div style="position:absolute;right:-10px;top:-10px;font-size:4rem;opacity:0.05;font-weight:900;color:var(--neon-orange);" aria-hidden="true">02</div>
          <div style="display:flex;align-items:center;gap:12px;margin-bottom:12px;">
            <span style="background:var(--neon-orange);color:#0a1628;font-weight:800;font-size:0.65rem;padding:2px 8px;border-radius:4px;text-transform:uppercase;">Novembre 2026</span>
            <h4 style="font-family:var(--font-display);font-size:1rem;font-weight:700;color:var(--text-primary);">📝 Quiz de présélection</h4>
          </div>
          <p style="font-size:0.9rem;color:var(--text-muted);line-height:1.6;">
            Les équipes passent un quiz en ligne sur la plateforme. Seules les meilleures équipes par niveau sont retenues pour la phase finale.
          </p>
        </div>

        <!-- Step 3 -->
        <div class="glass-card" style="padding:24px;border-left:4px solid #fff;position:relative;overflow:hidden;">
          <div style="position:absolute;right:-10px;top:-10px;font-size:4rem;opacity:0.05;font-weight:900;color:#fff;" aria-hidden="true">03</div>
            <div style="display:flex;align-items:center;gap:12px;margin-bottom:12px;">
              <span style="background:rgba(255,255,255,0.2);color:var(--text-primary);font-weight:800;font-size:0.65rem;padding:2px 8px;border-radius:4px;text-transform:uppercase;">Finalité</span>
              <h4 style="font-family:var(--font-display);font-size:1rem;font-weight:700;color:var(--text-primary);">📧 Annonce des résultats</h4>
            </div>
            <p style="font-size:0.9rem;color:var(--text-muted);line-height:1.6;">
              Les résultats de la présélection sont communiqués par email.
            </p>
          </div>
        </div>
      </div>
    </div>


  <style>
    @keyframes pulse {
      0% , 100% { box-shadow: 0 0 0 0 rgba(0,245,255,0.4); }
      50%       { box-shadow: 0 0 0 8px rgba(0,245,255,0); }
    }
    .glass-card {
      background: rgba(10, 22, 40, 0.7);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border: 1px solid rgba(0, 245, 255, 0.12);
      border-radius: 16px;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .glass-card:hover {
      border-color: rgba(0, 245, 255, 0.3);
    }
  </style>
</x-app-layout>
