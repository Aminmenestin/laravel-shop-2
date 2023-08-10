<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $parent_categories = Category::where('parent_id' , 0)->where('is_active' , 1)->get();

        $sliders = Banner::where('is_active' , 1)->orderBy('priority')->get();

        $products = Product::where('is_active' , 1)->inRandomOrder()->get();

        return view('home.index' , compact('parent_categories' , 'sliders' , 'products'));
    }


    public function parent_categories(){
        return $parent_categories = Category::where('parent_id' , 0)->where('is_active' , 1)->get();
    }
}
