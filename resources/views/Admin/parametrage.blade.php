<x-app-layout>

    <style>
        /* FORCE VISIBILITY IN ADMIN PANEL - INLINE STYLE TO BYPASS ALL CACHE/OVERRIDE */
        .admin-panel-wrapper, .admin-panel-wrapper * {
            color: var(--text-primary) !important;
        }
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
                            @livewire('admin.parametrage.hackaton')
                        </div>
                        <div x-show="activeTab===1" >
                            @livewire('admin.parametrage.niveau')
                        </div>
                        <div x-show="activeTab===2" >
                            @livewire('admin.salle')
                        </div>
                        {{--
                        <div x-show="activeTab===3" >
                            @livewire('admin.parametrage.repartition')
                        </div>
                        <div x-show="activeTab===4" >
                            @livewire('admin.parametrage.preselection')
                        </div>
                        <div x-show="activeTab===5" >
                            @livewire('admin.restauration.repas')
                        </div>
                        --}}
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
                activeTab: 0,
                tabs:['Hackaton', 'Niveaux', 'Salle', 'Repartition', 'Preselection', 'Restauration']
                };
            };
        </script>
    </x-slot>

</x-app-layout>
