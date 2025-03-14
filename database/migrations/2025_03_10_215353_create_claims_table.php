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
        Schema::create('claims', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('ID unik untuk setiap klaim hak cipta');
            $table->uuid('user_id')->comment('ID pengguna yang mengajukan klaim hak cipta');
            $table->uuid('song_id')->comment('ID lagu yang diklaim hak ciptanya');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->comment('Status klaim: pending, approved, rejected');
            $table->text('document')->nullable()->comment('Path dokumen klaim hak cipta');
            $table->timestamps(); // created_at & updated_at

            // Foreign Key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('claims');
    }
};
