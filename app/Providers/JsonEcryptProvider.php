<?php

namespace App\Providers;

use App\Func\JsonEncrypt;
use Illuminate\Support\ServiceProvider;

class JsonEcryptProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(JsonEncrypt::class, function (){
            return new JsonEncrypt();
        });
    }
}
