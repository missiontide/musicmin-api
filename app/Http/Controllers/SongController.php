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

    public function show($id)
    {
        return Song::find($id);
    }

    public function store(Request $request)
    {
        return Song::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $article = Song::findOrFail($id);
        $article->update($request->all());

        return $article;
    }

    public function delete(Request $request, $id)
    {
        $article = Song::findOrFail($id);
        $article->delete();

        return 204;
    }
}
