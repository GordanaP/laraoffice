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
        $day = today()->format('Y-m-d');

        factory(App\Appointment::class)->create([
            'profile_id' => 1,
            'start' => $day .' 15:00:00',
            'end' => $day .' 15:30:00'
        ]);

        factory(App\Appointment::class)->create([
            'profile_id' => 1,
            'start' => $day .' 16:00:00',
            'end' => $day .' 16:30:00'
        ]);

        factory(App\Appointment::class)->create([
            'profile_id' => 2,
            'start' => $day .' 16:00:00',
            'end' => $day .' 16:30:00'
        ]);

        factory(App\Appointment::class)->create([
            'profile_id' => 3,
            'start' => $day .' 18:00:00',
            'end' => $day .' 18:30:00'
        ]);

        factory(App\Appointment::class)->create([
            'profile_id' => 4,
            'start' => $day .' 17:00:00',
            'end' => $day .' 17:30:00'
        ]);

        factory(App\Appointment::class)->create([
            'profile_id' => 5,
            'start' => $day .' 09:00:00',
            'end' => $day .' 09:30:00'
        ]);

        factory(App\Appointment::class)->create([
            'profile_id' => 6,
            'start' => $day .' 11:00:00',
            'end' => $day .' 11:30:00'
        ]);

        factory(App\Appointment::class)->create([
            'profile_id' => 8,
            'start' => $day .' 12:30:00',
            'end' => $day .' 13:00:00'
        ]);
    }
}
