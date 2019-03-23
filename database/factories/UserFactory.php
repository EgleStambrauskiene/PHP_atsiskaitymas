<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'loginname' => $faker->unique()->name,
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make('iddqdidkfa'),
        'role' => 'admin',
    ];
});
