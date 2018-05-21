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
     * Create a new appointment.
     *
     * @param  array $data    [description]
     * @param  App\Patient $patient
     * @return App\Appointment
     */
    public static function createNew($data, $patient)
    {
        $appointment = new static;

        $appointment->start = getEventDate($data['appDate'], $data['appStart']);
        $appointment->profile()->associate($data['profile_id']);

        $patient->appointments()->save($appointment);

        return $appointment;
    }
}
