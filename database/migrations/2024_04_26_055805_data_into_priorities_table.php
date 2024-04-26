<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class DataIntoPrioritiesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Insert data into priorities table
        DB::table('priorities')->insert([
            ['id' => 10, 'name' => 'urgent', 'sort_sequence' => 10, 'created_at' => now()],
            ['id' => 20, 'name' => 'high', 'sort_sequence' => 20, 'created_at' => now()],
            ['id' => 30, 'name' => 'low', 'sort_sequence' => 30, 'created_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to revert the data insertion
    }
}



