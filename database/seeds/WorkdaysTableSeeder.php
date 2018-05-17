<?php

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
    }
}
