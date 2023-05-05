<?php

namespace App\Http\Controllers\User;

use App\Func\MyFunc;
use App\Http\Controllers\Controller;
use App\Jobs\AddCurrentRateJob;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        AddCurrentRateJob::dispatch();
        $user=Auth::user();
        $rate = MyFunc::getDollar();
        $group = DB::table('olx_apartments')
            ->select('rooms', 'floor', 'etajnost', 'location', DB::raw('ROUND(AVG(price),2) as price'),
                DB::raw('COUNT(rooms) as count'), DB::raw('ROUND(AVG(real_price),2) as real_price'))
            ->groupBy(['rooms', 'floor', 'etajnost', 'location'])
            ->orderBy('rooms')
            ->get();

        return view('admin.user.dashboard', ['group' => $group, 'rate' => $rate, 'user'=>$user]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        return to_route('login');
    }
}
