<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function index()
    {
        return view('admin.user.dashboard');
    }
}
