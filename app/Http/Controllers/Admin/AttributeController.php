<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributes = Attribute::latest()->paginate(10);

        $title = 'حذف برند';
        $text = "ایا میخواهید این ویژگی را حذف کنید؟";
        confirmDelete($title, $text);


        return view('admin.attributes.index' , compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | unique:attributes,name',
        ]);

        Attribute::create([
            'name' => $request->name,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $attribute = Attribute::find($id);
        return view('admin.attributes.show' , compact('attribute'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $attribute = Attribute::find($id);
        return view('admin.attributes.edit' , compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required | unique:attributes,name',
        ]);

        Attribute::find($id)->update([
            'name' => $request->name,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Attribute::find($id)->delete();
        alert()->success('ویژگی حذف شد');
        return redirect()->back();
    }
}
