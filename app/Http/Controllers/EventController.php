<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use App\Services\BarcodeService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    // 1. Show all published events
    public function index()
    {
        $events = Event::where('status', 'published')
                      ->where('date', '>', now())
                      ->orderBy('date', 'asc')
                      ->get();
        return view('events.index', compact('events'));
    }

    // 2. Register for event
    public function register($id)
    {
        $event = Event::findOrFail($id);

        // Check if event is published and not cancelled
        if ($event->status !== 'published') {
            return redirect()->back()->with('error', 'This event is not available for registration.');
        }

        // Check if event is full
        if ($event->isFull()) {
            return redirect()->back()->with('error', 'This event is full.');
        }

        $user = Auth::user();
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to register for an event.');
        }

        // Prevent duplicate registration
        $exists = Ticket::where('user_id', $user->id)
                        ->where('event_id', $id)
                        ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'You are already registered for this event.');
        }

        $ticketCode = strtoupper(Str::random(10));
        $barcodeUrl = BarcodeService::generateBarcodeUrl($ticketCode);

        Ticket::create([
            'user_id' => $user->id,
            'event_id' => $id,
            'ticket_code' => $ticketCode,
            'barcode_url' => $barcodeUrl,
        ]);

        return redirect('/my-tickets')->with('success', 'Successfully registered for the event!');
    }

    // 3. Show my tickets
    public function myTickets()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to view your tickets.');
        }
        $tickets = Ticket::with('event')
                         ->where('user_id', $user->id)
                         ->get();

        return view('tickets.index', compact('tickets'));
    }
}
