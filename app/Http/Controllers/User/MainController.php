<?php

namespace App\Http\Controllers\User;

use _PHPStan_1f608dc6a\Nette\Utils\DateTime;
use App\Http\Controllers\Controller;
use App\Jobs\AddCurrentRateJob;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index(): View
    {

            AddCurrentRateJob::dispatch();

        return view('admin.user.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return to_route('login');
    }
}
