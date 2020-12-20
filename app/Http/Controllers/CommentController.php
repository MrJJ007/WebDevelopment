<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\User;
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
        $post_id = substr(url()->previous(),-1);
        $validatedData = $request->validate([
            'comment'=> 'required|max:200',
            ]);
        $a = new Comment;
        $a->user_id = Auth::user()->id;
        $a->user = Auth::user()->name;
        $a->content = $validatedData['comment'];
        $a->post_id = $post_id;
        $a->save();
        session()->flash('message','Comment made');
        //$url = '127.0.0.1/post/'.$post_id;
        return redirect()->route('home');
    }
    public function edit(Post $post, Comment $comment){
        $comments = Comment::all();
        return view('editComment',['post'=>$post,'comments'=>$comments,'comment'=>$comment]);
    }
    public function editStore(Request $request,Comment $comment){
        $comment_id = substr(url()->previous(),-2);
        $comment = Comment::findOrFail($comment_id);
        $post_id = $comment->post_id;//substr(url()->previous(),-1);

        $post = 1;//Post::findOrFail($post_id);
        $comments = Comment::all();

        $comment->delete();

        $validatedData = $request->validate([
            'content'=> 'required|max:200',
            ]);

        $a=new Comment;
        $a->post_id = $post_id;
        $a->user_id = Auth::user()->id;// need to access user id
        $a->user = Auth::user()->name;// need to access user name

        $a->content=$validatedData['content'];
        $a->save();

        session()->flash('message','Comment edited');
        return redirect()->route('home');
    }
}



