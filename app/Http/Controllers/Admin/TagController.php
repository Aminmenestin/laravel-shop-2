<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::paginate(10);

        $title = 'حذف تگ';
        $text = "ایا میخواهید این تگ را حذف کنید؟";
        confirmDelete($title, $text);

        return view('admin.tags.index' , compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | unique:tags,name',
        ]);

        Tag::create([
            'name' => $request->name,
        ]);

        alert()->success('تگ با موفقیت ایجاد شد');

        return  redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tag = Tag::find($id);

        return view('admin.tags.show' , compact('tag'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tag = Tag::find($id);

        return view('admin.tags.edit' , compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Tag::find($id)->update([
            'name' => $request->name,
        ]);

        alert()->success('تگ با موفقیت ایجاد شد');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Tag::find($id)->delete();

        alert()->success('تگ با موفقیت حذف شد');

        return redirect()->back();
    }
}
