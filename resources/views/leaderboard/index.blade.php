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
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold">{{ __('Deelnemers table') }}</h2>
                        <button id="toggleFilters" class="rounded-md bg-blue-500 px-4 py-2 text-white hover:bg-blue-600 focus:border-blue-300 focus:outline-none focus:ring">
                            Filters
                        </button>
                    </div>
                </div>
                <div id="filterContainer" class="hidden">
                    <!-- Filter Form for Deelnemers -->
                    <div class="px-5">
                        <form action="{{ route('Leaderboard.racerfilter') }}" method="POST" class="flex flex-wrap space-x-2">
                            @csrf
                            <div class="relative mt-2">
                                <input class="mt-1 rounded-md border px-2 py-1 text-black focus:border-blue-300 focus:outline-none focus:ring" type="text" name="voornaam" placeholder="Filter by Voornaam" value="{{ request('voornaam') }}">
                            </div>
                            <div class="relative mt-2">
                                <input class="mt-1 rounded-md border px-2 py-1 text-black focus:border-blue-300 focus:outline-none focus:ring" type="text" name="achternaam" placeholder="Filter by Achternaam" value="{{ request('achternaam') }}">
                            </div>
                            <div class="relative mt-2">
                                <select name="geslacht" class="mt-1 rounded-md border px-3 py-1 text-black focus:border-blue-300 focus:outline-none focus:ring">
                                    <option value="">Geslacht</option>
                                    <option value="Man" @if (request('geslacht') === 'Man') selected @endif>Man</option>
                                    <option value="Vrouw" @if (request('geslacht') === 'Vrouw') selected @endif>Vrouw</option>
                                </select>
                            </div>
                            <div class="relative mt-2">
                                <input class="mt-1 rounded-md border px-2 py-1 text-black focus:border-blue-300 focus:outline-none focus:ring" type="date" name="geboortedatum" placeholder="Filter by Geboortedatum" value="{{ request('geboortedatum') }}">
                            </div>
                            <div class="relative mt-2">
                                <select class="mt-1 rounded-md border px-3 py-1 text-black focus:border-blue-300 focus:outline-none focus:ring" name="categorie">
                                    <option value="">Filter by Categorie</option>
                                    <option value="U8" @if (request('categorie') === 'U8') selected @endif>U8</option>
                                    <option value="U10" @if (request('categorie') === 'U10') selected @endif>U10</option>
                                    <option value="U12" @if (request('categorie') === 'U12') selected @endif>U12</option>
                                    <option value="U14" @if (request('categorie') === 'U14') selected @endif>U14</option>
                                    <option value="U16" @if (request('categorie') === 'U16') selected @endif>U16</option>
                                    <option value="U18" @if (request('categorie') === 'U18') selected @endif>U18</option>
                                    <option value="U21" @if (request('categorie') === 'U21') selected @endif>U21</option>
                                </select>
                            </div>
                            <div class="relative mt-2">
                                <button type="submit" class="rounded-md bg-blue-500 px-4 py-2 text-white hover:bg-blue-600 focus:border-blue-300 focus:outline-none focus:ring">Apply Filters</button>
                            </div>
                            <div class="relative mt-2">
                                <button class="rounded-md bg-blue-500 px-4 py-2 text-white hover:bg-blue-600 focus:border-blue-300 focus:outline-none focus:ring">
                                    <a href="{{ route('Leaderboard.reset') }}">{{ __('Reset Filters') }}</a>
                                </button>
                            </div>
                        </form>
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
                            @foreach ($Racerboard as $Racer)
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
                    <div class="relative py-4">
                        <button class="rounded-md bg-blue-500 px-4 py-2 text-white hover:bg-blue-600 focus:border-blue-300 focus:outline-none focus:ring">
                            <a href="{{ route('Racerboard.addracer') }}">{{ __('Voeg een Deelnemer toe') }}</a>
                        </button>
                    </div>
                    <script>
                        document.getElementById("toggleFilters").addEventListener("click", function() {
                            var filterContainer = document.getElementById("filterContainer");
                            if (filterContainer.classList.contains("hidden")) {
                                filterContainer.classList.remove("hidden");
                            } else {
                                filterContainer.classList.add("hidden");
                            }
                        });
                    </script>
                </div>
            </div>
            <!-- Second Box -->
            <div class="mb-8 overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
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
                                    {{ __('Acties') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Doubleboard as $FastestLap)
                                <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                                    <th scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{ __($FastestLap->id) }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ __($FastestLap->racer_id) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ __($FastestLap->firstlap) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ __($FastestLap->secondlap) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('Doubleboard.edit', $FastestLap->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600">
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
                            <a href="{{ route('Doubleboard.addDBLlaptimes') }}"> {{ __('Voeg nieuwe tijden toe') }} </a>
                        </button>
                    </div>
                </div>
            </div>
            <!-- * ! Third Box -->
            <div class="mb-8 overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold">{{ __('Samengevoegde tijd') }}</h2>
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
                            @foreach ($Doubleboard as $AverageLap)
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
                            <a href="{{ route('Doubleboard.addDBLlaptimes') }}"> {{ __('Voeg nieuwe tijden toe') }} </a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
