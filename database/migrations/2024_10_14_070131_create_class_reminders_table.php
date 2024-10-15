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
        Schema::create('class_reminders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->integer('reminder_time'); // Time in minutes before class
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('class_reminders');
    }
};
