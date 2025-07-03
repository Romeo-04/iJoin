<x-app-layout>
    <div class="p-4">
        <h1 class="text-2xl font-bold mb-4">Available Events</h1>
        @foreach($events as $event)
            <div class="p-4 border rounded mb-4 shadow">
                <h2 class="text-xl font-semibold">{{ $event->title }}</h2>
                <p>{{ $event->description }}</p>
                <p><strong>Date:</strong> {{ $event->date }}</p>
                <a href="{{ route('events.register', $event->id) }}" class="text-white bg-blue-500 px-3 py-1 rounded mt-2 inline-block">Register</a>
            </div>
        @endforeach
    </div>
</x-app-layout>
