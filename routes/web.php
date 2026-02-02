<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JudgeController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\TrickController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::middleware(['auth', 'verified'])->group(function() {
    // Dashboard Route
    Route::get('dashboard',[DashboardController::class, 'index'])->name('dashboard');
    // Judge Routes
    Route::get('/judges',[JudgeController::class, 'index'])->name('judges.index');
    Route::get('/judges/create', [JudgeController::class, 'create'])->name('judges.create');
    Route::post('/judges', [JudgeController::class, 'store'])->name('judges.store');
    Route::get('/judges/{judge}/edit', [JudgeController::class, 'edit'])->name('judges.edit');
    Route::patch('/judges/{judge}', [JudgeController::class, 'update'])->name('judges.update');
    Route::delete('/judges/{judge}',[JudgeController::class, 'destroy'])->name('judges.destroy');
    // Training Routes
    Route::get('/trainings',[TrainingController::class, 'index'])->name('trainings.index');
    Route::get('/trainings/view/{judge?}',[TrainingController::class, 'show'])->name('trainings.show');
    Route::post('/trainings',[TrainingController::class,'store'])->name('trainings.store');
    // Trick Routes
    Route::get('/tricks',[TrickController::class, 'index'])->name('tricks.index');
    Route::get('/tricks/create',[TrickController::class, 'create'])->name('tricks.create');
    Route::post('/tricks', [TrickController::class, 'store'])->name('tricks.store');
    Route::get('/tricks/{trick}/edit', [TrickController::class, 'edit'])->name('tricks.edit');
    Route::patch('/tricks/{trick}', [TrickController::class, 'update'])->name('tricks.update');
    Route::delete('/tricks/{trick}', [TrickController::class, 'destroy'])->name('tricks.destroy');
    Route::get('/tricks/{trick}/view',[TrickController::class, 'show'])->name('tricks.show');
    // User Administration routes
    Route::get('/users',[UsersController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit',[UsersController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{user}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}',[UsersController::class, 'destroy'])->name('users.destroy');
});

require __DIR__.'/settings.php';
