<?php

use Illuminate\Database\Seeder;
use Pilot\Specialty;

class SpecialtyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Specialty::create([
            'specialty_type_id' => 2,
            'name' => 'Компьютерные системы и комплексы',
            'code' => '09.02.01'
        ]);
        Specialty::create([
            'specialty_type_id' => 2,
            'name' => 'Компьютерные сети',
            'code' => '09.02.02'
        ]);
        Specialty::create([
            'specialty_type_id' => 2,
            'name' => 'Программирование в компьютерных системах',
            'code' => '09.02.03'
        ]);
        Specialty::create([
            'specialty_type_id' => 2,
            'name' => 'Информационные системы (по отраслям)',
            'code' => '09.02.04'
        ]);
        Specialty::create([
            'specialty_type_id' => 2,
            'name' => 'Прикладная информатика (по отраслям)',
            'code' => '09.02.05'
        ]);
        Specialty::create([
            'specialty_type_id' => 1,
            'name' => 'Организация и технология защиты информации',
            'code' => '10.02.01'
        ]);
        Specialty::create([
            'specialty_type_id' => 1,
            'name' => 'Информационная безопасность телекоммуникационных систем',
            'code' => '10.02.02'
        ]);
        Specialty::create([
            'specialty_type_id' => 1,
            'name' => 'Информационная безопасность автоматизированных систем',
            'code' => '10.02.03'
        ]);
    }
}
