<?php

namespace App\Http\Controllers;

use App\Events\ActivityEvent;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request){
        $post_id = substr(url()->previous(),27);
        $validatedData = $request->validate([
            'comment'=> 'required|max:200',
            ]);
        $a = new Comment;
        $a->user_id = Auth::user()->id;
        $a->user = Auth::user()->name;
        $a->content = $validatedData['comment'];
        $a->post_id = $post_id;
        $a->save();
        //event(new ActivityEvent('haha',$a->user));
        session()->flash('message','Comment made');
        return redirect()->route('home');
    }
    public function multi_store(Request $request){

        $multi_post_id = substr(url()->previous(),33);//33
        $validatedData = $request->validate([
            'comment'=> 'required|max:200',
            ]);
        $a = new Comment;
        $a->user_id = Auth::user()->id;
        $a->user = Auth::user()->name;
        $a->content = $validatedData['comment'];
        $a->multi_post_id=$multi_post_id;
        $a->save();
        session()->flash('message','Comment made');
        return redirect()->route('home');
    }
    public function deleteStore(){
        $comment_id = substr(url()->previous(),35);
        $comment = Comment::findOrFail($comment_id);
        $comment->delete();
        session()->flash('message','Comment deleted');
        return redirect()->route('home');
    }
    public function edit(Post $post, Comment $comment){
        $comments = Comment::all();
        return view('editComment',['post'=>$post,'comments'=>$comments,'comment'=>$comment]);
    }
    public function editStore(Request $request,Comment $comment){
        $comment_id = substr(url()->previous(),-2);
        $comment = Comment::findOrFail($comment_id);
        $validatedData = $request->validate([
            'content'=> 'required|max:200',
            ]);
        $comment->content=$validatedData['content'];
        $comment->save();
        session()->flash('message','Comment edited');
        return redirect()->route('home');
    }
}



