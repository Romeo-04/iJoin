<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Event;

class TicketController extends Controller
{
    public function verify(Request $request)
    {
        $request->validate([
            'ticket_code' => 'required|string'
        ]);

        $ticket = Ticket::where('ticket_code', $request->ticket_code)
                        ->with(['user', 'event'])
                        ->first();

        if (!$ticket) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid ticket code'
            ], 404);
        }

        // Mark ticket as verified
        $ticket->update(['is_verified' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Ticket verified successfully',
            'data' => [
                'ticket_code' => $ticket->ticket_code,
                'user_name' => $ticket->user->name,
                'user_email' => $ticket->user->email,
                'event_title' => $ticket->event->title,
                'event_date' => $ticket->event->date,
                'verified_at' => now()->toDateTimeString()
            ]
        ]);
    }

    public function show($ticketCode)
    {
        $ticket = Ticket::where('ticket_code', $ticketCode)
                        ->with(['user', 'event'])
                        ->first();

        if (!$ticket) {
            abort(404, 'Ticket not found');
        }

        return view('tickets.show', compact('ticket'));
    }
}
