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
        Schema::table('users', function (Blueprint $table) {
            $table->string('appno')->after('name')->nullable();
            $table->string('regno')->after('appno')->nullable();
            $table->string('surname')->after('regno')->nullable();
            $table->string('firstname')->after('surname')->nullable();
            $table->string('othername')->after('firstname')->nullable();
            $table->date('dob')->after('othername')->nullable();
            $table->string('session_of_entry')->after('dob')->nullable();
            $table->integer('term_of_entry')->after('session_of_entry')->nullable();
            $table->integer('level_admitted')->after('term_of_entry')->nullable();
            $table->integer('class_room_admitted')->after('level_admitted')->nullable();
            $table->integer('level_category_admitted')->after('class_room_admitted')->nullable();
            $table->integer('current_level_id')->after('level_category_admitted')->nullable();
            $table->integer('current_class_room_id')->after('current_level_id')->nullable();
            $table->integer('current_level_category_id')->after('current_class_room_id')->nullable();           
            $table->dateTime('date_admitted')->after('current_level_category_id')->nullable();            
            $table->integer('recorded_by')->after('date_admitted')->nullable();
            $table->dateTime('recorded_date')->after('recorded_by')->nullable();           
            $table->enum('program_status',['process','completed'])->after('recorded_date')->default('process');
            $table->dateTime('program_date_completion')->after('program_status')->nullable();            
            $table->integer('country_id')->after('othername')->nullable();           
            $table->integer('state_id')->after('country_id')->nullable();           
            $table->integer('city_id')->after('state_id')->nullable();           
            $table->text('residence')->after('city_id')->nullable();           
            $table->string('mobile')->after('email')->nullable();           
            $table->enum('gender',['male','female'])->after('othername')->nullable();           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('appno');
            $table->dropColumn('regno');
            $table->dropColumn('surname');
            $table->dropColumn('firstname');
            $table->dropColumn('othername');
            $table->dropColumn('dob');
            $table->dropColumn('session_of_entry');
            $table->dropColumn('term_of_entry');
            $table->dropColumn('level_admitted');
            $table->dropColumn('class_room_admitted');
            $table->dropColumn('level_category_admitted');
            $table->dropColumn('current_level_id');
            $table->dropColumn('current_class_room_id');
            $table->dropColumn('current_level_category_id');
            $table->dropColumn('date_admitted');
            $table->dropColumn('recorded_by');
            $table->dropColumn('recorded_date');
            $table->dropColumn('program_status');
            $table->dropColumn('program_date_completion');
            $table->dropColumn('country_id');
            $table->dropColumn('state_id');
            $table->dropColumn('city_id');
            $table->dropColumn('residence');     
            $table->dropColumn('mobile');     
            $table->dropColumn('gender');     
        });
    }
};
