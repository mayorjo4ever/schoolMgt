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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('regno')->nullable();
            $table->string('title',30)->nullable();           
            $table->string('surname');           
            $table->string('firstname');           
            $table->string('othername')->nullable();                       
            $table->date('appointment_date')->nullable();                  
            $table->string('mobile');
            $table->string('email')->unique();
            $table->tinyInteger('status')->default(1);
            $table->string('image')->nullable();
            $table->string('password');
            $table->enum('confirm',['yes','no'])->default('no');
           $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
