<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Ski-race Leaderboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- First Box -->
            <div class="mb-8 overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold">{{ __($Race->title) }}</h2>
                    <p class="text-lg font-semibold">Format: Rondes ( {{ __($Race->format) }} )</p>
                </div>
                <div class="p-6">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
