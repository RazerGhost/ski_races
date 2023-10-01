<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dubbele ronde aan het aanpassen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('Doubleboard.update', ['id' => $Doubleboard->id, 'racer_id' => $Racerboard->id]) }}">
                        @csrf

                        <!-- First Lap -->
                        <div class="mt-4">
                            <x-input-label for="firstlap" :value="__('firstlap')" />
                            <x-text-input id="firstlap" class="mt-1 block w-full" type="text" name="firstlap" :value="$Doubleboard->firstlap" :placeholder="$Doubleboard->firstlap" required autocomplete="firstlap" />
                            <x-input-error :messages="$errors->get('firstlap')" class="mt-2" />
                        </div>

                        <!-- Second Lap -->
                        <div class="mt-4">
                            <x-input-label for="secondlap" :value="__('secondlap')" />
                            <x-text-input id="secondlap" class="mt-1 block w-full" type="text" name="secondlap" :value="$Doubleboard->secondlap" :placeholder="$Doubleboard->secondlap" required autocomplete="secondlap" />
                            <x-input-error :messages="$errors->get('secondlap')" class="mt-2" />
                        </div>

                        <div class="mt-4 flex items-center justify-end">
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
