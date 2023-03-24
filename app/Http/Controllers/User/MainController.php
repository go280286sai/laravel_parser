<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index(): View
    {
        return view('admin.user.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return to_route('login');
    }
}
