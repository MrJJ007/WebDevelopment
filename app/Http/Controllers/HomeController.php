<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Comment;
use App\Models\MultiPost;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
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
    public function index(){
        $posts = Post::all();
        $comments = Comment::all();
        $multi_posts = MultiPost::all();
        echo asset('storage/images/image.jpg');
        //$contents = Storage::get('storage/images/image.jpg');
        //dd($contents);
        $filename='storage/images/image.jpg';
        if(file_exists($filename)){
            $filepath = asset($filename);
        }else{
            $filepath=null;
        }
        return  view('home',['posts'=>$posts,'comments'=>$comments,'multi_posts'=>$multi_posts,'image'=>$filepath]);

    }

    public function show(Post $post){
        $comments = Comment::all();
        return view('post',['post'=>$post,'comments'=>$comments]);
    }
}
