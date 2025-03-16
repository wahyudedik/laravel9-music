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
        Schema::create('streams', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('ID unik untuk setiap stream');
            $table->uuid('user_id')->comment('link ke user ID pengguna yang memutar lagu (nullable untuk guest user)');
            $table->uuid('song_id')->comment('link ke songs ID lagu yang sedang diputar');
            $table->timestamp('played_at')->useCurrent()->comment(' Waktu ketika lagu diputar');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('song_id')->references('id')->on('songs')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('streams');
    }
};
