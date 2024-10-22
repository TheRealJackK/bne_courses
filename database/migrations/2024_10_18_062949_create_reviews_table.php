<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Create table function
return new class extends Migration
{

    public function up() {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_id')->constrained()->onDelete('cascade');
            $table->foreignId('reviewer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('reviewee_id')->constrained('users')->onDelete('cascade');
            $table->text('review_text');
            $table->integer('rating')->between(1, 5);
            $table->integer('score')->nullable();
            $table->timestamps();
        });
    }
    // drop table if exists
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
