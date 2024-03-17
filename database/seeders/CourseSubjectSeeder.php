<?php

// database/seeders/CourseSubjectSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\coursesubjects; // Import the model

class CourseSubjectSeeder extends Seeder
{
    public function run()
    {
        // Adjust the number of records you want to seed
        coursesubjects::factory()->count(100)->create();
    }
}

