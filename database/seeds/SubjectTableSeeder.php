<?php

use Illuminate\Database\Seeder;
use Pilot\Subject;

class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::create([
            'name' => 'Операционные системы'
        ]);
        Subject::create([
            'name' => 'Архитектура аппаратных средств'
        ]);
        Subject::create([
            'name' => 'Информационные технологии'
        ]);
        Subject::create([
            'name' => 'Основы алгоритмизации и программирования'
        ]);
        Subject::create([
            'name' => 'Компьютерная графика'
        ]);
        Subject::create([
            'name' => 'Устройство и функционирование информационной системы'
        ]);
        Subject::create([
            'name' => 'Компьютерные сети'
        ]);
        Subject::create([
            'name' => 'Основы проектирования баз данных'
        ]);
        Subject::create([
            'name' => 'Стандартизация, сертификация и техническое документоведение'
        ]);
        Subject::create([
            'name' => 'Технические средства информатизации'
        ]);
        Subject::create([
            'name' => 'Инженерная компьютерная графика'
        ]);
        Subject::create([
            'name' => 'Основы теории информации'
        ]);
    }
}
