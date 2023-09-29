<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Racerboard;
use App\Models\Racesboard;
use App\Models\Doubleboard;

class DoublelapController extends Controller
{
    public function addDBLlaptimes($title): View
    {
        $Racerboard = Racerboard::all();
        $Racesboard = Racesboard::all();
        $Race = Racesboard::where('title', $title)->first();
        $CollectedRacerIDs = Racerboard::whereIn('id', $Race->racers)->get();
        return view('leaderboard.add.addDBLlaptimes', compact('CollectedRacerIDs', 'Racesboard'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'racer_id' => 'required|exists:racers,id',
            'race_id' => 'required',
            'firstlap' => [
                'required' => 'required',
                'max' => 'max:5,5',
            ],
            'secondlap' => [
                'required' => 'required',
                'max' => 'max:5,5',
            ],
        ]);

        $firstlap = $request->firstlap;
        $secondlap = $request->secondlap;
        $AverageLap = $this->calculateAverage($firstlap, $secondlap);

        Doubleboard::create([
            'racer_id' => $request->racer_id,
            'race_id' => $request->race_id,
            'firstlap' => $request->firstlap,
            'secondlap' => $request->secondlap,
            'averagelap' => $AverageLap,
        ]);

        return redirect()->route('Leaderboard.index');
    }

    public function edit($id): View
    {
        $Doubleboard = Doubleboard::find($id);
        $Racerboard = Racerboard::all();
        $Racesboard = Racesboard::all();
        return view('Leaderboard.edit.editDBLlaptimes', compact('Doubleboard', 'Racerboard', 'Racesboard'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        // Find the record with the given id
        $Doubleboard = Doubleboard::find($id);
        // Validate the form data
        $request->validate([
            'racer_id' => 'required|exists:racers,id',
            'firstlap' => [
                'required' => 'required',
                'max' => 'max:5,5',
            ],
            'secondlap' => [
                'required' => 'required',
                'max' => 'max:5,5',
            ],
        ]);
        // Check if the record exists
        if (!$Doubleboard) {
            return redirect()->route('Leaderboard.index');
        }

        // Creates the variables for the new data
        $firstlap = $request->firstlap;
        $secondlap = $request->secondlap;
        $AverageLap = $this->calculateAverage($firstlap, $secondlap);

        // Update the record with the new data
        $Doubleboard->update([
            'racer_id' => $request->racer_id,
            'firstlap' => $request->firstlap,
            'secondlap' => $request->secondlap,
            'averagelap' => $AverageLap,
        ]);

        return redirect()->route('Leaderboard.index');
    }

    // Calculate the average of the two given laptimes
    private function calculateAverage($firstlap, $secondlap)
    {
        $AverageLap = ($firstlap + $secondlap) / 2;
        return $AverageLap;
    }

    public function destroy($id): RedirectResponse
    {
        $Doubleboard = Doubleboard::find($id);
        $Doubleboard->delete();

        return redirect()->route('Leaderboard.index');
    }
}