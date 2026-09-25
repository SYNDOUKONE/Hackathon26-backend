<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Mes informations') }}
    </x-slot>

    <x-slot name="description">
        {{ __('mise à jour de ses informations de connexion.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
            <!-- Profile Photo File Input -->
            <input type="file" class="hidden" wire:model="photo" x-ref="photo" x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

            <x-jet-label for="photo" value="{{ __('Photo') }}" />

            <!-- Current Profile Photo -->
            <div class="mt-2" x-show="! photoPreview">
                <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
            </div>

            <!-- New Profile Photo Preview -->
            <div class="mt-2" x-show="photoPreview" style="display: none;">
                <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center" x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                </span>
            </div>

            <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                {{ __('Selectionner une nouvelle photo') }}
            </x-jet-secondary-button>

            @if ($this->user->profile_photo_path)
            <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                {{ __('Remove Photo') }}
            </x-jet-secondary-button>
            @endif

            <x-jet-input-error for="photo" class="mt-2" />
        </div>
        @endif


        @if(Auth::user()->etudiant)
        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="nom" value="{{ __('Nom') }}" />
            <x-jet-input id="nom" type="text" class="mt-1 block w-full" wire:model.defer="state.nom" placeholder="{{Auth::user()->etudiant->nom}}" autocomplete="nom" />
            <x-jet-input-error for="nom" class="mt-2" />
        </div>

        <!-- Surname -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="prenom" value="{{ __('Prenom') }}" />
            <x-jet-input id="prenom" type="text" class="mt-1 block w-full" wire:model.defer="state.prenom" placeholder="{{Auth::user()->etudiant->prenom}}" autocomplete="prenom" />
            <x-jet-input-error for="prenom" class="mt-2" />
        </div>

        <!-- Classe / École -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="classe" value="{{ __('Classe / École') }}" />
            <x-jet-input id="classe" type="text" class="mt-1 block w-full" wire:model.defer="state.classe" placeholder="{{Auth::user()->etudiant->classe}}" autocomplete="classe" />
            <x-jet-input-error for="classe" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>

        @else

        <!-- Matricule -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="matricule" value="{{ __('Name') }}" />
            <x-jet-input id="matricule" type="text" class="mt-1 block w-full" wire:model.defer="state.matricule" placeholder="{{Auth::user()->name}}" autocomplete="matricule" />
            <x-jet-input-error for="matricule" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>

        @endif
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Sauvegarder') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>