<?php

namespace App\Http\Controllers;

use App\Func\MyFunc;
use App\Models\Client;
use App\Models\Document;
use App\Models\OlxApartment;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $docs = Document::all();
        return view('admin.document.index', ['docs' => $docs, 'i' => 1]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $contacts = Client::all();
        $location = OlxApartment::all('location')->groupBy('location')->toArray();
        $service = Service::all();

        return view('admin.document.create', ['service' => $service, 'contacts' => $contacts, 'loc' => array_keys($location)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'rooms' => 'required|numeric',
            'etajnost' => 'required|numeric',
            'location' => 'required|not_regex:(Выбрать+)',
            'price' => 'required|numeric',
            'client_id'=>'required|numeric'
        ]);
        $fields = MyFunc::stripTags($request->all());
        Document::add($fields);

        return redirect('/user/documents');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $doc = Document::find($id);
        $contacts = Client::all();
        $location = OlxApartment::all('location')->groupBy('location')->toArray();
        $service = Service::all();

        return view('admin.document.show', ['doc' => $doc, 'service' => $service, 'contacts' => $contacts, 'loc' => array_keys($location)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $doc = Document::find($id);
        $contacts = Client::all();
        $location = OlxApartment::all('location')->groupBy('location')->toArray();
        $service = Service::all();

        return view('admin.document.edit', ['doc' => $doc, 'service' => $service, 'contacts' => $contacts, 'loc' => array_keys($location)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $fields = self::stripTags($request->all());
        Document::edit($fields, $id);

        return redirect('/user/documents');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        Document::remove($id);

        return redirect('/user/documents');
    }

    public function comment(Request $request): View
    {
        $id = $request->get('id');
        $comment = $request->get('comment');

        return view('admin.document.comment', ['id' => $id, 'comment' => $comment]);
    }

    public function addComment(Request $request): RedirectResponse
    {
        $fields = self::stripTags($request->all());
        Document::addComment($fields);

        return redirect('/user/documents');
    }
}
