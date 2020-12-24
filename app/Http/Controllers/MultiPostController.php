<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\MultiPost;
use Illuminate\Http\Request;

class MultiPostController extends Controller
{
    public function multi_post_show(){
        $multi_post_id = substr(url()->current(),33);
        $multi_post = MultiPost::findOrFail($multi_post_id);
        $comments = Comment::all();//this should probs be changed to only parse the needed comments
        return view('multiPost',['multi_post'=>$multi_post,'comments'=>$comments]);
    }

    public function multi_delete_store(){
        $multi_post_id = substr(url()->previous(),38);
        $multi_post = MultiPost::findOrFail($multi_post_id);
        $multi_post->delete();
        session()->flash('message','Multi Post deleted');
        return redirect()->route('home');
    }

    public function multi_edit(){
        $comments = Comment::all();//this should probs be changed to only parse the needed comments
        $multi_post_id = substr(url()->previous(),33);
        $multi_post = MultiPost::findOrFail($multi_post_id);
        return view('editMultiPost',['multi_post'=>$multi_post,'comments'=>$comments]);
    }

    public function multi_edit_store(Request $request){
        $multi_post_id = substr(url()->previous(),38);
        $multi_post = MultiPost::findOrFail($multi_post_id);
        $validatedData = $request->validate([
            'content'=> 'required|max:200',
            ]);
        $multi_post->content=$validatedData['content'];
        $multi_post->save();
        session()->flash('message','Post edited');
        return redirect()->route('home');
    }
}
