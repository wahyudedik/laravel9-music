<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongAgreementResponsesTable extends Migration
{
    public function up()
    {
        Schema::create('song_agreement_responses', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('UUID response');

            $table->foreignUuid('song_id')
                  ->constrained('songs')
                  ->onDelete('cascade')
                  ->comment('Relasi ke lagu');

            $table->foreignUuid('agreement_item_id')
                  ->constrained('agreement_items')
                  ->onDelete('cascade')
                  ->comment('Relasi ke item pernyataan');

            $table->text('accepted')->nullable()->comment('Jawaban user: teks (jika text) atau 1/null (jika checklist)');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('song_agreement_responses');
    }
}

