<?php

namespace App\Services\Utilities;

class AppointmentStatus
{
    protected static $status = [
        'Completed' => 'Completed',
        'Missed' => 'Missed',
        'Rescheduled' => 'Rescheduled'
    ];

    public static function all()
    {
        return static::$status;
    }
}