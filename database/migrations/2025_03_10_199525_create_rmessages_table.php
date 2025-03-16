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
        Schema::create('messages', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('ID unik untuk setiap pesan');
            $table->uuid('sender_id')->comment('ID pengguna yang mengirim pesan');
            $table->uuid('receiver_id')->comment('ID pengguna yang menerima pesan');
            $table->text('content')->comment('Isi pesan');
            $table->enum('status', ['unread', 'read'])->default('unread')->comment('Status pesan');
            $table->timestamps(); // Menyediakan created_at & updated_at otomatis

            // Foreign Keys
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
};
