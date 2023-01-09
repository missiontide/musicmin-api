<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable();
        });

        // back-fill slugs: title-artist-chords
        foreach (\App\Models\Song::all() as $song) {
            $song->slug = \Illuminate\Support\Str::slug($song->title . ' ' . $song->artist . ' chords', '-');
            $song->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
