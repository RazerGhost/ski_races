<?php

use App\Http\Controllers\BoardpageViewController;
use App\Http\Controllers\RacerController;
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

    // Routes for the Leaderboard
    Route::get('/leaderboard', [BoardpageViewController::class, 'index'])->name('Leaderboard.index');
    Route::post('/leaderboard', [BoardpageViewController::class, 'racerfilter'])->name('Leaderboard.racerfilter');
    Route::get('/leaderboard/reset', [BoardpageViewController::class, 'resetFilters'])->name('Leaderboard.reset');

    // Routes for the Racer Table
    Route::get('/leaderboard/addRacer', [RacerController::class, 'addracer'])->name('Racerboard.addracer');
    Route::post('/leaderboard/addRacer', [RacerController::class, 'store'])->name('Racerboard.store');
    Route::get('/leaderboard/{racer}/editRacer', [RacerController::class, 'edit'])->name('Racerboard.edit');
    Route::post('/leaderboard/{racer}/update', [RacerController::class, 'update'])->name('Racerboard.update');
    Route::delete('/leaderboard/{racer}', [RacerController::class, 'destroy'])->name('Racerboard.destroy');

    // Routes for the Doublelap Table
    Route::get('/leaderboard/addDBLlaptimes', [DoublelapController::class, 'addDBLlaptimes'])->name('Doubleboard.addDBLlaptimes');
    Route::post('/leaderboard/addDBLlaptimes', [DoublelapController::class, 'store'])->name('Doubleboard.store');
    Route::get('/leaderboard/{doublelap}/editDBLlaptimes', [DoublelapController::class, 'edit'])->name('Doubleboard.edit');
    Route::post('/leaderboard/{doublelap}/update', [DoublelapController::class, 'update'])->name('Doubleboard.update');
    Route::delete('/leaderboard/{doublelap}', [DoublelapController::class, 'destroy'])->name('Doubleboard.destroy');

    // Routes for the Triplelap Table
    Route::get('/leaderboard/addTRPLlaptimes', [TriplelapController::class, 'addTRPLlaptimes'])->name('Tripleboard.addTRPLlaptimes');
    Route::post('/leaderboard/addTRPLlaptimes', [TriplelapController::class, 'store'])->name('Tripleboard.store');
    Route::get('/leaderboard/{triplelap}/editTRPLlaptimes', [TriplelapController::class, 'edit'])->name('Tripleboard.edit');
    Route::post('/leaderboard/{triplelap}/update', [TriplelapController::class, 'update'])->name('Tripleboard.update');
    Route::delete('/leaderboard/{triplelap}', [TriplelapController::class, 'destroy'])->name('Tripleboard.destroy');
});

require __DIR__ . '/auth.php';
