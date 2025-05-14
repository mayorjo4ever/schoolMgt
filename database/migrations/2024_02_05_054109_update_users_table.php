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
        Schema::table('users', function($table){
            $table->string('pix')->after('gender')->nullable();             
            $table->string('blood_group')->after('pix')->nullable();             
          });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('users', function($table){       
         $table->dropColumn('pix')->nullable();         
         $table->dropColumn('blood_group')->nullable();         
       });
    }
};
