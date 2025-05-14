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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('regno')->nullable();
            $table->string('password');
            $table->string('surname');
            $table->string('firstname');
            $table->string('othername')->nullable();
            $table->date('dob')->nullable();
            $table->enum('gender', ['male','female']);
            $table->string('blood_group', 5)->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('lga_id')->nullable();
            $table->text('residence')->nullable();
            $table->string('session_of_entry', 10)->nullable();
            $table->integer('entry_level_id')->nullable();
            $table->integer('entry_term_id')->nullable();
            $table->integer('current_level_id')->nullable();
            $table->integer('current_classroom_id')->nullable();
            $table->bigInteger('parent_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

