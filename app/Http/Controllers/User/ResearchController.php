<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Research;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ResearchController extends Controller
{
    public function update(Request $request): RedirectResponse
    {
        Research::edit($request->get('id'), $request->all());

        return back();
    }
}
