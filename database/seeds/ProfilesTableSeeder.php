<?php

use App\Profile;
use App\User;
use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        foreach ($users as $user)
        {
            factory(App\Profile::class)->create();
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
