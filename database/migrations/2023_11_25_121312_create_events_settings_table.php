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
        Schema::create('events_settings', function (Blueprint $table) {
            $table->id();
            $table->string('event_type'); # eg : course-registration, school-fees-payment, holiday
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date');
            $table->string('applicable_to')->default(0); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events_settings');
    }
};
