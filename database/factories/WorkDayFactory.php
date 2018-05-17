<?php

use Faker\Generator as Faker;

$factory->define(App\WorkDay::class, function (Faker $faker) {
    return [
        'name' => $faker->dayOfWeek
    ];
});
