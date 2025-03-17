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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->comment('User full name');
            $table->string('username')->unique()->comment('nama username');
            $table->string('email')->unique()->comment('User email');
            $table->timestamp('email_verified_at')->nullable()->comment('tgl verifikasi email');
            $table->string('password');
            $table->string('phone')->comment('nomor telp user 628575466521');
            $table->string('city')->nullable()->comment('kota pengguna');
            $table->string('region')->nullable()->comment('Wilayah pengguna / propinsi');
            $table->string('country')->default('indonesia')->nullable()->comment('negara pengguna');
            $table->text('profile_picture')->nullable()->comment('foto profil avatar yg sudah di optimasi berisi url gambaar upload/users/nama_avatar.png');
            $table->integer('followers')->default(0)->comment('Jumlah pengikut');
            $table->integer('following')->default(0)->comment('Jumlah yang diikuti');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
