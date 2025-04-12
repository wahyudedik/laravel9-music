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
        Schema::create('playlist_song', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('Primary UUID for this pivot entry');

            $table->uuid('playlist_id')->comment('Foreign key from user_playlists');
            $table->uuid('song_id')->comment('Foreign key from songs');

            $table->timestamps();

            $table->foreign('playlist_id')->references('id')->on('user_playlists')->onDelete('cascade');
            $table->foreign('song_id')->references('id')->on('songs')->onDelete('cascade');

            $table->unique(['playlist_id', 'song_id'], 'playlist_song_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('playlist_song');
    }
};
