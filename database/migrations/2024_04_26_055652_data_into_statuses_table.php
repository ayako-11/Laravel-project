<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class DataIntoStatusesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // データ挿入
        DB::table('statuses')->insert([
            ['id' => 10, 'name' => 'new', 'sort_sequence' => 10, 'created_at' => now()],
            ['id' => 20, 'name' => 'in_progress', 'sort_sequence' => 20, 'created_at' => now()],
            ['id' => 30, 'name' => 'completed', 'sort_sequence' => 30, 'created_at' => now()],
            ['id' => 40, 'name' => 'cancelled', 'sort_sequence' => 40, 'created_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    
    {
            // データ削除
        DB::table('statuses')->where('id', 10)->delete();
        DB::table('statuses')->where('id', 20)->delete();
        DB::table('statuses')->where('id', 30)->delete();
        DB::table('statuses')->where('id', 40)->delete();
     }
    
}
