<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\MultiPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create(){
        return view('createp');
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'content'=> 'required|max:200',
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
        $a = new Post;
        $a->user_id = Auth::user()->id;// need to access user id
        $a->user = Auth::user()->name;// need to access user name
        $a->content = $validatedData['content'];
        $a->save();
        session()->flash('message','Post made');
        return redirect()->route('home');
    }
}
