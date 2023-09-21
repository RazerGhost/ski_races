<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ski-race Leaderboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __('Deelnemers table') }}
                    </div>
                    <div class="mt-4">
                        <form action="{{ route('Leaderboard.racerfilter') }}" method="POST">
                            @csrf
                            <input class="mt-1 text-black" type="text" name="voornaam" placeholder="Filter by Voornaam" value="{{ request('voornaam') }}">
                            <input class="mt-1 text-black" type="text" name="achternaam" placeholder="Filter by Achternaam" value="{{ request('achternaam') }}">
                            <select name="geslacht" class="mt-1 text-black">
                                <option value="">Filter by Geslacht</option>
                                <option value="Man" @if (request('geslacht')==='Man' ) selected @endif>Man</option>
                                <option value="Vrouw" @if (request('geslacht')==='Vrouw' ) selected @endif>Vrouw</option>
                            </select>
                            <input class="mt-1 text-black" type="date" name="geboortedatum" placeholder="Filter by Geboortedatum" value="{{ request('geboortedatum') }}">
                            <select class="mt-1 text-black" name="categorie">
                                <option value="">Filter by Categorie</option>
                                <option value="U8" @if (request('categorie')==='U8' ) selected @endif>U8</option>
                                <option value="U10" @if (request('categorie')==='U10' ) selected @endif>U10</option>
                                <option value="U12" @if (request('categorie')==='U12' ) selected @endif>U12</option>
                                <option value="U14" @if (request('categorie')==='U14' ) selected @endif>U14</option>
                                <option value="U16" @if (request('categorie')==='U16' ) selected @endif>U16</option>
                                <option value="U18" @if (request('categorie')==='U18' ) selected @endif>U18</option>
                                <option value="U21" @if (request('categorie')==='U21' ) selected @endif>U21</option>
                            </select>
                            <button type="submit">Apply Filters</button>
                        </form>
                        <a href="{{ route('Leaderboard.reset') }}">
                            {{ __('Reset Filters') }}
                        </a>
                        <a href="{{ route('Racerboard.addracer') }}">
                            {{ __('Voeg een nieuwe Deelnemer toe') }}
                        </a>
                    </div>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
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

                    {{-- <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __('Drie ronde race') }}
                </div>
                <a href="{{ route('Racerboard.addracer') }}">
                    {{ __('Voeg nieuwe tijden toe') }}
                </a>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                                    {{ __('Derde Ronde') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('Acties') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Tripleboard as $TripleLapTime)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ __($TripleLapTime->id) }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ __($TripleLapTime->racer_id) }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ __($TripleLapTime->firstlap) }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ __($TripleLapTime->secondlap) }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ __($TripleLapTime->thirdlap) }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('Tripleboard.editTRPLlaptimes', $TripleLapTime->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600">
                                        {{ __('Edit') }}
                                    </a>
                                    <form action="{{ route('Tripleboard.destroy', $TripleLapTime->id) }}" method="POST">
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
                </div> --}}

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('Snelste tijd') }}
                </div>
                <a href="{{ route('Doubleboard.addDBLlaptimes') }}">
                    {{ __('Voeg nieuwe tijden toe') }}
                </a>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
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
                </div>

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('Samengevoegde tijd') }}
                </div>

                <a href="{{ route('Doubleboard.addDBLlaptimes') }}">
                    {{ __('Voeg nieuwe tijden toe') }}
                </a>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
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
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>

<?php

?>