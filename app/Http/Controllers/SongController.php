<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return response(Song::all()); //->header('Access-Control-Allow-Origin', '*');
    }

    /**
     * @param Request $request must contain parameter songs -- a comma-delimited list of song ids
     * @return Response
     */
    public function lyrics(Request $request): Response
    {
        $songIds = explode(',', $request->songs);
        return response(Song::whereIn('id', $songIds)->get()); //->header('Access-Control-Allow-Origin', '*');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        return response();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id): Response
    {
        return response(Song::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, int $id): Response
    {
        return response();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        return response();
    }
}
