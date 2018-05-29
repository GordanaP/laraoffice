<?php

use Carbon\Carbon;

/**
 * Create the response message.
 *
 * @param  string  $message
 * @param  string  $type
 * @return array
 */
function message($message, $type="success")
{
    $response['message'] = $message;
    $response['type'] = $type;

    return $response;
}

/**
 * Indicate an active link.
 *
 * @param string  $value
 * @param integer $segment
 * @return  string
 */
function set_active_link($value, $segment=1)
{
    return request()->segment($segment) == $value ? 'active' : '';
}

function getCheckedValue($attribute, $value)
{
    return $attribute == $value ? 'checked' : '';
}

/**
 * Set the class color.
 *
 * @param [type] $param  [description]
 * @param [type] $value  [description]
 * @param string $class1 [description]
 * @param string $class2 [description]
 */
// function set_class($param, $value, $class1=' green', $class2=' red')
// {
//     return $param == $value ? $class1 : $class2;
// }

/**
 * Indicate a selected option.
 *
 * @param  integer $current
 * @param  integer $selected
 * @return string
 */
function selected($current, $selected)
{
    return $current == $selected ? 'selected' : '';
}

/**
 * Set an avatar.
 *
 * @param \App\User $user
 * @return string
 */
function setAvatar($user)
{
    $avatar = optional($user->avatar)->filename ?: 'default.jpg';

    return 'images/avatars/'.$avatar;
}

/**
 * Set the avatar name.
 *
 * @param int $userId
 * @param string $file
 * return string
 */
function setAvatarName($userId, $file)
{
    return $userId.'-'.$file->getClientOriginalName();
}

/**
 * Set the today's appointment start time.
 *
 * @param string $day
 * @param string $hour
 * @return string
 */
function appointmentStart($day, $hour, $format='Y-m-d')
{
    return $day->format($format). ' ' .$hour.':00';
}

/**
 * Set the first name.
 *
 * @param  string $firstName
 * @param  string $lastName
 * @return string
 */
function fullName($firstName, $lastName)
{
    return $firstName .' ' .$lastName;
}

/**
 * Get day time formatted.
 *
 * @return [type] [description]
 */
function dailyTime()
{
    return today()->toFormattedDateString();
}

/**
 * Determine if day time is morning
 *
 * @return bool
 */
function morningShift($start, $breakpoint)
{
    return  timeNow() >= $start && timeNow() < $breakpoint;
}

/**
 * Determine if day time is afternoon
 *
 * @return bool
 */
function afternoonShift($breakpoint, $end)
{
    return  timeNow() >= $breakpoint && timeNow() < $end;
}

/**
 * Get the hour of the day.
 *
 * @return string
 */
function timeNow($format = 'H')
{
    return now(config('app.timezone'))->format($format);
}

/**
 * Determine the day of week.
 *
 * @param  \Carbon\Carbon $day
 * @return int
 */
function weekdayId($day)
{
    return $day->dayOfWeek;
}

/**
 * Get the Carbon instance of the event dat.
 *
 * @param  string $date
 * @param  string $time
 * @param  string $format
 * @return string
 */
function getEventDate($date, $time, $format='Y-m-d H:i')
{
    return Carbon::createFromFormat($format, $date.' '.$time);
}

/**
 * Get a past year
 *
 * @param  string $day
 * @param  int $years
 * @param  string $format
 * @return string
 */
function pastYears($day, $years, $format='Y-m-d')
{
    return $day->subYears($years)->format($format);
}

/**
 * Set a date
 *
 * @param string $day
 * @param string $format
 */
function setDate($date, $format='Y-m-d')
{
    return $date->format($format);
}

/**
 * Set a weekday.
 *
 * @param string $format
 */
function setDay($date, $format='l')
{
    return date($format, strtotime($date));
}

function dateFormattedPHP($date, $format)
{
    return date($format, strtotime($date));
}

/**
 * Get the working hours stratified by the day time.
 *
 * @return array
 */
function workingHours($start, $breakpoint, $end)
{
    $workingHours = collect(WorkingHours::all());

    if(morningShift($start, $breakpoint))
    {
        $filteredHours = $workingHours->filter(function ($value, $key) use($start, $breakpoint, $end) {
            return $value >= $start && $value < $breakpoint;
        });
    }
    elseif (afternoonShift($breakpoint, $end))
    {
        $filteredHours = $workingHours->filter(function ($value, $key) use($start, $breakpoint, $end) {
            return $value >= $breakpoint && $value < $end;
        });
    }

    return $filteredHours->all();
}

/**
 * Get the medical record number
 *
 * @param  [string] $date
 * @param  [string] $f_name
 * @param  [string] $l_name
 * @return [string]
 */
function medicalRecord($birthday, $f_name, $l_name)
{
    $day = dateFormattedPHP($birthday, 'd');
    $month = dateFormattedPHP($birthday, 'm');
    $year = substr(dateFormattedPHP($birthday, 'Y'), 1);
    $f_name = strtoupper(substr($f_name, 0, 2));
    $l_name = strtoupper(substr($l_name, 0, 2));

    return $day.$month.$year.$f_name.$l_name;

}