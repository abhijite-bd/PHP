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
        $table->string('s_id');
        
        $table->double('l1s1');
        $table->double('l1s2');
        $table->double('l2s1');
        $table->double('l2s2');

        $table->double('l3s1');
        $table->double('l3s2');
        $table->double('l4s1');
        $table->double('l4s2');
        
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cgpa');
    }
};
