<?php

use Illuminate\Support\Facades\Route;
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

Route::middleware(['auth', \App\Http\Middleware\AdminOnly::class])->prefix('admin')->group(function () {
    Route::get('/events', [AdminEventController::class, 'index'])->name('admin.events.index');
    Route::get('/events/create', [AdminEventController::class, 'create'])->name('admin.events.create');
    Route::post('/events', [AdminEventController::class, 'store'])->name('admin.events.store');
    Route::get('/events/{event}', [AdminEventController::class, 'show'])->name('admin.events.show');
    Route::get('/events/{event}/edit', [AdminEventController::class, 'edit'])->name('admin.events.edit');
    Route::put('/events/{event}', [AdminEventController::class, 'update'])->name('admin.events.update');
    Route::delete('/events/{event}', [AdminEventController::class, 'destroy'])->name('admin.events.destroy');
});

require __DIR__.'/auth.php';
