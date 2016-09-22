<?php

use Innaco\Entities\User;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'full_name' => Config::get('custom.group_management.user'),
            'email'     => Config::get('custom.group_management.email'),
            'cedula'    => '123456',
            'password'  => Config::get('custom.group_management.password'),
            'available' => 1,
        ])->groupacls()->attach(1);

        User::create([
            'full_name' => 'Jonathan Linares',
            'email'     => 'jonathanlinares91@gmail.com',
            'password'  => '20666251',
            'cedula'    => '20666251',
            'available' => 1,
        ])->groups()->attach(2);

        User::create([
            'full_name' => 'Ysaias Henriquez',
            'email'     => 'ysaias1032@gmail.com',
            'password'  => '18421458',
            'cedula'    => '18421458',
            'available' => 1,
        ])->groups()->attach(1);

        User::create([
            'full_name' => 'Yaudilis Garcia',
            'email'     => 'yaudilisgarcia@gmail.com',
            'password'  => '20920508',
            'cedula'    => '20920508',
            'available' => 1,
        ])->groups()->attach(4);
    }
}
