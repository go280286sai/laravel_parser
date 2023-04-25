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

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $clients = Client::all();

        return view('admin.client.index', ['clients' => $clients, 'i' => 1]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.client.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        Client::add($request->all());

        return redirect('/user/client');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $client = Client::find($id);

        return view('admin.client.show', ['client' => $client]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $client = Client::find($id);

        return view('admin.client.edit', ['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        Client::edit($request->all(), $id);

        return redirect('/user/client');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        Client::remove($id);

        return redirect('/user/client');
    }

    public function comment(Request $request): View
    {
        $id = $request->get('id');
        $comment = $request->get('comment');

        return view('admin.client.comment', ['id' => $id, 'comment' => $comment]);
    }

    public function comment_add(Request $request): RedirectResponse
    {
        $id = $request->get('id');
        $comment = $request->get('comment');
        Client::client_comment_add(['id' => $id, 'comment' => $comment]);

        return redirect('/user/client');
    }

    public function createMessageClient(Request $request): View
    {
        $user = Client::find($request->all());

        return view('admin.client.mail', ['user' => $user[0]]);
    }

    public function sendMessageClient(Request $request): RedirectResponse
    {
        Mail::to($request->email)->cc(Auth::user()->email)->send(new User_email($request->all()));
        Log::info('Answer the message: '.$request->email.' '.$request->title.' --'.Auth::user()->name);

        return redirect('/user/client');
    }
}
