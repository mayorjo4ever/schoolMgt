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
        Schema::table('users_schedules', function (Blueprint $table) {
            $table->timestamp('started_at')->nullable()->after('paper_status');
            $table->timestamp('ends_at')->nullable()->after('started_at');
            $table->timestamp('submitted_at')->nullable()->after('ends_at');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_sessions');
    }
};
