<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration {
    public function up()
    {
        Schema::create('site_menus', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('UUID unik untuk setiap menu');
            $table->string('code')->unique()->comment('Kode unik untuk menu, misalnya "100, 100.001, 100.001.001" diinput manual');
            $table->string('name')->comment('Nama menu');
            $table->string('category')->nullable()->comment('Kategori menu, misal: Admin, User');
            $table->integer('level')->default(1)->comment('Level menu dalam hierarki');
            $table->enum('type', ['group', 'item'])->default('item')->comment('Tipe menu: group atau item');
            $table->uuid('group_id')->nullable()->comment('ID grup jika menu ini adalah bagian dari grup');
            $table->string('url')->nullable()->comment('URL atau rute yang terkait dengan menu');
            $table->text('description')->nullable()->comment('Deskripsi menu');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('site_menus');
    }
};
