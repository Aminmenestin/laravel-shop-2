<?php

namespace App\Http\Controllers\Admin;

use Error;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rules\Exists;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);

        return view('admin.categories.index' , compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentCategories = Category::where('parent_id' , 0)->where('is_active' , 1)->get();

        $attributes = Attribute::get();

        return view('admin.categories.create' , compact('attributes' , 'parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();

        $request->validate([
            'name' => 'required',
            'slug' => 'required | unique:categories,slug',
            'attribute_ids' => 'required',
            'attribute_is_filter_ids' => 'required',
            'variation_id' => 'required',
        ]);


        try {

            DB::beginTransaction();

            $category = Category::create([
                 'name' => $request->name,
                 'slug' => $request->slug,
                 'parent_id' => $request->parent_id,
                 'description' => $request->description,
                 'icon' => $request->icon,
                 'is_active' => $request->is_active,
             ]);

             foreach($request->attribute_ids as $attributeid){

                $attribute = Attribute::findOrFail($attributeid);

                $attribute->categories()->attach($category->id , [
                    'is_filter' => in_array($attributeid , $request->attribute_is_filter_ids) ? 1 : 0 ,
                    'is_variation' => $request->variation_id == $attributeid ? 1 : 0 ,
                ]);

             }

             DB::commit();
        } catch (\Exception  $ex) {
            DB::rollBack();

            $error = \Illuminate\Validation\ValidationException::withMessages([
                'error' => [$ex->getMessage()],
             ]);

             throw $error;

        }




    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);

        return view('admin.categories.show' , compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);

        // dd($category->attributes()->pluck('id')->toArray());

        $parentCategories = Category::where('parent_id' , 0)->where('is_active' , 1)->get();


        $attributes = Attribute::get();

        return view('admin.categories.edit' , compact('category' , 'parentCategories' , 'attributes'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {


        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'attribute_ids' => 'required',
            'attribute_is_filter_ids' => 'required',
            'variation_id' => 'required',
        ]);


        try {

            DB::beginTransaction();

            $category->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'parent_id' => $request->parent_id,
                'is_active' => $request->is_active,
                'icon' => $request->icon,
                'description' => $request->description,
            ]);

            $category->attributes()->detach();

             foreach($request->attribute_ids as $attributeid){

                $attribute = Attribute::findOrFail($attributeid);

                $attribute->categories()->attach($category->id, [
                    'is_filter' => in_array($attributeid , $request->attribute_is_filter_ids) ? 1 : 0 ,
                    'is_variation' => $request->variation_id == $attributeid ? 1 : 0 ,
                ]);

             }

             DB::commit();
        } catch (\Exception  $ex) {
            DB::rollBack();

            $error = \Illuminate\Validation\ValidationException::withMessages([
                'error' => [$ex->getMessage()],
             ]);
             throw $error;


        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }



    public function updateParentCategory(){

        $parentCategories = Category::where('parent_id' , 0)->where('is_active' , 1)->get();

        return response()->json($parentCategories);
    }


    public function getCategoryAttributes(Category $category){

        $attributes = $category->attributes()->wherePivot('is_filter' , 1)->wherePivot('is_variation' , 0)->get();
        $variation = $category->attributes()->wherePivot('is_variation' , 1)->first();



        return  ['attributes' => $attributes , 'variation' => $variation];
    }

}
