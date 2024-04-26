<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('tasks')) {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable(false);
            $table->text('detail')->nullable(false);
            $table->dateTime('deadline')->nullable(false);
            $table->integer('priority_id')->nullable(false);
            $table->integer('status_id')->nullable(false);
            $table->timestamps();
        });
            // priority_id 列の外部キー制約
         Schema::table('tasks', function (Blueprint $table) {
            $table->foreign('priority_id')->references('id')->on('priorities')->onDelete('cascade');
        });
            // status_id 列の外部キー制約
        Schema::table('tasks', function (Blueprint $table) {
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
        });
    }
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function(Blueprint $table){ 
            $table->dropForeign(['priority_id']);
            $table->dropForeign(['status_id']);
        });

        Schema::dropIfExists('tasks');
    }
};
