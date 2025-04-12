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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('number')->unique()->comment('kode produk unik bisa MSC-134-3443');
            $table->string('name')->unique()->comment('nama produk unik bisa MSC-134-3443');
            $table->text('description')->nullable();
            $table->enum('type', ['license', 'physical', 'digital', 'service', 'others'])->comment('Jenis produk yang dijual : jual lisensi, jual fisik, jual digital, jual layanan, dll ');
            $table->decimal('price', 15, 2)->default(0);
            $table->text('picture')->nullable()->comment('gambar produk 3 size lg,md,sm');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
