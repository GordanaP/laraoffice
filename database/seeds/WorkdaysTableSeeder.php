<?php

use App\Profile;
use Illuminate\Database\Seeder;

class WorkdaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days_names = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        foreach ($days_names as $name)
        {
            factory(App\WorkDay::class)->create([
                'name' => $name
            ]);
        }

        $workdayId = today()->dayOfWeek;

        Profile::first()->workdays()->sync($workdayId, [
            'start' => '15:00',
            'end' => '20:00'
        ]);

        Profile::find(2)->workdays()->sync($workdayId, [
            'start' => '16:00',
            'end' => '19:00'
        ]);

        Profile::find(3)->workdays()->sync([$workdayId => [
            'start' => '15:00',
            'end' => '18:30'
        ]]);

        Profile::find(4)->workdays()->sync([$workdayId => [
            'start' => '16:00',
            'end' => '20:00'
        ]]);

        Profile::find(5)->workdays()->sync([$workdayId => [
            'start' => '09:00',
            'end' => '15:00'
        ]]);

        Profile::find(6)->workdays()->sync([$workdayId => [
            'start' => '10:00',
            'end' => '12:30'
        ]]);

        Profile::find(7)->workdays()->sync([$workdayId => [
            'start' => '10:00',
            'end' => '13:00'
        ]]);

        Profile::find(8)->workdays()->sync([$workdayId => [
            'start' => '10:00',
            'end' => '15:00'
        ]]);
    }
}
