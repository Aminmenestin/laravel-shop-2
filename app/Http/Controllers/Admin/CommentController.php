<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(){

        $comments=Comment::latest()->paginate(10);

        // dd($comments);

        return view('admin.comments.index' , compact('comments'));
    }

    public function show(string $id){

        $comment = Comment::find($id);

        return view('admin.comments.show' , compact('comment'));

    }

    public function approve(string $id){

        $comment = Comment::find($id);

        $comment->update([
            'approved' => 1
        ]);

        alert()->success('کامنت تایید شد');

        return redirect()->route('admin.comments.index');

    }

    public function delete(string $id){

        $comment = Comment::find($id);

        $comment->update([
            'approved' => 0
        ]);

        alert()->warning('کامنت لغو تایید شد');

        return redirect()->route('admin.comments.index');

    }
}
