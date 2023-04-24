<?php

namespace App\Http\Controllers;

use App\Mail\User_email;
use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class TestController extends Controller
{
    public function index()
    {
        return view('test');
    }
}
