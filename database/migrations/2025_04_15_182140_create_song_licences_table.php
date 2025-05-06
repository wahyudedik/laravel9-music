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
        Schema::create('song_licences', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('Primary key UUID untuk song licence');
            $table->uuid('song_id')->comment('Relasi ke tabel songs');

            $table->enum('license_type', ['Cover', 'Remake', 'Royalty'])->comment('Jenis lisensi: cover, official, atau royalty');
            $table->enum('amount_type', ['Price', 'Percentage'])->comment('Tipe jumlah: price (harga) atau percentage (persentase)');

            $table->unsignedBigInteger('local_amount')->nullable()->comment('Nilai lokal sesuai tipe amount_type, bisa price atau percentage');
            $table->unsignedBigInteger('global_amount')->nullable()->comment('Nilai global sesuai tipe amount_type, bisa price atau percentage');

            $table->text('licence_file')->nullable()->comment('Path file pdf dokumen lisensi (opsional)');

            $table->timestamps();

            // Foreign key ke tabel songs
            $table->foreign('song_id')->references('id')->on('songs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('song_licences');
    }
};
