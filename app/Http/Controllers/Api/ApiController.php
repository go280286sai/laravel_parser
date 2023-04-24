<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OlxApartment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getFiles(Request $request): JsonResponse
    {
        try {
            $name = $request->get('name');
            OlxApartment::uploadImage($name, $request->file('file'));
            Log::info('UploadImage:'.Auth::id());
            return response()->json(['status' => 'ok']);
        } catch (\Exception $e) {
            Log::info('Error UploadImage:'.Auth::id());
            return response()->json(['status' => 'error'])->setStatusCode(400);
        }
    }
}
