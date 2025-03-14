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
        Schema::create('bookings', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('ID unik untuk setiap booking');
            $table->uuid('user_id')->comment('ID pengguna yang melakukan booking');
            $table->uuid('song_id')->nullable()->comment('ID lagu yang dipesan (jika applicable)');
            $table->uuid('artist_id')->comment('ID artist/composer yang dibooking');
            $table->enum('type', ['studio_session', 'song_request', 'other'])->default('song_request')->comment('Jenis booking');
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending')->comment('Status booking');
            $table->timestamp('scheduled_at')->comment('Jadwal booking');
            $table->timestamps();

            // Foreign Keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('song_id')->references('id')->on('songs')->onDelete('set null');
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
        Schema::dropIfExists('bookings');
    }
};
