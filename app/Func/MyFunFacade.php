<?php

namespace App\Func;

use Illuminate\Support\Facades\Facade;

class MyFunFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'MyFunc';
    }
}
