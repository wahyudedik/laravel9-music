<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgreementItemsTable extends Migration
{
    public function up()
    {
        Schema::create('agreement_items', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('UUID item');
            $table->foreignUuid('agreement_id')
                  ->constrained('agreements')
                  ->onDelete('cascade')
                  ->comment('Relasi ke grup agreement');

            $table->text('content')->comment('Isi pernyataan atau pertanyaan agreement');
            $table->boolean('is_required')->default(true)->comment('Wajib diisi/dicentang');
            $table->integer('sort_order')->default(0)->comment('Urutan tampil dalam form');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('agreement_items');
    }
}
