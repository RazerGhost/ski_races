<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Race aan het toevoegen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('Racesboard.store') }}">
                        @csrf

                        <!-- Race Title -->
                        <div class="mt-4">
                            <x-input-label for="title" :value="__('title')" />
                            <x-text-input id="title" class="mt-1 block w-full" type="text" name="title" :value="old('title')" required autofocus autocomplete="title" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Race Description -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('description')" />
                            <x-text-input id="description" class="mt-1 block w-full" type="text" name="description" :value="old('description')" required autocomplete="description" />
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Race Format -->
                        <div class="mt-4">
                            <x-input-label for="format" :value="__('format')" />
                            <select name="format" id="format" class="mt-1 block w-full text-black" required autocomplete="format">
                                <option value="3x"> 3 Rondes</option>
                                <option value="2xf"> 2 Rondes Snelste tijd</option>
                                <option value="2xa"> 2 Rondes Gemiddelde tijd</option>
                            </select>
                            <x-input-error :messages="$errors->get('format')" class="mt-2" />
                        </div>

                        <!-- Race Location -->
                        <div class="mt-4">
                            <x-input-label for="location" :value="__('location')" />
                            <x-text-input id="location" class="mt-1 block w-full" type="text" name="location" :value="old('location')" required autocomplete="location" />
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>

                        <!-- Race Date -->
                        <div class="mt-4">
                            <x-input-label for="date" :value="__('date')" />
                            <x-text-input id="date" class="mt-1 block w-full" type="date" name="date" :value="old('date')" required autocomplete="date" />
                        </div>

                        <!-- Race Contestants -->
                        <div class="mt-4">
                            <x-input-label for="racers" :value="__('racers')" />
                            <select multiple name="racers[]" id="racers" class="mt-1 block w-full text-black" required autocomplete="racers">
                                @foreach ($Racerboard as $Racer)
                                    <option value="{{ $Racer->id }}">{{ $Racer->id }} {{ $Racer->voornaam }} {{ $Racer->achternaam }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('racers')" class="mt-2" />
                        </div>

                        <!-- Selected Users Section -->
                        <div class="mt-4">
                            <x-input-label :value="__('Selected Racers')" />
                            <select multiple id="selected-racers" class="mt-1 block w-full text-black" required disabled>
                                <!-- Selected users will appear here -->
                            </select>
                        </div>

                        <script>
                            // JavaScript to move selected options to the "Selected Users" section
                            const racersSelect = document.getElementById('racers');
                            const selectedRacersSelect = document.getElementById('selected-racers');

                            racersSelect.addEventListener('change', function() {
                                // Clear the "Selected Racers" select box
                                selectedRacersSelect.innerHTML = '';

                                // Loop through the options in the main select box
                                for (const option of racersSelect.options) {
                                    if (option.selected) {
                                        // Create a new option element for the "Selected Racers" select box
                                        const selectedOption = document.createElement('option');
                                        selectedOption.value = option.value;
                                        selectedOption.text = option.text;

                                        // Append the selected option to the "Selected Racers" select box
                                        selectedRacersSelect.appendChild(selectedOption);
                                    }
                                }
                            });
                        </script>

                        <div class="mt-4 flex items-center justify-end">
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
