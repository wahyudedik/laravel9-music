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
        Schema::create('withdraws', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('ID unik untuk setiap transaksi penarikan');
            $table->uuid('user_id')->comment('ID pengguna yang melakukan penarikan saldo');
            $table->decimal('amount', 10, 2)->comment('Jumlah saldo yang ditarik');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->comment('Status penarikan saldo');
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
        Schema::dropIfExists('withdraws');
    }
};
