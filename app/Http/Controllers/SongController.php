<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return response(
            Song::select([
                'id',
                'title',
                'artist',
                'slug',
                DB::raw(
                    "(CASE WHEN (chords = '') IS NOT FALSE THEN false" // chords is either NULL or empty
                    . ' ELSE true END) as "has_chords"'
                ),
            ])->get()
        );
    }

    /**
     * @param Request $request must contain parameter songs -- a comma-delimited list of song ids
     * @return Response
     */
    public function lyrics(Request $request): Response
    {
        $songIds = explode(',', $request->songs);
        $songQuery = Song::select(['id', 'title', 'artist', 'lyrics'])->whereIn('id', $songIds);
        $songs = $songQuery->get();

        // track how many times a song was used in a powerpoint
        foreach ($songs as $song) {
            $song->increment('times_used');
        }

        // need to re-run the query, because incrementing adds all the other columns
        return response($songQuery->get());
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
}
