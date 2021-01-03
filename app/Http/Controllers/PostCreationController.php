<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\MultiPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Traits\UploadTrait;

class PostCreationController extends Controller
{
    use UploadTrait;

    public function create(){
        return view('createp');
    }

    public function store(Request $request){
        $validated_data = $request->validate([
            'content'=> 'required|max:200',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
        //this for multiposts
        if ($request->multi_post == "multi_post") {
            $a = new MultiPost;
            $a->user_id = Auth::user()->id;
            $a->users = Auth::user()->name;
            $a->content = $validated_data['content'];
            $a->save();
            session()->flash('message','Multi Post made');
            return redirect()->route('home');
        }
        //this for posts with/out images
        $a = new Post;
        $a->user_id = Auth::user()->id;
        $a->user = Auth::user()->name;
        $a->content = $validated_data['content'];
        if ($request->has('image')){
            $image = $request->file('image');
            $name=Str::slug($request->input('name')).'_'.time();
            $folder = '/images/';
            $file_path = 'storage/'.$folder.$name.'.'.$image->getClientOriginalExtension();
            $this->uploadOne($image,$folder,'public',$name);
            $a->post_image = $file_path;
        }
        $a->save();
        session()->flash('message','Post made');
        return redirect()->route('home');
    }
}
