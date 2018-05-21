<?php

use App\Patient;
use App\Profile;
use Faker\Generator as Faker;

$factory->define(App\Appointment::class, function (Faker $faker) {
    return [
        'profile_id' => Profile::first()->id,
        'patient_id' => Patient::all()->random()->id,
        'start' => now(),
    ];
});