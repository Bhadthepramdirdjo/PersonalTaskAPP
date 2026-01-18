<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AboutController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('tasks', \App\Http\Controllers\TaskController::class);
    Route::patch('/tasks/{task}/complete', [\App\Http\Controllers\TaskController::class, 'toggleComplete'])->name('tasks.complete');
    Route::get('/statistics', [\App\Http\Controllers\StatsController::class, 'index'])->name('stats.index');
    
    // Settings
    Route::get('/settings', [\App\Http\Controllers\SettingsController::class, 'edit'])->name('settings.edit');
    Route::patch('/settings', [\App\Http\Controllers\SettingsController::class, 'update'])->name('settings.update');
    Route::post('/settings/photo', [\App\Http\Controllers\SettingsController::class, 'updateProfilePhoto'])->name('settings.update-photo');
    Route::post('/settings/test-email', [\App\Http\Controllers\SettingsController::class, 'sendTestEmail'])->name('settings.test-email');
    


    // Categories
    Route::resource('categories', \App\Http\Controllers\CategoryController::class)->except(['create', 'edit', 'show']);
});

// New group for routes with 'auth' and 'set.locale' middleware
// Removed redundant SetUserLocale middleware as it is global


Route::middleware('auth')->group(function () {
    Route::get('/about', [AboutController::class, 'index'])->name('about');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
