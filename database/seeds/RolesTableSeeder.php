<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['owner', 'admin', 'superadmin', 'customer'];

        foreach ($roles as $role)
        {
            factory(App\Role::class)->create([
                'name' => $role
            ]);
        }

        $role = Role::find(2);

        User::first()->roles()->sync($role);
    }
}
