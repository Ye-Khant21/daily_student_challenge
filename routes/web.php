<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SubmissionController;

Route::get('/', [ChallengeController::class, 'index'])->name('home');
Route::get('/challenges/history', [ChallengeController::class, 'history'])->name('challenges.history');


Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('register.store');

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout')->middleware('auth');

Route::post('challenges/{challenge}/submit', [SubmissionController::class, 'store'])->name('submissions.store')->middleware('auth');
