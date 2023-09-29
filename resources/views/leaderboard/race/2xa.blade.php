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
                <div class="gap-10 p-6 text-gray-900 dark:text-gray-100">
                    <p class="text-sm font-semibold">{{ __($Race->date) }}</p>
                    <h2 class="text-lg font-semibold">{{ __($Race->title) }}</h2>
                    <p class="text-l font-semibold">Format: {{ __($Race->format) }} Rondes</p>
                    <p class="text-l font-semibold">{{ __($Race->description) }}</p>
                    <p class="text-l font-semibold">{{ __($Race->location) }}</p>
                </div>
                <div class="p-6">
                    <class="mb-8 overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="flex items-center justify-between">
                                <h2 class="text-lg font-semibold">{{ __('Deelnemers table') }}</h2>
                            </div>
                        </div>
                        <div class="p-6">
                            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                                <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            {{ __('Rugnummer') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            {{ __('Voornaam') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            {{ __('Achternaam') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            {{ __('Geslacht') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            {{ __('geboortedatum') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            {{ __('Categorie') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            {{ __('Acties') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($CollectedRacerIDs as $Racer)
                                        <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                                            <th scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white">
                                                {{ __($Racer->id) }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ __($Racer->voornaam) }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ __($Racer->achternaam) }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ __($Racer->geslacht) }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ __($Racer->geboortedatum) }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ __($Racer->categorie) }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <a href="{{ route('Racerboard.edit', $Racer->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600">
                                                    {{ __('Edit') }}
                                                </a>
                                                <form action="{{ route('Racerboard.destroy', $Racer->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600">
                                                        {{ __('Delete') }}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h2 class="text-lg font-semibold">{{ __('Snelste tijd') }}</h2>
                        </div>
                        <div class="p-6">
                            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                                <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            {{ __('id') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            {{ __('Rugnummer') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            {{ __('Eerste ronde') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            {{ __('Tweede Ronde') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            {{ __('Gemiddelde tijd') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            {{ __('Acties') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($CollectedRaceTimes2x as $AverageLap)
                                        <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                                            <th scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white">
                                                {{ __($AverageLap->id) }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ __($AverageLap->racer_id) }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ __($AverageLap->firstlap) }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ __($AverageLap->secondlap) }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ __($AverageLap->averagelap) }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <a href="{{ route('Doubleboard.edit', $AverageLap->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600">
                                                    {{ __('Edit') }}
                                                </a>
                                                <form action="{{ route('Doubleboard.destroy', $AverageLap->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600">
                                                        {{ __('Delete') }}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="relative py-4">
                                <button class="rounded-md bg-blue-500 px-4 py-2 text-white hover:bg-blue-600 focus:border-blue-300 focus:outline-none focus:ring">
                                    <a href="{{ route('Doubleboard.addDBLlaptimes', $Race->title) }}"> {{ __('Voeg nieuwe tijden toe') }} </a>
                                </button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
