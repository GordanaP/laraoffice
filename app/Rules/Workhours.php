<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Workhours implements Rule
{
    public $profile;
    public $app_date;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($profile, $app_date)
    {
        $this->profile = $profile;
        $this->app_date = $app_date;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->profile->workingDayHour($this->app_date, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The hour is outside the doctor\'s working hours';
    }
}
