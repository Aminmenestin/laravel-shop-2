<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Provinces;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){


        if(!auth()->check()){
            alert()->warning('ابتدا وارد سایت شوید');
            return redirect()->back();
        }

        if(\Cart::isEmpty()){
            return redirect()->back();
        }


        $userAddresses = UserAddress::where('user_id' , auth()->id())->get();

        $provinces = Provinces::all();

        return view('home.orders.index' , compact('userAddresses' , 'provinces'));
    }

    public function citiesInfo(Request $request){

        $cities = Provinces::where('parent' , $request->provindeId)->get(['id' , 'title']);

        return $cities;
    }
}
