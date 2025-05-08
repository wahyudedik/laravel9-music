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
        Schema::create('admin_tasks', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('Primary UUID key for the task');
            $table->string('category')->comment('Category of the task : Song Purchase, Booking Artist, Other ');
            $table->string('task_type')->comment('Type of task : Register Publisher , Other ');
            $table->string('task_title')->comment('Title of task');
            $table->uuid('song_id')->nullable()->comment('Related song ID (nullable)');
            $table->uuid('person_in_charge')->nullable()->comment('User ID of the person in charge');
            $table->uuid('assign_from')->nullable()->comment('User ID from who assign in');
            $table->text('description')->nullable()->comment('Detailed description of the task');
            $table->enum('status', ['active', 'progress', 'done', 'canceled'])->default('active')->comment('Current status of the task');
            $table->timestamps();

            // Foreign keys
            $table->foreign('song_id')->references('id')->on('songs')->onDelete('set null');
            $table->foreign('person_in_charge')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('assign_from')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_tasks');
    }
};
