<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Assessment;

class AssessmentSeeder extends Seeder
{

    // Run the database seeds.

    public function run(): void
    {
        // Get all courses
        $courses = Course::all();

        // Add 3 assessments per course
        foreach ($courses as $course) {
            Assessment::factory()->count(3)->create([
                'course_id' => $course->id,
                'type' => 'student-select' // or 'teacher-assign'
            ]);
        }
    }
}
