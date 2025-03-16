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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('ID unik untuk setiap transaksi');
            $table->uuid('user_id')->comment('ID pengguna yang melakukan transaksi');
            $table->uuid('order_id')->comment('ID pesanan yang dibayar');
            $table->enum('type', ['purchase', 'license'])->comment('Jenis transaksi: purchase (pembelian), license (lisensi)');
            $table->decimal('amount', 10, 2)->comment('Jumlah pembayaran transaksi');
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending')->comment('Status transaksi');
            $table->timestamps(); // created_at & updated_at

            // Foreign Key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
