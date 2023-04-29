<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\User_email;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $users = User::all();

        return view('admin.user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        User::add($request->all());

        return redirect('/user/users');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): void
    {
//
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $user = User::find($id);

        return view('admin.user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        User::edit($request->all(), $id);

        return redirect('/user/users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        User::remove($id);

        return redirect('/user/users');
    }

    public function comment(Request $request): View
    {
        $id = $request->get('id');
        $comment = $request->get('comment');

        return view('admin.user.comment', ['id' => $id, 'comment' => $comment]);
    }

    public function add_comment_user(Request $request): RedirectResponse
    {
        User::add_comment_user($request->all());

        return redirect('/user/users');
    }

    public function createMessage(Request $request): View
    {
        $user = User::find($request->all());

        return view('admin.user.mail', ['user' => $user[0]]);
    }

    public function sendMessage(Request $request): RedirectResponse
    {
        $request->validate([
            'content'=>'required|string',
            'title'=>'required|string',
            'email'=>'required'
        ]);
        $email = $request->get('email');
        $title = $request->get('title');

        Mail::to($email)->cc(Auth::user()->email)->send(new User_email($request->all()));
        Log::info('Answer the message: '.$email.' '.$title.' --'.Auth::user()->name);

        return redirect('/user/users');
    }
}
