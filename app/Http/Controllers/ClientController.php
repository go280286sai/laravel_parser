<?php

namespace App\Http\Controllers;

use App\Func\MyFunc;
use App\Jobs\OlxApartmentJob;
use App\Mail\User_email;
use App\Models\Client;
use App\Models\Document;
use App\Models\OlxApartment;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        DB::transaction(function () use ($id) {
            $posts = OlxApartment::all()->where('client_id', '=', $id);
            $docs = Document::all()->where('client_id', '=', $id);
            foreach ($docs as $doc) {
                Document::remove($doc->id);
            }
            foreach ($posts as $post) {
                OlxApartment::removeId($post->id);
            }
            $postRemoveForever = OlxApartment::onlyTrashed()->where('client_id', '=', $id)->get();
            foreach ($postRemoveForever as $item) {
                $item->forceDelete();
            }
            Client::remove($id);
        });

        return redirect('/user/client');
    }

    /**
     * Add comment to client
     */
    public function comment(string $id): View
    {
        $comment = Client::find($id);

        return view('admin.client.comment', ['comment' => $comment]);
    }

    public function comment_add(Request $request): RedirectResponse
    {
        $id = $request->get('id');
        $comment = $request->get('comment');
        Client::client_comment_add(['id' => $id, 'comment' => $comment]);

        return redirect('/user/client');
    }

    /**
     * Create message to client
     */
    public function createMessageClient(string $id): View
    {
        $user = Client::find($id);

        return view('admin.client.mail', ['user' => $user]);
    }

    /**
     * Send message to client
     */
    public function sendMessageClient(Request $request): RedirectResponse
    {
        $request->validate([
            'content' => 'required|string',
            'title' => 'required|string',
            'email' => 'required',
        ]);
        $email = $request->get('email');
        $title = $request->get('title');
        $text = $request->get('text');
        Mail::to($email)->cc(Auth::user()->email)->send(new User_email($text));
        Log::info('Answer the message: '.$email.' '.$title.' --'.Auth::user()->name);

        return redirect('/user/client');
    }

    public function addBuy(string $client_id, string $service_id): View
    {
        $contacts = Client::find($client_id);
        $location = MyFunc::getLocation();
        $service = Service::find($service_id);

        return view('admin.client.create_buy', [
            'service' => $service,
            'client' => $contacts,
            'loc' => $location,
        ]);
    }

    public function addSell(string $client_id, string $service_id): View
    {
        $contacts = Client::find($client_id);
        $service = Service::find($service_id);
        $location = MyFunc::getLocation();
        $rate = MyFunc::getDollar();

        return view('admin.client.create_sell', [
            'loc' => $location,
            'rate' => $rate,
            'client' => $contacts,
            'service' => $service,
        ]);
    }

    public function createSell(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'unique:olx_apartments|string',
            'rooms' => 'required|numeric',
            'floor' => 'required|numeric',
            'etajnost' => 'required|numeric',
            'area' => 'required|numeric',
            'location' => 'required|not_regex:(Выбрать+)',
            'price' => 'required|numeric',
            'description' => 'required',
        ]);
        $fields = $request->all();
        $fields = MyFunc::stripTags($fields);
        $fields['type'] = env('APP_NAME');
        $fields['url'] = env('APP_URL').'/user/client/'.$fields['client_id'];
        OlxApartmentJob::dispatch($fields)->onQueue('olx_apartment');

        return redirect('/user/documents');
    }
}
