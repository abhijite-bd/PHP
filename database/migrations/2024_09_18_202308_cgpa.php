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
        Schema::create('cgpa', function (Blueprint $table) {
            $table->id();
            $table->string('s_id'); // Adjust the data type if needed
    
            // CGPA values for each level and semester, nullable if necessary
            $table->double('l1s1')->nullable();
            $table->double('l1s2')->nullable();
            $table->double('l2s1')->nullable();
            $table->double('l2s2')->nullable();
            $table->double('l3s1')->nullable();
            $table->double('l3s2')->nullable();
            $table->double('l4s1')->nullable();
            $table->double('l4s2')->nullable();
    
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('cgpa');
    }
};
