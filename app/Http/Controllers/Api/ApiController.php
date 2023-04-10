<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OlxApartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    public function getFiles(Request $request)
    {
        try {
            $name = $request->get('name');
            OlxApartment::uploadImage($name, $request->file('file'));
            return response()->json(['status' => 'ok']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error'])->setStatusCode(400);
        }
    }
}
