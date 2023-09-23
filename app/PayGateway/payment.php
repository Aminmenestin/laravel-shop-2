<?php

namespace App\PayGateway;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItems;
use App\Models\Transactions;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\DB;

class payment
{

    public function createorder($addressId, $amounts, $token, $gateway_name)
    {


        try {
            DB::beginTransaction();

            $order = Order::create([
                'user_id' => auth()->id(),
                'address_id' => $addressId,
                'coupon_id' => session()->has('coupon') ? session()->get('coupon.id') : null,
                'total_amount' => $amounts['total_amount'],
                'delivery_amount' => $amounts['total_amount'],
                'coupon_amount' => $amounts['coupon_amount'],
                'paying_amount' => $amounts['paying_amount'],
                'payment_type' => 'online',
            ]);



            foreach (\Cart::getContent() as $item) {
                OrderItems::create([
                    'order_id' => $order->id,
                    'product_id' => $item->associatedModel->id,
                    'product_variation_id' => $item->attributes->id,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'subtotal' => ($item->price * $item->quantity),
                ]);
            }

            if (!Transactions::where('user_id', auth()->id())->where('token', $token)->where('status', 1)->first()) {
                Transactions::create([
                    'user_id' => auth()->id(),
                    'order_id' => $order->id,
                    'amount' => $amounts['paying_amount'],
                    'token' => $token,
                    'gateway_name' => $gateway_name
                ]);
            }



            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return ['error' => 'مشکل در مراجعه به صفحه پرداخت'];
        }

        return ['success' => 'success'];
    }



    public function updateorder($token, $refId)
    {
        try {
            DB::beginTransaction();

            $transaction = Transactions::where('token', $token)->firstOrFail();

            $transaction->update([
                'ref_id' => $refId,
                'status' => 1
            ]);

            $order = Order::findOrFail($transaction->order_id);

            $order->update([
                'status' => 1,
            ]);

            foreach (\Cart::getContent() as $item) {

                $variation = ProductVariation::find($item->attributes->id);

                $variation->update([
                    'quantity' => ($variation->quantity - $item->quantity),
                ]);

                if($variation->quantity == 0){
                    $product = Product::find($item->associatedModel->id);
                    $product->update([
                        'status' => 0,
                    ]);
                }

            }
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return ['error' => 'مشکل در مراجعه به صفحه پرداخت'];
        }

        return ['success' => 'success'];
    }
}
