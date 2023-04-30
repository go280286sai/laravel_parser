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

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function comment_add(Request $request): RedirectResponse
    {
        $object = MyFunc::stripTags($request->all());
        Client::client_comment_add($object);

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
        ]);
        $fields = MyFunc::stripTags($request->all());
        Mail::to($fields['email'])->cc(Auth::user()->email)->send(new User_email($fields));
        Log::info('Answer the message: '.$fields['email'].' '.$fields['title'].' --'.Auth::user()->name);

        return redirect('/user/client');
    }

    /**
     * @param string $client_id
     * @param string $service_id
     * @return View
     */
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

    /**
     * @param string $client_id
     * @param string $service_id
     * @return View
     */
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

    /**
     * @param Request $request
     * @return RedirectResponse
     */
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
