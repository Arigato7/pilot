<?php

use Pilot\MaterialType;
use Illuminate\Database\Seeder;

class MaterialTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MaterialType::create([
            'name' => 'РП'
        ]);
        MaterialType::create([
            'name' => 'КОС'
        ]);
        MaterialType::create([
            'name' => 'УМП'
        ]);
        MaterialType::create([
            'name' => 'Практика'
        ]);
    }
}
