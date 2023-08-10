<?php

namespace App\Http\Controllers\Home;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function index(Category $category){


        if($category->parent_id == 0){
            abort(404);
        }

        $products = $category->products()->paginate(50);

        $parent_category = $category->parent;


        return view('home.categories.shop' , compact('products' , 'parent_category' , 'category'));
    }
}
