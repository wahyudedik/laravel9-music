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
        Schema::create('albums', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('Unique ID  album');
            $table->uuid('artist_id')->comment('ID artis yang memiliki album tersebut');
            $table->string('title')->comment('Judul Album');
            $table->text('cover_image')->nullable()->comment('Gambar sampul album 3 ukuran lg,md,sm   mis upload/albums/nama_cover_kodeunik.png,upload/albums/nama_cover_kodeunik_md.png,upload/albums/nama_cover_kodeunik_sm.png ');
            $table->date('release_date')->nullable()->comment('Tanggal rilis album');
            $table->timestamps();

            // Foreign Key
            $table->foreign('artist_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('albums');
    }
};
