<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class BasicPostController extends Controller
{
    public function show(Post $post){
        $comments=$post->comments;
        return view('post',['post'=>$post,'comments'=>$comments]);
    }
    //this for deleting posts
    public function delete_store(Request $request){
        $post = Post::findOrFail($request->post);
        $post->delete();
        session()->flash('message','Post deleted');
        return redirect()->route('home');
    }
    //this for showing the edit screen
    public function edit(Post $post){
        $comments=$post->comments;
        return view('editPost',['post'=>$post,'comments'=>$comments]);
    }
    //this called when you push the edit
    public function edit_store(Request $request){
        $post_id = substr(url()->previous(),32);
        $post = Post::findOrFail($post_id);
        $validated_data = $request->validate([
            'content'=> 'required|max:200',
            ]);
        $post->content=$validated_data['content'];
        $post->save();
        session()->flash('message','Post edited');
        return redirect()->route('home');
    }
}
