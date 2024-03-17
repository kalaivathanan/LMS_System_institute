<?php

// database/factories/CourseSubjectFactory.php

namespace Database\Factories;

use App\Models\coursemodel;
use App\Models\coursesubjects;
use Illuminate\Database\Eloquent\Factories\Factory;

class coursesubjectsFactory extends Factory
{
    protected $model = coursesubjects::class;

    public function definition()
    {
        return [
            'code' => $this->faker->unique()->word,
            'name' => $this->faker->sentence,
            'hours' => $this->faker->randomNumber(2),
            'courseid' => function () {
                // You can assign a valid course ID here if you have courses in your database
                // Otherwise, you might need to adjust this based on your application logic
                return 1; // Replace with the appropriate course ID
            },
            //'courseid' => $this->faker->randomNumber(2),
        ];
    }
}
