<?php

use App\Models\User;
use App\Models\Event;
use App\Models\Ticket;

require_once 'vendor/autoload.php';
require_once 'bootstrap/app.php';

echo "=== EventEase Application Status ===\n\n";

// Check users
$users = User::all();
echo "Users ({$users->count()}):\n";
foreach ($users as $user) {
    echo "- {$user->name} ({$user->email}) - {$user->role}\n";
}

echo "\n";

// Check events
$events = Event::all();
echo "Events ({$events->count()}):\n";
foreach ($events as $event) {
    echo "- {$event->title} - {$event->status} - {$event->date}\n";
    echo "  Price: \${$event->price} | Max: {$event->max_registrants} | Registered: {$event->tickets->count()}\n";
}

echo "\n";

// Check tickets
$tickets = Ticket::all();
echo "Tickets ({$tickets->count()}):\n";
foreach ($tickets as $ticket) {
    echo "- Ticket #{$ticket->id} for {$ticket->user->name} - Event: {$ticket->event->title}\n";
}

echo "\n=== Application Ready for Testing! ===\n";
