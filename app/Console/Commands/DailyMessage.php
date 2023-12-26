<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Purchase;
use App\Notifications\DailySalesNotification;
use Illuminate\Support\Facades\Notification;

class DailyMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'message:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Artisan command to send daily messages';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Retrieve the total sales amount
        $totalSalesAmount = Purchase::sum('amount');

        // Send a notification with the total sales amount
        Notification::route('mail', 'fross0988@gmail.com')->notify(new DailySalesNotification($totalSalesAmount));

        $this->info('Daily message sent successfully.');
    }
}
