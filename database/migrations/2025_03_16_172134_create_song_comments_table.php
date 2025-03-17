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
        Schema::create('song_comments', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('ID unik untuk setiap komentar');
            $table->uuid('song_id')->comment('Link ke tabel songs');
            $table->uuid('user_id')->comment('Link ke tabel users');
            $table->uuid('parent_id')->nullable()->index()->comment('Link ke komentar induk untuk balasan, null jika komentar utama');
            $table->integer('level')->default(1)->comment('Level komentar, digunakan untuk membatasi balasan hanya sampai level 2');
            $table->text('comment')->comment('Isi komentar');
            $table->timestamps();

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
        Schema::dropIfExists('song_comments');
    }
};
