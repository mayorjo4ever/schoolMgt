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
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->string('surname');
            $table->string('firstname');
            $table->string('othername')->nullable();
            $table->enum('gender', ['male','female']);            
            $table->string('blood_group', 5)->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('lga_id')->nullable();
            $table->text('residence')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parents');
    }
};
