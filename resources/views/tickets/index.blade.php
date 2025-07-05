@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-3xl font-bold mb-6">My Tickets</h1>
                
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if($tickets->count() > 0)
                    <div class="space-y-4">
                        @foreach($tickets as $ticket)
                            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow">
                                <div class="flex justify-between items-start mb-4">
                                    <h2 class="text-xl font-semibold">{{ $ticket->event->title }}</h2>
                                    @if($ticket->is_verified)
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">✅ Verified</span>
                                    @else
                                        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm">⏳ Pending</span>
                                    @endif
                                </div>
                                
                                <p class="text-gray-600 dark:text-gray-300 mb-3">{{ Str::limit($ticket->event->description, 100) }}</p>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            <strong>📅 Event Date:</strong> {{ \Carbon\Carbon::parse($ticket->event->date)->format('F j, Y \a\t g:i A') }}
                                        </p>
                                        @if($ticket->event->location)
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                <strong>📍 Location:</strong> {{ $ticket->event->location }}
                                            </p>
                                        @endif
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            <strong>💰 Price:</strong> ₱{{ number_format($ticket->event->price, 2) }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            <strong>🎫 Ticket Code:</strong> 
                                            <span class="font-mono bg-gray-200 dark:bg-gray-600 px-2 py-1 rounded">{{ $ticket->ticket_code }}</span>
                                        </p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            <strong>📝 Registered:</strong> {{ $ticket->created_at->format('M d, Y H:i') }}
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="flex space-x-2">
                                    <a href="{{ route('tickets.show', $ticket->ticket_code) }}" 
                                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">
                                        View Full Ticket
                                    </a>
                                    <button onclick="copyToClipboard('{{ $ticket->ticket_code }}')" 
                                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-sm">
                                        Copy Code
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded">
                        You haven't registered for any events yet. <a href="{{ route('dashboard') }}" class="underline">Browse available events</a>.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show success message
        const toast = document.createElement('div');
        toast.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50';
        toast.textContent = 'Ticket code copied to clipboard!';
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.remove();
        }, 3000);
    }).catch(function(err) {
        console.error('Could not copy text: ', err);
    });
}
</script>
@endsection
