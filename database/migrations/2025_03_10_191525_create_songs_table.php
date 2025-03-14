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
        Schema::create('songs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title')->comment('judul lagu');
            $table->string('version')->default('original')->comment('Versi lagu (misalnya: Reggae, Acoustic, EDM, Jazz, Cover, Live, Remix, dll.)');
            $table->uuid('album_id')->nullable()->comment('ID Album tempat lagu tersebut berada');
            $table->uuid('composer_id')->comment('link user role composer');
            $table->uuid('artist_id')->nullable()->comment('link user role artist');
            $table->uuid('cover_creator_id')->nullable()->comment('link user role cover creator');
            $table->string('cover_version')->nullable()->comment('versi cover misal dari Original Artist: Ed Sheeran');
            $table->enum('license_status', ['pending', 'approved', 'rejected'])->default('pending')->comment('status lisensi lagu');
            $table->date('release_date')->nullable()->comment('tanggal release lagu');
            $table->integer('play_count')->default(0)->comment('jumlah dimainkan');
            $table->integer('like_count')->default(0)->comment('jumlah di sukai');
            $table->text('cover_image')->nullable()->comment('link upload file gambar jadi 3 file image cover utk large,medium.small mis upload/songs/nama_cover_kodeunik.png,upload/songs/nama_cover_kodeunik_md.png,upload/songs/nama_cover_kodeunik_sm.png ');
            $table->text('file_path')->nullable()->comment('link atau path file MP3 misal upload/songs/audio_kodeunik.mp3');
            $table->integer('duration')->nullable()->comment('durasi lagu dalam detik');

            $table->timestamps();

            $table->foreign('composer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('artist_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('cover_creator_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('songs');
    }
};
