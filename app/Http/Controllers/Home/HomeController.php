<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $parent_categories = Category::where('parent_id' , 0)->where('is_active' , 1)->get();

        $sliders = Banner::where('is_active' , 1)->orderBy('priority')->get();

        // $cat = Category::find(3);

        // dd($cat->children);

        return view('home.index' , compact('parent_categories' , 'sliders'));
    }
}
