<?php

namespace App\Http\Controllers\Home;

use Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductVariation;

class CardController extends Controller
{

    public function index()
    {
        return view('home.cart.index');
    }

    public function add(Request $request)
    {


        $request->validate([
            'variation' => 'required',
            'qtybutton' => 'required | integer',
            'productId' => 'required',
        ]);


        $product = Product::findOrfail($request->productId);
        $productVariation = ProductVariation::findOrfail(json_decode($request->variation)->id);

        if ($request->qtybutton > $productVariation->quantity) {
            alert()->error('تعداد وارد شده محصول نادرست است');
            return redirect()->back();
        }


        $rowId = $product->id . '-' . $productVariation->id;


        if (Cart::get($rowId) == null) {

            Cart::add(array(
                'id' => $rowId,
                'name' => $product->name,
                'price' => $productVariation->is_sale ? $productVariation->sale_price : $productVariation->price,
                'quantity' => $request->qtybutton,
                'attributes' => $productVariation->toArray(),
                'associatedModel' => $product
            ));



            alert()->success('محصول به سبد خرید اضافه شد');
            return redirect()->back();
        } else {
            alert()->warning('این محصول در سبد خرید وجود دارد');
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        $item = Cart::get($request->cartId);


        if ($request->quantity > $item->attributes->quantity) {
            return response('no', 402);
        } else {
            if ($request->type == 'plus') {

                Cart::update($request->cartId, array(
                    'quantity' => +1,
                ));
            } else {

                Cart::update($request->cartId, array(
                    'quantity' => -1,
                ));
            }


            return response(\Cart::getContent(), 200);
        }
    }

    public function delete(string $id)
    {
        if (\Cart::get($id)) {

            \Cart::remove($id);

            if(\Cart::getContent()->first() == null){
                session()->forget('coupon');
            }
            alert()->warning('محصول از سبد خرید حذف شد');
            return redirect()->back();
        }
        else{
            alert()->error('این محصول در سبد خرید وجود ندارد');
            return redirect()->back();
        }
    }

    public function clear(){
        \Cart::clear();
        session()->forget('coupon');
        alert()->warning('سبد خرید شما پاک شد');
        return redirect()->back();
    }


    public function couponcheck(Request $request){
        $request->validate([
            'coupon' => 'required'
        ]);

        $result = checkcoupon($request->coupon);

        if(array_key_exists('error' , $result )){
            alert()->error($result['error']);
        }
        else{
            alert()->success($result['success']);
        }

        return redirect()->back();
    }


    public function info(){
        return ['shiping' => shiping() , 'totalamount' => cardtotalamount() , 'totalesaleamount' => totalesaleamount() , 'finalamount' => finalamount()];
    }

}
