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
        Schema::create('verifications', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('ID unik untuk setiap verifikasi akun');
            $table->uuid('user_id')->comment('ID pengguna yang mengajukan verifikasi');
            $table->enum('type', ['composer', 'artist', 'cover'])->comment('Tipe verifikasi: composer, artist, cover creator');
            $table->text('document_ktp')->comment('Path dokumen KTP');
            $table->text('document_npwp')->nullable()->comment('Path dokumen NPWP (opsional)');
            $table->enum('status', ['pending', 'approved', 'rejected', 'suspended'])->default('pending')->comment('Status verifikasi: pending, approved, rejected, suspended ');
            $table->timestamps(); // created_at & updated_at

            // Foreign Key
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
        Schema::dropIfExists('verifications');
    }
};
