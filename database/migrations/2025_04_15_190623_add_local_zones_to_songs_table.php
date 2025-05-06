<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->text('local_zones')->nullable()->after('license_file')->comment('Daftar zona lokal dipisahkan koma, contoh: Jakarta,Cirebon,Indramayu');
        });
    }

    public function down(): void
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->dropColumn('local_zones');
        });
    }
};
