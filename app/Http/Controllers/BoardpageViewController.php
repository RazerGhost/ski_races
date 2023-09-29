<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Racerboard;
use App\Models\Racesboard;
use App\Models\Doubleboard;
use App\Models\Tripleboard;

class BoardpageViewController extends Controller
{
    public function index()
    {

        return view('leaderboard.index')
            ->with('Racerboard', Racerboard::all())
            ->with('Doubleboard', Doubleboard::all())
            ->with('Tripleboard', Tripleboard::all());
    }

    public function races()
    {
        return view('leaderboard.races')
            ->with('Racerboard', Racerboard::all())
            ->with('Races', Racesboard::all());
    }

    // Racer Table Filter
    public function racerfilter(Request $request): View
    {
        // Start with an empty query
        $query = Racerboard::query();

        if ($request->filled('voornaam')) {
            $voornaam = $request->input('voornaam');
            $query->where('voornaam', 'like', '%' . $voornaam . '%');
        }

        if ($request->filled('achternaam')) {
            $achternaam = $request->input('achternaam');
            $query->where('achternaam', 'like', '%' . $achternaam . '%');
        }

        if ($request->filled('geslacht')) {
            $geslacht = $request->input('geslacht');
            $query->where('geslacht', $geslacht);
        }

        if ($request->filled('geboortedatum')) {
            $geboortedatum = $request->input('geboortedatum');
            $query->where('geboortedatum', $geboortedatum);
        }

        if ($request->filled('categorie')) {
            $categorie = $request->input('categorie');
            $query->where('categorie', $categorie);
        }

        // Get the results
        $Racerboard = $query->get();
        $Doubleboard = Doubleboard::all();
        $Tripleboard = Tripleboard::all();

        return view('Leaderboard.index', compact('Racerboard', 'Doubleboard', 'Tripleboard'));
    }

    // Filter reset
    public function resetfilters()
    {
        // Clear the filter request parameters
        request()->flush();

        // Redirect back to the original page
        return redirect()->route('Leaderboard.index');
    }

    public function racepage($title)
    {
        // * Get all the data from the database
        $Racerboard = Racerboard::all();
        $Racesboard = Racesboard::all();
        $Doubleboard = Doubleboard::all();
        $Tripleboard = Tripleboard::all();

        // * Get the data from the database where the title is equal to the title in the url
        $Race = Racesboard::where('title', $title)->first();
        // * Get the format from the database where the title is equal to the title in the url
        $format = $Race->format;
        // * Get the id from the database where the title is equal to the title in the url
        $RaceID = $Race->id;
        // * Get the id from the database where the id is equal to the id's in the race table
        $CollectedRacerIDs = Racerboard::whereIn('id', $Race->racers)->get();
        // *
        $CollectedRaceTimes = Doubleboard::where('race_id', $RaceID)->get();
        //dd($Race, $format, $CollectedRacerIDs, $RaceID, $CollectedRaceTimes);

        // * Switch statement to check which format is selected
        switch ($format) {
            case "3x":
                return view('leaderboard.race.3x', compact('Race', 'CollectedRacerIDs', 'RaceID', ));
            case "2xf":
                return view('leaderboard.race.2xf', compact('Race', 'CollectedRacerIDs', 'RaceID', 'CollectedRaceTimes'));
            case "2xa":
                return view('leaderboard.race.2xf', compact('Race', 'CollectedRacerIDs', 'RaceID', 'CollectedRaceTimes'));
            default:
                echo "No format found";
        }
    }
}
