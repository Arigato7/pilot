<?php

use Pilot\Position;
use Illuminate\Database\Seeder;

class PositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Position::create([
            'name' => 'Директор'
        ]);
        Position::create([
            'name' => 'Заведующий отделения'
        ]);
        Position::create([
            'name' => 'Заместитель директора'
        ]);
        Position::create([
            'name' => 'Методист'
        ]);
        Position::create([
            'name' => 'Преподаватель'
        ]);
    }
}
