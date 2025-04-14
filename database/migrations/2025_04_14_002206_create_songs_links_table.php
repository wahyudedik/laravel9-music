<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//ganti jadi song_links
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs_links', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('song_id');
            $table->string('platform');
            $table->string('link')->nullable();
            $table->timestamps();

            // foreign key ke songs table
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
        Schema::dropIfExists('songs_links');
    }
};
