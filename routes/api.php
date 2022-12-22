<?php

use App\Http\Controllers\SongController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('songs', [SongController::class, 'index']);
Route::get('songs/{song}', [SongController::class, 'show']);
Route::post('songs', [SongController::class, 'store']);
Route::put('songs/{song}', [SongController::class, 'update']);
Route::delete('songs/{song}', [SongController::class, 'delete']);
