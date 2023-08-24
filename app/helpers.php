<?php

use Carbon\Carbon;
use Hekmatinasser\Verta\Facades\Verta;

function generateFileName($value)
{
    $year = Carbon::now()->year;
    $month = Carbon::now()->month;
    $day = Carbon::now()->day;
    $hour = Carbon::now()->hour;
    $minute = Carbon::now()->minute;
    $second = Carbon::now()->second;
    $micro = Carbon::now()->micro;

    $fileNameImagePrimary = ($year . '_' . $month . '_' . $day . '_' . $hour . '_' . $minute . '_' . $second . '_' . $micro . '_' . $value);

    return $fileNameImagePrimary;
}



function convertTime($date)
{
    if ($date == null) {
        return null;
    }

    $pattern = "/[-\s]/";

    $shamsiDateSplit = preg_split($pattern, $date);

    $gregorianDate = verta()->jalaliToGregorian($shamsiDateSplit[0], $shamsiDateSplit[1], $shamsiDateSplit[2]);

    return implode("-", $gregorianDate) . " " . $shamsiDateSplit[3];
}
