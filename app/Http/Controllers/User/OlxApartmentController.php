<?php

namespace App\Http\Controllers\User;

use App\Events\OlxApartmentEvent;
use App\Http\Controllers\Controller;
use App\Jobs\OlxApartmentJob;
use App\Models\OlxApartment;
use App\Models\Research;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as Back;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;

class OlxApartmentController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        OlxApartment::setIdexLocation();
        $olx = Research::find(1);
        $OlxApartment = OlxApartment::all()->sortByDesc('date');
        $data = OlxApartment::all('id', 'rooms', 'floor', 'etajnost', 'area', 'metro', 'shops','repair', 'service','location_index', 'price', 'date');

        return view('admin.parser.apartment.olx.index',
            [
                'title' => 'Parser OLX',
                'apartments' => $OlxApartment,
                'olx' => $olx,
                'data'=>$data
            ]);
    }

    /**
     * @param Request $request
     * @return void
     */
    public function addOlxApartment(Request $request): void
    {
        $request->validate([
            'title' => 'unique:olx_apartments',
        ]);
//        OlxApartment::add($request->all());
        OlxApartmentJob::dispatch($request->all())->onQueue('olx_apartment');
    }

    /**
     * @return RedirectResponse
     */
    public function cleanDb(): RedirectResponse
    {
        OlxApartment::cleanBase();

        return back();
    }

    /**
     * @return Back
     */
    public function saveJson(): Back
    {
        $data = OlxApartment::all('title', 'type', 'rooms', 'floor', 'etajnost', 'description', 'price', 'date', 'location');
        $now = Carbon::now()->format('d_m_Y');
        $name = 'Olx_Apartment_' . $now;

        return Response::make($data)->header('Content-Type', 'application/json;charset=utf-8')
            ->header('Content-Disposition', "attachment;filename=$name.json");
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function remove(Request $request): RedirectResponse
    {
        $id = $request->get('id');
        OlxApartment::removeId($id);

        return back();
    }

    /**
     * @return View
     */
    public function olx_soft_delete_index(): View
    {
        $data = OlxApartment::onlyTrashed()->get();

        return view('admin.parser.apartment.olx.trash', ['trash' => $data]);
    }

    /**
     * @return RedirectResponse
     */
    public function olx_soft_delete_all(): RedirectResponse
    {
        OlxApartment::onlyTrashed()->forceDelete();

        return redirect()->route('olx_apartment');
    }

    /**
     * @return RedirectResponse
     */
    public function olx_soft_recovery_all(): RedirectResponse
    {
        OlxApartment::onlyTrashed()->restore();

        return redirect()->route('olx_apartment');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function olx_soft_delete_item(Request $request): RedirectResponse
    {
        $item = $request->get('id');
        OlxApartment::onlyTrashed()->find($item)->forceDelete();

        return redirect()->route('olx_apartment');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function olx_soft_recovery_item(Request $request): RedirectResponse
    {
        $item = $request->get('id');
        OlxApartment::onlyTrashed()->find($item)->restore();

        return redirect()->route('olx_apartment');
    }

    /**
     * @param Request $request
     * @return View
     */
    public function comment_view(Request $request): View
    {
        $id = $request->get('id');
        $data = OlxApartment::find($id);

        return view('admin.parser.apartment.olx.comment', ['data' => $data]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function comment_add(Request $request): RedirectResponse
    {
        $id = $request->get('id');
        $comment = $request->get('comment');
        OlxApartment::addComment($id, $comment);

        return redirect()->route('olx_apartment');
    }

    /**
     * @param Request $request
     * @return void
     */
    public function checks_remove(Request $request): void
    {
        $data = $request->get('checks');
        foreach ($data as $item) {
            OlxApartment::removeId($item);
        }
    }

    /**
     * @param Request $request
     * @return void
     */
    public function setStatus(Request $request): void
    {
        OlxApartment::setStatus($request->get('id'));
    }

    /**
     * @param Request $request
     * @return void
     */
    public function sendPushMessage(Request $request): void
    {
        $text = $request->get('text');
        event(new OlxApartmentEvent($text));
    }

    public function getNewPrice()
    {
        $data = OlxApartment::all('id', 'rooms', 'floor', 'etajnost', 'area', 'metro', 'shops','repair', 'service','location_index', 'price', 'date');
      //        Response::view('admin.parser.apartment.olx.getNewPrice', ['data' => $data]);

    }

}
