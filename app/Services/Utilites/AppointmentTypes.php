<?php

namespace App\Services\Utilities;

class AppointmentTypes
{
    protected static $types = [
        'EG' => 'Vision correction exam',
        'CL' => 'Vision correction exam',
        'SE' => 'Standard exam',
        'SSE' => 'Expert exam',
        'FUP' => 'Follow up'
    ];

    public static function all()
    {
        return static::$types;
    }
}