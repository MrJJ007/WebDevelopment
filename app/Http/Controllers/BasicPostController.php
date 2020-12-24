<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class BasicPostController extends Controller
{
    public function show(Post $post){
        $comments = Comment::all();//this should probs be changed to only parse the needed comments
        return view('post',['post'=>$post,'comments'=>$comments]);
    }

    public function delete_store(){
        $post_id = substr(url()->previous(),32);
        $post = Post::findOrFail($post_id);
        $post->delete();
        session()->flash('message','Post deleted');
        return redirect()->route('home');
    }

    public function edit(Post $post){
        $comments = Comment::all();//this should probs be changed to only parse the needed comments
        return view('editPost',['post'=>$post,'comments'=>$comments]);
    }

    public function edit_store(Request $request){
        $post_id = substr(url()->previous(),32);
        $post = Post::findOrFail($post_id);
        $validatedData = $request->validate([
            'content'=> 'required|max:200',
            ]);
        $post->content=$validatedData['content'];
        $post->save();
        session()->flash('message','Post edited');
        return redirect()->route('home');
    }
}
