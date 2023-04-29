<?php

namespace App\Jobs;

use App\Mail\Client_email;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Send_mail_clientJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private object $object;

    private string $email;

    /**
     * Create a new job instance.
     */
    public function __construct(object $object, string $email)
    {
        $this->object = $object;
        $this->email = $email;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->cc(Auth::user()->email)->send(new Client_email($this->object));
    }
}
