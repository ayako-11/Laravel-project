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
        Schema::create('todo_database', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable(false);
            $table->text('detail')->nullable(false);
            $table->dateTime('deadline')->nullable(false);
            $table->integer('priority')->nullable(false);
            $table->integer('status')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todo_database');
    }
};
