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
        Schema::create('class_attendance_logs', function (Blueprint $table) {
            $table->id();
            $table->string('session');
            $table->tinyInteger('term');
            $table->unsignedInteger('level_id');
            $table->unsignedInteger('class_room_id');            
            $table->date('date'); 
            $table->unsignedBigInteger('taken_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_attendance_logs');
    }
};
