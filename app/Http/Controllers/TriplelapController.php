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
    public function addTRPLlaptimes(): View
    {
        $Racerboard = Racerboard::all();
        $Racesboard = Racesboard::all();
        return view('leaderboard.add.addTRPLlaptimes', compact('Racerboard', 'Racesboard'));
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
            'thirdlap' => [
                'required' => 'required',
                'max' => 'max:5,5',
            ],
        ]);

        Tripleboard::create([
            'racer_id' => $request->racer_id,
            'race_id' => $request->race_id,
            'firstlap' => $request->firstlap,
            'secondlap' => $request->secondlap,
            'thirdlap' => $request->thirdlap,
        ]);

        return redirect()->route('Leaderboard.index');
    }

    public function edit($id): View
    {
        $Tripleboard = Tripleboard::find($id);
        $Racerboard = Racerboard::all();
        $Racesboard = Racesboard::all();
        return view('Leaderboard.edit.editTRPLlaptimes', compact('Tripleboard', 'Racerboard', 'Racesboard'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        // Find the record with the given id
        $Tripleboard = Tripleboard::find($id);
        // Validate the form data
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
            'thirdlap' => [
                'required' => 'required',
                'max' => 'max:5,5',
            ],
        ]);
        // Check if the record exists
        if (!$Tripleboard) {
            return redirect()->route('Leaderboard.index');
        }

        // Update the record with the new data
        $Tripleboard->update([
            'racer_id' => $request->racer_id,
            'race_id' => $request->race_id,
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