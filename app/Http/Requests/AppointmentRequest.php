<?php

namespace App\Http\Requests;

use App\Rules\AfterNow;
use App\Rules\AlphaNumSpace;
use App\Rules\Workdays;
use App\Rules\Workhours;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AppointmentRequest extends FormRequest
{
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
        switch ($this->method())
        {
            case 'POST':
                $rules = [
                    'profile_id' => 'required|exists:profiles,id',
                    'app_date' => [
                        'required','date_format:Y-m-d','after_or_equal:today',
                        new Workdays($this->profile)
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

                if ( $this->profile->isAtWork($this->app_date )) {
                    $rules['app_start'] = [
                        'bail',
                        'required',
                        'date_format:H:i',
                        new Workhours($this->profile, $this->app_date),
                        new AfterNow($this->app_date)
                    ];
                }
                break;

            case 'PUT':
            case 'PATCH':
                $rules = [
                    'app_date' => [
                        'required','date_format:Y-m-d','after_or_equal:today',
                        new Workdays($this->profile)
                    ],
                ];

                if ( $this->profile->isAtWork($this->app_date )) {
                    $rules['app_start'] = [
                        'bail',
                        'required',
                        'date_format:H:i',
                        new Workhours($this->profile, $this->app_date),
                        new AfterNow($this->app_date)
                    ];
                }
                break;
        }

        return $rules;
    }
}