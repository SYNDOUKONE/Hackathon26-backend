<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 relative z-50" style="background: rgba(6, 11, 20, 0.92) !important; border-bottom: 1px solid rgba(0, 245, 255, 0.1) !important; backdrop-filter: blur(24px) !important; -webkit-backdrop-filter: blur(24px) !important;">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('welcome', null, false) }}">
                        <x-jet-application-mark class="block w-auto h-9" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('dashboard', null, false) }}" :active="request()->routeIs('dashboard')" style="color: var(--text-primary) !important;">
                        {{ __('Mon espace') }}
                    </x-jet-nav-link>

                    @if (Auth::user()->etudiant)
                    @if(Auth::user()->etudiant->is_chief())
                    <x-jet-nav-link href="{{ route('preselection', null, false) }}" :active="request()->routeIs('preselection')" style="color: var(--text-primary) !important;">
                        {{ __('Présélection') }}
                    </x-jet-nav-link>
                    @endif

                    @if (Auth::user()->etudiant && Auth::user()->etudiant->currentEquipe() && Auth::user()->etudiant->currentEquipe()->statut)
                    <x-jet-nav-link href="{{ route('restauration', null, false) }}" :active="request()->routeIs('restauration')" style="color: var(--text-primary) !important;">
                        {{ __('Restauration') }}
                    </x-jet-nav-link>
                    @endif
                    @endif

                    @role('super-admin')
                    <x-jet-nav-link href="{{ route('Admin.parametres.index', null, false) }}" :active="request()->routeIs('Admin.parametres.index')" style="color: var(--text-primary) !important;">
                        {{ __('Paramétrage') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('Admin.groupe.selection', null, false) }}" :active="request()->routeIs('Admin.groupe.selection')" style="color: var(--text-primary) !important;">
                        {{ __('Groupes') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('Admin.groupe.impression', null, false) }}" :active="request()->routeIs('Admin.groupe.impression')" style="color: var(--text-primary) !important;">
                        {{ __('Impression') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('Admin.restauration', null, false) }}" :active="request()->routeIs('Admin.restauration')" style="color: var(--text-primary) !important;">
                        {{ __('Restauration') }}
                    </x-jet-nav-link>
                    @endrole

                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                <div class="relative ml-3">
                    <x-jet-dropdown align="right" width="60">
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-800 transition bg-white border border-transparent rounded-md hover:bg-gray-50 hover:text-gray-900 focus:outline-none focus:bg-gray-50 active:bg-gray-50" style="background: transparent !important; color: var(--text-primary) !important;">
                                    {{ Auth::user()->currentTeam->name }}
                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            <div class="w-60" style="background: #0a1628 !important; border: 1px solid rgba(0, 245, 255, 0.15) !important;">
                                <div class="block px-4 py-2 text-xs text-gray-400" style="color: var(--text-muted) !important;">
                                    {{ __('Manage Team') }}
                                </div>
                                <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" style="color: var(--text-primary) !important;">
                                    {{ __('Team Settings') }}
                                </x-jet-dropdown-link>
                                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                <x-jet-dropdown-link href="{{ route('teams.create') }}" style="color: var(--text-primary) !important;">
                                    {{ __('Create New Team') }}
                                </x-jet-dropdown-link>
                                @endcan
                                <div class="border-t border-gray-100"></div>
                                <div class="block px-4 py-2 text-xs text-gray-400" style="color: var(--text-muted) !important;">
                                    {{ __('Switch Teams') }}
                                </div>
                                @foreach (Auth::user()->allTeams() as $team)
                                <x-jet-switchable-team :team="$team" />
                                @endforeach
                            </div>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="relative ml-3">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button class="flex text-sm transition border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                                <img class="object-cover w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                            @else
                            <span class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-800 transition bg-white border border-transparent rounded-md hover:text-gray-900 focus:outline-none" style="background: transparent !important; color: var(--text-primary) !important;">
                                    {{ Auth::user()->name }}
                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <div class="w-48" style="background: #0a1628 !important; border: 1px solid rgba(0, 245, 255, 0.15) !important;">
                                <div class="block px-4 py-2 text-xs text-gray-400" style="color: var(--text-muted) !important;">
                                    {{ __('Gestion de mon espace') }}
                                </div>
                                <x-jet-dropdown-link href="{{ route('profile.show', null, false) }}" style="color: var(--text-primary) !important;">
                                    {{ __('Mes informations') }}
                                </x-jet-dropdown-link>
                                <div class="border-t border-gray-100"></div>
                                <form method="POST" action="{{ route('logout', null, false) }}" x-data>
                                    @csrf
                                    <x-jet-dropdown-link @click.prevent="$root.submit();" style="color: var(--text-primary) !important;">
                                        {{ __('Se Deconnecter') }}
                                    </x-jet-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -mr-2 sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-gray-400 transition rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500" style="color: var(--text-muted) !important;">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('dashboard', null, false) }}" :active="request()->routeIs('dashboard')" style="color: var(--text-primary) !important;">
                {{ __('Mon espace') }}
            </x-jet-responsive-nav-link>
            @if (Auth::user()->etudiant)
            @if (Auth::user()->etudiant && Auth::user()->etudiant->currentEquipe() && Auth::user()->etudiant->currentEquipe()->statut)
            <x-jet-responsive-nav-link href="{{ route('restauration', null, false) }}" :active="request()->routeIs('restauration')" style="color: var(--text-primary) !important;">
                {{ __(' Restauration') }}
            </x-jet-responsive-nav-link>
            @endif
            @endif
            @role('super-admin')
            <x-jet-responsive-nav-link href="{{ route('Admin.parametres.index', null, false) }}" :active="request()->routeIs('Admin.parametres.index')" style="color: var(--text-primary) !important;">
                {{ __('Paramétrage') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('Admin.groupe.selection', null, false) }}" :active="request()->routeIs('Admin.groupe.selection')" style="color: var(--text-primary) !important;">
                {{ __('Groupes') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('Admin.groupe.impression', null, false) }}" :active="request()->routeIs('Admin.groupe.impression')" style="color: var(--text-primary) !important;">
                {{ __('Impression') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('Admin.restauration', null, false) }}" :active="request()->routeIs('Admin.restauration')" style="color: var(--text-primary) !important;">
                {{ __('Restauration') }}
            </x-jet-responsive-nav-link>
            @endrole
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div class="mr-3 shrink-0">
                    <img class="object-cover w-10 h-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                </div>
                @endif
                <div style="color: var(--text-primary) !important;">
                    <div class="text-base font-medium" style="color: var(--text-primary) !important;">{{ Auth::user()->name }}</div>
                    <div class="text-sm font-medium" style="color: var(--text-muted) !important;">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <div class="mt-3 space-y-1">
                <x-jet-responsive-nav-link href="{{ route('profile.show', null, false) }}" :active="request()->routeIs('profile.show')" style="color: var(--text-primary) !important;">
                    {{ __('Mes informations') }}
                </x-jet-responsive-nav-link>
                <form method="POST" action="{{ route('logout', null, false) }}" x-data>
                    @csrf
                    <x-jet-responsive-nav-link @click.prevent="$root.submit();" style="color: var(--text-primary) !important;">
                        {{ __('Se Deconnecter') }}
                    </x-jet-responsive-nav-link>
                </form>
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                <div class="border-t border-gray-200"></div>
                <div class="block px-4 py-2 text-xs text-gray-400" style="color: var(--text-muted) !important;">
                    {{ __('Manage Team') }}
                </div>
                <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')" style="color: var(--text-primary) !important;">
                    {{ __('Team Settings') }}
                </x-jet-responsive-nav-link>
                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')" style="color: var(--text-primary) !important;">
                    {{ __('Create New Team') }}
                </x-jet-responsive-nav-link>
                @endcan
                <div class="border-t border-gray-200"></div>
                <div class="block px-4 py-2 text-xs text-gray-400" style="color: var(--text-muted) !important;">
                    {{ __('Switch Teams') }}
                </div>
                @foreach (Auth::user()->allTeams() as $team)
                <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                @endforeach
                @endif
            </div>
        </div>
    </div>
</nav>
