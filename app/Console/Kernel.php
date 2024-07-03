<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            Log::debug('Schedule Start.');
            $update_file = Storage::disk('local')->get( 'woocommerce_merchant_list.csv' );
            $result = Storage::disk('sftp')->put('woocommerce_merchant_list.csv', $update_file);
            if($result){
                Log::debug('The file was successfully transferred to Paidy\'s server.');
            }else{
                Log::error('File transfer to Paidy\'s server failed.');
            }
        })->everyFiveMinutes();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
