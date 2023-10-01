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
    public function addDBLlaptimes($id): View
    {
        $Racerboard = Racerboard::all();
        $Racesboard = Racesboard::all();
        $Race = Racesboard::where('id', $id)->first();
        //dd($Racerboard, $Racesboard, $Race);
        $CollectedRacerIDs = Racerboard::whereIn('id', $Race->racers)->get();
        return view('leaderboard.add.addDBLlaptimes', compact('CollectedRacerIDs', 'Race', 'Racesboard'));
    }

    public function store(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'racer_id' => 'required|exists:racers,id',
            //'race_id' => 'required',
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
            'race_id' => $id,
            'firstlap' => $request->firstlap,
            'secondlap' => $request->secondlap,
            'averagelap' => $AverageLap,
        ]);

        return redirect()->route('Leaderboard.index');
    }

    public function edit($id, $racer_id): View
    {
        $Doubleboard = Doubleboard::find($id);
        $Racerboard = Racerboard::find($racer_id);
        $Racesboard = Racesboard::all();
        //dd($Doubleboard, $Racerboard, $Racesboard);
        return view('Leaderboard.edit.editDBLlaptimes', compact('Doubleboard', 'Racerboard', 'Racesboard'));
    }

    public function update(Request $request, $id, $racer_id): RedirectResponse
    {
        // Find the record with the given id
        $Doubleboard = Doubleboard::find($id);
        $Racerboard = Racerboard::find($racer_id);
        // Validate the form data
        $request->validate([
            //'racer_id' => 'required|exists:racers,id',
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

        if (!$Racerboard) {
            return redirect()->route('Leaderboard.index');
        }

        // Creates the variables for the new data
        $firstlap = $request->firstlap;
        $secondlap = $request->secondlap;
        $AverageLap = $this->calculateAverage($firstlap, $secondlap);

        // Update the record with the new data
        $Doubleboard->update([
            //'racer_id' => $racer_id,
            'firstlap' => $request->firstlap,
            'secondlap' => $request->secondlap,
            'averagelap' => $AverageLap,
        ]);

        return redirect()->route('Leaderboard.index');
    }

    // Calculate the average of the two given laptimes
    private function calculateAverage($firstlap, $secondlap)
    {
        if ($firstlap == 0 & $secondlap >= 0) {
            $AverageLap = $secondlap;
            return $AverageLap;
        } else if ($firstlap >= 0 & $secondlap == 0) {
            $AverageLap = $firstlap;
            return $AverageLap;
        } else {
            $AverageLap = ($firstlap + $secondlap) / 2;
            return $AverageLap;
        }
    }

    public function destroy($id): RedirectResponse
    {
        $Doubleboard = Doubleboard::find($id);
        $Doubleboard->delete();

        return redirect()->route('Leaderboard.index');
    }
}
