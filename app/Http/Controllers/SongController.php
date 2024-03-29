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
                'songs.id',
                'title',
                'artist',
                'slug',
                'tempo',
                'key',
                DB::raw(
                    "(CASE WHEN (chords = '') IS NOT FALSE THEN false" // chords is either NULL or empty
                    . ' ELSE true END) as "has_chords"'
                ),
                DB::raw("json_agg(song_tag.tag_id) AS tag_ids")
            ])->join('song_tag', function ($join){
                $join->on('songs.id', '=', 'song_tag.song_id')
                    ->orderBy('tag_id');
            })->groupBy('songs.id')->get()
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
     * @param Request $request must contain parameter songs -- a comma-delimited list of song ids
     * @return Response
     */
    public function chords(Request $request): Response
    {
        $songIds = explode(',', $request->songs);
        $songQuery = Song::select(['id', 'title', 'artist', 'key', 'chords'])->whereIn('id', $songIds);
        $songs = $songQuery->get();

        // track how many times a song was used in chord sheets
        foreach ($songs as $song) {
            $song->increment('times_used_chords');
        }

        // need to re-run the query, because incrementing adds all the other columns
        return response($songQuery->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return Response
     */
    public function show(string $slug): Response
    {
        return response(Song::where(['slug' => $slug])->firstOrFail());
    }
}
