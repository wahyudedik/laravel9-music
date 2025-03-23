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
        Schema::create('user_documents', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('Primary key sebagai UUID');
            $table->uuid('user_id')->comment('Link ke tabel users');
            $table->string('document_type',100)->comment('Jenis dokumen, misalnya KTP, NPWP, Hak Cipta, dll.');
            $table->string('document_file_type',10)->comment('Jenis file dokumen, misalnya Image, Pdf , Doc , Xls, dll.');
            $table->text('document_file')->nullable()->comment('Path lokasi file dokumen yang diunggah');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_documents');
    }
};
