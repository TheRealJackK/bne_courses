<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Create table function
return new class extends Migration
{
    public function up() {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }
    // drop table if exists
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
