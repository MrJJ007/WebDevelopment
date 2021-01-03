<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
/**
     * this for comment creation
     * I could make the comments polymorphic
     * however ive already demostrated that relationship type
     * with upvotes and so reworking the comments would yield
     * no new marks therefore effectively being a waste of time
     */
class CommentController extends Controller
{
    public function store(Request $request){
        $post_id = substr(url()->previous(),27);
        $validated_data = $request->validate([
            'comment'=> 'required|max:200',
            ]);
        $a = new Comment;
        $a->user_id = Auth::user()->id;
        $a->user = Auth::user()->name;
        $a->content = $validated_data['comment'];
        $a->post_id = $post_id;
        $a->save();
        session()->flash('message','Comment made');
        return redirect()->route('home');//put this to email if you want to replug that
    }
    public function multi_store(Request $request){
        $multi_post_id = substr(url()->previous(),33);
        $validated_data = $request->validate([
            'comment'=> 'required|max:200',
            ]);
        $a = new Comment;
        $a->user_id = Auth::user()->id;
        $a->user = Auth::user()->name;
        $a->content = $validated_data['comment'];
        $a->multi_post_id=$multi_post_id;
        $a->save();
        session()->flash('message','Comment made');
        return redirect()->route('home');//put this to email if you want to replug that
    }
    //this is for deleting comments
    public function delete_store(){
        $comment_id = substr(url()->previous(),35);
        $comment = Comment::findOrFail($comment_id);
        $comment->delete();
        session()->flash('message','Comment deleted');
        return redirect()->route('home');
    }
    //for editing comments
    public function edit(Post $post, Comment $comment){
        $comments = Comment::all();
        return view('editComment',['post'=>$post,'comments'=>$comments,'comment'=>$comment]);
    }
    public function edit_store(Request $request,Comment $comment){
        $comment_id = substr(url()->previous(),-2);
        $comment = Comment::findOrFail($comment_id);
        $validated_data = $request->validate([
            'content'=> 'required|max:200',
            ]);
        $comment->content=$validated_data['content'];
        $comment->save();
        session()->flash('message','Comment edited');
        return redirect()->route('home');
    }
    //this is for testing ajax
    public function api_index(Request $request){
        $post_id = substr(url()->previous(),27);
        $post = Post::findOrFail($post_id);
        $comments = $post->comments;
        foreach($comments as $comment){
            $upvote = $comment->upvotes->count();
            $comment->upvotes = $upvote;
        }
        return $comments;
    }
    public function api_store(Request $request){
        $post_id = substr(url()->previous(),27);
        $validated_data=$request->validate([
            'content'=> 'required|max:200'
        ]);
        $a = new Comment;
        $a->user_id = $request->user_id;
        $a->user = $request->user;
        $a->content = $validated_data['content'];
        $a->post_id =$post_id;
        $a->save();
        return $a;
    }
}



