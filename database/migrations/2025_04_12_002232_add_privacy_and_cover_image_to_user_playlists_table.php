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
        Schema::table('user_playlists', function (Blueprint $table) {
            $table->enum('privacy', ['Private', 'Public', 'Friends Only'])
                  ->default('Private')
                  ->after('name')
                  ->comment('Playlist visibility setting');

            $table->string('cover_image')->nullable()
                  ->after('privacy')
                  ->comment('Optional cover image path for the playlist');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_playlists', function (Blueprint $table) {
            $table->dropColumn(['privacy', 'cover_image']);
        });
    }
};
