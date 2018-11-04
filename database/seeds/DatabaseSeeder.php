<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CourseTypeSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(SubjectTableSeeder::class);
        $this->call(SpecialtyTypeTableSeeder::class);
        $this->call(SpecialtyTableSeeder::class);
        $this->call(MaterialTypeTableSeeder::class);
        $this->call(EducationOrganizationTableSeeder::class);
        $this->call(PositionTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(UserInfoTableSeeder::class);
    }
}
