<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RaceBoard;

class RaceBoardViewController extends Controller
{
    public function index(Request $request)
    {
        $RaceBoard = RaceBoard::all();
        return view('raceboard.index', compact('RaceBoard'));
    }
}
