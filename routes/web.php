<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminEventController;
use App\Http\Controllers\TicketController;

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [EventController::class, 'index'])->name('dashboard');
    Route::get('/register/{id}', [EventController::class, 'register'])->name('events.register');
    Route::get('/my-tickets', [EventController::class, 'myTickets'])->name('tickets.index');
    
    // Ticket routes
    Route::get('/tickets/{ticketCode}', [TicketController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/verify', [TicketController::class, 'verify'])->name('tickets.verify');
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
    Route::get('/verify', [AdminEventController::class, 'verify'])->name('admin.verify');
});

// Public ticket verification (accessible to all authenticated users)
Route::middleware(['auth'])->group(function () {
    Route::post('/tickets/verify', [TicketController::class, 'verify'])->name('tickets.verify');
});

// Test route for theme toggle
Route::get('/test-theme', function () {
    return view('test-theme');
});

require __DIR__.'/auth.php';
