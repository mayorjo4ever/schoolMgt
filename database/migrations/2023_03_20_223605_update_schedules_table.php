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
      Schema::table('schedules', function($table){
            $table->integer('max_qtn')->after('paper_type');             
          });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedules', function($table){       
         $table->dropColumn('max_qtn');         
       });
        // 
    }
};
