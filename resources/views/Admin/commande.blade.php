<x-app-layout>
    <style>
        .admin-panel-wrapper, .admin-panel-wrapper * {
            color: var(--text-primary) !important;
        }
        .admin-panel-wrapper label,
        .admin-panel-wrapper .font-bold,
        .admin-panel-wrapper th,
        .admin-panel-wrapper [class*="text-gray-"],
        .admin-panel-wrapper [class*="text-black"],
        .admin-panel-wrapper [class*="text-slate"] {
            color: var(--neon-cyan) !important;
        }
        .admin-panel-wrapper input,
        .admin-panel-wrapper select,
        .admin-panel-wrapper textarea {
            background-color: rgba(6, 11, 20, 0.9) !important;
            color: white !important;
            border: 1px solid var(--neon-cyan) !important;
        }
        .admin-panel-wrapper table {
            border: 1px solid var(--neon-cyan) !important;
        }
        .admin-panel-wrapper td {
            border-bottom: 1px solid rgba(0, 245, 255, 0.2) !important;
        }
    </style>

    <div class="py-6">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg admin-container admin-panel-wrapper" style="border: 1px solid rgba(0, 245, 255, 0.2); border-radius: 16px; background: rgba(10, 22, 40, 0.8) !important;">

                <div x-data="Tabsetup()" class="w-full h-full">
                    <ul class="flex items-center justify-center mt-6 mb-4" style="gap: 10px;">
                        <template x-for="(tab, index) in tabs" :key="index">
                            <li class="px-4 py-2 cursor-pointer transition-all duration-300 rounded-md"
                                :class="activeTab===index ? 'text-cyan bg-cyan-dim border-cyan' : 'text-muted border-transparent'"
                                :style="activeTab===index ? 'color: var(--neon-cyan); background: rgba(0, 245, 255, 0.1); border: 1px solid var(--neon-cyan);' : 'color: var(--text-muted);'"
                                @click="activeTab = index"
                                x-text="tab"></li>
                        </template>
                    </ul>

                    <div class="w-full h-full p-6" style="background: rgba(6, 11, 20, 0.5);">
                        <div x-show="activeTab===0" >
                            @livewire('admin.restauration.commande')
                        </div>
                        <div x-show="activeTab===1" >
                            <div class="px-2 py-4  md:py-2">
                                <div class=" gap-8 md:grid md:grid-cols-6 ">
                                    <div class="col-span-2 px-2  ">
                                        @livewire('admin.restauration.qrcode')
                                    </div>
                                    <div class="font-bold md:col-span-4">
                                        <div class="flex flex-col w-full">
                                            <div class="w-full -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                <div class="inline-block w-full min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                                    <div class="w-full border-b border-gray-200 shadow overflow-x sm:rounded-lg">
                                                        <table class="min-w-full divide-y divide-gray-800">
                                                            <thead class="bg-gray-100">
                                                                <tr>
                                                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                                        Intitulé du repas
                                                                    </th>
                                                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="bg-white divide-y divide-gray-200">
                                                                @foreach ($repas as $repa)
                                                                <tr>
                                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                                        <div class="flex items-center">
                                                                            <div class="ml-4">
                                                                                <div class="text-sm font-extrabold text-gray-900">
                                                                                    {{$repa->libelle }}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="px-6 py-4 text-xl whitespace-nowrap">
                                                                        {{$repa->restauration()->count()}} / {{$nb_participants}}
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="flex justify-end py-2">
                                                        {{$repas->links()}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center gap-4 p-6 border-t" style="border-color: rgba(0, 245, 255, 0.1);">
                        <button
                            class="px-6 py-2 text-sm font-bold uppercase border rounded-md cursor-pointer transition-all"
                            :style=" 'color: var(--neon-orange); border-color: var(--neon-orange);' "
                            @click="activeTab--" x-show="activeTab>0"
                            onmouseover="this.style.backgroundColor='var(--neon-orange)'; this.style.color='white'"
                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--neon-orange)'"
                            >Précédent</button>
                        <button
                            class="px-6 py-2 text-sm font-bold uppercase border rounded-md cursor-pointer transition-all"
                            :style=" 'color: var(--neon-orange); border-color: var(--neon-orange);' "
                            @click="activeTab++" x-show="activeTab<tabs.length-1"
                            onmouseover="this.style.backgroundColor='var(--neon-orange)'; this.style.color='white'"
                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--neon-orange)'"
                            >Suivant</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="scripts" >
        <script>
            function Tabsetup() {
                return {
                activeTab: 1,
                tabs:['Commandes', 'Restaurant']
                };
            };
        </script>
    </x-slot>
</x-app-layout>