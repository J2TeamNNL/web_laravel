<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Course::factory(10)->create();
        Student::factory(500)->create();
        $this->call([
            UserSeeder::class,
        ]);
    }
}
