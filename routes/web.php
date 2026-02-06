<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TagController;

Route::get('/', function () {
    header('Location: /login');
    exit();
});


Route::middleware(['auth', 'check.status'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Categories & Links
    Route::resource('categories', CategoryController::class);
    Route::resource('links', LinkController::class);
    Route::resource('tags',TagController::class);
});


require __DIR__.'/auth.php';
