<?php

use Pilot\CourseType;
use Illuminate\Database\Seeder;

class CourseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseType::create([
            'name' => 'Очный'
        ]);
        CourseType::create([
            'name' => 'Заочный'
        ]);
        CourseType::create([
            'name' => 'Очно-заочный'
        ]);
    }
}
