<?php

namespace App\Jobs;

use App\Models\OlxApartment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RealPriceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $fields;

    /**
     * Create a new job instance.
     */
    public function __construct(array $fields)
    {
        $this->fields = $fields;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        OlxApartment::setNewPrice($this->fields);
    }
}
