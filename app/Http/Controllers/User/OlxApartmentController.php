<?php

namespace App\Http\Controllers\User;

use App\Events\OlxApartmentEvent;
use App\Http\Controllers\Controller;
use App\Jobs\OlxApartmentJob;
use App\Jobs\RealPriceJob;
use App\Models\OlxApartment;
use App\Models\Rate;
use App\Models\Research;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as Back;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class OlxApartmentController extends Controller
{
    public function index(): View
    {
        if (Cache::has('research')) {
            $olx = Cache::get('research');
        } else {
            $olx = Research::find(1);
            Cache::put('research', $olx);
        }
        $OlxApartment = OlxApartment::all()->sortByDesc('date');
        if (Cache::has('dollar')) {
            $rate = Cache::get('dollar');
        } else {
            $rate = Rate::latest()->get('dollar');
            Cache::put('dollar', $rate);
        }
        if (Auth::user()->token == null) {
            $token = Auth::user()->createToken('API TOKEN')->plainTextToken;
            User::setToken($token);
        } else {
            $token = Auth::user()->token;
        }

        return view('admin.parser.apartment.olx.index',
            [
                'title' => 'Parser OLX',
                'apartments' => $OlxApartment,
                'olx' => $olx,
                'data' => $data ?? 0,
                'rate' => $rate[0] ?? 0,
                'token' => $token
            ]);
    }

    public function report(): View
    {
        if (Cache::has('dollar')) {
            $rate = Cache::get('dollar');
        } else {
            $rate = Rate::latest()->get('dollar');
            Cache::put('dollar', $rate);
        }
        $group = DB::table('olx_apartments')
            ->select('rooms', 'floor', 'etajnost', 'location', DB::raw('ROUND(AVG(price),2) as price'),
                DB::raw('COUNT(rooms) as count'), DB::raw('ROUND(AVG(real_price),2) as real_price'))
            ->groupBy(['rooms', 'floor', 'etajnost', 'location'])
            ->orderBy('rooms')
            ->get();
        return view('admin.parser.apartment.olx.report', ['group' => $group, 'rate' => $rate]);
    }

    public function addOlxApartment(Request $request): void
    {
        $request->validate([
            'title' => 'unique:olx_apartments',
        ]);
        OlxApartmentJob::dispatch($request->all())->onQueue('olx_apartment');
    }

    public function cleanDb(): RedirectResponse
    {
        OlxApartment::cleanBase();

        return back();
    }

    public function saveJson(): Back
    {
        $data = OlxApartment::all('title', 'type', 'rooms', 'floor', 'etajnost', 'description', 'price', 'date', 'location');
        $now = Carbon::now()->format('d_m_Y');
        $name = 'Olx_Apartment_' . $now;

        return Response::make($data)->header('Content-Type', 'application/json;charset=utf-8')
            ->header('Content-Disposition', "attachment;filename=$name.json");
    }

    public function remove(Request $request): RedirectResponse
    {
        $id = $request->get('id');
        OlxApartment::removeId($id);

        return back();
    }

    public function olx_soft_delete_index(): View
    {
        $data = OlxApartment::onlyTrashed()->get();

        return view('admin.parser.apartment.olx.trash', ['trash' => $data]);
    }

    public function olx_soft_delete_all(): RedirectResponse
    {
        OlxApartment::onlyTrashed()->forceDelete();

        return redirect()->route('olx_apartment');
    }

    public function olx_soft_recovery_all(): RedirectResponse
    {
        OlxApartment::onlyTrashed()->restore();

        return redirect()->route('olx_apartment');
    }

    public function olx_soft_delete_item(Request $request): RedirectResponse
    {
        $item = $request->get('id');
        OlxApartment::onlyTrashed()->find($item)->forceDelete();

        return redirect()->route('olx_apartment');
    }

    public function olx_soft_recovery_item(Request $request): RedirectResponse
    {
        $item = $request->get('id');
        OlxApartment::onlyTrashed()->find($item)->restore();

        return redirect()->route('olx_apartment');
    }

    public function create()
    {
        $location = OlxApartment::all('location')->groupBy('location')->toArray();
        return view('admin.parser.apartment.olx.create', ['loc' => array_keys($location)]);
    }

    public function addCreate(Request $request)
    {
        $request->validate([
            'title' => 'unique:olx_apartments|string',
            'rooms' => 'required|numeric',
            'floor' => 'required|numeric',
            'etajnost' => 'required|numeric',
            'area' => 'required|numeric',
            'location' => 'required|not_regex:(Выбрать+)',
            'price' => 'required|numeric',
            'description' => 'required'
        ]);
        $fields = $request->all();
        $fields = array_map(function ($item) {
            return strip_tags($item);
        }, $fields);
        $fields['url'] = env('APP_URL');
        $fields['type'] = env('APP_NAME');
        OlxApartmentJob::dispatch($fields)->onQueue('olx_apartment');
        return back();

    }

    public function comment_view(Request $request): View
    {
        $id = $request->get('id');
        $data = OlxApartment::find($id);

        return view('admin.parser.apartment.olx.comment', ['data' => $data]);
    }

    public function comment_add(Request $request): RedirectResponse
    {
        $id = $request->get('id');
        $comment = $request->get('comment');
        OlxApartment::addComment($id, $comment);

        return redirect()->route('olx_apartment');
    }

    public function checks_remove(Request $request): void
    {
        $data = $request->get('checks');
        foreach ($data as $item) {
            OlxApartment::removeId($item);
        }
    }

    public function setStatus(Request $request): void
    {
        OlxApartment::setStatus($request->get('id'));
    }

    public function sendPushMessage(Request $request): void
    {
        $text = $request->get('text');
        event(new OlxApartmentEvent($text));
    }

    public function setNewPrice(Request $request)
    {
        $fields = $request->get('price');
        foreach ($fields['data'] as $item) {
            RealPriceJob::dispatch($item)->onQueue('setPrice');
        }
    }

    public function addFavorite(Request $request)
    {
        $data = $request->get('checks');
        foreach ($data as $item) {
            OlxApartment::addFavorite($item);
        }
    }

    public function removeFavorite(Request $request)
    {
        $data = $request->get('checks');
        foreach ($data as $item) {
            OlxApartment::removeFavorite($item);
        }
    }

    public function setting(Request $request)
    {
        $arr = $request->get('data');
        $name = array_keys($arr);
        $text = array_values($arr);
        Setting::addSetting(['name' => $name[0], 'text' => $text[0]]);

    }
}
