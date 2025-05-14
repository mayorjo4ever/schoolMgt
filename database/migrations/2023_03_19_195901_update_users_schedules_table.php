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
        Schema::table('users_schedules', function($table){
            $table->float('score')->after('paper_status')->nullable();           
            $table->float('max_score')->after('score')->nullable();           
          });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('users_schedules', function($table){       
         $table->dropColumn('score');         
         $table->dropColumn('max_score');         
       });
    }
};
