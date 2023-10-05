<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Racerboard;
use App\Models\Doubleboard;
use App\Models\Tripleboard;
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
            'title' => 'required|unique:races',
            'description' => 'required',
            'format' => 'required',
            'location' => 'required',
            'date' => 'required',
            'racers' => 'required',
        ]);

        Racesboard::create([
            'title' => $request->title,
            'description' => $request->description,
            'format' => $request->format,
            'location' => $request->location,
            'date' => $request->date,
            'racers' => $request->racers,
        ]);

        return redirect()->route('Leaderboard.index');
    }


    public function destroy($id): RedirectResponse
    {
        $Races = Racesboard::find($id);
        $Doubleboard = Doubleboard::where('race_id', $id);
        $Tripleboard = Tripleboard::where('race_id', $id);

        $Doubleboard->delete();
        $Tripleboard->delete();
        $Races->delete();

        return redirect()->route('Leaderboard.index');
    }

    public function destroyracer($id, $racer): RedirectResponse
    {
        $Racerboard = Racerboard::find($racer);

        // * Find the record with the given id
        $Racesboard = Racesboard::find($id);
        // * Defines the Racers Variable as the row in the 'Racesboard' model that matches the given id
        $Racers = $Racesboard->racers;
        // * Remove the racer from the array
        $UpdatedRacers = array_diff($Racers, [$racer]);
        // * Re-index the array
        $UpdatedRacers = array_values($UpdatedRacers);
        // * Update the array in the database
        $Racesboard->racers = $UpdatedRacers;
        // * Save the changes
        $Racesboard->save();
        // * Finds the row in Doubleboard that matches the given racer
        $Doubleboard = Doubleboard::where('racer_id', $racer);
        // * Finds the row in Tripleboard that matches the given racer
        $Tripleboard = Tripleboard::where('racer_id', $racer);

        // * Delete the records
        $Doubleboard->delete();
        $Tripleboard->delete();

        return redirect()->route('Leaderboard.race', $id);
    }
}