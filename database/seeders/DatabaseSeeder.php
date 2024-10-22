<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    //Seed the application's database.
    public function run(): void
    {
        $this->call(UserSeeder::class);
        // Seed courses
        $this->call(CourseSeeder::class);
        // Seed assessments
        $this->call(AssessmentSeeder::class);
    }
}
