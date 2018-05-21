<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkDay extends Model
{
    public $timestamps = false;

    /**
     * Get the profiles that belong to the work day.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function profiles()
    {
        return $this->belongsToMany(Profile::class)->withPivot('start', 'end', 'appInterval');
    }

    /**
     * Get the profiles currently on duty.
     *
     * @param  int $start
     * @param  int $breakpoint
     * @param  int $end
     * @return array
     */
    public static function profilesOnDuty($start, $breakpoint, $end)
    {
        $today = today()->dayOfWeekIso;

        if(morningShift($start, $breakpoint))
        {
            $profiles = static::find($today)->profiles()->wherePivot('start', '<', $breakpoint)->get();
        }
        elseif (afternoonShift($breakpoint, $end))
        {
            $profiles = static::find($today)->profiles()->wherePivot('start', '>=', $breakpoint)->get();
        }

        return $profiles->load('appointments.patient');
    }
}
