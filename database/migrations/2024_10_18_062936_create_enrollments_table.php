<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Create table function
return new class extends Migration
{
    public function up() {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->enum('role', ['student', 'teacher']);
            $table->timestamps();
        });
    }

    // drop table if exists
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
