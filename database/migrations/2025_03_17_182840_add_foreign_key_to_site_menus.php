<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('site_menus', function (Blueprint $table) {
            $table->foreign('group_id')
                  ->references('id')
                  ->on('site_menus')
                  ->onDelete('cascade')
                  ->comment('Foreign key untuk relasi grup');
        });
    }

    public function down()
    {
        Schema::table('site_menus', function (Blueprint $table) {
            $table->dropForeign(['group_id']);
        });
    }
};
