<?php

use Illuminate\Database\Seeder;

class AppointmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = today()->format('Y-m-d');
        $tomorrow = today()->addDay(1)->format('Y-m-d');

        factory(App\Appointment::class)->create([
            'profile_id' => 1,
            'start' => $today .' 15:00:00',
            'end' => $today .' 15:20:00'
        ]);

        factory(App\Appointment::class)->create([
            'profile_id' => 1,
            'start' => $today .' 15:20:00',
            'end' => $today .' 15:40:00'
        ]);

        factory(App\Appointment::class)->create([
            'profile_id' => 1,
            'start' => $today .' 16:00:00',
            'end' => $today .' 16:20:00'
        ]);

        factory(App\Appointment::class)->create([
            'profile_id' => 1,
            'start' => $tomorrow .' 16:00:00',
            'end' => $tomorrow .' 16:20:00'
        ]);

        factory(App\Appointment::class)->create([
            'profile_id' => 2,
            'start' => $today .' 15:00:00',
            'end' => $today .' 15:30:00'
        ]);

        factory(App\Appointment::class)->create([
            'profile_id' => 3,
            'start' => $today .' 18:00:00',
            'end' => $today .' 18:20:00'
        ]);

        factory(App\Appointment::class)->create([
            'profile_id' => 4,
            'start' => $today .' 17:00:00',
            'end' => $today .' 17:30:00'
        ]);

        factory(App\Appointment::class)->create([
            'profile_id' => 5,
            'start' => $today .' 09:00:00',
            'end' => $today .' 09:20:00'
        ]);

        factory(App\Appointment::class)->create([
            'profile_id' => 6,
            'start' => $today .' 11:00:00',
            'end' => $today .' 11:30:00'
        ]);

        factory(App\Appointment::class)->create([
            'profile_id' => 8,
            'start' => $today .' 12:30:00',
            'end' => $today .' 13:00:00'
        ]);
    }
}
