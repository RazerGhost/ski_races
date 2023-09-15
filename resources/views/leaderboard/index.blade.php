<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ski-race LeaderBoard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __('Competing racers table') }}
                    </div>
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('Racerboard.addracer') }}">
                        {{ __('Voeg een nieuwe racer toe') }}
                    </a>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Racerboard as $Racer)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
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
                                            <a href="{{ route('Racerboard.edit', $Racer->id) }}"
                                                class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600">
                                                {{ __('Edit') }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <form action="{{ route('Racerboard.destroy', $Racer->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600">
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
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('Racerboard.addracer') }}">
                        {{ __('Voeg nieuwe tijden toe') }}
                    </a> 
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Tripleboard as $TripleLapTimes)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> --}}

                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __('Snelste tijd') }}
                    </div>
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('Doubleboard.addDBLlaptimes') }}">
                        {{ __('Voeg nieuwe tijden toe') }}
                    </a> 
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Doubleboard as $FastestLap)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __('Samengevoegde tijd') }}
                    </div>

                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('Doubleboard.addDBLlaptimes') }}">
                        {{ __('Voeg nieuwe tijden toe') }}
                    </a> 
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Doubleboard as $AverageLap)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
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
