<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Racerboard;
use App\Models\Racesboard;
use App\Models\Tripleboard;

class TriplelapController extends Controller
{
    public function addTRPLlaptimes($id): View
    {
        $Racerboard = Racerboard::all();
        $Racesboard = Racesboard::all();
        $Race = Racesboard::where('id', $id)->first();
        //dd($Racerboard, $Racesboard, $Race);
        $CollectedRacerIDs = Racerboard::whereIn('id', $Race->racers)->get();
        return view('leaderboard.add.addTRPLlaptimes', compact('CollectedRacerIDs', 'Race', 'Racesboard'));
    }

    public function store(Request $request, $id): RedirectResponse
    {
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
            'thirdlap' => [
                'required' => 'required',
                'max' => 'max:5,5',
            ],
        ]);

        Tripleboard::create([
            'racer_id' => $request->racer_id,
            'race_id' => $id,
            'firstlap' => $request->firstlap,
            'secondlap' => $request->secondlap,
            'thirdlap' => $request->thirdlap,
        ]);

        return redirect()->route('Leaderboard.index');
    }

    public function edit($id, $racer_id): View
    {
        $Tripleboard = Tripleboard::find($id);
        $Racerboard = Racerboard::find($racer_id);
        $Racesboard = Racesboard::all();
        return view('Leaderboard.edit.editTRPLlaptimes', compact('Tripleboard', 'Racerboard', 'Racesboard'));
    }

    public function update(Request $request, $id, $racer_id): RedirectResponse
    {
        // Find the record with the given id
        $Tripleboard = Tripleboard::find($id);
        $Racerboard = Racerboard::find($racer_id);
        // Validate the form data
        $request->validate([
            // 'racer_id' => 'required|exists:racers,id',
            // 'race_id' => 'required',
            'firstlap' => [
                'required' => 'required',
                'max' => 'max:5,5',
            ],
            'secondlap' => [
                'required' => 'required',
                'max' => 'max:5,5',
            ],
            'thirdlap' => [
                'required' => 'required',
                'max' => 'max:5,5',
            ],
        ]);
        // Check if the record exists
        if (!$Tripleboard) {
            return redirect()->route('Leaderboard.index');
        }

        if (!$Racerboard) {
            return redirect()->route('Leaderboard.index');
        }

        // Update the record with the new data
        $Tripleboard->update([
            // 'racer_id' => $request->racer_id,
            // 'race_id' => $request->race_id,
            'firstlap' => $request->firstlap,
            'secondlap' => $request->secondlap,
            'thirdlap' => $request->thirdlap,
        ]);

        return redirect()->route('Leaderboard.index');
    }

    public function destroy($id): RedirectResponse
    {
        $Tripleboard = Tripleboard::find($id);
        $Tripleboard->delete();

        return redirect()->route('Leaderboard.index');
    }
}