<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImages;
use App\Models\ProductTag;
use App\Models\ProductVariation;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();

        $tags = Tag::all();

        $categories = Category::where('is_active', 1)->where('parent_id', '!=', 0)->get();

        return view('admin.products.create', compact('brands', 'tags', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            "brand_id" => 'required',
            "tag_ids" => 'required',
            "is_active" => 'required',
            "description" => 'required',
            "primary_image" => 'required | mimes:jpg,jpeg,png,svg,webp',
            "images" => 'nullable',
            "images.*" => 'mimes:jpg,jpeg,png,svg,webp',
            "category_id" => 'required',
            "attribute_ids" => 'required',
            "attribute_ids.*" => 'required',
            'variation_value' => 'required',
            'variation_value.*.*' => 'required',
            'variation_value.price.*' => 'integer',
            'variation_value.quantity.*' => 'integer',
            "delivery_amount" => 'required | integer',
            "delivery_amount_per_product" => 'nullable | integer',
        ]);


        try {
            DB::beginTransaction();


            $productImageController =  new ProductImageController;

            $fileNameImages =  $productImageController->upload($request->primary_image, $request->images);



            $product = Product::create([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'primary_image' => $fileNameImages['primary_image'],
                'description' => $request->description,
                'is_active' => $request->is_active,
                'delivery_amount' => $request->delivery_amount,
                'delivery_amount_per_product' => $request->delivery_amount_per_product,
            ]);


            if ($fileNameImages['images'] != null) {

                foreach ($fileNameImages['images'] as $image) {
                    ProductImages::create([
                        'product_id' => $product->id,
                        'image' => $image
                    ]);
                }
            }


            $ProductAttributeController = new ProductAttributeController;

            $ProductAttributeController->store($request->attribute_ids, $product);


            $category = Category::find($request->category_id);


            $ProductVariationController = new ProductVariationController;
            $ProductVariationController->store($request->variation_value, $category->attributes()->wherePivot('is_variation', 1)->first(), $product);

            $product->tags()->attach($request->tag_ids);


            DB::commit();

            alert()->success('محصول با موفقیت ایجاد شد');

            return redirect()->back();
        } catch (\Exception  $ex) {
            DB::rollBack();

            alert()->error('خطا در ایحاد محصول', $ex->getMessage())->persistent('حله');

            return redirect()->back();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);

        return view('admin.products.show' , compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {

        $brands = Brand::all();
        $tags = Tag::all();
        $productAttributes = $product->attributes()->with('attribute')->get();
        $productVariations = $product->variations;

        return view('admin.products.edit', compact('product', 'brands', 'tags', 'productAttributes', 'productVariations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        // dd($request->all());

        $request->validate([
            'name' => 'required',
            "brand_id" => 'required',
            "tag_ids" => 'required',
            "is_active" => 'required',
            "description" => 'required',
            'delivery_amount' => 'required | integer',
            'delivery_amount_per_product' => 'required | integer',
            'attribute_values.*' => 'required',
            'variation_values.*' => 'required',
            'variation_values.*.price' => 'required | integer',
            'variation_values.*.quantity' => 'required | integer',
            'variation_values.*.sku' => 'required',
            'variation_values.*.sale_price' => 'nullable | integer',
            'variation_values.*.date_on_sale_from' => 'nullable | date',
            'variation_values.*.date_on_sale_to' => 'nullable | date',
        ]);

        // dd($request->all());

        $product = Product::find($id);



        try {

            DB::beginTransaction();

            $product->update([
                'name' => $request->name,
                'brand_id' => $request->brand_id,
                'is_active' => $request->is_active,
                'description' => $request->description,
                'delivery_amount' => $request->delivery_amount,
                'delivery_amount_per_product' => $request->delivery_amount_per_product,
            ]);



            $ProductAttributeController = new ProductAttributeController;
            $ProductAttributeController->update($request->attribute_values);

            $ProductVariationController = new ProductVariationController;
            $ProductVariationController->update($request->variation_values);

            $product->tags()->sync($request->tag_ids);

            DB::commit();


            alert()->success('محصول با موفقیت ویرایش شد');

            return redirect()->back();
        } catch (\Exception  $ex) {
            DB::rollBack();

            alert()->error('خطا در ویرایش محصول', $ex->getMessage())->persistent('حله');

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }



    public function category_edit(Product $product)
    {

        $categories = Category::where('parent_id', '!=', 0)->where('is_active', 1)->get();

        // dd($categories);

        return view('admin.products.edit_category', compact('product', 'categories'));
    }

    public function category_update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required',
            'attribute_ids' => 'required',
            'attribute_ids.*' => 'required',
            'variation_values' => 'required',
            'variation_values.*.*' => 'required',
            'variation_values.price.*' => 'integer',
            'variation_values.quantity.*' => 'integer',
        ]);

        try {
            DB::beginTransaction();

            $product->update([
                'category_id' => $request->category_id,
            ]);


            $ProductAttributeController = new ProductAttributeController;

            $ProductAttributeController->change($request->attribute_ids, $product);


            $category = Category::find($request->category_id);

            $ProductVariationController = new ProductVariationController;

            $ProductVariationController->change($request->variation_values, $category->attributes()->wherePivot('is_variation', 1)->first()->id, $product);

            DB::commit();

            alert()->success('دسته بندی با موفقیت ویرایش شد');

            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            alert()->error($ex->getMessage())->persistent();
            return redirect()->back();
        }
    }
}
