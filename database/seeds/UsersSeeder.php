<?php

class UsersSeeder
{
    public function run()
    {
        User::create(['username' => 'Srdjan']);
    }
}
