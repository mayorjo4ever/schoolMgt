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
        Schema::create('users_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('regno');
            $table->string('session');
            $table->tinyInteger('term');
            $table->unsignedInteger('subject_id');
            $table->unsignedInteger('level_id');
            $table->unsignedInteger('class_room_id');
            $table->unsignedInteger('ca_1');
            $table->unsignedInteger('ca_1_max');
            $table->unsignedInteger('ca_2');
            $table->unsignedInteger('ca_2_max');
            $table->unsignedInteger('exam');
            $table->unsignedInteger('exam_max');
            $table->unsignedBigInteger('upload_by');
            $table->boolean('published')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_results');
    }
};
