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
        Schema::create('test_exam_marks', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('ca_1');
            $table->unsignedInteger('ca_2');
            $table->unsignedInteger('exam');            
            $table->string('applicable_to')->nullable();
            $table->string('session')->nullable();  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_exam_marks');
    }
};
