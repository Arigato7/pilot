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
            'shortname' => 'ИПЭК',
            'name' => 'Ижевский промышленно-экономический колледж', 
            'phone' => '88005553535', 
            'address' => 'ул Ленина 68', 
            'cite' => 'ipek.cuir.ru', 
            'email' => 'ipek@izh.ru'
        ]);
    }
}
