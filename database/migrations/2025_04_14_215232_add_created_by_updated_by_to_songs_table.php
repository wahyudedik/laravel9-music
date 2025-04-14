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
        Schema::table('songs', function (Blueprint $table) {
            // Kolom untuk menyimpan siapa yang membuat data
            $table->string('created_by')->nullable()->after('updated_at')->comment('Who created this song user_id');

            // Kolom untuk menyimpan siapa yang terakhir mengupdate data
            $table->string('updated_by')->nullable()->after('created_by')->comment('Who updated this song user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->dropColumn(['created_by', 'updated_by']);
        });
    }
};
