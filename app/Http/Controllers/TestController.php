<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;

class TestController extends Controller
{
    public function index()
    {
        $test = Http::get('https://privatbank.ua/')->body();
        $pattern = '/<td\s+id="USD_sell">\s*([\d.]+)\s*<\/td>/';
        preg_match($pattern, $test, $matches);

        if (isset($matches[1])) {
            echo $matches[1];
        }

        return true;

        return Response::view('test');
    }
}
