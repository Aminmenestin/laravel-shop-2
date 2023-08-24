<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductImages;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductImageController extends Controller
{

    public function upload($primary_image , $images){

        $fileNameImagePrimary = generateFileName($primary_image->getClientOriginalName());

        $primary_image->move(public_path(env('PRODUCT_IMAGES_UPLOAD_PATH')) ,  $fileNameImagePrimary);


        if($images != null){

            $allImages = [];
            foreach($images as $image){
                $image->move(public_path(env('PRODUCT_IMAGES_UPLOAD_PATH')) ,  generateFileName($image));
                array_push($allImages , generateFileName($image));
            }

            return [ 'primary_image' => generateFileName($primary_image ) , 'images'=> $allImages];
        }

        return [ 'primary_image' => generateFileName($primary_image ) , 'images'=> null];
    }



    public function edit(Product $product){


        $product = Product::find($product)->first();

        $title = 'حذف عکس';
        $text = "ایا میخواهید این عکس را حذف کنید؟";
        confirmDelete($title, $text);

        return view('admin.products.edit_images' , compact('product'));

    }


    public function add(Request $request , Product $product){

        $request->validate([
            'primary_image' => 'nullable|mimes:jpg,JPG,jpeg,png,PNG,svg,webp',
            'images.*' => 'nullable|mimes:jpg,JPG,jpeg,png,PNG,svg,webp',
        ]);

        if ($request->primary_image == null && $request->images == null) {
            alert()->error('تصویر یا تصاویر محصول الزامی است');
            return redirect()->back();
        }

        try {
            DB::begintransaction();

            if($request->has('primary_image')){

                $fileNameImagePrimary = generateFileName($request->primary_image->getClientOriginalName());

                $request->primary_image->move(public_path(env('PRODUCT_IMAGES_UPLOAD_PATH')) ,  $fileNameImagePrimary );

                $product->update([
                    'primary_image' => $fileNameImagePrimary
                ]);
            }


            if($request->has('images')){
                foreach($request->images as $image){

                    $fileNameImage =generateFileName($image->getClientOriginalName());

                    $image->move(public_path(env('PRODUCT_IMAGES_UPLOAD_PATH')), $fileNameImage);

                    ProductImages::create([
                        'product_id' => $product->id,
                        'image' => $fileNameImage,
                    ]);
                }
            }

            DB::commit();

            alert()->success('اپدیت موفق');
            return redirect()->back();


        } catch (\Exception $ex) {
            DB::rollBack();
            alert()->error('مشکل اپدیت تصویر', $ex->getMessage())->persistent('حله');
            return redirect()->back();
        }

    }

    public function delete(Product $product , ProductImages $image_id){

        ProductImages::find($image_id->id)->delete();

        alert()->success('عکس حذف شد');

        return redirect()->back();


    }


    public function set_primary(Request $request , Product $product){

        $image = ProductImages::find($request->image_id)->image;

        $product->update([
            'primary_image' => $image ,
        ]);

        alert()->success('عکس اصلی اپدیت شد');

        return redirect()->back();
    }
}
