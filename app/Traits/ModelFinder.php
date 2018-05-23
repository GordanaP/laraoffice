<?php

namespace App\Traits;

use App\Profile;
use App\Role;
use App\User;

trait ModelFinder
{
    /**
     * Get all roles;
     *
     * @return array
     */
    public function getRoles() {

        return Role::all();
    }

    /**
     * Get all users.
     *
     * @return array
     */
    public function getUsers()
    {
        return User::with('roles:name')->with('avatar')->get();
    }

    /**
     * Get all profiles.
     *
     * @return array
     */
    // public function getProfiles()
    // {
    //     return Profile::all()->load('appointments.patient');
    // }


    /**
     * Get a profile.
     *
     * @param  mixed $value
     * @param  string $attribute
     * @return \App\Profile
     */
    public function getProfile($value, $attribute='id')
    {
        return Profile::where($attribute, $value)->first();
    }
}