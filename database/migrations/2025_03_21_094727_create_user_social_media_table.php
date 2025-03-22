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
        Schema::create('user_social_media', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('id unik');
            $table->uuid('user_id')->comment('link ke tabel user');
            $table->string('platform')->comment('Nama platform media sosial, contoh: Facebook, Twitter, Instagram');
            $table->string('url')->nullable()->comment('URL profil media sosial pengguna');
            $table->timestamps();

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
        Schema::dropIfExists('user_social_media');
    }
};
