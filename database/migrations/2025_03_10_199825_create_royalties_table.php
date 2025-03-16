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
        Schema::create('royalties', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('song_id')->comment('link ke song');
            $table->uuid('user_id')->comment('link ke user');
            $table->decimal('amount', 10, 2)->comment('nilai royalti');
            $table->enum('status', ['pending', 'paid'])->default('pending')->comment('status pembayaran royalti');
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
        Schema::dropIfExists('royalties');
    }
};
