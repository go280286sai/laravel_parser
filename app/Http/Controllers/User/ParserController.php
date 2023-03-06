<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\OlxApartment;
use App\Models\Research;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Illuminate\View\View;
use function MongoDB\BSON\toJSON;

class ParserController extends Controller
{
    public function apartment(): View
    {
        $olx=Research::find(1);
        $OlxApartment = OlxApartment::all();
       return view('admin.user.apartment.index', ['title'=>'Parser OLX', 'i'=>0, 'apartments'=>$OlxApartment, 'olx'=> $olx]);
    }

    public function getCsv(Request $request)
    {
        $data = $request->all();
        return Response::view('admin.user.apartment.csv', ['data'=>$data])->header('Content-Type', 'text/csv')->header("Content-Disposition", "attachment;filename=myfilename.csv");
    }

    public function addOlxApartment(Request $request)
    {
        OlxApartment::add($request->all());
        Log::info($request->all());
        return $request->all();
    }
    public function runCleanDb(Request $request)
    {
        $resource = $request->get('target');
        switch ($resource){
            case 'olx_apartment':
                OlxApartment::cleanBase();
                break;
            default:
                break;
        }
return back();
    }
}
