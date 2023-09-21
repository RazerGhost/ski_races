<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Carbon\Carbon;
use App\Models\Racerboard;
use App\Models\Doubleboard;
use App\Models\Tripleboard;

class RacerController extends Controller
{
    public function addracer(): View
    {
        return view('leaderboard.addracer',);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'voornaam' => 'required',
            'achternaam' => 'required',
            'geslacht' => 'required',
            'geboortedatum' => 'required',
        ]);

        $birthdate = $request->geboortedatum;
        $age = $this->calculateAge($birthdate);
        $category = $this->determineCategory($age);

        Racerboard::create([
            'voornaam' => $request->voornaam,
            'achternaam' => $request->achternaam,
            'geslacht' => $request->geslacht,
            'geboortedatum' => $request->geboortedatum,
            'categorie' => $category,
        ]);

        return redirect()->route('Leaderboard.index');
    }

    public function edit($id): View
    {
        $Racerboard = Racerboard::find($id);
        return view('Leaderboard.editracer', compact('Racerboard'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        // Find the record with the given id
        $Racerboard = Racerboard::find($id);
        // Validate the form data
        $request->validate([
            'voornaam' => 'required',
            'achternaam' => 'required',
            'geslacht' => 'required',
            'geboortedatum' => 'required',
        ]);
        // Check if the record exists
        if (!$Racerboard) {
            return redirect()->route('Leaderboard.index');
        }

        $birthdate = $request->geboortedatum;
        $age = $this->calculateAge($birthdate);
        $category = $this->determineCategory($age);

        // Update the record with the new data
        $Racerboard->update([
            'voornaam' => $request->voornaam,
            'achternaam' => $request->achternaam,
            'geslacht' => $request->geslacht,
            'geboortedatum' => $request->geboortedatum,
            'categorie' => $category,
        ]);

        return redirect()->route('Leaderboard.index');
    }


    private function calculateAge($birthdate)
    {
        $birthDate = Carbon::parse($birthdate);
        $currentDate = Carbon::now();
        return $birthDate->diffInYears($currentDate);
    }

    private function determineCategory($age)
    {
        if ($age >= 0 && $age <= 8) {
            return 'U8';
        } elseif ($age > 8 && $age <= 11) {
            return 'U10';
        } elseif ($age > 11 && $age <= 13) {
            return 'U12';
        } elseif ($age > 12 && $age <= 15) {
            return 'U14';
        } elseif ($age > 14 && $age <= 17) {
            return 'U16';
        } elseif ($age > 16 && $age <= 19) {
            return 'U18';
        } elseif ($age > 19 && $age <= 21) {
            return 'U21';
        } else {
            return 'Te oud';
        }
    }

    public function destroy($id): RedirectResponse
    {
        $Racerboard = Racerboard::find($id);
        $Doubleboard = Doubleboard::where('racer_id', $id);
        $Tripleboard = Tripleboard::where('racer_id', $id);

        $Doubleboard->delete();
        $Tripleboard->delete();
        $Racerboard->delete();

        return redirect()->route('Leaderboard.index');
    }
}