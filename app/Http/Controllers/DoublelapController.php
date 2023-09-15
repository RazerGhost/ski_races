<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Doubleboard;

class DoublelapController extends Controller
{
    public function addDBLlaptimes(): View
    {
        return view('leaderboard.addDBLlaptimes');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'racer_id' => 'required|exists:racers,id',
            'firstlap' => 'required',
            'secondlap' => 'required',
        ]);

        Doubleboard::create([
            'racer_id' => $request->racer_id,
            'firstlap' => $request->firstlap,
            'secondlap' => $request->secondlap,
        ]);

        return redirect()->route('Leaderboard.index');
    }

    public function edit($id): View
    {
        $Doubleboard = Doubleboard::find($id);
        return view('Leaderboard.editDBLlaptimes', compact('Doubleboard'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        // Find the record with the given id
        $Doubleboard = Doubleboard::find($id);
        // Validate the form data 
        $request->validate([
            'racer_id' => 'required',
            'firstlap' => 'required',
            'secondlap' => 'required',
        ]);
        // Check if the record exists
        if (!$Doubleboard) {
            return redirect()->route('Leaderboard.index');
        }


        // Update the record with the new data
        $Doubleboard->update([
            'racer_id' => $request->racer_id,
            'firstlap' => $request->firstlap,
            'secondlap' => $request->secondlap,
        ]);

        return redirect()->route('Leaderboard.index');
    }

    public function destroy($id): RedirectResponse
    {
        $Doubleboard = Doubleboard::find($id);
        $Doubleboard->delete();

        return redirect()->route('Leaderboard.index');
    }
}