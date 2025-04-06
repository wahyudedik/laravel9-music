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
        // Buat tabel genres
        Schema::create('genres', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('Primary key berupa UUID untuk genre');
            $table->string('name')->comment('Nama genre');
            $table->text('description')->nullable()->comment('Deskripsi tambahan mengenai genre');
            $table->string('icon_color')->nullable()->comment('Warna ikon yang digunakan untuk menampilkan genre');
            $table->enum('status', ['active', 'pending', 'inactive'])->default('pending')->comment('Status genre: active = aktif, pending = menunggu, inactive = tidak aktif');
            $table->timestamps();
        });

        // Update tabel songs
        Schema::table('songs', function (Blueprint $table) {
            $table->dropColumn('genre'); // kolom lama genre (string)
            $table->uuid('genre_id')->nullable()->comment('Relasi ke genre, UUID dari tabel genres');
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Rollback tabel songs
        Schema::table('songs', function (Blueprint $table) {
            $table->dropForeign(['genre_id']);
            $table->dropColumn('genre_id');
            $table->string('genre')->nullable()->comment('Kolom genre lama');
        });

        // Hapus tabel genres
        Schema::dropIfExists('genres');
    }
};
