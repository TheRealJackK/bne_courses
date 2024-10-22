<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Create table function
class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('s_number')->unique(); // Unique student/teacher number
            $table->string('password');
            $table->enum('user_type', ['student', 'teacher']); // User type (student/teacher)
            $table->rememberToken(); // This handles the `remember_token` column error you encountered
            $table->timestamps(); // created_at and updated_at
        });
    }

    // drop table if exists
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
