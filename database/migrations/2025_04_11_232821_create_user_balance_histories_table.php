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
        Schema::create('user_balance_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Ini harus uuid juga!
            $table->uuid('user_id');

            $table->enum('type', ['deposit', 'withdraw'])->comment('Tipe transaksi');
            $table->decimal('amount', 15, 2)->comment('Jumlah saldo');
            $table->text('description')->nullable()->comment('Keterangan transaksi');
            $table->timestamps();

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
        Schema::dropIfExists('user_balance_histories');
    }
};
