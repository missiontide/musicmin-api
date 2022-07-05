<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    public function index()
    {
        return Song::all();
    }

    public function show(Song $song)
    {
        return $song;
    }

    public function store(Request $request)
    {
        $song = Song::create($request->all());

        return response()->json($song, 201);
    }

    public function update(Request $request, Song $song)
    {
        $song->update($request->all());

        return response()->json($song, 200);
    }

    public function delete(Request $request, Song $song)
    {
        $song->delete();

        return response()->json(null, 204);
    }
}
