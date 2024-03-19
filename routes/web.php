<?php

use App\Http\Controllers\GameController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware('auth')->group(function() {
    Route::get('/dashboard', [GameController::class, 'getHome'])->name('game.home');
    Route::get('/game/create', [GameController::class, 'getCreateGame'])->name('game.create');
    Route::post('/game/join/', [GameController::class, 'postJoinRoom'])->name('game.join');
    Route::get('/game/play/{roomCode}', [GameController::class, 'getPlayGame'])->name('game.play');
    Route::post('/game/play/{roomCode}/turn', [GameController::class, 'postPlayerTurn'])->name('game.turn');
});



// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
