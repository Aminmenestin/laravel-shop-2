<?php

namespace App\Http\Controllers\Home;

use Carbon\Carbon;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductVariation;

class HomeController extends Controller
{
    public function index()
    {

        // $t = ProductVariation::find(2);

        // dd($t->percentCounter);

        // foreach(\Cart::getContent() as $item){
        //     dd($item->attributes);
        // }

        // session()->flush();

        // dd(session()->get('compare'));

        $parent_categories = Category::where('parent_id', 0)->where('is_active', 1)->get();

        $sliders = Banner::where('is_active', 1)->orderBy('priority')->get();

        $products = Product::where('is_active', 1)->inRandomOrder()->get();

        // $product = Product::find(17);

        // dd($product->priceCheck);

        return view('home.index', compact('parent_categories', 'sliders', 'products'));
    }


    public function parent_categories()
    {
        return $parent_categories = Category::where('parent_id', 0)->where('is_active', 1)->get();
    }

    public function compare(string $id)
    {

        // dd($id);

        if (session()->has('compare')) {

            if(count(session('compare')) >= 3){
                alert()->warning('محصولات لیست مقایسه تکمیل است');

                return redirect()->back();
            }

            if (in_array($id, session('compare'))) {
                alert()->warning('این محصول در لیست مقایسه وجود دارد');

                return redirect()->back();
            } else {
                session()->push('compare', $id);
            }
        } else {
            session()->put('compare', [$id]);
        }

        alert()->success('محصول برای مقایسه اضاف شد');

        return redirect()->back();
    }


    public function compareIndex(){

        $products = Product::find(session()->get('compare'));

        return view('home.compare.index' , compact('products'));
    }

    public function delete(string $id){

        if(session()->has('compare')){
            foreach(session()->get('compare') as $key => $item){
                if($item == $id){
                    session()->pull('compare.' .$key );
                }
            }

            if(session()->get('compare') == []){
                session()->forget('compare');
            }

            alert()->success('محصول مورد نظر حذف شد');

            return redirect()->route('home.compare.index');

        }else{
            alert()->warning('ابتدا محصولی برای مقایسه اضافه کنید');

            return redirect()->back();
        }
    }
}
