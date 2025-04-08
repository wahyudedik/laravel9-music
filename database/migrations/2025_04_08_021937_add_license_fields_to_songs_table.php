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
            $table->enum('license_type', ['Full License', 'Royalty', 'Free'])->default('Free')->after('license_status')->comment('Tipe lisensi lagu');
            $table->decimal('license_price', 10, 2)->nullable()->after('license_type')->comment('Harga lisensi lagu');
            $table->text('license_file')->nullable()->after('license_price')->comment('Path file lisensi');
            $table->boolean('allow_cover_version')->default(false)->after('license_file')->comment('Apakah mengizinkan versi cover');
            $table->boolean('allow_commercial_use')->default(false)->after('allow_cover_version')->comment('Apakah mengizinkan penggunaan komersial');
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
            $table->dropColumn([
                'license_type',
                'license_price',
                'license_file',
                'allow_cover_version',
                'allow_commercial_use',
            ]);
        });
    }
};
