<?php

use Illuminate\Database\Seeder;
use Pilot\EducationOrganization;

class EducationOrganizationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EducationOrganization::create([
            'name' => 'ИПЭК', 
            'phone' => '88005553535', 
            'address' => 'ул Пушкина д Колотушкина', 
            'cite' => 'ipek.cuir.ru', 
            'email' => 'ipek@izh.ru'
        ]);
    }
}
