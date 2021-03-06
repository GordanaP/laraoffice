<?php

use Faker\Generator as Faker;

$factory->define(App\Patient::class, function (Faker $faker) {
    return [
        'f_name' => $f_name = $faker->firstName,
        'l_name' => $l_name = $faker->lastName,
        'gender' =>  $faker->randomElement(['M' ,'F']),
        'birthday' => $birthday = setDate(today()->subYears(30)),
        'phone' => $faker->e164PhoneNumber,
        'record' => medicalRecord($birthday, $f_name, $l_name)
    ];
});
