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
        Schema::table('permissions', function($table){       
            $table->enum('category',['admins','payments','roles','students','subjects','settings'])->after('name')->nullable(); 
          });   
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::table('permissions', function($table){
            $table->dropColumn('category');
         });
    }
};
