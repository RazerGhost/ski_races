<?php

use App\Http\Controllers\RacerboardViewController;
use App\Http\Controllers\RacerController;
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

    Route::get('/leaderboard', [RacerboardViewController::class, 'index'])->name('Leaderboard.index');
    Route::get('/leaderboard/addracer', [RacerController::class, 'addracer'])->name('Racerboard.addracer');
    Route::post('/leaderboard', [RacerController::class, 'store'])->name('Racerboard.store');
    Route::delete('/leaderboard/{racer}', [RacerController::class, 'destroy'])->name('Racerboard.destroy');
    Route::get('/leaderboard/{racer}/edit', [RacerController::class, 'edit'])->name('Racerboard.edit');
});

require __DIR__.'/auth.php';
