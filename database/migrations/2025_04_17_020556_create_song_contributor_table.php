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
        Schema::create('song_contributor', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('Primary UUID for song_contributor record');
            $table->uuid('song_id')->comment('UUID of the song from songs table');
            $table->uuid('user_id')->comment('UUID of the user as contributor');
            $table->string('role')->comment('Contributor role (composer, arranger, vocal, etc)');
            $table->string('description')->comment('Description : Song Creator');
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('song_id')->references('id')->on('songs')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('song_contributor');
    }
};
