<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::table('cgpa', function (Blueprint $table) {
            $table->integer('valid')->default(1);
        });
    }

    public function down(): void
    {
        Schema::table('cgpa', function (Blueprint $table) {
            $table->dropColumn('valid');
        });
    }
};
