<div x-data="{ activeTab: 0, tabs: [0, 1] }" style="max-width: 700px; margin: 0 auto; padding: 20px;">
    <form wire:submit.prevent="createEquipe">
        @csrf

        <div x-show="activeTab===0" style="display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 60vh;">
            <div class="tete" style="text-align: center; margin-bottom: 40px;">
                <h1 class="titre" style="color: #FFFFFF; font-family: var(--font-display); font-size: 2.5rem; font-weight: 900; text-transform: uppercase; letter-spacing: 2px;">Inscription</h1>
                <p style="color: var(--neon-cyan); font-weight: bold; font-size: 1.1rem; text-transform: uppercase; letter-spacing: 1px;">Étape 1 : Profil Utilisateur</p>
            </div>

            <div class="champs" style="background: rgba(10, 22, 40, 0.6); padding: 40px; border-radius: 20px; border: 1px solid rgba(0, 245, 255, 0.2); backdrop-filter: blur(10px); width: 100%; max-width: 500px; box-shadow: 0 0 30px rgba(0,0,0,0.5);">
                <div class="groupe" style="text-align: center;">
                    <h2 class="tchamp" style="color: #FFFFFF; font-size: 1.4rem; margin-bottom: 30px; font-weight: 700; font-family: var(--font-display);">Êtes-vous étudiant à l'ESATIC ?</h2>
                    <div class="gr" style="display: flex; justify-content: center; gap: 40px; align-items: center; font-size: 1.2rem;">
                        <label style="color: #FFFFFF; cursor: pointer; font-weight: 600; display: flex; align-items: center; gap: 10px;">
                            <input type="radio" value="1" wire:model="esatic" style="cursor: pointer; accent-color: var(--neon-cyan); transform: scale(1.3);" />
                            <span style="color: #000000 !important;">Oui</span>
                        </label>
                        <label style="color: #FFFFFF; cursor: pointer; font-weight: 600; display: flex; align-items: center; gap: 10px;">
                            <input type="radio" value="0" wire:model="esatic" style="cursor: pointer; accent-color: var(--neon-cyan); transform: scale(1.3);" />
                            <span style="color: #000000 !important;">Non</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="activeTab===1" style="display: flex; flex-direction: column; align-items: center;">
            <div class="tete" style="text-align: center; margin-bottom: 30px;">
                <h1 class="titre" style="color: #FFFFFF; font-family: var(--font-display); font-size: 2.5rem; font-weight: 900; text-transform: uppercase; letter-spacing: 2px;">Inscription</h1>
                <p style="color: var(--neon-cyan); font-weight: bold; font-size: 1.1rem; text-transform: uppercase; letter-spacing: 1px;">Étape 2 : Détails de l'Équipe</p>
            </div>

            <div class="champs" style="background: rgba(10, 22, 40, 0.6); padding: 40px; border-radius: 20px; border: 1px solid rgba(0, 245, 255, 0.2); backdrop-filter: blur(10px); width: 100%; max-width: 600px; box-shadow: 0 0 30px rgba(0,0,0,0.5);">

                {{-- SECTION GROUPE --}}
                <div class="groupe" style="margin-bottom: 40px;">
                    <h2 class="tchamp" style="color: var(--neon-cyan); font-weight: bold; margin-bottom: 25px; text-align: center; font-size: 1.5rem; font-family: var(--font-display); border-bottom: 1px solid rgba(0,245,255,0.2); padding-bottom: 10px;">Informations du Groupe</h2>
                    <div class="gr" style="display: flex; flex-direction: column; gap: 20px;">
                        <div style="display: flex; flex-direction: column;">
                            <label style="color: #FFFFFF; margin-bottom: 8px; font-weight: 600; font-size: 0.9rem;">Niveau d'études *</label>
                            <select wire:model='niveau' style="background: rgba(255,255,255,0.9); color: #000000 !important; border: 1px solid rgba(0,245,255,0.4); padding: 12px; border-radius: 8px; font-size: 1rem; transition: all 0.3s; outline: none;">
                                <option value="0" style="color: black;">-- Choisir --</option>
                                @foreach ($niveaux as $niveau)
                                <option value="{{$niveau->id}}" style="color: black;">{{$niveau->libelle}}</option>
                                @endforeach
                            </select>
                            @error('niveau') <span style="color: #ff4060; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</span> @enderror
                        </div>

                        <div style="display: flex; flex-direction: column;">
                            <label style="color: #FFFFFF; margin-bottom: 8px; font-weight: 600; font-size: 0.9rem;">Nom de l'équipe (30 Caractères Max) *</label>
                            <input type="text" wire:model.defer='nom_groupe' placeholder="Ex: Les Codeurs" maxlength="30" style="background: rgba(255,255,255,0.9); color: #000000 !important; border: 1px solid rgba(0,245,255,0.4); padding: 12px; border-radius: 8px; font-size: 1rem; transition: all 0.3s; outline: none;">
                            @error('nom_groupe') <span style="color: #ff4060; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                {{-- SECTION CHEF --}}
                <div class="chef">
                    <h2 class="tchef" style="color: var(--neon-cyan); font-weight: bold; margin-bottom: 25px; text-align: center; font-size: 1.5rem; font-family: var(--font-display); border-bottom: 1px solid rgba(0,245,255,0.2); padding-bottom: 10px;">Chef de l'Équipe</h2>
                    <div class="info_chef" style="display: flex; flex-direction: column; gap: 20px;">

                        @if ($esatic == 1)
                        <div style="display: flex; flex-direction: column;">
                            <label style="color: #FFFFFF; margin-bottom: 8px; font-weight: 600; font-size: 0.9rem;">Numéro Matricule *</label>
                            <input type="text" wire:model.defer='matricule_chef' placeholder="00-ESATIC0000AB" style="background: rgba(255,255,255,0.9); color: #000000 !important; border: 1px solid rgba(0,245,255,0.4); padding: 12px; border-radius: 8px; font-size: 1rem; transition: all 0.3s; outline: none;">
                            @error('matricule_chef') <span style="color: #ff4060; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</span> @enderror
                        </div>
                        @endif

                        <div style="display: flex; flex-direction: column;">
                            <label style="color: #FFFFFF; margin-bottom: 8px; font-weight: 600; font-size: 0.9rem;">Nom complet *</label>
                            <input type="text" wire:model.defer='nom_chef' placeholder="Votre nom" style="background: rgba(255,255,255,0.9); color: #000000 !important; border: 1px solid rgba(0,245,255,0.4); padding: 12px; border-radius: 8px; font-size: 1rem; transition: all 0.3s; outline: none;">
                            @error('nom_chef') <span style="color: #ff4060; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</span> @enderror
                        </div>

                        <div style="display: flex; flex-direction: column;">
                            <label style="color: #FFFFFF; margin-bottom: 8px; font-weight: 600; font-size: 0.9rem;">Prénoms *</label>
                            <input type="text" wire:model.defer='prenom_chef' placeholder="Vos prénoms" style="background: rgba(255,255,255,0.05); color: #FFFFFF !important; border: 1px solid rgba(0,245,255,0.4); padding: 12px; border-radius: 8px; font-size: 1rem; transition: all 0.3s; outline: none;">
                            @error('prenom_chef') <span style="color: #ff4060; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</span> @enderror
                        </div>

                        <div style="display: flex; flex-direction: column;">
                            <label style="color: #FFFFFF; margin-bottom: 8px; font-weight: 600; font-size: 0.9rem;">Genre *</label>
                            <select wire:model.defer='genre_chef' style="background: rgba(255,255,255,0.9); color: #000000 !important; border: 1px solid rgba(0,245,255,0.4); padding: 12px; border-radius: 8px; font-size: 1rem; transition: all 0.3s; outline: none;">
                                <option value="" style="color: black;">---- Choisir ----</option>
                                <option value="Masculin" style="color: black;">Masculin</option>
                                <option value="Feminin" style="color: black;">Féminin</option>
                            </select>
                            @error('genre_chef') <span style="color: #ff4060; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</span> @enderror
                        </div>

                        <div style="display: flex; flex-direction: column;">
                            <label style="color: #FFFFFF; margin-bottom: 8px; font-weight: 600; font-size: 0.9rem;">Classe / École *</label>
                            @if($esatic == 1)
                            <select wire:model.defer='classe_chef' style="background: rgba(255,255,255,0.9); color: #000000 !important; border: 1px solid rgba(0,245,255,0.4); padding: 12px; border-radius: 8px; font-size: 1rem; transition: all 0.3s; outline: none;">
                                <option value="c" style="color: black;">---- Choisir Classe ----</option>
                                @foreach ($classes as $classe)
                                <option value="{{$classe->id}}" style="color: black;">{{ $classe->libelle}}</option>
                                @endforeach
                            </select>
                            @else
                            <input type="text" wire:model.defer='classe_chef' placeholder="Nom de votre école" style="background: rgba(255,255,255,0.9); color: #000000 !important; border: 1px solid rgba(0,245,255,0.4); padding: 12px; border-radius: 8px; font-size: 1rem; transition: all 0.3s; outline: none;">
                            @endif
                            @error('classe_chef') <span style="color: #ff4060; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</span> @enderror
                        </div>

                        <div style="display: flex; flex-direction: column;">
                            <label style="color: #FFFFFF; margin-bottom: 8px; font-weight: 600; font-size: 0.9rem;">Email *</label>
                            <input type="email" wire:model.defer='email_chef' placeholder="sophie@example.com" style="background: rgba(255,255,255,0.9); color: #000000 !important; border: 1px solid rgba(0,245,255,0.4); padding: 12px; border-radius: 8px; font-size: 1rem; transition: all 0.3s; outline: none;">
                            @error('email_chef') <span style="color: #ff4060; font-size: 0.8rem; margin-top: 4px;">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div style="margin-top: 40px; text-align: center;">
                    @if(count($errors) > 0)
                        <span style="color: #ff4060; display: block; margin-bottom: 20px; font-weight: bold; font-size: 1rem;">
                            Veuillez corriger les erreurs signalées ci-dessus.
                        </span>
                    @endif

                    <button wire:click.prevent='createEquipe' style="cursor: pointer; background-color: var(--neon-cyan); color: #0a1628; padding: 15px 40px; font-size: 1.1rem; font-weight: 800; border: none; border-radius: 8px; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s; box-shadow: 0 0 15px rgba(0,245,255,0.3);" onmouseover="this.style.boxShadow='0 0 25px rgba(0,245,255,0.6)'; this.style.transform='scale(1.05)';" onmouseout="this.style.boxShadow='0 0 15px rgba(0,245,255,0.3)'; this.style.transform='scale(1)';">
                        Confirmer l'enregistrement
                    </button>
                </div>
            </div>
        </div>

        <div class="flex justify-center gap-4 p-4 border-t" style="margin-top: 40px; border-color: rgba(255,255,255,0.1);">
            <button @click="activeTab--" x-show="activeTab>0" style="color: var(--neon-orange); border: 1px solid var(--neon-orange); background: transparent; padding: 10px 25px; font-size: 0.85rem; font-weight: 800; text-transform: uppercase; border-radius: 8px; cursor: pointer; transition: all 0.3s;" onmouseover="this.style.backgroundColor='var(--neon-orange)'; this.style.color='white';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--neon-orange)';">
                Précédent
            </button>
            <button @click="activeTab++" x-show="activeTab<tabs.length-1" style="color: var(--neon-orange); border: 1px solid var(--neon-orange); background: transparent; padding: 10px 25px; font-size: 0.85rem; font-weight: 800; text-transform: uppercase; border-radius: 8px; cursor: pointer; transition: all 0.3s;" onmouseover="this.style.backgroundColor='var(--neon-orange)'; this.style.color='white';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--neon-orange)';">
                Suivant
            </button>
        </div>
    </form>
</div>