<?php

namespace App\Http\Controllers\Home;

use App\Models\User;
use App\Models\Order;
use App\Models\Comment;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        $comments = Comment::where('user_id', auth()->id())->where('approved', 1)->get();
        $orders = Order::where('user_id', auth()->id())->orderBy('created_at' , 'desc')->get();
        $addresses = UserAddress::where('user_id', auth()->id())->orderBy('created_at' , 'desc')->get();

        // dd($orders);

        return view('home.profile.index', compact('comments' , 'orders' , 'addresses'));
    }

    public function update(Request $request)
    {

        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required | email'
        ]);

        $user = User::find(auth()->id());

        $user->update([
            'name' => $request->firstName . $request->lastName,
            'email' => $request->email
        ]);


        return response('پروفایل شما اپدیت شد', 200);
    }


    public function addressCreate(Request $request)
    {

        $request->validate([

            'title' => 'required | unique:user_addresses,title',

            'number' => 'required',

            'province' => 'required',

            'city' => 'required',

            'address' => 'required',

            'postalCode' => 'required',

        ]);


        if (!auth()->check()) {
            return response(['error' => 'وارد سایت شوید']);
        }

        UserAddress::create([

            'title' => $request->title,

            'name' => auth()->user()->name,

            'number' => $request->number,

            'province_id' => $request->province,

            'city_id' => $request->city,

            'address' => $request->address,

            'postal_code' => $request->postalCode,

            'user_id' => auth()->id(),

        ]);

        return response(['success' => 'ادرس شما با موفقیت ذخیره شد'], 200);
    }
}
