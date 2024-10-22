<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\User;

class CourseSeeder extends Seeder
{
    // Run the database seeds.
    public function run(): void
    {
        // Fetch all teachers
        $teachers = User::where('user_type', 'teacher')->get();

        // Seed 5 courses for each teacher
        foreach ($teachers as $teacher) {
            Course::factory()->count(5)->create();
        }
    }
}
