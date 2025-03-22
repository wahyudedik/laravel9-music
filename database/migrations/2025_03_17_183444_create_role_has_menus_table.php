<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('role_has_menus', function (Blueprint $table) {
            $table->id()->comment('Primary key tabel');
            $table->unsignedBigInteger('role_id')->comment('link ke table roles');
            $table->uuid('menu_id')->comment('link ke table site_menus');
            $table->boolean('is_active')->default(1)->comment('Status aktif menu untuk role, 1 = aktif, 0 = non-aktif');
            $table->timestamps();

            // Foreign key untuk role dan menu
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('menu_id')->references('id')->on('site_menus')->onDelete('cascade');

            // Menambahkan unique agar tidak ada duplikat role-menu
            $table->unique(['role_id', 'menu_id'], 'unique_role_menu');
        });
    }

    public function down()
    {
        Schema::dropIfExists('role_has_menus');
    }
};
