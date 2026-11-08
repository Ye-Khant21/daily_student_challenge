<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', [ChallengeController::class, 'index'])->name('home');
Route::get('/challenges/history', [ChallengeController::class, 'history'])->name('challenges.history');


Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('register.store');
});
