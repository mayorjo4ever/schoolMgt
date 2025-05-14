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
        Schema::create('users_attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('regno');
            $table->string('session');
            $table->tinyInteger('term');
            $table->unsignedInteger('level_id');
            $table->unsignedInteger('class_room_id');            
            $table->date('date'); 
            $table->boolean('is_present')->default(false);             
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_attendances');
    }
};
