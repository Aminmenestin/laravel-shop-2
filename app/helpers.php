<?php

use Carbon\Carbon;

function generateFileName($value)
{
    $year = Carbon::now()->year;
    $month = Carbon::now()->month;
    $day = Carbon::now()->day;
    $hour = Carbon::now()->hour;
    $minute = Carbon::now()->minute;
    $second = Carbon::now()->second;
    $micro = Carbon::now()->micro;

    $fileNameImagePrimary = ($year. '_' . $month . '_' . $day . '_' . $hour . '_' . $minute . '_' . $second . '_' . $micro . '_' . $value);

    return $fileNameImagePrimary;
}


