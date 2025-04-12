<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->enum('status', ['Active', 'Inactive', 'Pending','Draft', 'Published', 'Scheduled'])
                ->default('draft')
                ->after('duration')
                ->comment('Status lagu: Draft, Published, Scheduled, Actove , Inactive ,Pending');
        });
    }

    public function down()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
