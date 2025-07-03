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
        Event::create($request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'date' => 'required|date',
            'max_registrants' => 'required|integer',
        ]));

        return redirect()->route('admin.events.index')->with('success', 'Event created!');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $event->update($request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'date' => 'required|date',
            'max_registrants' => 'required|integer',
        ]));

        return redirect()->route('admin.events.index')->with('success', 'Event updated!');
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
}

