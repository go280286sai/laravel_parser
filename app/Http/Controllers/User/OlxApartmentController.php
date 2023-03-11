<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\OlxApartment;
use App\Models\Research;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;

class OlxApartmentController extends Controller
{
    public function index()
    {
        $olx = Research::find(1);
        $OlxApartment = OlxApartment::all();

        return view('admin.parser.apartment.olx.index', ['title' => 'Parser OLX', 'apartments' => $OlxApartment, 'olx' => $olx]);
    }

    public function addOlxApartment(Request $request)
    {
        $request->validate([
            'title' => 'unique:olx_apartments',
        ]);
        OlxApartment::add($request->all());
    }

    public function cleanDb()
    {
        OlxApartment::cleanBase();

        return back();
    }

    public function saveJson()
    {
        $data = OlxApartment::all('title', 'type', 'rooms', 'floor', 'etajnost', 'description', 'price', 'date');
        $now = Carbon::now()->format('d_m_Y');
        $name = 'Olx_Apartment_'.$now;

        return Response::make($data)->header('Content-Type', 'application/json;charset=utf-8')->header('Content-Disposition', "attachment;filename=$name.json");
    }

    public function remove(Request $request)
    {
        $id = $request->get('id');
        OlxApartment::removeId($id);

        return back();
    }

    public function olx_soft_delete_index()
    {
        $data = OlxApartment::onlyTrashed()->get();

        return view('admin.parser.apartment.olx.trash', ['trash' => $data]);
    }

    public function olx_soft_delete_all()
    {
        OlxApartment::onlyTrashed()->forceDelete();

        return redirect()->route('olx_apartment');
    }

    public function olx_soft_recovery_all()
    {
        OlxApartment::onlyTrashed()->restore();

        return redirect()->route('olx_apartment');
    }

    public function olx_soft_delete_item(Request $request)
    {
        $item = $request->get('id');
        OlxApartment::onlyTrashed()->find($item)->forceDelete();

        return redirect()->route('olx_apartment');
    }

    public function olx_soft_recovery_item(Request $request)
    {
        $item = $request->get('id');
        OlxApartment::onlyTrashed()->find($item)->restore();

        return redirect()->route('olx_apartment');
    }

    public function comment_view(Request $request)
    {
        $id = $request->get('id');
        $data = OlxApartment::find($id);

        return view('admin.parser.apartment.olx.comment', ['data' => $data]);
    }

    public function comment_add(Request $request)
    {
        $id = $request->get('id');
        $comment = $request->get('comment');
        OlxApartment::addComment($id, $comment);

        return redirect()->route('olx_apartment');
    }

    public function checks_remove(Request $request)
    {
        $data = $request->get('checks');
        foreach ($data as $item) {
            OlxApartment::removeId($item);
        }
    }
}
