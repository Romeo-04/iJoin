<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Event;
use App\Models\Ticket;

class VerifyData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:verify-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verify that the application has proper test data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== EventEase Application Status ===');
        $this->newLine();

        // Check users
        $users = User::all();
        $this->info("Users ({$users->count()}):");
        foreach ($users as $user) {
            $this->line("- {$user->name} ({$user->email}) - {$user->role}");
        }
        $this->newLine();

        // Check events
        $events = Event::all();
        $this->info("Events ({$events->count()}):");
        foreach ($events as $event) {
            $this->line("- {$event->title} - {$event->status} - {$event->date}");
            $this->line("  Price: \${$event->price} | Max: {$event->max_registrants} | Registered: {$event->tickets->count()}");
        }
        $this->newLine();

        // Check tickets
        $tickets = Ticket::all();
        $this->info("Tickets ({$tickets->count()}):");
        foreach ($tickets as $ticket) {
            $this->line("- Ticket #{$ticket->id} for {$ticket->user->name} - Event: {$ticket->event->title}");
        }

        $this->newLine();
        $this->info('=== Application Ready for Testing! ===');

        // Provide login credentials
        $this->newLine();
        $this->info('=== Test Login Credentials ===');
        $this->line('Admin Account:');
        $this->line('  Email: admin@example.com');
        $this->line('  Password: password');
        $this->newLine();
        $this->line('User Accounts:');
        $this->line('  Email: test@example.com | Password: password');
        $this->line('  Email: user@example.com | Password: password');
        $this->line('  Email: marcus@gmail.com | Password: password');

        return Command::SUCCESS;
    }
}
