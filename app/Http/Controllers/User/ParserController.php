<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Jobs\OlxApartmentJob;
use App\Models\OlxApartment;
use App\Models\Research;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class ParserController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->get('name');
        $url = $request->get('url');
        switch ($name) {
            case $name=='OlxApartment':
                OlxApartmentJob::dispatch('hello')->onQueue('OlxApartment');
                break;
            default:
                break;
        }
        return back();
    }


    public function getCsv(Request $request)
    {
        $data = $request->all();
        return Response::view('admin.parser.apartment.csv', ['data' => $data])->header('Content-Type', 'text/csv')->header("Content-Disposition", "attachment;filename=myfilename.csv");
    }
}
