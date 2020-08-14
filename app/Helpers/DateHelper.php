<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Carbon;

class DateHelper
{
    /**
     * @param null|string $utcTime
     * @return ?Carbon
     */
    public static function utcToAppTimeZone($utcTime): ?Carbon
    {
        if (empty($utcTime)) {
            return null;
        }

        return Carbon::createFromTimestampUTC(strtotime($utcTime))->setTimezone(config('app.timezone'));
    }

    /**
     * @param $dateString
     * @return null|Carbon
     */
    public static function toAppTimeZone($dateString): ?Carbon
    {
        if (empty($dateString)) {
            return null;
        }

        return Carbon::parse($dateString)->setTimezone(config('app.timezone'));
    }

    /**
     * @param string $dateTime
     * @param string $format
     * @param mixed  $timezone
     * @return mixed
     */
    public static function formatDatetime($dateTime, $format, $timezone = 'UTC')
    {
        if (empty($dateTime) || !method_exists($dateTime, 'setTimezone')) {
            return '';
        }

        if (is_numeric($dateTime)) {
            $dateTime = Carbon::createFromTimestamp($dateTime);
        } elseif (is_string($dateTime)) {
            $dateTime = Carbon::parse($dateTime);
        }

        return $dateTime->setTimezone($timezone)->format($format);
    }

    public static function toJsonDateFormat($dateTime)
    {
        return self::formatDatetime($dateTime, 'Y-m-d\TH:i:s.000\Z');
    }

    /**
     * @param $startOne
     * @param $endOne
     * @param $startTwo
     * @param $endTwo
     * @return bool
     */
    public static function datesOverlap($startOne, $endOne, $startTwo, $endTwo)
    {
        if ($startOne <= $endTwo && $endOne >= $startTwo) {
            return true;
        }

        return false;
    }
}
