<?php

namespace App\Http\Controllers;

use App\Models\OlxApartment;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class TestController extends Controller
{
    public function index()
    {
//                $data = OlxApartment::all('id', 'rooms', 'floor', 'etajnost', 'metro', 'shops', 'service', 'price', 'date');
//               $loc= OlxApartment::all()->pluck('location');
//           $list=array_unique($loc->toArray());
//               dd(array_keys($list, 'Харків, Немишлянський')[0]);


//        return Response::view('test', ['data' => $data]);
        OlxApartment::setIdexLocation();
        return true;

    }
}
