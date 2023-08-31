<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductVariation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductVariationController extends Controller
{
    public function store($variations, $attribute_variation, $product)
    {
        $counter = $variations['name'];

        for ($i = 0; $i < count($counter); $i++) {

            ProductVariation::create([
                'attribute_id' => $attribute_variation->id,
                'product_id' => $product->id,
                'value' => $variations['name'][$i],
                'price' => $variations['price'][$i],
                'quantity' => $variations['quantity'][$i],
                'sku' => $variations['sku'][$i],
            ]);
        };
    }


    public function update($variation_values)
    {
        foreach ($variation_values as $key => $value) {

            $variation = ProductVariation::find($key);

            $variation->update([
                'price' => $value['price'],
                'quantity' => $value['quantity'],
                'sku' => $value['sku'],
                'sale_price' => $value['sale_price'],
                'date_on_sale_from' => $value['date_on_sale_from'] == null ? $variation->date_on_sale_from : convertTime($value['date_on_sale_from']),
                'date_on_sale_to' =>  $value['date_on_sale_to'] == null ? $variation->date_on_sale_to : convertTime($value['date_on_sale_to']),
                'is_sale' => $value['sale_price'] != null  && $variation['date_on_sale_from'] != null && $variation['date_on_sale_to'] !=null ?  1 : 0,
            ]);
        }
    }

    public function change($variation_values, $attributeId, $product)
    {
        ProductVariation::where('product_id', $product->id)->delete();

        $counter = count($variation_values['value']);

        for ($i = 0; $i < $counter; $i++) {
            ProductVariation::create([
                'attribute_id' => $attributeId,
                'product_id' => $product->id,
                'value' => $variation_values['value'][$i],
                'price' => $variation_values['price'][$i],
                'quantity' => $variation_values['quantity'][$i],
                'sku' => $variation_values['sku'][$i],
            ]);
        }
    }
}
