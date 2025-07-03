<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller; // ✅ Add this line


class EventController extends Controller
{
    // 1. Show all events
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    // 2. Register for event
    public function register($id)
    {
        $event = Event::findOrFail($id);

        // Prevent duplicate registration
        $exists = Ticket::where('user_id', auth()->id())
                        ->where('event_id', $id)
                        ->exists();

        if (!$exists) {
            Ticket::create([
                'user_id' => auth()->id(),
                'event_id' => $id,
                'ticket_code' => strtoupper(Str::random(10)),
            ]);
        }

        return redirect('/my-tickets')->with('success', 'Registered successfully!');
    }

    // 3. Show my tickets
    public function myTickets()
    {
        $tickets = Ticket::with('event')
                         ->where('user_id', auth()->id())
                         ->get();

        return view('tickets.index', compact('tickets'));
    }
}
