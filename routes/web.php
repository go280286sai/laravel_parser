<?php

use App\Http\Controllers\User\MainController;
use App\Http\Controllers\User\OlxApartmentController;
use App\Http\Controllers\User\ParserController;
use App\Http\Controllers\User\ResearchController;
use App\Http\Controllers\User\UserController;
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
Route::get('/apartment', [ParserController::class, 'index']);
Route::get('/test', '\App\Http\Controllers\TestController@index');
Route::get('/admin', function () {
    return view('admin.layout.layout');
});
Route::get('/front', function () {
    return view('front.layout.layout');
});
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
    Route::controller(ParserController::class)->group(function () {
        Route::post('/runParser', 'index');
        Route::post('/csv', 'getCsv');
    });
    Route::controller(ResearchController::class)->group(function () {
        Route::post('url_edit', 'update');
    });
    Route::controller(MainController::class)->group(function () {
        Route::get('/dashboard', 'index');
        Route::post('/exit', 'logout');
    });
    Route::controller(OlxApartmentController::class)->group(function () {
        Route::post('/cleanDb', 'cleanDb');
        Route::post('/addOlxApartment', 'addOlxApartment');
        Route::get('/apartment', 'index')->name('olx_apartment');
        Route::post('/saveJson', 'saveJson');
        Route::get('olx_apartment_comment', 'comment_view');
        Route::post('olx_apartment_comment', 'comment_add');
        Route::post('/olx_apartment_delete', 'remove');
        Route::get('/olx_apartment_delete_index', 'olx_soft_delete_index');
        Route::post('/olx_apartment_delete_all', 'olx_soft_delete_all');
        Route::post('/olx_apartment_delete_item', 'olx_soft_delete_item');
        Route::post('/olx_apartment_recovery_all', 'olx_soft_recovery_all');
        Route::post('/olx_apartment_recovery_item', 'olx_soft_recovery_item');
        Route::post('/checks_remove', 'checks_remove');
        Route::post('/set_status', 'setStatus');
        Route::post('/sendPushMessage', 'sendPushMessage');
        Route::post('/setNewPrice', 'setNewPrice');
        Route::get('/report', 'report');
        Route::post('add_favorite', 'addFavorite');
        Route::post('remove_favorite', 'removeFavorite');
        Route::get('/create_apartment', 'create');
        Route::post('/addCreate', 'addCreate');
        Route::post('/setting', 'setting');
        Route::post('/view', 'view');
        Route::post('/edit', 'edit');
    });
    Route::resource('/users', UserController::class);
    Route::controller(UserController::class)->group(function (){
       Route::post('/comment', 'comment');
       Route::post('/add_comment_user', 'add_comment_user');
       Route::post('createMessage', 'createMessage');
       Route::post('/sendMessage', 'sendMessage');
    });
});
