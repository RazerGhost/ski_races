<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Drie dubbele ronde aan het aanpassen') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('Tripleboard.update', ['racer' => $Tripleboard->id]) }}">
                        @csrf
                        <!-- Voornaam -->
                        <div class="mt-4">
                            <x-input-label for="racer_id" :value="__('racer_id')" />
                            <select id="racer_id" name="racer_id" class="mt-1 block w-full text-black" required autofocus autocomplete="racer_id">
                                <option value="">Select Race ID</option>
                                @foreach ($Racerboard as $Racer)
                                    <option value="{{ $Racer->id }}">{{ $Racer->id }} {{ $Racer->voornaam }} {{ $Racer->achternaam }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('racer_id')" class="mt-2" />
                        </div>

                        <!-- firstlap -->
                        <div class="mt-4">
                            <x-input-label for="firstlap" :value="__('firstlap')" />
                            <x-text-input id="firstlap" class="mt-1 block w-full" type="text" name="firstlap" :value="$Tripleboard->firstlap" :placeholder="$Tripleboard->firstlap" required autocomplete="firstlap" />
                            <x-input-error :messages="$errors->get('firstlap')" class="mt-2" />
                        </div>

                        <!-- secondlap -->
                        <div class="mt-4">
                            <x-input-label for="secondlap" :value="__('secondlap')" />
                            <x-text-input id="secondlap" class="mt-1 block w-full" type="text" name="secondlap" :value="$Tripleboard->secondlap" :placeholder="$Tripleboard->secondlap" required autocomplete="secondlap" />
                            <x-input-error :messages="$errors->get('secondlap')" class="mt-2" />
                        </div>

                        <!-- thirdlap -->
                        <div class="mt-4">
                            <x-input-label for="thirdlap" :value="__('thirdlap')" />
                            <x-text-input id="thirdlap" class="mt-1 block w-full" type="text" name="thirdlap" :value="$Tripleboard->thirdlap" :placeholder="$Tripleboard->thirdlap" required autocomplete="thirdlap" />
                            <x-input-error :messages="$errors->get('thirdlap')" class="mt-2" />
                        </div>

                        <div class="mt-4 flex items-center justify-end">
                            <x-primary-button class="ml-4">
                                {{ __('Vervang Drie dubbele ronde Data') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
