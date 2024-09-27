<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('cgpas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('s_id');           // Student ID (Foreign key to students table)
            $table->float('sem1', 3, 2)->nullable();      // CGPA for Semester 1
            $table->float('sem2', 3, 2)->nullable();      // CGPA for Semester 2
            $table->float('sem3', 3, 2)->nullable();      // CGPA for Semester 3
            $table->float('sem4', 3, 2)->nullable();      // CGPA for Semester 4
            $table->float('sem5', 3, 2)->nullable();      // CGPA for Semester 5
            $table->float('sem6', 3, 2)->nullable();      // CGPA for Semester 6
            $table->float('sem7', 3, 2)->nullable();      // CGPA for Semester 7
            $table->float('sem8', 3, 2)->nullable();      // CGPA for Semester 8
            $table->boolean('valid')->default(false);     // Valid status
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('cgpas');
    }
};
