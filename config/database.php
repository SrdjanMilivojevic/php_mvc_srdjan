<?php

/*
|--------------------------------------------------------------
| Database configuration:
|--------------------------------------------------------------
|
| Here are each of the availabile database
| connection setups for your application.
|
 */

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

// SQLite
$capsule->addConnection([
    'driver' => 'sqlite',
    'database' => BASE_PATH . 'system/storage/database.sqlite',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

// // MySQL
// $capsule->addConnection([
//     'driver' => 'mysql',
//     'host' => 'localhost',
//     'database' => '',
//     'username' => '',
//     'password' => '',
//     'charset' => 'utf8',
//     'collation' => 'utf8_unicode_ci',
//     'prefix' => '',
//     'strict' => false,
// ]);

// // PostgreSql
// $capsule->addConnection([
//     'driver' => 'pgsql',
//     'host' => 'localhost',
//     'database' => '',
//     'username' => '',
//     'password' => '',
//     'charset' => 'utf8',
//     'prefix' => '',
//     'schema' => 'public',
// ]);

// // SQLserver
// $capsule->addConnection([
//     'driver' => 'sqlsrv',
//     'host' => 'localhost',
//     'database' => '',
//     'username' => '',
//     'password' => '',
//     'charset' => 'utf8',
//     'prefix' => '',
// ]);

// For eloquent fascade example: User::all();
$capsule->setAsGlobal();

$capsule->bootEloquent();
date_default_timezone_set('UTC');
