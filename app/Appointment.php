<?php

namespace App;

use App\Patient;
use App\Traits\ModelFinder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use ModelFinder;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['start'];

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

    public static function createNew($data)
    {
        $patient = Patient::createOrUpdate($data);

        $appointment = new static;

        $appointment->start = getEventDate($data['app_date'], $data['app_start']);
        $appointment->profile()->associate($data['profile_id']);

        $patient->appointments()->save($appointment);
    }

    public function saveChanges($data)
    {
        $this->start = getEventDate($data['app_date'], $data['app_start']);

        $this->save();
    }

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