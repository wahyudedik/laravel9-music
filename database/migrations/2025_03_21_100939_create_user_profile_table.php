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
        Schema::create('user_profile', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('Primary key sebagai UUID');
            $table->uuid('user_id')->comment('Link ke tabel users');
            $table->enum('gender', ['male', 'female'])->nullable()->comment('Jenis kelamin pengguna');
            $table->date('birthdate')->nullable()->comment('Tanggal lahir pengguna');
            $table->text('address')->nullable()->comment('Alamat pengguna');
            $table->text('bio')->nullable()->comment('Deskripsi singkat tentang pengguna');
            $table->string('background_image')->nullable()->comment('URL gambar latar belakang profil pengguna');
            $table->timestamps();

            // Foreign key constraint
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
        Schema::dropIfExists('user_profile');
    }
};
