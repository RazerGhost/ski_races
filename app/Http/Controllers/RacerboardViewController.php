<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Racerboard;

class RacerboardViewController extends Controller
{
    public function index(Request $request)
    {
        $Racerboard = Racerboard::all();
        return view('leaderboard.index', compact('Racerboard'));
    }
}
