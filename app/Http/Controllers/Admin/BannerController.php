<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::latest()->paginate(10);

        $title = 'حذف بنر';
        $text = "ایا میخواهید این بنر را حذف کنید؟";
        confirmDelete($title, $text);

        return view('admin.banners.index' , compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'priority' => 'required | integer',
            'banner_position' => 'required | integer',
            'image' => 'required | mimes:png,jpg,webp,svg',
        ]);

         $fileNameImage = generateFileName($request->image->getClientOriginalName());
         $request->image->move(public_path(env('BANNER_UPLOAD_PATH') ), $fileNameImage);

         Banner::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $fileNameImage,
            'button' => $request->button,
            'banner_position' => $request->banner_position,
            'priority' => $request->priority,
            'is_active' => $request->is_active,
         ]);

         alert()->success('بنر با موفقیت ایجاد شد');

         return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $banner = Banner::find($id);

        return view('admin.banners.edit' , compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'image' => 'mimes:png,jpg,webp,svg',
            'priority' => 'integer',
            'banner_position' => 'integer'
        ]);

        $banner = Banner::find($id);

        if($request->image != null){

            $fileNameImage = generateFileName($request->image->getClientOriginalName());

            $request->image->move(  public_path(env('BANNER_UPLOAD_PATH')) , $fileNameImage  );

            $banner->update([
                'image' => $fileNameImage,
            ]);

        }

        $banner->update([
            'title' => $request->title,
            'description' => $request->description,
            'button' => $request->button,
            'banner_position' => $request->banner_position,
            'priority' => $request->priority,
            'is_active' => $request->is_active,
        ]);

        alert()->success('بنر با موفقیت ویرایش شد');

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::find($id);

        $banner->delete();

        alert()->success('بنر با موفقیت حذف شد');

        return redirect()->back();
    }
}
