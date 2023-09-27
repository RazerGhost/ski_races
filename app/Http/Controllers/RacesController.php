<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Racerboard;
use App\Models\Racesboard;

class RacesController extends Controller
{
    public function addRace(): View
    {
        $Races = Racesboard::all();
        $Racerboard = Racerboard::all();
        return view('leaderboard.add.addRace', compact('Races', 'Racerboard'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'format' => 'required',
            'location' => 'required',
            'date' => 'required',
            'racers' => 'required',
        ]);

        //dd($request->all());

        Racesboard::create([
            'title' => $request->title,
            'description' => $request->description,
            'format' => $request->format,
            'location' => $request->location,
            'date' => $request->date,
            'racers' => $request->racers,
        ]);



        return redirect()->route('Leaderboard.races');
    }

    public function editRace($id): View
    {
        $Races = Racesboard::find($id);
        $Racerboard = Racerboard::all();
        return view('Leaderboard.editRace', compact('Racerboard', 'Races'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $Races = Racesboard::find($id);
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'format' => 'required',
            'location' => 'required',
            'date' => 'required',
            'racers' => 'required',
        ]);

        $Races->update([
            'title' => $request->title,
            'description' => $request->description,
            'format' => $request->format,
            'location' => $request->location,
            'date' => $request->date,
            'racers' => $request->racers,
        ]);

        return redirect()->route('leaderboard.races');

    }

    public function destroy($id): RedirectResponse
    {
        $Races = Racesboard::find($id);
        $Races->delete();

        return redirect()->route('Leaderboard.races');
    }
}