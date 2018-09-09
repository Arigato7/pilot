<?php

use Illuminate\Database\Seeder;
use Pilot\User;
use Illuminate\Support\Facades\Storage;
use Pilot\Events\UserCreated;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'role_id' => 1, 
            'login' => 'admin', 
            'password' => bcrypt('admin')
        ]);
        event(new UserCreated($user));
        $moderator = User::create([
            'role_id' => 2, 
            'login' => 'moderator', 
            'password' => bcrypt('moderator')
        ]);
        event(new UserCreated($moderator));
        $teacher = User::create([
            'role_id' => 3, 
            'login' => 'teacher', 
            'password' => bcrypt('teacher')
        ]);
        event(new UserCreated($teacher));
    }
}
