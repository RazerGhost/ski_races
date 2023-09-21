<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Racerboard;
use App\Models\Doubleboard;
use App\Models\Tripleboard;

class BoardpageViewController extends Controller
{
    public function index()
    {

        return view('leaderboard.index',)
            ->with('Racerboard', Racerboard::all())
            ->with('Doubleboard', Doubleboard::all())
            ->with('Tripleboard', Tripleboard::all());
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
    public function resetFilters()
    {
        // Clear the filter request parameters
        request()->flush();

        // Redirect back to the original page
        return redirect()->route('Leaderboard.index');
    }
}
