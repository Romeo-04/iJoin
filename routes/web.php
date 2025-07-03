<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminEventController;

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [EventController::class, 'index'])->name('dashboard');
    Route::get('/register/{id}', [EventController::class, 'register'])->name('events.register');
    Route::get('/my-tickets', [EventController::class, 'myTickets'])->name('tickets.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin.only'])->prefix('admin')->group(function () {
    Route::get('/events', [AdminEventController::class, 'index'])->name('admin.events.index');
});


require __DIR__.'/auth.php';
