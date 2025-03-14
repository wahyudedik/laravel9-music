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
        Schema::create('copyrights', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('song_id')->comment('link ke songs');
            $table->uuid('owner_id')->comment('link ke user');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->comment('status copyright');
            $table->text('document')->nullable()->comment('upload file dokumen jika ada isi mis upload/copyrights/nama_lagu_user_copyright_kodeunik.pdf');
            $table->timestamps();

            $table->foreign('song_id')->references('id')->on('songs')->onDelete('cascade');
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('copyrights');
    }
};
