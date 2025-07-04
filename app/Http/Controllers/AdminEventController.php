<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Ticket;

class AdminEventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|in:draft,published,cancelled',
            'date' => 'required|date|after:now',
            'max_registrants' => 'required|integer|min:1',
        ]);

        $validated['created_by'] = auth()->id();

        Event::create($validated);

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully!');
    }

    public function show(Event $event)
    {
        $registrants = Ticket::where('event_id', $event->id)->with('user')->get();
        return view('admin.events.show', compact('event', 'registrants'));
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|in:draft,published,cancelled',
            'date' => 'required|date|after:now',
            'max_registrants' => 'required|integer|min:1',
        ]);

        $event->update($validated);

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully!');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return back()->with('success', 'Event deleted!');
    }

    public function registrants(Event $event)
    {
        $registrants = Ticket::where('event_id', $event->id)->with('user')->get();
        return view('admin.events.registrants', compact('event', 'registrants'));
    }

    public function verify()
    {
        return view('admin.verify');
    }
}

