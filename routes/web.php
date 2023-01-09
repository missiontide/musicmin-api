<?php

use App\Http\Controllers\SongController;
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['cors']], function () {
    Route::get('songs', [SongController::class, 'index']);
    Route::get('lyrics', [SongController::class, 'lyrics']);
    Route::get('songs/{slug}', [SongController::class, 'show']);

    Route::get('request', [EmailController::class, 'sendSongRequestEmail']);
});

