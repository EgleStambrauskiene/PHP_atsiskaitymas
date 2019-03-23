<?php

use Faker\Generator as Faker;

$factory->define(App\Lecture::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->word,
        'description' => $faker->sentence,
    ];
});
