<?php

namespace App\Jobs;

use App\Models\OlxApartment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class OlxApartmentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public array $data;
    /**
     * Create a new job instance.
     */
    public function __construct(array $data)
    {
       $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        OlxApartment::add($this->data);
    }
}
