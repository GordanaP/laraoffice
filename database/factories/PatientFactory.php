<?php

use Faker\Generator as Faker;

$factory->define(App\Patient::class, function (Faker $faker) {
    return [
        'f_name' => $faker->firstName,
        'l_name' => $faker->lastName,
        'gender' =>  $faker->randomElement(['M' ,'F']),
        'birthday' => $faker->dateTimeBetween($startDate = '-40 years', $endDate = '-20 years'),
        'phone' => $faker->e164PhoneNumber
    ];
});
