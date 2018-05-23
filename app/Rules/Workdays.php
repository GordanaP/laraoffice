<?php

namespace App\Rules;

use App\Profile;
use Illuminate\Contracts\Validation\Rule;

class Workdays implements Rule
{
    public $profile;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($profile)
    {
        $this->profile = $profile;
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
        return $this->profile->isAtWork($value);
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
