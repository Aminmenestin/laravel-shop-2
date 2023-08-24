<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use App\Http\Controllers\Controller;

class ProductAttributeController extends Controller
{
    public function store($attributes, $product){

        foreach($attributes as $key => $value){
            ProductAttribute::create([
                'attribute_id' =>$key,
                'product_id' =>$product->id,
                'value' =>$value,
            ]);
            }
    }


    public function update($attribute_values){


        foreach($attribute_values as $key => $value){

            $attribute= ProductAttribute::findOrfail($key);
            $attribute->update([
                'value' => $value[0]
            ]);

        }
    }

    public function change($attributes, $product)
    {
        ProductAttribute::where('product_id' , $product->id)->delete();
        foreach ($attributes as $key => $value) {
            ProductAttribute::create([
                'product_id' => $product->id,
                'attribute_id' => $key,
                'value' => $value,
            ]);
        }
    }
}
