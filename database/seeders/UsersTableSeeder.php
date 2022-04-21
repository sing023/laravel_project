<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name= 'Finn';
        $user->email= 'finn@gmail.com';
        $user->password = 'password';
        $user->save();

        $user = new User();
        $user->name= 'Graham';
        $user->email= 'graham@gmail.com';
        $user->password = 'password';
        $user->save();

        $user= User::factory()->count(10)->create();


    }
}
