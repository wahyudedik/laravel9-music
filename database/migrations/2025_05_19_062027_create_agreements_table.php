<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgreementsTable extends Migration
{
    public function up()
    {
        Schema::create('agreements', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('UUID sebagai primary key');
            $table->string('name')->comment('Nama grup agreement');
            $table->enum('type', ['text', 'checklist'])->comment('Tipe isian: text atau checklist');
            $table->string('category')->nullable()->comment('Kategori agreement, misal: lisensi, distribusi, penggunaan');
            $table->boolean('is_active')->default(true)->comment('Status aktif/tidak untuk form');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('agreements');
    }
}


