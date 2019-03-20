<?php

use Faker\Generator as Faker;

$factory->define(App\Grade::class, function (Faker $faker) {
    return [
        'lecture_id' => function() {
            return factory('App\Lecture')->create()->id;
        },
        'student_id' => function() {
            return factory('App\Student')->create()->id;
        },
        'grade' => 0,
    ];
});
