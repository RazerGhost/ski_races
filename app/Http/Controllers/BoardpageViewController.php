<?php

namespace App\Http\Controllers;

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
}
