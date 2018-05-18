<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Profile::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'name' => $faker->name,
        'about' => $faker->sentence,
        'location' => $faker->city,
    ];
});
