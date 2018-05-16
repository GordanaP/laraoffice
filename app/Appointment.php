<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['start', 'end'];

    /**
     * Get the profile that has the appointment.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public static function dayArchives()
    {
        return static::selectRaw('year(start) year, monthname(start) month, dayname(start) day, hour(start) as hour,  profile_id, patient_id, COUNT(*) scheduled')
            ->groupBy('year', 'month', 'day', 'hour', 'profile_id', 'patient_id')
            ->orderByRaw('min(start) asc')
            ->get();
    }

    /**
     * Get the patient that has the appointment.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Get the today's appointments stratified by start time.
     *
     * @param  mixed $query
     * @param  string $value
     * @return mixed
     */
    public function scopeToday($query, $value)
    {
        return $query->where('start', appointmentStart(Carbon::today(), $value));
    }

}
