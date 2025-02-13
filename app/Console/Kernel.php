<?php

namespace App\Console;

use Carbon\Carbon;
use App\Models\lslbOrder;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            lslbOrder::where('status', 'complete')
                ->where('advertiser_status', 'new')
                ->where('updated_at', '<=', Carbon::now()->subHours(48))
                ->update(['advertiser_status' => 'complete']);
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
