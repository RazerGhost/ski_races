<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Racer aan het toevoegen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('Racerboard.update', ['racer' => $Racerboard->id]) }}">
                        @csrf
                        <!-- Voornaam -->
                        <div class="mt-4">
                            <x-input-label for="voornaam" :value="__('voornaam')" />
                            <x-text-input id="voornaam" class="block mt-1 w-full" type="text" name="voornaam"
                                :value="$Racerboard->voornaam" :placeholder="$Racerboard->voornaam" required autofocus autocomplete="voornaam" />
                            <x-input-error :messages="$errors->get('voornaam')" class="mt-2" />
                        </div>

                        <!-- Achternaam -->
                        <div class="mt-4">
                            <x-input-label for="achternaam" :value="__('achternaam')" />
                            <x-text-input id="achternaam" class="block mt-1 w-full" type="text" name="achternaam"
                                :value="$Racerboard->achternaam" :placeholder="$Racerboard->achternaam" required autocomplete="achternaam" />
                            <x-input-error :messages="$errors->get('achternaam')" class="mt-2" />
                        </div>

                        <!-- Geslacht -->
                        <div class="mt-4">
                            <x-input-label for="geslacht" :value="__('geslacht')" />
                            <x-text-input id="geslacht" class="block mt-1 w-full" type="text" name="geslacht"
                                :value="$Racerboard->geslacht" :placeholder="$Racerboard->geslacht" required autocomplete="geslacht" />
                            <x-input-error :messages="$errors->get('geslacht')" class="mt-2" />
                        </div>

                        <!-- DOB -->
                        <div class="mt-4">
                            <x-input-label for="geboortedatum" :value="__('geboortedatum')" />
                            <x-text-input id="geboortedatum" class="block mt-1 w-full" type="date"
                                name="geboortedatum" :value="$Racerboard->geboortedatum" :placeholder="$Racerboard->geboortedatum" required
                                autocomplete="geboortedatum" />
                        </div>

                        <!-- Categorie -->
                        {{-- <div class="mt-4">
                            <x-input-label for="Categorie" :value="__('Categorie')" />
                            <x-text-input id="Categorie" class="block mt-1 w-full" type="text" name="Categorie"
                                :value="old('Categorie')" required autocomplete="Categorie" />
                        </div> --}}
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Vervang Racer Data') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
