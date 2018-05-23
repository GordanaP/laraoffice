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

    public static function profilesOnDuty($start, $breakpoint, $end)
    {
        $today = today()->dayOfWeekIso;

        if(morningShift($start, $breakpoint))
        {
            $profiles = static::whereHas('workdays', function ($q) use($today, $breakpoint) {
                $q->where('start', '<', $breakpoint);
            })->get();
        }
        elseif (afternoonShift($breakpoint, $end))
        {
            $profiles = static::whereHas('workdays', function ($q) use($today, $breakpoint) {
                $q->where('start', '>=', $breakpoint);
            })->get();
        }

        return $profiles->load('appointments.patient');
    }

    /**
     * The doctor is at work.
     *
     * @param  string  $date
     * @return boolean
     */
    public function isAtWork($date)
    {
        $workdays = $this->workdays->pluck('name');

        $day = setDay($date);

        return $workdays->contains($day);
    }

    /**
     * Determine if the time is working hour.
     *
     * @param  string $date
     * @param  string $time
     * @return string
     */
    public function workingDayHour($date, $time)
    {
        $work_day_id = setDay($date, 'w');

        $day = $this->workdays()->where('work_day_id', $work_day_id)->first();

        return $day ? $time >= $day->pivot->start && $time < $day->pivot->end : '';
    }
}
