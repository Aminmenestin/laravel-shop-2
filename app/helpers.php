<?php

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Coupon;
use Hekmatinasser\Verta\Facades\Verta;

if (!function_exists('generateFileName')) {
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
}


if (!function_exists('convertTimeToGregorian')) {
    function convertTimeToGregorian($date)
    {
        if ($date == null) {
            return null;
        }

        $pattern = "/[-\s]/";

        $shamsiDateSplit = preg_split($pattern, $date);

        $gregorianDate = verta()->jalaliToGregorian($shamsiDateSplit[0], $shamsiDateSplit[1], $shamsiDateSplit[2]);

        return implode("-", $gregorianDate) . " " . $shamsiDateSplit[3];
    }
}

if (!function_exists('shiping')) {
    function shiping()
    {

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
}

if (!function_exists('cardtotalamount')) {
    function cardtotalamount()
    {

        $cardtotalamount = 0;
        foreach (\Cart::getContent() as $item) {
            $cardtotalamount += $item->quantity * $item->attributes->price;
        }
        return $cardtotalamount;
    }
}

if (!function_exists('totalesaleamount')) {
    function totalesaleamount()
    {

        $totalesaleamount = 0;
        foreach (\Cart::getContent() as $item) {
            if ($item->attributes->is_sale) {
                $totalesaleamount += $item->quantity * ($item->attributes->price - $item->attributes->sale_price);
            }
        }

        return $totalesaleamount;
    }
}

if (!function_exists('finalamount')) {
    function finalamount()
    {

        if (session()->exists('coupon')) {

            if (session()->get('coupon.amount') > \Cart::gettotal() + shiping()) {
                return 0;
            } else {
                return (\Cart::gettotal() + shiping()) - session()->get('coupon.amount');
            }
        } else {
            return \Cart::gettotal() + shiping();
        }
    }
}


if (!function_exists('checkcoupon')) {
    function checkcoupon($code)
    {

        $coupon = Coupon::where('code', $code)->where('expired_at', '>', Carbon::now())->first();


        if ($coupon == null) {
            session()->forget('coupon');
            return (['error' => 'این کد تخفیف وجود ندارد']);
        }

        if (!auth()->check()) {
            return (['error' => 'لطفا ابتدا وارد سایت شوید']);
        }

        if (Order::where('user_id', auth()->id())->where('coupon_id', $coupon->code)->where('payment_status', 1)->exists()) {
            return (['error' => 'این کد تخفیف قبلا استفاده شده است']);
        }

        if ($coupon->getRawOriginal('type') == 'amount') {
            session()->put('coupon', ['id' => $coupon->id, 'code' => $coupon->code, 'amount' => $coupon->amount]);
            return (['success' => 'کد تخفیف برای شما اعمال شد']);
        } else {
            $total = \Cart::gettotal();

            $amount = ($total * $coupon->percentage) / 100 > $coupon->max_percentage_amount ? $coupon->max_percentage_amount : ($total * $coupon->percentage) / 100;

            session()->put('coupon', ['code' => $coupon->code, 'amount' => $amount]);

            return (['success' => 'کد تخفیف برای شما اعمال شد']);
        }
    }
}
