<?php

use App\Http\Controllers\User\MainController;
use App\Http\Controllers\User\ParserController;
use App\Http\Controllers\User\ResearchController;
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
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::group(['prefix' => 'user', 'middleware'=> IsAuthUser::class], function () {
    Route::controller(ParserController::class)->group(function () {
        Route::get('/apartment', 'apartment');
        Route::post('/csv', 'getCsv');
        Route::post('/cleanDb', 'runCleanDb');
        Route::post('/addOlxApartment', 'addOlxApartment');
    });
    Route::controller(ResearchController::class)->group(function () {
        Route::post('url_edit', 'update');
    });
    Route::controller(MainController::class)->group(function (){
       Route::get('/dashboard', 'index');
    });
});
