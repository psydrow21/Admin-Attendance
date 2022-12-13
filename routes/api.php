<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('store', [AdminController::class, 'cloudsamples'])->name('store');


Route::get('trigger',[AdminController::class, 'trigger'])->name('trigger');

Route::get('index', 'GuzzlePostController@index');

// Http::post('/http://127.0.0.1:8000/userstocloud');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
