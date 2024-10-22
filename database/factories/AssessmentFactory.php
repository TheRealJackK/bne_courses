<?php

namespace Database\Factories;

use App\Models\Assessment;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssessmentFactory extends Factory
{
    protected $model = Assessment::class;

    // factory for inserting data into assessments
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(2),
            'instruction' => $this->faker->paragraph(),
            'num_reviews_required' => $this->faker->numberBetween(1, 5),
            'max_score' => $this->faker->numberBetween(1, 100),
            'due_date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'type' => $this->faker->randomElement(['student-select', 'teacher-assign']),
        ];
    }
}
