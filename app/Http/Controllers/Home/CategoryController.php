<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Request $request , Category $category){

        $products = $category->products()->where('is_active' , 1)->filter()->search()->paginate(10);

        // dd($products);

        $attributes = $category->attributes()->where('is_filter' , 1)->where('is_variation' , 0)->with('attribiuteValue')->get();

        $variation = $category->attributes()->where('is_filter' , 1)->where('is_variation' , 1)->with('variationValue')->first();

        return view('home.categories.show' , compact('products' , 'attributes' , 'variation' , 'category'));
    }
}
