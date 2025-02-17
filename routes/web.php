<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
})->middleware('guest');

Route::get('/register', function () {
    return view('auth.register');
})->middleware('guest');

Route::get('/not-approved', function () {
    return view('auth.not-approved');
})->name('not_approved');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('users', UserController::class);
    Route::resource('achievements', AchievementController::class)->middleware('auth');
    Route::patch('/achievements/{id}/update-status', [AchievementController::class, 'updateStatus'])
        ->name('achievements.updateStatus');


    Route::post('/user/{id}/verify', [UserController::class, 'verify'])->name('user.verify');
});

require __DIR__ . '/auth.php';
