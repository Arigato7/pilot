<?php

use Illuminate\Database\Seeder;
use Pilot\SpecialtyType;

class SpecialtyTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SpecialtyType::create([
            'name' => 'Информационная безопасность'
        ]);
        SpecialtyType::create([
            'name' => 'Информатика и вычислительная техника'
        ]);
        SpecialtyType::create([
            'name' => 'Электроника, радиотехника и системы связи'
        ]);
    }
}
