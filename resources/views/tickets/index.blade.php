<x-app-layout>
    <div class="p-4">
        <h1 class="text-2xl font-bold mb-4">My Tickets</h1>
        @foreach($tickets as $ticket)
            <div class="p-4 border rounded mb-4 shadow">
                <h2 class="text-xl font-semibold">{{ $ticket->event->title }}</h2>
                <p><strong>Code:</strong> {{ $ticket->ticket_code }}</p>
                <p><strong>Status:</strong> {{ $ticket->is_verified ? '✅ Verified' : '❌ Not Verified' }}</p>
            </div>
        @endforeach
    </div>
</x-app-layout>
