<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class TestController extends Controller
{
    public function index()
    {
        $client = new Client();
        $result = $client->get('https://www.olx.ua/d/uk/obyavlenie/prodam-3kmnatnu-kvartiru-metro-metrobudvnikv-IDR6SvJ.html')->getBody();

        return view('test', ['result' => $result]);
    }
}
