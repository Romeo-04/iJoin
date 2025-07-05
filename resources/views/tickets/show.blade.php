@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold mb-2">🎫 Event Ticket</h1>
                    <p class="text-gray-600 dark:text-gray-400">Your digital event ticket</p>
                </div>

                <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg p-8 text-white mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h2 class="text-2xl font-bold mb-4">{{ $ticket->event->title }}</h2>
                            <div class="space-y-2">
                                <p><span class="font-semibold">📅 Date:</span> {{ \Carbon\Carbon::parse($ticket->event->date)->format('F j, Y \a\t g:i A') }}</p>
                                @if($ticket->event->location)
                                    <p><span class="font-semibold">📍 Location:</span> {{ $ticket->event->location }}</p>
                                @endif
                                <p><span class="font-semibold">💰 Price:</span> ₱{{ number_format($ticket->event->price, 2) }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="bg-white/20 rounded-lg p-4">
                                <p class="text-sm opacity-80">Ticket Code</p>
                                <p class="text-2xl font-mono font-bold">{{ $ticket->ticket_code }}</p>
                                <div class="mt-4">
                                    @if($ticket->is_verified)
                                        <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm">✅ Verified</span>
                                    @else
                                        <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm">⏳ Pending</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-4">🧑‍💼 Attendee Information</h3>
                        <div class="space-y-2">
                            <p><span class="font-semibold">Name:</span> {{ $ticket->user->name }}</p>
                            <p><span class="font-semibold">Email:</span> {{ $ticket->user->email }}</p>
                            <p><span class="font-semibold">Registered:</span> {{ $ticket->created_at->format('F j, Y \a\t g:i A') }}</p>
                        </div>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-4">📋 Event Information</h3>
                        <div class="space-y-2">
                            @if($ticket->event->description)
                                <p><span class="font-semibold">Description:</span> {{ Str::limit($ticket->event->description, 100) }}</p>
                            @endif
                            <p><span class="font-semibold">Capacity:</span> {{ $ticket->event->tickets->count() }}/{{ $ticket->event->max_registrants }}</p>
                            <p><span class="font-semibold">Status:</span> 
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $ticket->event->status === 'published' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $ticket->event->status === 'draft' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $ticket->event->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ ucfirst($ticket->event->status) }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <div class="bg-blue-50 dark:bg-blue-900 border border-blue-200 dark:border-blue-700 rounded-lg p-4 mb-4">
                        <p class="text-sm text-blue-800 dark:text-blue-200">
                            💡 <strong>Pro Tip:</strong> Save this page or take a screenshot of your ticket code for easy access at the event.
                        </p>
                    </div>
                    
                    <div class="space-x-4">
                        <a href="{{ route('tickets.index') }}" 
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                            Back to My Tickets
                        </a>
                        <button onclick="window.print()" 
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded">
                            🖨️ Print Ticket
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .no-print { display: none !important; }
    body { background: white !important; }
}
</style>
@endsection
