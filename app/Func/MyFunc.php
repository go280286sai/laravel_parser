<?php

namespace App\Func;

use App\Models\OlxApartment;
use App\Models\Rate;
use Illuminate\Support\Facades\Cache;

class MyFunc
{
    public static function stripTags(array $fields): array
    {
        return array_map(function ($item) {
            return strip_tags($item);
        }, $fields);
    }

    public static function getLocation(): array
    {
        if (Cache::has('location')) {
            $location = Cache::get('location');
        } else {
            $location = OlxApartment::all('location')->groupBy('location')->toArray();
            Cache::put('location', $location);
        }
        return array_keys($location);
    }

    /**
     * @return mixed
     */
    public static function getDollar(): mixed
    {
        if (Cache::has('dollar')) {
            $rate = Cache::get('dollar');
        } else {
            $rate = Rate::latest()->get('dollar');
            Cache::put('dollar', $rate);
        }
        return $rate[0];
    }

}
