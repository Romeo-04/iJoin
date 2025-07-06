@extends('layouts.app')

@section('content')

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div x-data="eventViewToggle()" x-init="init()">
                    <div class="flex items-center justify-between mb-6">
                        <h1 class="text-3xl font-bold">Available Events</h1>
                        <!-- Calendar/List Switch Button -->
                        <button @click="calendar = !calendar"
                            type="button"
                            class="flex items-center gap-2 px-3 py-1.5 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-full shadow hover:bg-blue-500 hover:text-white transition text-sm font-medium focus:outline-none"
                            x-text="calendar ? 'Calendar View' : 'List View'"
                            aria-label="Toggle calendar/list view">
                        </button>
                    </div>

                    <!-- List -->
                    <template x-if="!calendar">
                        <div>
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
                    </template>

                    <!-- Calendar -->
                    <template x-if="calendar">
                        <div class="w-full flex flex-col items-center gap-8">
                            <div x-data="calendarGrid({{ json_encode($events->map(function($e) {
                                $date = \Carbon\Carbon::parse($e->date);
                                $alreadyRegistered = $e->tickets->where('user_id', auth()->id())->count() > 0;
                                $spotsAvailable = !$e->isFull();
                                return [
                                    'id' => $e->id,
                                    'date' => $date->toDateString(),
                                    'year' => (int) $date->year,
                                    'month' => (int) $date->month - 1, // JS months are 0-based
                                    'day' => (int) $date->day,
                                    'title' => $e->title,
                                    'description' => $e->description,
                                    'location' => $e->location,
                                    'price' => $e->price,
                                    'max_registrants' => $e->max_registrants,
                                    'availableSpots' => $e->availableSpots(),
                                    'status' => $e->status,
                                    'alreadyRegistered' => $alreadyRegistered,
                                    'spotsAvailable' => $spotsAvailable,
                                    'register_url' => route('events.register', $e->id),
                                ];
                            })) }})" x-init="init()" class="w-full bg-white dark:bg-gray-700 rounded-lg shadow p-4">
                                <!-- Calendar Header: Month, Year, Navigation -->
                                <div class="flex items-center justify-between mb-2">
                                    <button @click="prevMonth" class="px-2 py-1 rounded hover:bg-gray-200 dark:hover:bg-gray-600" aria-label="Previous Month">&#8592;</button>
                                    <div class="font-semibold text-lg" x-text="monthYear"></div>
                                    <button @click="nextMonth" class="px-2 py-1 rounded hover:bg-gray-200 dark:hover:bg-gray-600" aria-label="Next Month">&#8594;</button>
                                </div>
                                <!-- Synced Scrollable Calendar Header and Grid -->
                                <div class="w-full" x-data="{ scrollRef: null }" x-init="scrollRef = $refs.calScroll">
                                    <div class="overflow-x-auto" x-ref="calScroll" @scroll="$refs.calGrid.scrollLeft = $refs.calScroll.scrollLeft">
                                        <div class="grid grid-cols-7 min-w-[420px] mb-1 text-xs font-bold text-center text-gray-500 dark:text-gray-300">
                                            <template x-for="day in days" :key="day">
                                                <div x-text="day"></div>
                                            </template>
                                        </div>
                                    </div>
                                    <div class="overflow-x-auto" x-ref="calGrid" @scroll="$refs.calScroll.scrollLeft = $refs.calGrid.scrollLeft">
                                        <div class="grid grid-cols-7 grid-rows-6 gap-1 w-full min-w-[420px]">
                                            <template x-for="(cell, idx) in datesInMonth" :key="'d'+idx">
                                                <div
                                                    class="flex flex-col items-center justify-start h-20 rounded cursor-pointer hover:bg-blue-100 dark:hover:bg-blue-800 transition border border-gray-200 dark:border-gray-600 text-xs sm:text-sm p-0.5"
                                                    :class="{
                                                        'bg-blue-500 text-white': isToday(cell.date) && cell.isCurrent,
                                                        'opacity-40': !cell.isCurrent,
                                                        'cursor-default hover:bg-transparent': !cell.isCurrent
                                                    }"
                                                    @click="cell.isCurrent && cell.date ? selectDate(cell.date) : null"
                                                >
                                                    <span class="flex items-center gap-0.5">
                                                        <template x-if="!cell.isCurrent">
                                                            <span x-text="cell.monthShort + ' '"></span>
                                                        </template>
                                                        <span x-text="cell.date ? cell.date : ''"></span>
                                                    </span>
                                                    <!-- Event Tags -->
                                                    <template x-if="cell.isCurrent && eventsForDate(cell).length">
                                                        <div class="flex flex-col items-center w-full mt-0.5 space-y-0.5 overflow-y-auto max-h-12 relative">
                                                            <template x-for="(event, eidx) in eventsForDate(cell)" :key="'e'+eidx">
                                                                <div class="w-full">
                                                                    <button
                                                                        type="button"
                                                                        class="block w-full px-1 py-0.5 rounded text-[10px] sm:text-xs font-medium truncate max-w-full whitespace-nowrap cursor-pointer transition text-left focus:outline-none border mb-0.5"
                                                                        :class="event.alreadyRegistered ? 'bg-green-100 text-green-800 border-green-300 hover:bg-green-200 hover:text-green-900' : 'bg-blue-100 text-blue-700 border-blue-300 hover:bg-blue-200 hover:text-blue-900'"
                                                                        :title="event.title"
                                                                        @click.stop="$dispatch('showevent', { event })"
                                                                    >
                                                                        <span x-text="event.title"></span>
                                                                    </button>
                                                                </div>
                                                            </template>
                                                        </div>
                                                    </template>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                                <!-- Quick Navigation Bar -->
                                <div class="mt-4 mb-2">
                                    <div class="text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Quick Event Nav</div>
                                    <div class="flex flex-wrap items-center gap-2">
                                        <!-- Today Button -->
                                        <button type="button"
                                            class="px-3 py-1 rounded border border-blue-500 text-blue-700 dark:border-blue-300 dark:text-blue-200 bg-transparent font-semibold text-sm hover:bg-blue-50 dark:hover:bg-blue-900 transition"
                                            @click="current = new Date(today.getFullYear(), today.getMonth(), 1)"
                                        >
                                            Today
                                        </button>
                                        <!-- Event Month Buttons -->
                                        <template x-for="(event, idx) in uniqueEventsByMonth()" :key="'nav'+event.id">
                                            <button type="button"
                                                class="px-3 py-1 rounded border border-gray-900 text-gray-900 dark:border-gray-600 dark:text-white bg-transparent font-semibold text-sm hover:bg-gray-50 dark:hover:bg-gray-800 transition"
                                                @click="current = new Date(event.year, event.month, 1)"
                                                x-text="event.title"
                                            ></button>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Global Popup Modal -->
                    <div x-data="{ show: false, event: null }" x-on:showevent.window="show = true; event = $event.detail.event" x-show="show" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40">
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-md relative">
                            <button @click="show = false" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 text-xl">&times;</button>
                            <h2 class="text-lg font-bold mb-2" x-text="event?.title"></h2>
                            <div class="mb-2">
                                <span class="font-semibold">Description:</span>
                                <span x-text="event?.description || 'No description.'"></span>
                            </div>
                            <div class="mb-2" x-show="event?.location">
                                <span class="font-semibold">Location:</span>
                                <span x-text="event?.location"></span>
                            </div>
                            <div class="mb-2">
                                <span class="font-semibold">Price:</span>
                                ₱<span x-text="Number(event?.price).toLocaleString(undefined, {minimumFractionDigits:2})"></span>
                            </div>
                            <div class="mb-4">
                                <span class="font-semibold">Available Spots:</span>
                                <span x-text="event?.availableSpots"></span> / <span x-text="event?.max_registrants"></span>
                            </div>
                            <template x-if="event?.alreadyRegistered">
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded text-sm">✅ Already Registered</span>
                            </template>
                            <template x-if="!event?.alreadyRegistered && event?.spotsAvailable && event?.status === 'published'">
                                <a :href="event?.register_url" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Register Now</a>
                            </template>
                            <template x-if="!event?.alreadyRegistered && event?.status !== 'published'">
                                <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded text-sm">🚫 Not Available</span>
                            </template>
                            <template x-if="!event?.alreadyRegistered && !event?.spotsAvailable && event?.status === 'published'">
                                <span class="bg-red-100 text-red-800 px-3 py-1 rounded text-sm">❌ Event Full</span>
                            </template>
                        </div>
                    </div>

                    <script>
                    // Alpine.js calendar grid logic only (list view untouched)
                    function eventViewToggle() {
                        return {
                            calendar: false
                        }
                    }
                    function calendarGrid(events = []) {
                        return {
                            today: new Date(),
                            current: new Date(),
                            days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                            selectedDate: null,
                            selectedEvents: [],
                            events: events,
                            uniqueEventsByMonth() {
                                const seen = new Set();
                                return this.events
                                    .slice()
                                    .sort((a, b) => {
                                        const da = new Date(a.year, a.month, a.day);
                                        const db = new Date(b.year, b.month, b.day);
                                        return da - db;
                                    })
                                    .filter(e => {
                                        const key = `${e.year}-${e.month}-${e.id}`;
                                        if (seen.has(key)) return false;
                                        seen.add(key);
                                        return true;
                                    });
                            },
                            get month() { return this.current.getMonth(); },
                            get year() { return this.current.getFullYear(); },
                            get monthYear() { return this.current.toLocaleString('default', { month: 'long', year: 'numeric' }); },
                            get datesInMonth() {
                                const firstDayOfWeek = new Date(this.year, this.month, 1).getDay();
                                const daysInMonth = new Date(this.year, this.month + 1, 0).getDate();
                                const prevMonth = this.month === 0 ? 11 : this.month - 1;
                                const prevYear = this.month === 0 ? this.year - 1 : this.year;
                                const prevMonthDays = new Date(prevYear, prevMonth + 1, 0).getDate();
                                const nextMonth = this.month === 11 ? 0 : this.month + 1;
                                const nextYear = this.month === 11 ? this.year + 1 : this.year;
                                const days = [];
                                for (let i = firstDayOfWeek - 1; i >= 0; i--) {
                                    days.push({
                                        date: prevMonthDays - i,
                                        isCurrent: false,
                                        month: prevMonth,
                                        year: prevYear,
                                        monthShort: new Date(prevYear, prevMonth).toLocaleString('default', { month: 'short' })
                                    });
                                }
                                for (let d = 1; d <= daysInMonth; d++) {
                                    days.push({
                                        date: d,
                                        isCurrent: true,
                                        month: this.month,
                                        year: this.year,
                                        monthShort: new Date(this.year, this.month).toLocaleString('default', { month: 'short' })
                                    });
                                }
                                let nextDay = 1;
                                while (days.length < 42) {
                                    days.push({
                                        date: nextDay++,
                                        isCurrent: false,
                                        month: nextMonth,
                                        year: nextYear,
                                        monthShort: new Date(nextYear, nextMonth).toLocaleString('default', { month: 'short' })
                                    });
                                }
                                return days;
                            },
                            isToday(date) {
                                if (!date) return false;
                                let d;
                                if (typeof date === 'object' && date !== null && 'date' in date && 'month' in date && 'year' in date) {
                                    d = new Date(date.year, date.month, date.date);
                                } else {
                                    d = new Date(this.year, this.month, date);
                                }
                                return d.toDateString() === this.today.toDateString();
                            },
                            eventsForDate(date) {
                                let y, m, d;
                                if (typeof date === 'object' && date !== null && 'date' in date && 'month' in date && 'year' in date) {
                                    y = date.year;
                                    m = date.month;
                                    d = date.date;
                                } else {
                                    y = this.year;
                                    m = this.month;
                                    d = date;
                                }
                                return this.events.filter(e => e.year === y && e.month === m && e.day === d);
                            },
                            selectDate(date) {
                                if (!date) return;
                                let d, cell = date;
                                if (typeof date === 'object' && date !== null && 'date' in date && 'month' in date && 'year' in date) {
                                    d = new Date(cell.year, cell.month, cell.date);
                                } else {
                                    d = new Date(this.year, this.month, date);
                                }
                                const dateStr = d.toISOString().slice(0,10);
                                this.selectedDate = dateStr;
                                this.selectedEvents = this.events ? this.events.filter(e => e.date === dateStr) : [];
                            },
                            get selectedDateLabel() {
                                if (!this.selectedDate) return '';
                                const d = new Date(this.selectedDate);
                                return d.toLocaleDateString(undefined, { month: 'long', day: 'numeric', year: 'numeric' });
                            },
                            prevMonth() {
                                this.current = new Date(this.year, this.month - 1, 1);
                                this.selectedDate = null;
                                this.selectedEvents = [];
                            },
                            nextMonth() {
                                this.current = new Date(this.year, this.month + 1, 1);
                                this.selectedDate = null;
                                this.selectedEvents = [];
                            },
                            init() {
                                this.current = new Date(this.today.getFullYear(), this.today.getMonth(), 1);
                                this.selectDate(this.today.getDate());
                            }
                        }
                    }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
