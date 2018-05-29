<?php

namespace App\Services\Utilities;

class AppointmentTypes
{
    protected static $types = [
        'EG' => 'Vision correction eyglasses',
        'CL' => 'Vision correction contact lenses',
        'SE' => 'Standard exam',
        'EE' => 'Expert exam',
        'FUP' => 'Follow up'
    ];

    public static function all()
    {
        return static::$types;
    }
}