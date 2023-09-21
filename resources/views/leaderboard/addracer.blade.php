<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Deelnemer aan het toevoegen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('Racerboard.store') }}">
                        @csrf

                        <!-- Voornaam -->
                        <div class="mt-4">
                            <x-input-label for="voornaam" :value="__('voornaam')" />
                            <x-text-input id="voornaam" class="block mt-1 w-full" type="text" name="voornaam" :value="old('voornaam')" required autofocus autocomplete="voornaam" />
                            <x-input-error :messages="$errors->get('voornaam')" class="mt-2" />
                        </div>

                        <!-- Achternaam -->
                        <div class="mt-4">
                            <x-input-label for="achternaam" :value="__('achternaam')" />
                            <x-text-input id="achternaam" class="block mt-1 w-full" type="text" name="achternaam" :value="old('achternaam')" required autocomplete="achternaam" />
                            <x-input-error :messages="$errors->get('achternaam')" class="mt-2" />
                        </div>

                        <!-- Geslacht -->
                        <div class="mt-4">
                            <x-input-label for="geslacht" :value="__('geslacht')" />
                            <select name="geslacht" id="geslacht" class="block mt-1 w-full text-black" required autocomplete="geslacht">
                                <option value="Man"> Man</option>
                                <option value="Vrouw"> Vrouw</option>
                            </select>
                            <x-input-error :messages="$errors->get('geslacht')" class="mt-2" />
                        </div>

                        <!-- DOB -->
                        <div class="mt-4">
                            <x-input-label for="geboortedatum" :value="__('geboortedatum')" />
                            <x-text-input id="geboortedatum" class="block mt-1 w-full" type="date" name="geboortedatum" :value="old('geboortedatum')" required autocomplete="geboortedatum" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Voeg Deelnemer toe') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>