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


function shiping(){

    $shiping = 0;
    foreach (\Cart::getContent() as $item) {
        if ($item->associatedModel->delivery_amount_per_product) {
            $shiping += $item->quantity * $item->associatedModel->delivery_amount_per_product;
        } else {
            $shiping += $item->associatedModel->delivery_amount;
        }
    }

    return $shiping;
}

function cardtotalamount(){

    $cardtotalamount = 0;
    foreach (\Cart::getContent() as $item) {
        $cardtotalamount += $item->quantity * $item->attributes->price;
    }
    return $cardtotalamount;
}

function totalesaleamount(){

    $totalesaleamount = 0;
    foreach (\Cart::getContent() as $item) {
        if($item->attributes->is_sale){
            $totalesaleamount += $item->quantity * ($item->attributes->price - $item->attributes->sale_price);
        }
    }

    return $totalesaleamount;
}


