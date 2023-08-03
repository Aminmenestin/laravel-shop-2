<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use RealRashid\SweetAlert\Facades\Alert;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

       $brands = Brand::latest()->paginate(10);

       $title = 'حذف برند';
       $text = "ایا میخواهید این برند را حذف کنید؟";
       confirmDelete($title, $text);


        return view('admin.brands.index' , compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required | unique:brands,name',
            'is_active' => 'required',
        ]);

         Brand::create([
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $brand = Brand::find($id);
        return view('admin.brands.show' , compact('brand'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::find($id);

        return view('admin.brands.edit' , compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'is_active' => 'required',
        ]);

         Brand::find($id)->update([
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Brand::find($id)->delete();
        alert()->success('برند حذف شد');
        return redirect()->back();
    }
}
