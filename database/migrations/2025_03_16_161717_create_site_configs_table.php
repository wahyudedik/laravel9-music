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
        Schema::create('site_configs', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('ID unik untuk setiap konfigurasi');
            $table->string('key')->unique()->comment('key unik untuk nama konfigurasi');
            $table->text('value')->nullable()->comment('nilai konfigurasi');
            $table->longText('description')->comment('keterangan untuk  konfigurasi');
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
        Schema::dropIfExists('site_configs');
    }
};
