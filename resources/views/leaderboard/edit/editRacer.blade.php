<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Deelnemer aan het aanpassen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('Racerboard.update', ['racer' => $Racerboard->id]) }}">
                        @csrf
                        <!-- Voornaam -->
                        <div class="mt-4">
                            <x-input-label for="voornaam" :value="__('voornaam')" />
                            <x-text-input id="voornaam" class="mt-1 block w-full" type="text" name="voornaam" :value="$Racerboard->voornaam" :placeholder="$Racerboard->voornaam" required autofocus autocomplete="voornaam" />
                            <x-input-error :messages="$errors->get('voornaam')" class="mt-2" />
                        </div>

                        <!-- Achternaam -->
                        <div class="mt-4">
                            <x-input-label for="achternaam" :value="__('achternaam')" />
                            <x-text-input id="achternaam" class="mt-1 block w-full" type="text" name="achternaam" :value="$Racerboard->achternaam" :placeholder="$Racerboard->achternaam" required autocomplete="achternaam" />
                            <x-input-error :messages="$errors->get('achternaam')" class="mt-2" />
                        </div>

                        <!-- Geslacht -->
                        <div class="mt-4">
                            <x-input-label for="geslacht" :value="__('geslacht')" />
                            <select name="geslacht" id="geslacht" :placeholder="$Racerboard->geslacht" class="mt-1 block w-full text-black" required autocomplete="geslacht">
                                <option value="Man"> Man</option>
                                <option value="Vrouw"> Vrouw</option>
                            </select>
                            <x-input-error :messages="$errors->get('geslacht')" class="mt-2" />
                        </div>

                        <!-- DOB -->
                        <div class="mt-4">
                            <x-input-label for="geboortedatum" :value="__('geboortedatum')" />
                            <x-text-input id="geboortedatum" class="mt-1 block w-full" type="date" name="geboortedatum" :value="$Racerboard->geboortedatum" :placeholder="$Racerboard->geboortedatum" required autocomplete="geboortedatum" />
                        </div>

                        <div class="mt-4 flex items-center justify-end">
                            <x-primary-button class="ml-4">
                                {{ __('Vervang Deelnemer Data') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
