<?php

use App\Http\Controllers\BoardpageViewController;
use App\Http\Controllers\RacerController;
use App\Http\Controllers\RacesController;
use App\Http\Controllers\DoublelapController;
use App\Http\Controllers\TriplelapController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // * Routes for the Leaderboard.index
    Route::get('/leaderboard', [BoardpageViewController::class, 'index'])->name('Leaderboard.index');
    Route::post('/leaderboard', [BoardpageViewController::class, 'racerfilter'])->name('Leaderboard.racerfilter');
    Route::get('/leaderboard/reset', [BoardpageViewController::class, 'resetfilters'])->name('Leaderboard.reset');
    Route::get('/leaderboard/races', [BoardpageViewController::class, 'races'])->name('Leaderboard.races');
    Route::get('/leaderboard/race/{id}', [BoardpageViewController::class, 'racepage'])->name('Leaderboard.race');

    // * Routes for the Race Table
    Route::get('/leaderboard/add/addRace', [RacesController::class, 'addRace'])->name('Racesboard.addRace');
    Route::post('/leaderboard/addRace', [RacesController::class, 'store'])->name('Racesboard.store');
    Route::delete('/Racesboard/{race}', [RacesController::class, 'destroy'])->name('Racesboard.destroy');

    // * Routes for the Racer Table
    Route::get('/leaderboard/add/addRacer', [RacerController::class, 'addracer'])->name('Racerboard.addracer');
    Route::post('/leaderboard/addRacer', [RacerController::class, 'store'])->name('Racerboard.store');
    Route::get('/leaderboard/edit/{racer}/editRacer', [RacerController::class, 'edit'])->name('Racerboard.edit');
    Route::post('/leaderboard/{racer}/update', [RacerController::class, 'update'])->name('Racerboard.update');
    Route::delete('/leaderboard/race/{id}/{racer}', [RacerController::class, 'destroy'])->name('Racerboard.destroy');

    // * Routes for the Doublelap Table
    Route::get('/leaderboard/add/{id}/addDBLlaptimes', [DoublelapController::class, 'addDBLlaptimes'])->name('Doubleboard.addDBLlaptimes');
    Route::post('/leaderboard/{id}/addDBLlaptimes', [DoublelapController::class, 'store'])->name('Doubleboard.store');
    Route::get('/leaderboard/edit/{id}/{racer_id}/editDBLlaptimes', [DoublelapController::class, 'edit'])->name('Doubleboard.edit');
    Route::post('/leaderboard/{id}/{racer_id}/update', [DoublelapController::class, 'update'])->name('Doubleboard.update');
    Route::delete('/Doubleboard/{doublelap}', [DoublelapController::class, 'destroy'])->name('Doubleboard.destroy');

    // * Routes for the Triplelap Table
    Route::get('/leaderboard/add/{id}/addTRPLlaptimes', [TriplelapController::class, 'addTRPLlaptimes'])->name('Tripleboard.addTRPLlaptimes');
    Route::post('/leaderboard/{id}/addTRPLlaptimes', [TriplelapController::class, 'store'])->name('Tripleboard.store');
    Route::get('/leaderboard/edit/{id}/{racer_id}/editTRPLlaptimes', [TriplelapController::class, 'edit'])->name('Tripleboard.edit');
    Route::post('/leaderboard/{id}/{racer_id}/update', [TriplelapController::class, 'update'])->name('Tripleboard.update');
    Route::delete('/Tripleboard/{triplelap}', [TriplelapController::class, 'destroy'])->name('Tripleboard.destroy');
});

require __DIR__ . '/auth.php';
