<?php

namespace App\Providers;

use App\Func\MyFunc;
use Illuminate\Support\ServiceProvider;

class MyFuncProvider extends ServiceProvider
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
        $this->app->bind('MyFunc', MyFunc::class);
    }
}
