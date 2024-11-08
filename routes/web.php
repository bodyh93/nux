<?php

use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class, 'showRegistrationForm']);
Route::post('/auth/register', [AuthController::class, 'register'])->name('auth.register');

Route::post('/link/create', [LinkController::class, 'create'])->name('link.create');
