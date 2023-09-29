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
    // * This is the main page for the leaderboard
    public function index()
    {
        return view('leaderboard.index')
            ->with('Racerboard', Racerboard::all())
            ->with('Races', Racesboard::all());
    }
    // * This Returns a table with lots of data and was used for testing but was the starting point for this project
    public function races()
    {
        return view('leaderboard.races')
            ->with('Racerboard', Racerboard::all())
            ->with('Races', Racesboard::all())
            ->with('Doubleboard', Doubleboard::all())
            ->with('Tripleboard', Tripleboard::all());
    }

    // * Racer Table Filter
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
        $Races = Racesboard::all();

        return view('Leaderboard.index', compact('Racerboard', 'Races'));
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

        // * Gets the data from the database where the title is equal to the title in the url
        $Race = Racesboard::where('title', $title)->first();
        // * Gets the format from the database where the title is equal to the title in the url
        $format = $Race->format;
        // * Gets the id from the database where the title is equal to the title in the url
        $RaceID = $Race->id;
        // * Gets the id from the database where the id is equal to the id's in the race table
        $CollectedRacerIDs = Racerboard::whereIn('id', $Race->racers)->get();
        // * Gets the id's from an array and finds them in the doubleboard table
        // * and sends them to the view
        $CollectedRaceTimes2x = Doubleboard::where('race_id', $RaceID)->get();
        // * Does the same as the above query but for the tripleboard table
        $CollectedRaceTimes3x = Tripleboard::where('race_id', $RaceID)->get();
        //dd($Race, $format, $CollectedRacerIDs, $RaceID, $CollectedRaceTimes2x);

        // * Switch statement to check which format is selected
        switch ($format) {
            case "3x":
                // ! dd($Race, $format, $CollectedRacerIDs, $RaceID, $CollectedRaceTimes3x); //!Debugging
                return view('leaderboard.race.3x', compact('Race', 'CollectedRacerIDs', 'RaceID', 'CollectedRaceTimes3x'));
            case "2xf":
                // ! dd($Race, $format, $CollectedRacerIDs, $RaceID, $CollectedRaceTimes2x); //!Debugging
                return view('leaderboard.race.2xf', compact('Race', 'CollectedRacerIDs', 'RaceID', 'CollectedRaceTimes2x'));
            case "2xa":
                // ! dd($Race, $format, $CollectedRacerIDs, $RaceID, $CollectedRaceTimes2x); //!Debugging
                return view('leaderboard.race.2xf', compact('Race', 'CollectedRacerIDs', 'RaceID', 'CollectedRaceTimes2x'));
            default:
                echo "No format found";
        }
    }
}
