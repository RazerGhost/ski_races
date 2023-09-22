<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Doubleboard;
use App\Models\Racerboard;

class DoublelapController extends Controller
{
    public function addDBLlaptimes(): View
    {
        $Racerboard = Racerboard::all();
        return view('leaderboard.addDBLlaptimes', compact('Racerboard'));
    }

    public function store(Request $request): RedirectResponse
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
        ]);

        $firstlap = $request->firstlap;
        $secondlap = $request->secondlap;
        $AverageLap = $this->calculateAverage($firstlap, $secondlap);

        Doubleboard::create([
            'racer_id' => $request->racer_id,
            'firstlap' => $request->firstlap,
            'secondlap' => $request->secondlap,
            'averagelap' => $AverageLap,
        ]);

        return redirect()->route('Leaderboard.index');
    }

    public function edit($id): View
    {
        $Racerboard = Racerboard::all();
        $Doubleboard = Doubleboard::find($id);
        return view('Leaderboard.editDBLlaptimes', compact('Doubleboard', 'Racerboard'));
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