<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AlterDescriptionNullableOnSiteConfigsTable extends Migration
{
    public function up()
    {
        // Ganti `TEXT` sesuai tipe kolommu jika bukan TEXT
        DB::statement("ALTER TABLE site_configs MODIFY description TEXT NULL");
    }

    public function down()
    {
        // Jika sebelumnya NOT NULL, ubah kembali
        DB::statement("ALTER TABLE site_configs MODIFY description TEXT NOT NULL");
    }
}

