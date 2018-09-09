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
            'name' => 'Электро- и теплоэнергетика'
        ]);
        SpecialtyType::create([
            'name' => 'Машиностроение'
        ]);
        SpecialtyType::create([
            'name' => 'Электроника, радиотехника и системы связи'
        ]);
        SpecialtyType::create([
            'name' => 'Технологии материалов'
        ]);
        SpecialtyType::create([
            'name' => 'Технологии легкой промышленности'
        ]);
        SpecialtyType::create([
            'name' => 'Юриспруденция'
        ]);
    }
}
