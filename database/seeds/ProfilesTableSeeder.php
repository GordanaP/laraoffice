<?php

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

        factory(App\Profile::class)->create([
            'user_id' => User::first()->id,
            'name' => 'Dr Gordana Vlajkovic',
        ]);

        foreach ($users as $user)
        {
            factory(App\Profile::class)->create();
        }
    }
}
