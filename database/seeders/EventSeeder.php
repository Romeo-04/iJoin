<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();
        
        if (!$admin) {
            $admin = User::create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]);
        }

        $events = [
            [
                'title' => 'Laravel Conference 2025',
                'description' => 'Join us for the biggest Laravel conference of the year! Learn from industry experts and network with fellow developers.',
                'location' => 'Convention Center, Downtown',
                'price' => 150.00,
                'status' => 'published',
                'date' => Carbon::now()->addDays(30)->setTime(9, 0),
                'max_registrants' => 200,
                'created_by' => $admin->id,
            ],
            [
                'title' => 'Web Development Workshop',
                'description' => 'Hands-on workshop covering modern web development techniques including HTML5, CSS3, and JavaScript.',
                'location' => 'Tech Hub, Building A',
                'price' => 75.00,
                'status' => 'published',
                'date' => Carbon::now()->addDays(15)->setTime(10, 0),
                'max_registrants' => 50,
                'created_by' => $admin->id,
            ],
            [
                'title' => 'Startup Networking Event',
                'description' => 'Connect with entrepreneurs, investors, and innovators in the startup ecosystem.',
                'location' => 'Rooftop Lounge, City Center',
                'price' => 25.00,
                'status' => 'published',
                'date' => Carbon::now()->addDays(7)->setTime(18, 30),
                'max_registrants' => 100,
                'created_by' => $admin->id,
            ],
            [
                'title' => 'AI & Machine Learning Summit',
                'description' => 'Explore the latest trends and applications in artificial intelligence and machine learning.',
                'location' => 'University Auditorium',
                'price' => 200.00,
                'status' => 'draft',
                'date' => Carbon::now()->addDays(45)->setTime(9, 0),
                'max_registrants' => 300,
                'created_by' => $admin->id,
            ],
            [
                'title' => 'Free Coding Bootcamp',
                'description' => 'A free introduction to programming for beginners. No prior experience required!',
                'location' => 'Community Center',
                'price' => 0.00,
                'status' => 'published',
                'date' => Carbon::now()->addDays(10)->setTime(14, 0),
                'max_registrants' => 30,
                'created_by' => $admin->id,
            ],
        ];

        foreach ($events as $eventData) {
            Event::create($eventData);
        }
    }
}
