<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Comment;
use App\Models\MultiPost;

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
    private $paginate=2;
    public function index(){
        $posts = Post::orderBy('created_at','DESC')->paginate($this->paginate);
        $multi_posts = MultiPost::orderBy('created_at','DESC')->paginate($this->paginate);
        return  view('home',['posts'=>$posts,'multi_posts'=>$multi_posts]);
    }
}
