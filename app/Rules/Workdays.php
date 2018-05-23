<?php

namespace App\Rules;

use App\Profile;
use App\Traits\ModelFinder;
use Illuminate\Contracts\Validation\Rule;

class Workdays implements Rule
{
    use ModelFinder;

    public $profile_id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($profile_id)
    {
        $this->profile_id = $profile_id;
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

        $workdays = $profile->workdays->pluck('name');

        $day = setDay($value);

        return $workdays->contains($day);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The doctor does not work on this day.';
    }
}
