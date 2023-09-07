<?php

namespace App\Http\Controllers\Home;
use Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductVariation;

class CardController extends Controller
{
    public function add(Request $request){

        $request->validate([
            'variation' => 'required',
            'qtybutton' => 'required | integer',
            'productId' => 'required',
        ]);


        $product = Product::findOrfail($request->productId);
        $productVariation = ProductVariation::findOrfail(json_decode($request->variation)->id);


        if($request->qtybutton > $productVariation->quantity){
            alert()->error('تعداد وارد شده محصول نادرست است');
            return redirect()->back();
        }


        $rowId = $product->id .'-'. $productVariation->id;


        if(Cart::get($rowId) == null){

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

        }
        else{
            alert()->error('این محصول در سبد خرید وجود دارد');
            return redirect()->back();
        }



    }



}
