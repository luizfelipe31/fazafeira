<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => 'Veus',
        'email' => 'veus@domain.com',
        'status' => 1,
        'document' => '00000000000',
        'password' => '$2y$10$78ge326zDs7i.Fn.LYVvPOB6PLiG17mewfW1BbQi7O/NqCwHJC86q', // secret
        'remember_token' => Str::random(10),
    ];
});
