<?php

namespace App\Http\Controllers\Home;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\OrderItems;
use App\Models\Transactions;
use App\PayGateway\zarinpal;
use App\PayGateway\zibal;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_method' => 'required',
            'address' => 'required'
        ]);

        if ($validator->fails()) {
            alert()->error('یک ادرس برای خود انتخاب کنید');
            return redirect()->back();
        }


        $checkcart = $this->checkcart();

        if (array_key_exists('error', $checkcart)) {
            alert()->error($checkcart['error'])->persistent('حله');
            return redirect()->route('home.cart.index');
        }

        $amounts = $this->getAmount();

        if (array_key_exists('error', $amounts)) {
            alert()->error($amounts['error'])->persistent('حله');
            return redirect()->route('home.cart.index');
        }


        if ($request->payment_method == 'zarinpal') {
            $payGateway = new zarinpal();

            $payGatewayResult = $payGateway->send($amounts, $request->address);


            if (array_key_exists('error', $payGatewayResult)) {
                alert()->error($payGatewayResult['error'])->persistent('حله');
                return redirect()->back();
            } else {
                return redirect()->to($payGatewayResult['success']);
            }
        }

        if ($request->payment_method == 'zibal') {

            $payGateway = new zibal();

            $payGatewayResult = $payGateway->send($amounts, $request->address);

            if (array_key_exists('error', $payGatewayResult)) {
                alert()->error($payGatewayResult['error'])->persistent('حله');
                return redirect()->back();
            } else {
                return redirect()->to($payGatewayResult['success']);
            }
        }

        alert()->error('درگاه پرداخت اشتباه است');
        return redirect()->back();
    }


    public function paymentVerify($getwayname)
    {
        if ($getwayname == 'zarinpal') {

            $veryfyRequest = new zarinpal();

            $veryfyRequestResult = $veryfyRequest->verifyRequest();

            if (array_key_exists('error', $veryfyRequestResult)) {
                alert()->error($veryfyRequestResult['error'])->persistent('حله');
                return redirect()->back();
            } else {
                alert()->success($veryfyRequestResult['success']);
                return redirect()->route('home.profile.index' , ['any'=>'orders']);
            }
        }

        if ($getwayname == 'zibal') {
            $veryfyRequest = new zibal();

            $veryfyRequestResult = $veryfyRequest->verifyRequest();

            if (array_key_exists('error', $veryfyRequestResult)) {
                alert()->error($veryfyRequestResult['error'])->persistent('حله');
                return redirect()->route('home.order.index');
            } else {
                alert()->success($veryfyRequestResult['success']);
                return redirect()->route('home.profile.index' , ['any'=>'orders']);
            }
        }


        alert()->error('درگاه پرداخت اشتباه است');
        return redirect()->back();

    }



    public function checkcart()
    {

        if (\Cart::isEmpty()) {
            return ['error' => 'سبد خرید شما خالی است'];
        }


        foreach (\Cart::getContent() as $item) {

            $variation = ProductVariation::find($item->attributes->id);

            $price = $variation->is_sale ? $variation->sale_price : $variation->price;

            if ($item->price != $price) {
                \Cart::remove($item->id);
                return ['error' => "قیمت محصول '$item->name' تغییر کرده است و از سبد خرید شما حذف شد"];
            }

            if ($item->quantity > $variation->quantity) {
                \Cart::remove($item->id);
                return ['error' => "تعداد محصول '$item->name' تغییر کرده است و از سبد خرید شما حذف شد"];
            }

            return ['success' => 'success'];
        }
    }


    public function getAmount()
    {
        if (session()->has('coupon')) {
            $checkcoupon = checkcoupon(session()->get('coupon.code'));
            if (array_key_exists('error', $checkcoupon)) {
                return $checkcoupon;
            }
        }


        return [
            'total_amount' => (cardtotalamount() + totalesaleamount()),
            'delivery_amount' => shiping(),
            'coupon_amount' => session()->has('coupon') ? session()->get('coupon.amount') : 0,
            'paying_amount' => finalamount(),
        ];
    }
}
