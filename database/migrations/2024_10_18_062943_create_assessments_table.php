<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Create table function
class CreateAssessmentsTable extends Migration
{
    public function up()
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade'); // Foreign key to courses
            $table->string('title'); // Assessment title
            $table->text('instruction'); // Assessment instruction
            $table->integer('num_reviews_required'); // Number of reviews required
            $table->integer('max_score'); // Max score
            $table->dateTime('due_date'); // Due date
            $table->enum('type', ['student-select', 'teacher-assign']); // Peer review type
            $table->timestamps(); // created_at and updated_at
        });
    }
    // drop table if exists
    public function down()
    {
        Schema::dropIfExists('assessments');
    }
}
