<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Tripleboard;
use App\Models\Racerboard;

class TriplelapController extends Controller
{
    public function addTRPLlaptimes(): View
    {
        $Racerboard = Racerboard::all();
        return view('leaderboard.addTRPLlaptimes', compact('Racerboard'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'racer_id' => 'required|exists:racers,id',
            'firstlap' => 'required',
            'secondlap' => 'required',
            'thirdlap' => 'required',
        ]);

        Tripleboard::create([
            'racer_id' => $request->racer_id,
            'firstlap' => $request->firstlap,
            'secondlap' => $request->secondlap,
            'thirdlap' => $request->thirdlap,
        ]);

        return redirect()->route('Leaderboard.index');
    }

    public function edit($id): View
    {
        $Racerboard = Racerboard::all();
        $Tripleboard = Tripleboard::find($id);
        return view('Leaderboard.editTRPLlaptimes', compact('Tripleboard', 'Racerboard'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        // Find the record with the given id
        $Tripleboard = Tripleboard::find($id);
        // Validate the form data
        $request->validate([
            'racer_id' => 'required',
            'firstlap' => 'required',
            'secondlap' => 'required',
            'thirdlap' => 'required',
        ]);
        // Check if the record exists
        if (!$Tripleboard) {
            return redirect()->route('Leaderboard.index');
        }

        // Update the record with the new data
        $Tripleboard->update([
            'racer_id' => $request->racer_id,
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