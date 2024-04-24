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
        if (!Schema::hasTable('statuses')) {
        Schema::create('statuses', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name')->nullable(false);
            $table->integer('sort_sequence')->nullable(false)->unique;
            $table->timestamp('created_at')->nullable(false);
        });
        Schema::table('tasks', function (Blueprint $table) {
            $table->foreign('status_id')->references('id')->on('statuses');
        });
    }
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function(Blueprint $table){ 
            $table->dropForeign(['status_id']);
        });
        
        Schema::dropIfExists('statuses');
    }
};