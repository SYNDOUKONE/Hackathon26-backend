<div class="px-4 py-5">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Section Gestion des Niveaux -->
        <div class="bg-gray-900 p-6 rounded-xl border border-cyan-900 shadow-lg">
            <h3 class="text-lg font-bold text-cyan-400 mb-4 border-b border-cyan-900 pb-2">🎓 Gestion des Niveaux</h3>

            <div class="mb-6">
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col">
                        <label class="font-bold text-white mb-1">Libellé du Niveau</label>
                        <input type="text" placeholder="Ex: Niveau 1" wire:model.defer='niv_libelle'
                               class="relative w-full px-3 py-2 text-sm text-gray-600 placeholder-gray-400 bg-white border-gray-400 rounded outline-none focus:border-coolGray-400 focus:outline-none focus:ring-coolGray-100" />
                        @error('niv_libelle')
                            <div class="text-sm font-thin text-red-600">{{ $errors->first('niv_libelle') }}</div>
                        @enderror
                    </div>
                    <div class="flex justify-end">
                        <button wire:click.prevent="@if($niv_edit_mode) updateNiveau({{$niv_id}}) @else createNiveau() @endif"
                                class="px-6 py-2 bg-myblue text-white font-bold uppercase rounded shadow hover:bg-blue-600 transition-all">
                            @if($niv_edit_mode) Mettre à jour @else Enregistrer @endif
                        </button>
                    </div>
                </div>
            </div>

            <div class="overflow-hidden rounded-lg border border-gray-800">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-800 text-gray-400 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-2">Niveau</th>
                            <th class="px-4 py-2 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800 text-white">
                        @foreach ($niveaux as $niveau)
                        <tr class="hover:bg-gray-800/50">
                            <td class="px-4 py-2">{{$niveau->libelle}}</td>
                            <td class="px-4 py-2 text-center flex justify-center gap-2">
                                <button wire:click="editNiveau({{$niveau->id}})" class="text-cyan-400 hover:text-cyan-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 6.732z"/></svg>
                                </button>
                                <button wire:click="deleteNiveau({{$niveau->id}})" class="text-red-400 hover:text-red-300">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Section Gestion des Classes -->
        <div class="bg-gray-900 p-6 rounded-xl border border-cyan-900 shadow-lg">
            <h3 class="text-lg font-bold text-cyan-400 mb-4 border-b border-cyan-900 pb-2">🏫 Gestion des Classes</h3>

            <div class="mb-6">
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col">
                        <label class="font-bold text-white mb-1">Libellé de la classe</label>
                        <input type="text" placeholder="SRIT 1 A" wire:model.defer='libelle'
                               class="relative w-full px-3 py-2 text-sm text-gray-600 placeholder-gray-400 bg-white border-gray-400 rounded outline-none focus:border-coolGray-400 focus:outline-none focus:ring-coolGray-100" />
                        @error('libelle')
                            <div class="text-sm font-thin text-red-600">{{ $errors->first('libelle') }}</div>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="font-bold text-white mb-1">Niveau</label>
                        <select wire:model.defer='niveau_id'
                                class="relative w-full px-3 py-2 text-sm text-gray-600 placeholder-gray-400 bg-white border-gray-400 rounded outline-none form-select focus:border-coolGray-400 focus:outline-none focus:ring-coolGray-100">
                            <option value=""></option>
                            @foreach ($niveaux as $niveau)
                                <option value="{{$niveau->id}}">{{$niveau->libelle}}</option>
                            @endforeach
                        </select>
                        @error('niveau_id')
                            <div class="text-sm font-thin text-red-600">{{ $errors->first('niveau_id') }}</div>
                        @enderror
                    </div>
                    <div class="flex justify-end">
                        <button wire:click.prevent="@if($edit_mode) updateClasse({{$classe_id}}) @else createClasse() @endif"
                                class="px-6 py-2 bg-myblue text-white font-bold uppercase rounded shadow hover:bg-blue-600 transition-all">
                            @if($edit_mode) Mettre à jour @else Enregistrer @endif
                        </button>
                    </div>
                </div>
            </div>

            <div class="overflow-hidden rounded-lg border border-gray-800">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-800 text-gray-400 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-2">Classe</th>
                            <th class="px-4 py-2">Niveau</th>
                            <th class="px-4 py-2 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800 text-white">
                        @foreach ($classes as $classe)
                        <tr class="hover:bg-gray-800/50">
                            <td class="px-4 py-2 font-bold">{{$classe->libelle}}</td>
                            <td class="px-4 py-2">{{$classe->niveau->libelle}}</td>
                            <td class="px-4 py-2 text-center flex justify-center gap-2">
                                <button wire:click="editClasse({{$classe->id}})" class="text-cyan-400 hover:text-cyan-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 6.732z"/></svg>
                                </button>
                                <button wire:click="deleteClasse({{$classe->id}})" class="text-red-400 hover:text-red-300">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{$classes->links()}}
            </div>
        </div>

        <!-- Section Gestion des Participants -->
        <div class="bg-gray-900 p-6 rounded-xl border border-cyan-900 shadow-lg mt-8">
            <h3 class="text-lg font-bold text-cyan-400 mb-4 border-b border-cyan-900 pb-2">👥 Gestion des Participants Inscrit</h3>

            <div class="overflow-hidden rounded-lg border border-gray-800">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-800 text-gray-400 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-2">Nom & Prénom</th>
                            <th class="px-4 py-2">Équipe</th>
                            <th class="px-4 py-2 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800 text-white">
                        @foreach ($participants as $p)
                        <tr class="hover:bg-gray-800/50">
                            <td class="px-4 py-2">{{ $p->etudiant->nom }} {{ $p->etudiant->prenom }}</td>
                            <td class="px-4 py-2">{{ $p->equipe->libelle ?? 'Sans équipe' }}</td>
                            <td class="px-4 py-2 text-center">
                                <button wire:click="deleteParticipant({{$p->id}})" class="text-red-400 hover:text-red-300 p-2" title="Supprimer l'inscription">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{$participants->links()}}
            </div>
        </div>
    </div>
    </div>

    </div>
</div>
