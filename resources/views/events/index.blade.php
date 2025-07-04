@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-3xl font-bold mb-6">Available Events</h1>
                
                @if($events->count() > 0)
                    <div class="space-y-4">
                        @foreach($events as $event)
                            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow">
                                <div class="flex justify-between items-start mb-2">
                                    <h2 class="text-xl font-semibold">{{ $event->title }}</h2>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $event->status === 'published' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $event->status === 'draft' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $event->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ ucfirst($event->status) }}
                                    </span>
                                </div>
                                <p class="text-gray-600 dark:text-gray-300 mb-3">{{ $event->description }}</p>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            <strong>📅 Date:</strong> {{ \Carbon\Carbon::parse($event->date)->format('F j, Y \a\t g:i A') }}
                                        </p>
                                        @if($event->location)
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                <strong>📍 Location:</strong> {{ $event->location }}
                                            </p>
                                        @endif
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            <strong>💰 Price:</strong> ₱{{ number_format($event->price, 2) }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            <strong>Available Spots:</strong> {{ $event->availableSpots() }} / {{ $event->max_registrants }}
                                        </p>
                                        <div class="bg-gray-200 dark:bg-gray-600 rounded-full h-2 mt-2">
                                            <div class="bg-blue-600 h-2 rounded-full" 
                                                 style="width: {{ ($event->tickets->count() / $event->max_registrants) * 100 }}%"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                @php
                                    $alreadyRegistered = $event->tickets->where('user_id', auth()->id())->count() > 0;
                                    $spotsAvailable = !$event->isFull();
                                @endphp
                                
                                @if($alreadyRegistered)
                                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded text-sm">✅ Already Registered</span>
                                @elseif($spotsAvailable && $event->status === 'published')
                                    <a href="{{ route('events.register', $event->id) }}" 
                                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Register Now
                                    </a>
                                @elseif($event->status !== 'published')
                                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded text-sm">🚫 Not Available</span>
                                @else
                                    <span class="bg-red-100 text-red-800 px-3 py-1 rounded text-sm">❌ Event Full</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded">
                        No events available at the moment.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
