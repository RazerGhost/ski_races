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
                <div class="p-6">
                    <div class="mb-8 overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                        <div class="gap-10 p-6 text-gray-900 dark:text-gray-100">
                            <p class="text-sm font-semibold">{{ __($Race->date) }}</p>
                            <h2 class="text-lg font-semibold">{{ __($Race->title) }}</h2>
                            <p class="text-l font-semibold">Format: {{ __($Race->format) }} Rondes</p>
                            <p class="text-l font-semibold">{{ __($Race->description) }}</p>
                            <p class="text-l font-semibold">{{ __($Race->location) }}</p>
                        </div>
                        <div class="p-6">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <div class="flex items-center justify-between">
                                    <h2 class="text-lg font-semibold">{{ __('Deelnemers table') }}</h2>
                                </div>
                            </div>
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
                                                <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600" type="button">
                                                    {{ __('Delete') }}
                                                </button>

                                                <div id="popup-modal" tabindex="-1" class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full overflow-y-auto overflow-x-hidden p-4 md:inset-0">
                                                    <div class="relative max-h-full w-full max-w-md">
                                                        <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                                                            <button type="button" class="absolute right-2.5 top-3 ml-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                                                                <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                            <div class="p-6 text-center">
                                                                <svg class="mx-auto mb-4 h-12 w-12 text-gray-400 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                                </svg>
                                                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Weet je zeker dat je deze deelnemer wilt verwijderen?
Je hebt de keuze om de deelnemer van elke race te verwijderen of om hem/haar alleen binnen deze race te verwijderen</h3>
                                                                <form action="{{ route('Racesboard.destroyracer', ['id' => $Race->id, 'racer' => $Racer->id]) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600">
                                                                        {{ __('Verwijder binnen de race') }}
                                                                    </button>
                                                                </form>
                                                                <form action="{{ route('Racesboard.destroyracerglobal', ['id2' => $Race->id, 'racer2' => $Racer->id]) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600">
                                                                        {{ __('Verwijder van elke race') }}
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="mb-8 overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                        <div class="p-6">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <h2 class="text-lg font-semibold">{{ __('Snelste tijd') }}</h2>
                            </div>
                            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                                <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            {{ __('id') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            {{ __('Race_ID') }}
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
                                            {{ __('Acties') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($CollectedRaceTimes2x as $FastestLap)
                                        <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                                            <th scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white">
                                                {{ __($FastestLap->id) }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ __($FastestLap->race_id) }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ __($FastestLap->racer_id) }}
                                            </td>
                                            <td class="px-6 py-4">
                                                @if ($FastestLap->firstlap == 0)
                                                    {{ __('DNF') }}
                                                @else
                                                    {{ __($FastestLap->firstlap) }}
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                @if ($FastestLap->secondlap == 0)
                                                    {{ __('DNF') }}
                                                @else
                                                    {{ __($FastestLap->secondlap) }}
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                <a href="{{ route('Doubleboard.edit', ['id' => $FastestLap->id, 'racer_id' => $FastestLap->racer_id]) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600">
                                                    {{ __('Edit') }}
                                                </a>
                                                <form action="{{ route('Doubleboard.destroy', $FastestLap->id) }}" method="POST">
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
                                    <a href="{{ route('Tripleboard.addTRPLlaptimes', ['id' => $Race->id, 'title' => $Race->title]) }}"> {{ __('Voeg nieuwe tijden toe') }} </a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
