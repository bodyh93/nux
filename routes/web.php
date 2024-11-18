<?php

use App\Http\Controllers\LinkController;
use App\Http\Controllers\PageAController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;

Route::get('/', [AuthController::class, 'showRegistrationForm'])->name('auth.index');
Route::post('/auth/register', [AuthController::class, 'register'])->name('auth.register');
Route::middleware([AuthMiddleware::class])->group(function () {
    Route::get('/link', [LinkController::class, 'index'])->name('link.index');
    Route::get('/link/new', [LinkController::class, 'newLink'])->name('link.newLink');
    Route::get('/link/deactivate', [LinkController::class, 'deactivateLink'])->name('link.deactivateLink');
    Route::get('/pageA/{link}', [PageAController::class, 'index'])->name('pageA.index');
    Route::get('/ajax/game/play', [GameController::class, 'play'])->name('game.play');
    Route::get('/ajax/game/history', [GameController::class, 'history'])->name('game.history');
});
