<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ScoreBoardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Game

Route::get('/', function () {
    return redirect('/game');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/game', function () {
    return view('game');
})->name('game.show');

Route::middleware(['auth:sanctum', 'verified'])
    ->post('/gamepost', [GameController::class, 'store'])
    ->name('game.store');

//ScoreBoard

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/scoreboard', [ScoreBoardController::class, 'index'])
    ->name('scoreboard.index');
