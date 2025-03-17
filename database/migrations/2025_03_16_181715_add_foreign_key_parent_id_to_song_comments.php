<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('song_comments', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('song_comments')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('song_comments', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
        });
    }
};
