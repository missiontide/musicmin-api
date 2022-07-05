<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


$songController = 'App\Http\Controllers\SongController';
Route::get('songs', $songController . '@index');
Route::get('songs/{id}', $songController . '@show');
Route::post('songs', $songController . '@store');
Route::put('songs/{id}', $songController . '@update');
Route::delete('songs/{id}', $songController . '@delete');
