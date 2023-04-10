<?php

namespace App\Jobs;

use App\Models\Rate;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AddCurrentRateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $date = Carbon::now()->format('Y-m-d');
        $test = Http::get('https://privatbank.ua/')->body();
        $pattern = '/<td\s+id="USD_sell">\s*([\d.]+)\s*<\/td>/';
        preg_match($pattern, $test, $matches);
        if (isset($matches[1])) {
            try {
                Rate::add(['dollar' => $matches[1], 'date' => $date]);
            } catch (Exception $exception) {
                Log::info($exception->getMessage());
            }
        }
    }
}
