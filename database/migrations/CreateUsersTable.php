<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateUsersTable
{
    public function run()
    {
        Capsule::schema()->dropIfExists('users');

        Capsule::schema()->create('users', function ($table) {

            $table->increments('id');
            $table->string('username');
            $table->timestamps();

        });
    }
}
