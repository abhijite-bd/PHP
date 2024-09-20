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
        Schema::create('courses_schedule', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('course_code'); // Course code
            $table->date('date'); // Date
            $table->string('day'); // Day
            $table->time('time'); // Time
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses_schedule');
    }
};
