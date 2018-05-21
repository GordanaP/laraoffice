<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * Get the user that owns the profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Create a new profile or update the existing one
     *
     * @param  \App\User $user
     * @param  array $data
     *
     * @return void
     */
    public static function newOrUpdate($user, $data)
    {
        $profile = $user->profile ?: new static;

        $profile->name = $data['name'];
        $profile->about = $data['about'];
        $profile->location = $data['location'];

        $user->profile()->save($profile);
    }

    /**
     * Get the appointments that belong to the profile.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Get today's appointments stratified by start time.
     *
     * @param  string $hour
     * @return array
     */
    public function getAppointments($day, $hour)
    {
        return $this->appointments->where('start', appointmentStart($day, $hour));
    }

    /**
     * Get the work days that belong to the profile.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function workdays()
    {
        return $this->belongsToMany(WorkDay::class)->withPivot('start', 'end', 'appInterval');
    }

    /**
     * get profiles grouped by appointments intervals
     *
     * @param  [int] $mins
     * @return array
     */
    public static function appInterval($mins)
    {
        return static::with('workdays')->whereHas('workdays', function ($q) use($mins) {
            $q->where('appInterval', '=', $mins);
        })->get();
    }
}
