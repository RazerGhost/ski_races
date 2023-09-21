<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Drie dubbele ronde aan het toevoegen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('Tripleboard.store') }}">
                        @csrf

                        <!-- Racer Rugnummer -->
                        <div class="mt-4">
                            <x-input-label for="racer_id" :value="__('racer_id')" />
                            <x-text-input id="racer_id" class="block mt-1 w-full" type="text" name="racer_id" :value="old('racer_id')" required autofocus autocomplete="racer_id" />
                            <x-input-error :messages="$errors->get('racer_id')" class="mt-2" />
                        </div>

                        <!-- First Lap -->
                        <div class="mt-4">
                            <x-input-label for="firstlap" :value="__('firstlap')" />
                            <x-text-input id="firstlap" class="block mt-1 w-full" type="text" name="firstlap" :value="old('firstlap')" required autocomplete="firstlap" />
                            <x-input-error :messages="$errors->get('firstlap')" class="mt-2" />
                        </div>

                        <!-- Second Lap -->
                        <div class="mt-4">
                            <x-input-label for="secondlap" :value="__('secondlap')" />
                            <x-text-input id="secondlap" class="block mt-1 w-full" type="text" name="secondlap" :value="old('secondlap')" required autocomplete="secondlap" />
                            <x-input-error :messages="$errors->get('secondlap')" class="mt-2" />
                        </div>

                        <!-- Third Lap -->
                        <div class="mt-4">
                            <x-input-label for="thirdlap" :value="__('thirdlap')" />
                            <x-text-input id="thirdlap" class="block mt-1 w-full" type="text" name="thirdlap" :value="old('thirdlap')" required autocomplete="thirdlap" />
                            <x-input-error :messages="$errors->get('thirdlap')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Voeg ronde tijden toe') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>