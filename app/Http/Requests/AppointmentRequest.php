<?php

namespace App\Http\Requests;

use App\Rules\AlphaNumSpace;
use App\Rules\Workdays;
use App\Rules\Workhours;
use App\Traits\ModelFinder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AppointmentRequest extends FormRequest
{
    use ModelFinder;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $profile = $this->getProfile($this->profile_id);

        $workdays = $profile->workdays->pluck('name');

        $day = setDay($this->app_date);

        $rules = [
            'profile_id' => 'required|exists:profiles,id',
            'app_date' => [
                'required','date_format:Y-m-d','after_or_equal:today',
                new Workdays($this->profile_id)
            ],
            'gender' => [
                'required',
                Rule::in(['M', 'F'])
            ],
            'f_name' => [
                'required','string','max:50',
                new AlphaNumSpace
            ],
            'l_name' => [
                'required','string','max:50',
                new AlphaNumSpace
            ],
            'birthday' => 'required|date_format:Y-m-d|before:today|after:'.pastYears(today(), 110),
            'phone' => 'required|digits_between:5,15',
        ];

        if ( $workdays->contains($day)) {
            $rules['app_start'] = [
                'required',
                'date_format:H:i',
                new Workhours($this->profile_id, $this->app_date),
            ];
        }

        return $rules;
    }
}