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
                    <form method="POST" action="{{ route('Race.update', ['race' => $Racesboard->id]) }}">
                        @csrf
                        <!-- Voornaam -->
                        <div class="mt-4">
                            <x-input-label for="title" :value="__('title')" />
                            <x-text-input id="title" class="mt-1 block w-full" type="text" name="title" :value="$Racesboard->title" :placeholder="$Racesboard->title" required autofocus autocomplete="title" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Achternaam -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('description')" />
                            <x-text-input id="description" class="mt-1 block w-full" type="text" name="description" :value="$Racesboard->description" :placeholder="$Racesboard->description" required autocomplete="description" />
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Geslacht -->
                        <div class="mt-4">
                            <x-input-label for="format" :value="__('format')" />
                            <select name="format" id="format" :placeholder="$Racesboard - > format" class="mt-1 block w-full text-black" required autocomplete="format">
                                <option value="3x"> 3 Rondes</option>
                                <option value="2xf"> 2 Rondes Snelste tijd</option>
                                <option value="2xa"> 2 Rondes Gemiddelde tijd</option>
                            </select>
                            <x-input-error :messages="$errors->get('format')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="location" :value="__('location')" />
                            <x-text-input id="location" class="mt-1 block w-full" type="text" name="location" :value="$Racesboard->location" :placeholder="$Racesboard->location" required autocomplete="location" />
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>

                        <!-- DOB -->
                        <div class="mt-4">
                            <x-input-label for="date" :value="__('date')" />
                            <x-text-input id="date" class="mt-1 block w-full" type="date" name="date" :value="$Racesboard->date" :placeholder="$Racesboard->date" required autocomplete="date" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="racers" :value="__('racers')" />
                            <select name="racers" id="racers" class="mt-1 block w-full text-black" required autocomplete="racers" multiple data-placeholder="Add tools">
                                @foreach ($RaceBoard as $Racer )
                                <option value="{{ $Racer->id }}-{{ $Racer->voornaam }}-{{ $Racer->achternaam }}">{{ $Racer->voornaam }} {{ $Racer->achternaam }}</option>

                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('racers')" class="mt-2" />
                        </div>

                        <!-- Categorie -->
                        {{-- <div class="mt-4">
                            <x-input-label for="Categorie" :value="__('Categorie')" />
                            <x-text-input id="Categorie" class="block mt-1 w-full" type="text" name="Categorie"
                                :value="old('Categorie')" required autocomplete="Categorie" />
                        </div> --}}
                        <div class="mt-4 flex items-center justify-end">
                            <x-primary-button class="ml-4">
                                {{ __('Vervang Race Data') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
