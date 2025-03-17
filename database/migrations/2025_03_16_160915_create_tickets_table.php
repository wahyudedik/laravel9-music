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
        Schema::create('tickets', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('ID unik untuk setiap ticket');
            $table->string('ticket_code')->unique()->comment('kode unik tiket auto uppercase T-uniqueid ');
            $table->uuid('user_id')->comment('ID pengguna yang membuat tiket');
            $table->string('subject')->comment('Subjek tiket');
            $table->text('description')->comment('Deskripsi tiket');
            $table->enum('category', ['support','teknikal', 'billing', 'umum', 'lainnya'])->default('umum')->comment('Kategori tiket');
            $table->enum('status', ['open', 'progress', 'resolved', 'closed'])->default('open')->comment('Status tiket');
            $table->timestamps();

            // Foreign key ke tabel users
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
        Schema::dropIfExists('tickets');
    }
};
