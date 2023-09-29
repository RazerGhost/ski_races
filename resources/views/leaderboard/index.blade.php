<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Ski-race Leaderboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="relative rounded border border-red-400 bg-red-100 px-4 py-3 text-red-700" role="alert" id="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('status') }}.</span>
                    <span class="absolute bottom-0 right-0 top-0 px-4 py-3">
                        <svg class="h-6 w-6 fill-current text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <title>Close</title>
                            <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                        </svg>
                    </span>
                </div>
            @endif
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
                </div>
            </div>
            <!-- Second Box -->
            <div class="mb-8 overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold">{{ __('Bestaande Races') }}</h2>
                </div>
                <div class="p-6">
                    <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                        <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('id') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('title') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('description') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('format') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('location') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('date') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('racers') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('Acties') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Races as $Race)
                                <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                                    <th scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{ __($Race->id) }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ __($Race->title) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ __($Race->description) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ __($Race->format) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ __($Race->location) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ __($Race->date) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('Leaderboard.race', $Race->title) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600">
                                            @foreach ($Race->racers as $Racer)
                                                {{ $Racer }}
                                            @endforeach
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{-- <a href="{{ route('Racesboard.edit', $Race->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600">
                                            {{ __('Edit') }}
                                        </a> --}}
                                        <form action="{{ route('Racesboard.destroy', $Race->id) }}" method="POST">
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
                            <a href="{{ route('Racesboard.addRace') }}"> {{ __('Voeg nieuwe race toe') }} </a>
                        </button>
                    </div>
                </div>
            </div>
            <!-- * ! Third Box -->
        </div>
    </div>
</x-app-layout>