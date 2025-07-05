@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-bold">{{ $event->title }}</h2>
                    <div class="space-x-2">
                        <a href="{{ route('admin.events.edit', $event) }}" 
                           class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                            Edit Event
                        </a>
                        <a href="{{ route('admin.events.index') }}" 
                           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to List
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div>
                        <h3 class="text-xl font-semibold mb-4">Event Details</h3>
                        <div class="space-y-3">
                            <p><span class="font-semibold">Description:</span> {{ $event->description ?: 'No description provided' }}</p>
                            <p><span class="font-semibold">Location:</span> {{ $event->location ?: 'No location specified' }}</p>
                            <p><span class="font-semibold">Price:</span> ₱{{ number_format($event->price, 2) }}</p>
                            <p><span class="font-semibold">Status:</span> 
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $event->status === 'published' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $event->status === 'draft' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $event->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ ucfirst($event->status) }}
                                </span>
                            </p>
                            <p><span class="font-semibold">Date:</span> {{ \Carbon\Carbon::parse($event->date)->format('F j, Y \a\t g:i A') }}</p>
                            <p><span class="font-semibold">Created by:</span> {{ $event->creator ? $event->creator->name : 'Unknown' }}</p>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold mb-4">Registration Status</h3>
                        <div class="space-y-3">
                            <p><span class="font-semibold">Max Registrants:</span> {{ $event->max_registrants }}</p>
                            <p><span class="font-semibold">Current Registrants:</span> {{ $registrants->count() }}</p>
                            <p><span class="font-semibold">Available Spots:</span> {{ $event->availableSpots() }}</p>
                            
                            @if($registrants->count() > 0)
                                <div class="mt-4">
                                    <div class="bg-gray-200 dark:bg-gray-700 rounded-full h-4 mb-2">
                                        <div class="bg-blue-600 h-4 rounded-full" 
                                             style="width: {{ ($registrants->count() / $event->max_registrants) * 100 }}%"></div>
                                    </div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ round(($registrants->count() / $event->max_registrants) * 100) }}% Full
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                    @if($registrants->count() > 0)
                        <hr>
                        <h5>Registered Users</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Registration Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($registrants as $registrant)
                                        <tr>
                                            <td>{{ $registrant->user->name ?? 'N/A' }}</td>
                                            <td>{{ $registrant->user->email ?? 'N/A' }}</td>
                                            <td>{{ $registrant->created_at->format('M d, Y H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            No users have registered for this event yet.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
