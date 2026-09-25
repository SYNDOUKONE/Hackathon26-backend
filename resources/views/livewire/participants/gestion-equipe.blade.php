<div style="padding:32px 24px;max-width:1200px;margin:0 auto;">

    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:32px;gap:16px;flex-wrap:wrap;">
        <div>
            <h1 style="font-family:var(--font-display);font-size:1.8rem;font-weight:800;color:var(--text-primary);margin-bottom:4px;">Gestion de l'Équipe</h1>
            <p style="color:var(--text-muted);font-size:0.9rem;">Ajoutez ou gérez les membres de votre équipe de hackathon.</p>
        </div>
        <a href="{{ route('dashboard') }}" style="padding:8px 16px;background:rgba(255,255,255,0.05);border:1px solid var(--glass-border);color:var(--text-primary);border-radius:8px;font-size:0.85rem;text-decoration:none;transition:var(--transition);">← Retour Dashboard</a>
    </div>

    @if (session()->has('success'))
        <div style="background:rgba(0,255,127,0.1);border:1px solid rgba(0,255,127,0.2);color:#00ff7f;padding:12px 16px;border-radius:8px;margin-bottom:24px;font-size:0.9rem;">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div style="background:rgba(255,64,64,0.1);border:1px solid rgba(255,64,64,0.2);color:#ff4040;padding:12px 16px;border-radius:8px;margin-bottom:24px;font-size:0.9rem;">
            {{ session('error') }}
        </div>
    @endif

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(350px,1fr));gap:32px;">

        <!-- Formulaire d'ajout -->
        <div class="glass-card" style="padding:32px;">
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:24px;">
                <div style="width:36px;height:36px;border-radius:8px;background:var(--neon-cyan-dim);border:1px solid var(--glass-border);display:flex;align-items:center;justify-content:center;">
                    <svg width="18" height="18" fill="none" stroke="var(--neon-cyan)" stroke-width="2" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"/></svg>
                </div>
                <h3 style="font-family:var(--font-display);font-size:0.85rem;font-weight:700;color:var(--text-primary);letter-spacing:0.08em;text-transform:uppercase;">Ajouter un membre</h3>
            </div>

            <form wire:submit.prevent="addMembre" style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div style="grid-column:span 2;">
                    <label style="display:block;font-size:0.7rem;color:var(--text-muted);text-transform:uppercase;margin-bottom:6px;letter-spacing:0.05em;">Nom complet</label>
                    <input type="text" wire:model="nom_membre" style="width:100%;background:rgba(0,0,0,0.2);border:1px solid var(--glass-border);border-radius:6px;padding:10px;color:var(--text-primary);font-size:0.9rem;outline:none;" placeholder="Ex: KONAN">
                </div>
                <div style="grid-column:span 2;">
                    <label style="display:block;font-size:0.7rem;color:var(--text-muted);text-transform:uppercase;margin-bottom:6px;letter-spacing:0.05em;">Prénom</label>
                    <input type="text" wire:model="prenom_membre" style="width:100%;background:rgba(0,0,0,0.2);border:1px solid var(--glass-border);border-radius:6px;padding:10px;color:var(--text-primary);font-size:0.9rem;outline:none;" placeholder="Ex: Koffi">
                </div>
                <div style="grid-column:span 2;">
                    <label style="display:block;font-size:0.7rem;color:var(--text-muted);text-transform:uppercase;margin-bottom:6px;letter-spacing:0.05em;">Classe / École</label>
                    <input type="text" wire:model="classe_membre" style="width:100%;background:rgba(0,0,0,0.2);border:1px solid var(--glass-border);border-radius:6px;padding:10px;color:var(--text-primary);font-size:0.9rem;outline:none;" placeholder="Ex: Master 1 Info">
                </div>
                <div style="grid-column:span 2;">
                    <label style="display:block;font-size:0.7rem;color:var(--text-muted);text-transform:uppercase;margin-bottom:6px;letter-spacing:0.05em;">Email</label>
                    <input type="email" wire:model="email_membre" style="width:100%;background:rgba(0,0,0,0.2);border:1px solid var(--glass-border);border-radius:6px;padding:10px;color:var(--text-primary);font-size:0.9rem;outline:none;" placeholder="email@example.com">
                </div>
                <div style="grid-column:span 2;">
                    <label style="display:block;font-size:0.7rem;color:var(--text-muted);text-transform:uppercase;margin-bottom:6px;letter-spacing:0.05em;">Genre</label>
                    <select wire:model="genre_membre" style="width:100%;background:rgba(0,0,0,0.2);border:1px solid var(--glass-border);border-radius:6px;padding:10px;color:var(--text-primary);font-size:0.9rem;outline:none;">
                        <option value="g">Garçon</option>
                        <option value="f">Fille</option>
                    </select>
                </div>

                <button type="submit" style="grid-column:span 2;background:var(--neon-cyan);color:#0a1628;padding:12px;border-radius:8px;font-weight:700;font-family:var(--font-display);text-transform:uppercase;letter-spacing:0.05em;cursor:pointer;transition:var(--transition);border:none;margin-top:12px;">
                    Ajouter au Groupe
                </button>
            </form>
        </div>

        <!-- Liste des membres -->
        <div class="glass-card" style="padding:32px;">
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:24px;">
                <div style="width:36px;height:36px;border-radius:8px;background:rgba(0,245,255,0.1);border:1px solid var(--glass-border);display:flex;align-items:center;justify-content:center;">
                    <svg width="18" height="18" fill="none" stroke="var(--neon-cyan)" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <h3 style="font-family:var(--font-display);font-size:0.85rem;font-weight:700;color:var(--text-primary);letter-spacing:0.08em;text-transform:uppercase;">Membres Actuels ({{ count($membres) }}/3)</h3>
            </div>

            <div style="display:flex;flex-direction:column;gap:12px;">
                @forelse($membres as $membre)
                    <div style="display:flex;align-items:center;justify-content:space-between;padding:12px;background:rgba(255,255,255,0.03);border:1px solid var(--glass-border);border-radius:12px;transition:var(--transition);">
                        <div style="display:flex;align-items:center;gap:12px;">
                            <div style="width:36px;height:36px;border-radius:50%;background:var(--neon-cyan-dim);display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-weight:700;color:var(--neon-cyan);font-size:0.8rem;flex-shrink:0;">
                                {{ strtoupper(substr($membre->etudiant->nom, 0, 1)) }}
                            </div>
                            <div>
                                <p style="font-size:0.9rem;font-weight:600;color:var(--text-primary);margin:0;">{{ $membre->etudiant->nom }} {{ $membre->etudiant->prenom }}</p>
                                <p style="font-size:0.75rem;color:var(--text-muted);margin:0;">{{ $membre->etudiant->matricule }}</p>
                            </div>
                        </div>
                        @if(!$membre->chef)
                            <button wire:click="removeMembre({{ $membre->id }})" style="background:none;border:none;color:var(--neon-orange);cursor:pointer;padding:8px;transition:var(--transition);" title="Supprimer membre">
                                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        @else
                            <span style="font-size:0.7rem;color:var(--neon-cyan);font-weight:700;text-transform:uppercase;background:rgba(0,245,255,0.1);padding:2px 6px;border-radius:4px;">Chef</span>
                        @endif
                    </div>
                @empty
                    <p style="text-align:center;color:var(--text-muted);font-size:0.85rem;padding:20px 0;">Aucun membre ajouté pour le moment.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>