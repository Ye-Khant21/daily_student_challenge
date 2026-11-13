<?php

use App\Http\Controllers\Admin\ChallengeController as AdminChallengeController;
use App\Http\Controllers\Admin\SubmissionController as AdminSubmissionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth', 'can:access-admin'])
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [AdminSubmissionController::class, 'index'])->name('admin.submissions.index');
        Route::patch('submissions/{submission}/approve', [AdminSubmissionController::class, 'approve'])->name('admin.submissions.approve');
        Route::get('/challenges/create', [AdminChallengeController::class, 'create'])->name('admin.challenges.create');
        Route::post('/challenges', [AdminChallengeController::class, 'store'])->name('admin.challenges.store');
    });
