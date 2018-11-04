<?php

use Illuminate\Database\Seeder;
use Pilot\UserInfo;

class UserInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserInfo::create([
            'user_id' => 1,
            'position_id' => 1,
            'name' => 'Администратор',
            'lastname' => 'Администраторов',
            'middlename' => 'Администратович',
            'about' => 'Администратор информационной системы Пилот'
        ]);
        UserInfo::create([
            'user_id' => 2,
            'position_id' => 2,
            'name' => 'Модератор',
            'lastname' => 'Модераторов',
            'about' => 'Модератор информационной системы Пилот'
        ]);
        UserInfo::create([
            'user_id' => 3,
            'position_id' => 3,
            'name' => 'Преподаватель',
            'lastname' => 'Обычный',
            'about' => 'Пользователь информационной системы Пилот'
        ]);
    }
}
