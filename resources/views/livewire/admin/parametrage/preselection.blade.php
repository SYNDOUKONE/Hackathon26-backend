<div>

    <div class="px-4 py-5 ">

        @if($_niveau && $_niveau->quiz_available == 1)
        <div>

            @if($quiz)
                <div class="text-md font-bold text-center">Score: {{$quiz->score}} pts</div>
                <div class="text-md font-bold text-center">Questions: {{sizeof($questions)}}</div>

                <div class="col-span-6" style="margin-bottom: 30px;">
                    <div class="flex flex-col">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <form>
                                        <th scope="col" class="px-6 py-3 text-xs font-bold tracking-wider text-left text-gray-500 uppercase">
                                            <select wire:model='niveau' class="relative w-full px-3 py-2 text-sm text-gray-600 placeholder-gray-400 bg-white border-gray-400 rounded outline-none form-select focus:border-coolGray-400 focus:outline-none focus:ring-coolGray-100">
                                                @foreach ($niveaux as $niv)
                                                <option value="{{$niv->id}}">{{$niv->libelle}}</option>
                                                @endforeach
                                            </select>
                                        </th>
                                        <th scope="col-span-2" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            <input type="number" wire:model="quiz_score" min=0 placeholder="Score..." required class="relative w-full px-3 py-2 ext-sm text-gray-600 placeholder-gray-400 bg-white border-gray-400 rounded outline-none focus:border-coolGray-400 focus:outline-none focus:ring-coolGray-100" />
                                        </th>
                                        <th scope="col-span-2" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            <button wire:click.prevent="updateQuiz({{$quiz->id}})" class="px-6 py-3 mb-1 mr-1 text-sm font-bold text-white uppercase transition-all duration-150 rounded shadow outline-none ease-linearbg-emerald-500 bg-myblue hover:shadow-lg focus:outline-none" type="submit">
                                                Modifier
                                            </button>
                                        </th>
                                        <th>
                                            <button wire:click.prevent="openCloseQuiz({{$quiz->id}})" class="px-6 py-3 mb-1 mr-1 text-sm font-bold uppercase border rounded-md cursor-pointer border-orange text-orange hover:bg-orange hover:text-white hover:shadow" type="submit">
                                                @if($quiz->state == 1) Fermer le quiz @else Ouvrir le quiz @endif
                                            </button>
                                            <span id="dNd" style="display:none;">Done</span>
                                        </th>
                                    </form>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            @else
                <div class="text-center text-red-500 font-bold">Aucun quiz trouvé pour ce niveau. Veuillez en créer un.</div>
            @endif

            <div class="col-span-6">
                <div class="flex flex-col">
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <form method="POST">
                                    <th scope="col" class="px-6 py-3 text-xs font-bold tracking-wider text-left text-gray-500 uppercase">
                                        <input type="text" placeholder="Nouvelle question..." wire:model="newQuestion" required class="relative px-3 py-2 w-full text-sm text-gray-600 placeholder-gray-400 bg-white border-gray-400 rounded outline-none focus:border-coolGray-400 focus:outline-none focus:ring-coolGray-100" />
                                    </th>
                                    <th scope="col-span-2" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        <button wire:click.prevent="@if($editModeQ) updateQuestion() @else storeNewQuestion() @endif" class="px-6 py-3 mb-1 mr-1 text-sm font-bold text-white uppercase transition-all duration-150 rounded shadow outline-none ease-linearbg-emerald-500 bg-myblue hover:shadow-lg focus:outline-none" type="submit">
                                            @if($editModeQ) Mettre à jour @else Enregistrer @endif
                                        </button>
                                    </th>
                                </form>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            @foreach($questions as $question)
            <div class="col-span-6">
                <div class="md:grid md:grid-cols-6">
                    <div class="col-span-6">
                        <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                    <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                                        <table class="min-w-full divide-y table-auto  divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 text-xs font-bold tracking-wider text-left text-gray-500 uppercase">
                                                        {{$question->content}}
                                                    </th>
                                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">

                                                    </th>
                                                    <th scope="col-span-2" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                        <div class="flex">
                                                            <a wire:click="editQuestion({{$question->id}})" class="px-2 text-cyan-500 cursor-pointer hover:text-cyan-300">
                                                                <svg class="w-6 h-6 " viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" />
                                                                    <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                                                    <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                                                    <line x1="16" y1="5" x2="19" y2="8" />
                                                                </svg>
                                                            </a>
                                                            <a wire:click="deleteQuestion({{$question->id}})" class="px-2 text-red-500 cursor-pointer hover:text-red-300">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 20 20" fill="currentColor">
                                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                                </svg>
                                                            </a>
                                                        </div>
                                                        <span style="font-size:0.7rem;color:var(--neon-cyan);margin-left:5px;font-weight:bold;">Neon</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach($question->responses as $response)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="font-bold text-gray-900 text-md">
                                                                    {{$response->content}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="font-bold text-gray-900 text-md">
                                                                    {{$response->score}} pts
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                        <div class="flex">
                                                            <a wire:click="editResponse({{$question->id}}, {{$response->id}})" class="px-2 text-cyan-500 cursor-pointer hover:text-cyan-300">
                                                                <svg class="w-6 h-6 " viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" />
                                                                    <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                                                    <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                                                    <line x1="16" y1="5" x2="19" y2="8" />
                                                                </svg>
                                                            </a>
                                                            <a wire:click="deleteResponse({{$response->id}})" class="px-2 text-red-500 cursor-pointer hover:text-red-300">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 20 20" fill="currentColor">
                                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-6">
                        <div class="flex flex-col">
                            <table class="min-w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <form method="POST">
                                            <th scope="col" class="px-6 py-3 text-xs font-bold tracking-wider text-left text-gray-500 uppercase">
                                                <input type="text" wire:model="newResponseC.{{$question->id}}" placeholder="Reponse..." class="relative px-3 py-2 w-full text-sm text-gray-600 placeholder-gray-400 bg-white border-gray-400 rounded outline-none focus:border-coolGray-400 focus:outline-none focus:ring-coolGray-100" />
                                            </th>
                                            <th scope="col-span-2" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                <input type="number" wire:model="newResponseS.{{$question->id}}" placeholder="Nombre de point..." min="0" class="relative px-3 py-2 w-full text-sm text-gray-600 placeholder-gray-400 bg-white border-gray-400 rounded outline-none focus:border-coolGray-400 focus:outline-none focus:ring-coolGray-100" />
                                            </th>
                                            <th scope="col-span-2" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                <button wire:click.prevent="@if($editModeR) updateResponse({{$question->id}}) @else storeNewResponse({{$question->id}}) @endif" class="px-6 py-3 mb-1 mr-1 text-sm font-bold text-white uppercase transition-all duration-150 rounded shadow outline-none ease-linearbg-emerald-500 bg-myblue hover:shadow-lg focus:outline-none" type="submit">
                                                    @if($editModeR) Mettre à jour @else Enregistrer @endif
                                                </button>
                                            </th>
                                        </form>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @else

        <div>

            <div class="col-span-6" style="margin-bottom: 30px;">
                <div class="flex flex-col">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-xs font-bold tracking-wider text-left text-gray-500 uppercase">
                                    <select wire:model='niveau' class="relative px-3 py-2 text-sm text-gray-600 placeholder-gray-400 bg-white border-gray-400 rounded outline-none form-select focus:border-coolGray-400 focus:outline-none focus:ring-coolGray-100">
                                        @foreach ($niveaux as $niv)
                                        <option value="{{$niv->id}}">{{$niv->libelle}}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th>
                                    @if($qvideo)
                                        <button wire:click.prevent="openCloseQvideo({{$qvideo->id}})" class="px-6 py-3 mb-1 mr-1 text-sm font-bold uppercase border rounded-md cursor-pointer border-orange text-orange hover:bg-orange hover:text-white hover:shadow" type="submit">
                                            @if($qvideo->state == 1) Fermer la soumission de video @else Ouvrir la soumission de video @endif
                                        </button>
                                    @else
                                        <span class="text-gray-500 italic">Aucune vidéo configurée</span>
                                    @endif
                                    <span id="dNd" style="display:none;">Done</span>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>

        @endif

    </div>

</div>

<script>
    function hideAndShow() {

        document.getElementById("dNd").style.display = "block"
        setTimeout(function() {
            document.getElementById("dNd").style.display = "none"
        }, 1000)
    }
</script>