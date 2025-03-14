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
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('ID unik untuk setiap notifikasi');
            $table->uuid('user_id')->comment('ID pengguna yang menerima notifikasi');
            $table->enum('type', ['claim', 'purchase', 'booking', 'message', 'other'])->comment('Jenis notifikasi');
            $table->json('data')->comment('Data tambahan dalam format JSON mis {"message": "Pembelian berhasil", "amount": 50000, "order_id": "ORD12345"}');
            $table->timestamp('read_at')->nullable()->comment('Waktu ketika notifikasi dibaca');
            $table->timestamps(); // Menyediakan created_at & updated_at otomatis

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
        Schema::dropIfExists('notifications');
    }
};
