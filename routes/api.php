<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Song;

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

Route::get('songs', function() {
    // If the Content-Type and Accept headers are set to 'application/json',
    // this will return a JSON structure. This will be cleaned up later.
    return Song::all();
});

Route::get('songs/{id}', function($id) {
    return Song::find($id);
});

Route::post('songs', function(Request $request) {
    return Song::create($request->all);
});

Route::put('songs/{id}', function(Request $request, $id) {
    $article = Song::findOrFail($id);
    $article->update($request->all());

    return $article;
});

Route::delete('songs/{id}', function($id) {
    Song::find($id)->delete();

    return 204;
});
