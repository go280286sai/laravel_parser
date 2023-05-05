<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\User\MainController;
use App\Http\Controllers\User\OlxApartmentController;
use App\Http\Controllers\User\ResearchController;
use App\Http\Controllers\User\UserController;
use App\Http\Middleware\IsAdminMiddleware;
use App\Http\Middleware\IsAuthUser;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/test', '\App\Http\Controllers\TestController@index');

Route::get('/', function () {
    return view('front.pages.index');
})->name('main');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::group(['prefix' => 'user', 'middleware' => IsAuthUser::class], function () {
    //    ResearchController
    Route::controller(ResearchController::class)->group(function () {
        Route::post('url_edit', 'update');
        Route::post('url_add', 'store');
    });

    //    MainController
    Route::controller(MainController::class)->group(function () {
        Route::get('/dashboard', 'index');
        Route::get('/exit', 'logout');
    });

    //    OlxApartmentController
    Route::controller(OlxApartmentController::class)->group(function () {
        Route::post('/cleanDb', 'cleanDb')->middleware(IsAdminMiddleware::class);
        Route::post('/addOlxApartment', 'addOlxApartment');
        Route::get('/apartment', 'index')->name('olx_apartment');
        Route::post('/saveJson', 'saveJson')->middleware(IsAdminMiddleware::class);
        Route::get('olx_apartment_comment/{id}', 'comment_view');
        Route::post('olx_apartment_comment', 'comment_add');
        Route::post('/olx_apartment_delete', 'remove');
        Route::get('/olx_apartment_delete_index', 'olx_soft_delete_index')->middleware(IsAdminMiddleware::class);
        Route::get('/olx_apartment_delete_all', 'olx_soft_delete_all')->middleware(IsAdminMiddleware::class);
        Route::get('/olx_apartment_delete_item/{id}', 'olx_soft_delete_item')->middleware(IsAdminMiddleware::class);
        Route::get('/olx_apartment_recovery_all', 'olx_soft_recovery_all')->middleware(IsAdminMiddleware::class);
        Route::get('/olx_apartment_recovery_item/{id}', 'olx_soft_recovery_item')->middleware(IsAdminMiddleware::class);
        Route::post('/checks_remove', 'checks_remove');
        Route::post('/set_status', 'setStatus');
        Route::post('/setNewPrice', 'setNewPrice');
        Route::post('add_favorite', 'addFavorite');
        Route::post('remove_favorite', 'removeFavorite');
        Route::get('/create_apartment', 'create');
        Route::post('/addCreate', 'addCreate');
        Route::post('/setting', 'setting');
        Route::get('/view/{id}', 'view');
        Route::post('/edit', 'edit');
        Route::post('/getApartment', 'getApartments');
        Route::post('/sendClientMail', 'sendClientMail');
    });

    //    ServiceController
    Route::resource('/service', ServiceController::class)->middleware(IsAdminMiddleware::class);

    //    UserController
    Route::resource('/users', UserController::class);
    Route::controller(UserController::class)->middleware(IsAdminMiddleware::class)->group(function () {
        Route::get('/comment/{id}', 'comment');
        Route::post('/add_comment_user', 'add_comment_user');
        Route::get('/createMessage/{id}', 'createMessage');
        Route::post('/sendMessage', 'sendMessage');
    });
    Route::resource('/client', ClientController::class);
    Route::controller(ClientController::class)->group(function () {
        Route::get('/client_comment/{id}', 'comment');
        Route::post('/client_comment_add', 'comment_add');
        Route::get('/createMessageClient/{id}', 'createMessageClient');
        Route::post('/sendMessageClient', 'sendMessageClient');
        Route::get('/add_buy/{client_id}/{service_id}', 'addBuy');
        Route::get('/add_sell/{client_id}/{service_id}', 'addSell');
        Route::post('/createSell', 'createSell');
    });

    //    DocumentController
    Route::resource('/documents', DocumentController::class);
    Route::controller(DocumentController::class)->group(function () {
        Route::get('/document_comment/{id}', 'comment');
        Route::post('/document_comment_add', 'addComment');
    });
});
