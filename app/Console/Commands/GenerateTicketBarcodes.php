<?php

namespace App\Console\Commands;

use App\Models\Ticket;
use App\Services\BarcodeService;
use Illuminate\Console\Command;

class GenerateTicketBarcodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tickets:generate-barcodes {--force : Force regenerate all barcodes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate barcodes for tickets that don\'t have them';


    public function handle()
    {
        $force = $this->option('force');
        
        if ($force) {
            $tickets = Ticket::all();
            $this->info('Regenerating barcodes for all tickets...');
        } else {
            $tickets = Ticket::whereNull('barcode_url')->get();
            $this->info('Generating barcodes for tickets without barcodes...');
        }

        if ($tickets->isEmpty()) {
            $this->info('No tickets need barcode generation.');
            return;
        }

        $progress = $this->output->createProgressBar($tickets->count());
        $progress->start();

        $successCount = 0;
        $failureCount = 0;

        foreach ($tickets as $ticket) {
            $barcodeUrl = BarcodeService::generateBarcodeUrl($ticket->ticket_code);
            
            if ($barcodeUrl) {
                $ticket->update(['barcode_url' => $barcodeUrl]);
                $successCount++;
            } else {
                $failureCount++;
                $this->error("\nFailed to generate barcode for ticket: {$ticket->ticket_code}");
            }
            
            $progress->advance();
        }

        $progress->finish();
        
        $this->newLine(2);
        $this->info("Barcode generation completed!");
        $this->info("✅ Successfully generated: {$successCount}");
        
        if ($failureCount > 0) {
            $this->error("❌ Failed to generate: {$failureCount}");
        }
    }
}
