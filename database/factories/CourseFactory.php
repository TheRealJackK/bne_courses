<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    // factory for inserting data into courses
    public function definition()
    {
        return [
            'course_code' => $this->faker->unique()->word(),
            'name' => $this->faker->sentence(3),
        ];
    }
}
