<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        DB::statement('ALTER TABLE activity_log MODIFY COLUMN causer_id CHAR(36) NULL');
    }

    public function down()
    {
        // DB::statement('ALTER TABLE activity_log MODIFY COLUMN causer_id BIGINT UNSIGNED NULL');
    }
};
