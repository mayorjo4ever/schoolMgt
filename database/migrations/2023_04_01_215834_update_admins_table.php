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
        /**Schema::table('admins', function($table){
            $table->string('surname')->after('name')->nullable();           
            $table->string('firstname')->after('surname')->nullable();           
            $table->string('othername')->after('firstname')->nullable();                       
            $table->date('appointment_date')->after('othername')->nullable();                       
          }); **/
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /**
         Schema::table('admins', function($table){       
         $table->dropColumn('surname');         
         $table->dropColumn('firstname');         
         $table->dropColumn('othername');         
         $table->dropColumn('appointment_date');         
       });**/
    }
};
