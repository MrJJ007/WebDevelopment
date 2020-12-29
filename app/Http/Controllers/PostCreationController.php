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

        $validatedData = $request->validate([
            'content'=> 'required|max:200',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
        if ($request->multiPost == "multiPost") {
            $a = new MultiPost;
            $a->user_id = Auth::user()->id;
            $a->users = Auth::user()->name;
            $a->content = $validatedData['content'];
            $a->save();
            session()->flash('message','MultiPost made');
            return redirect()->route('home');
        }
        //dd($request->image);
        $a = new Post;
        $a->user_id = Auth::user()->id;// need to access user id
        $a->user = Auth::user()->name;// need to access user name
        $a->content = $validatedData['content'];
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
