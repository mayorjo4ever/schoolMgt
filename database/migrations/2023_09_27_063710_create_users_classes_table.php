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
        Schema::create('users_classes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('regno');
            $table->integer('level_id');          
            $table->integer('class_room_id');          
            $table->string('session'); 
            $table->enum('class_status', ['normal','repeat','promote','depromote'])->default('normal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_classes');
    }
};
