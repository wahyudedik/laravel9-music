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
        Schema::table('messages', function (Blueprint $table) {
            // Add new columns
            $table->uuid('conversation_id')->after('id')->nullable()->comment('link ke tabel conversation');
            $table->timestamp('edited_at')->nullable()->after('status')->comment('Waktu pesan diedit');
            $table->boolean('is_deleted')->default(false)->after('status')->comment('Tandai jika pesan dihapus');

            // Remove receiver_id (handled by conversation now)
            $table->dropForeign(['receiver_id']);
            $table->dropColumn('receiver_id');

            // Add foreign key for conversation
            $table->foreign('conversation_id')->references('id')->on('conversations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            // Reverse changes
            $table->dropForeign(['conversation_id']);
            $table->dropColumn(['conversation_id', 'edited_at', 'is_deleted']);
            $table->uuid('receiver_id')->after('sender_id')->comment('ID pengguna yang menerima pesan');

            // Restore foreign key
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
