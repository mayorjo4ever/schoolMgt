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
        Schema::create('users_registered_courses', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('regno');
            $table->string('session');
            $table->integer('level_id');
            $table->integer('class_room_id');
            $table->string('subject_ids');
            $table->integer('level_categ_id');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_registered_courses');
    }
};
