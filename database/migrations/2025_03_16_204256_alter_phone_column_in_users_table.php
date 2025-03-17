<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Ubah kolom phone menjadi nullable dengan default null
        DB::statement('ALTER TABLE users MODIFY phone VARCHAR(255) NULL DEFAULT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Kembalikan kolom phone ke keadaan semula (tidak nullable dan tanpa default)
        DB::statement('ALTER TABLE users MODIFY phone VARCHAR(255) NOT NULL');
    }
};