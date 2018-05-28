<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $dates = ['birthday'];

    /**
     * Get the appointments that belong to the profile.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Create a new patient.
     *
     * @param  array $data
     * @return App\Patient
     */
    public static function createOrUpdate($data, $patient=null)
    {
        $patient = $patient ?: new static;

        $patient->f_name = $data['f_name'];
        $patient->l_name =$data['l_name'];
        $patient->birthday = Carbon::createFromFormat('Y-m-d', $data['birthday']);
        $patient->gender = $data['gender'];
        $patient->phone = $data['phone'];
        $patient->record = medicalRecord($data['birthday'], $data['f_name'], $data['l_name']);

        $patient->save();

        return $patient;
    }
}
