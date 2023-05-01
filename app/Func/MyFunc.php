<?php

namespace App\Func;

use App\Models\OlxApartment;
use App\Models\Rate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

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

    public static function getToken()
    {
        $token = DB::table('personal_access_tokens')->where('tokenable_id', '=', Auth::id())->select('token')->get();
        if (count($token) > 0) {
            $token = $token[0]->token;
        } else {
            $token = Auth::user()->createToken('API TOKEN')->plainTextToken;
        }

        return $token;
    }

    public static function getListToArray(string $text): array
    {
        $array = explode(',', substr($text, 0, strlen($text) - 1));
        $object = DB::table('olx_apartments')->where('deleted_at','=',null)->whereIn('id', $array)->get();

        return [$object, $array];
    }
}
