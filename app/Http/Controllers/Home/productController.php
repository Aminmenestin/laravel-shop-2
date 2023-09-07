<?php

namespace App\Http\Controllers\Home;

use App\Models\Comment;
use App\Models\Product;
use App\Models\ProductRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class productController extends Controller
{
    public function index(Request $request, Product $product)
    {

        if ($request->method() == 'GET') {
            $products = Product::where('is_active', 1)->inRandomOrder()->get();
            return view('home.products.details', compact('products', 'product'));
        }

        if (!auth()->check()) {
            return response(['errors' => ['auth' => 'لطفا ابتدا وارد سایت شوید']], 422);
        } else {

            $request->validate([
                'rate' => 'required | digits_between:1,5',
                'comment' => 'required | min:5 | max:7000'
            ]);


            try {
                DB::beginTransaction();

                $comment = Comment::create([
                    'user_id' => auth()->id(),
                    'product_id' => $product->id,
                    'text' => $request->comment,
                ]);

                ProductRate::create([
                    'user_id' => auth()->id(),
                    'product_id' => $product->id,
                    'comment_id' => $comment->id,
                    'rate' => $request->rate
                ]);

                DB::commit();
            } catch (\Exception $ex) {
                DB::rollBack();
                return response(['error' => $ex->getMessage()], 421);
            }
        }
    }
}
