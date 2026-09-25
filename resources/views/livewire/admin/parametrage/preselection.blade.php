<div>

    <div class="px-4 py-5 ">

                <div class="mb-6 flex justify-center gap-4">
                    <div class="flex items-center gap-4 bg-gray-800 p-4 rounded-lg border border-cyan-500">
                        <label class="font-bold text-white">Sélectionner le Niveau :</label>
                        <select wire:model='niveau' class="relative w-full px-3 py-2 text-sm text-gray-600 placeholder-gray-400 bg-white border-gray-400 rounded outline-none form-select focus:border-coolGray-400 focus:outline-none focus:ring-coolGray-100">
                            @foreach ($niveaux as $niv)
                            <option value="{{$niv->id}}">{{$niv->libelle}}</option>
                            @endforeach
                        </select>
                    </div>

                    @if($niveau >= 2)
                    <div class="flex items-center gap-4 bg-gray-800 p-4 rounded-lg border border-cyan-500">
                        <label class="font-bold text-white">Parcours :</label>
                        <select wire:model='track' class="relative w-full px-3 py-2 text-sm text-gray-600 placeholder-gray-400 bg-white border-gray-400 rounded outline-none form-select focus:border-coolGray-400 focus:outline-none focus:ring-coolGray-100">
                            <option value="">Sélectionner un parcours</option>
                            @foreach ($quizzes as $q)
                            <option value="{{$q->title}}">{{$q->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                </div>

        @if($_niveau)
            <div class="grid grid-cols-1 gap-6">

                <!-- Section Configuration du Quiz -->
                <div class="bg-gray-900 p-6 rounded-xl border border-cyan-900 shadow-lg">
                    <h3 class="text-lg font-bold text-cyan-400 mb-4 border-b border-cyan-900 pb-2">⚙️ Configuration du Quiz - {{$_niveau->libelle}}</h3>

                    @if($quiz)
                        <div class="flex flex-wrap items-end gap-4">
                            <div class="flex flex-col">
                                <label class="text-sm font-medium text-gray-400 mb-1">Score Total du Quiz</label>
                                <input type="number" wire:model="quiz_score" min=0 placeholder="Ex: 100" class="relative w-48 px-3 py-2 text-sm text-white bg-gray-800 border-gray-600 rounded outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500" />
                            </div>
                            <button wire:click.prevent="updateQuiz({{$quiz->id}})" class="px-6 py-2 bg-myblue text-white font-bold uppercase rounded shadow hover:bg-blue-600 transition-all">
                                Modifier le Score
                            </button>
                            <button wire:click.prevent="openCloseQuiz({{$quiz->id}})" class="px-6 py-2 border border-orange text-orange font-bold uppercase rounded hover:bg-orange hover:text-white transition-all">
                                @if($quiz->state == 1) Fermer le quiz @else Ouvrir le quiz @endif
                            </button>
                        </div>
                        <div class="mt-2 text-sm text-gray-400">
                            Score actuel : <span class="text-cyan-400 font-bold">{{$quiz->score}} pts</span> |
                            Questions : <span class="text-cyan-400 font-bold">{{sizeof($questions)}}</span>
                        </div>
                    @else
                        <div class="bg-red-900/30 border border-red-500 p-4 rounded-lg text-red-400 font-bold text-center">
                            ⚠️ Aucun quiz n'est créé pour ce niveau. Veuillez ajouter des questions ci-dessous pour initialiser le quiz.
                        </div>
                    @endif
                </div>

                <!-- Section Ajout de Questions -->
                <div class="bg-gray-900 p-6 rounded-xl border border-cyan-900 shadow-lg">
                    <h3 class="text-lg font-bold text-cyan-400 mb-4 border-b border-cyan-900 pb-2">➕ Ajouter une Question</h3>
                    <div class="flex flex-wrap gap-4">
                        <div class="flex-1 min-w-[300px]">
                            <input type="text" placeholder="Saisissez la question ici..." wire:model="newQuestion" required class="relative w-full px-3 py-2 text-sm text-white bg-gray-800 border-gray-600 rounded outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500" />
                        </div>
                        <button wire:click.prevent="@if($editModeQ) updateQuestion() @else storeNewQuestion() @endif" class="px-6 py-2 bg-myblue text-white font-bold uppercase rounded shadow hover:bg-blue-600 transition-all">
                            @if($editModeQ) Mettre à jour @else Enregistrer @endif
                        </button>
                    </div>
                </div>

                <!-- Liste des Questions et Réponses -->
                <div class="space-y-6">
                    @foreach($questions as $question)
                    <div class="bg-gray-900 p-6 rounded-xl border border-cyan-900 shadow-lg">
                        <div class="flex justify-between items-center mb-4 border-b border-gray-800 pb-2">
                            <span class="text-white font-bold text-lg">{{$question->content}}</span>
                            <div class="flex gap-2">
                                <button wire:click="editQuestion({{$question->id}})" class="p-2 text-cyan-400 hover:bg-cyan-900 rounded transition-all" title="Modifier">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 6.732z"/></svg>
                                </button>
                                <button wire:click="deleteQuestion({{$question->id}})" class="p-2 text-red-400 hover:bg-red-900 rounded transition-all" title="Supprimer">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                </button>
                            </div>
                        </div>

                        <div class="overflow-hidden rounded-lg border border-gray-800">
                            <table class="w-full text-left">
                                <thead class="bg-gray-800 text-gray-400 text-xs uppercase">
                                    <tr>
                                        <th class="px-4 py-2">Réponse</th>
                                        <th class="px-4 py-2 w-32">Points</th>
                                        <th class="px-4 py-2 w-24 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-800">
                                    @foreach($question->responses as $response)
                                    <tr class="hover:bg-gray-800/50 transition-colors">
                                        <td class="px-4 py-3 text-white">{{$response->content}}</td>
                                        <td class="px-4 py-3 text-cyan-400 font-bold">{{$response->score}} pts</td>
                                        <td class="px-4 py-3 text-center flex justify-center gap-2">
                                            <button wire:click="editResponse({{$question->id}}, {{$response->id}})" class="text-cyan-400 hover:text-cyan-300">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 6.732z"/></svg>
                                            </button>
                                            <button wire:click="deleteResponse({{$response->id}})" class="text-red-400 hover:text-red-300">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Formulaire d'ajout de réponse -->
                        <div class="mt-4 p-4 bg-gray-800/50 rounded-lg border border-gray-700">
                            <div class="flex flex-wrap gap-4">
                                <input type="text" wire:model="newResponseC.{{$question->id}}" placeholder="Nouvelle réponse..." class="flex-1 px-3 py-2 text-sm text-white bg-gray-900 border-gray-600 rounded outline-none focus:border-cyan-500" />
                                <input type="number" wire:model="newResponseS.{{$question->id}}" placeholder="Points" min="0" class="w-24 px-3 py-2 text-sm text-white bg-gray-900 border-gray-600 rounded outline-none focus:border-cyan-500" />
                                <button wire:click.prevent="@if($editModeR) updateResponse({{$question->id}}) @else storeNewResponse({{$question->id}}) @endif" class="px-4 py-2 bg-myblue text-white font-bold uppercase rounded hover:bg-blue-600 transition-all">
                                    @if($editModeR) Mettre à jour @else Ajouter @endif
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="text-center py-10 text-red-400 font-bold bg-red-900/20 rounded-xl border border-red-900">
                ❌ Niveau non trouvé. Veuillez vérifier la configuration des niveaux.
            </div>
        @endif

    </div>

</div>
