<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('user_banks', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('Primary key sebagai UUID');
            $table->uuid('user_id')->comment('Link ke tabel users');
            $table->string('bank_name')->comment('Nama bank, misalnya BCA, Mandiri, BRI, dll.');
            $table->string('account_name')->comment('Nama pemilik rekening sesuai yang terdaftar di bank');
            $table->string('account_number')->unique()->comment('Nomor rekening pengguna yang unik');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_banks');
    }
};
