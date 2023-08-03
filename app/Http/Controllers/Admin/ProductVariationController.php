<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductVariation;
use Illuminate\Http\Request;

class ProductVariationController extends Controller
{
    public function store($variations , $attribute_variation , $product){

        // dd($variations);

        $counter = $variations['value'];

        for ($i = 0; $i < count($counter); $i++) {

            ProductVariation::create([
                'attribute_id' => $attribute_variation->id,
                'product_id' => $product->id,
                'price' => $variations['price'][$i],
                'value' => $variations['value'][$i],
                'quantity' => $variations['quantity'][$i],
                'sku' => $variations['sku'][$i],
            ]);
          };

    }


    public function update($variation_values){

        // dd($variation_values);

        foreach($variation_values as $key => $value){

            $variation = ProductVariation::find($key);

            $variation->update([
                'price' => $value['price'],
                'quantity' => $value['quantity'],
                'sku' => $value['sku'],
                'sale_price' => $value['sale_price'],
                'date_on_sale_from' => $value['date_on_sale_from'],
                'date_on_sale_to' => $value['date_on_sale_to'],
            ]);

        }

    }
}
