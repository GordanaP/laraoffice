<?php

namespace App\Rules;

use App\Traits\ModelFinder;
use Illuminate\Contracts\Validation\Rule;

class Workhours implements Rule
{
    use ModelFinder;

    public $profile_id;
    public $app_date;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($profile_id, $app_date)
    {
        $this->profile_id = $profile_id;
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
        $profile = $this->getProfile($this->profile_id);

        $work_day_id = setDay($this->app_date, 'w');

        $day = $profile->workdays()->where('work_day_id', $work_day_id)->first();

        return $day ? $value >= $day->pivot->start && $value < $day->pivot->end : '';
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
