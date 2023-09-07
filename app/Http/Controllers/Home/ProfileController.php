<?php

namespace App\Http\Controllers\Home;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index(){
        $comments = Comment::where('user_id' , auth()->id())->where('approved' , 1)->get();

        return view('home.profile.index' , compact('comments'));
    }

    public function update(Request $request){

        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required | email'
        ]);

        $user = User::find(auth()->id());

        $user->update([
            'name' => $request->firstName . $request->lastName ,
            'email' => $request->email
        ]);


        return response('پروفایل شما اپدیت شد' , 200);
    }
}
