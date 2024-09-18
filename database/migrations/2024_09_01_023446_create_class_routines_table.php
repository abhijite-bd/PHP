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
        Schema::create('class_routines', function (Blueprint $table) {
            $table->id();         
            $table->string('degree');   
            $table->string('level');            
            $table->string('semester');
            $table->string('session');
            $table->enum('weekday', ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday']);
            $table->string('time_slot');
            $table->string('class_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_routines');
    }
};
