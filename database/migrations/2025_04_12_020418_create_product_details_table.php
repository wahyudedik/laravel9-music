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
        Schema::create('product_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('product_id');

            $table->uuid('song_id')->nullable()->comment('link ke song produk untuk lisensi lagu'); // Untuk lisensi lagu
            $table->enum('license_type', ['cover', 'commercial', 'royalty'])->nullable()->comment('jenis produk detil untuk lisensi lagu');

            $table->text('file')->nullable()->comment('untuk produk digital seperti kaos, sticker, disc, asesories dll'); // Untuk digital product

            $table->uuid('artist_id')->nullable()->comment('link ke user artis untuk produk booking'); // Untuk booking artis
            $table->dateTime('available_start')->nullable()->comment('untuk produk booking');
            $table->dateTime('available_end')->nullable()->comment('untuk produk booking');

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_details');
    }
};
