<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Comment;
use App\Models\MultiPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return  view('home',['posts'=>$posts,'comments'=>$comments,'multi_posts'=>$multi_posts]);
    }

    public function show(Post $post){
        $comments = Comment::all();
        return view('post',['post'=>$post,'comments'=>$comments]);
    }
    public function multi_post_show(){
        $multi_post_id = substr(url()->current(),33);
        $multi_post = MultiPost::findOrFail($multi_post_id);
        $comments = Comment::all();
        return view('multiPost',['multi_post'=>$multi_post,'comments'=>$comments]);
    }
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

    public function multiPostStore(Request $request){
        dd($request);
    }

    public function deleteStore(){
        $post_id = substr(url()->previous(),32);
        $post = Post::findOrFail($post_id);
        $post->delete();
        session()->flash('message','Post deleted');
        return redirect()->route('home');
    }

    public function edit(Post $post){
        $comments = Comment::all();
        return view('editPost',['post'=>$post,'comments'=>$comments]);
    }
    public function editStore(Request $request){
        $post_id = substr(url()->previous(),32);
        $post = Post::findOrFail($post_id);
        $comments = Comment::all();

        $post->delete();
        $validatedData = $request->validate([
            'content'=> 'required|max:200',
            ]);
        $a=new Post;
        $a->id = $post_id;
        $a->user_id = Auth::user()->id;// need to access user id
        $a->user = Auth::user()->name;// need to access user name
        $a->content=$validatedData['content'];
        $a->save();
        foreach($comments as $comment){
            if($comment->post_id==$post->id){
                $a = new Comment;
                $a->id= $comment->id;
                $a->user_id = $comment->user_id;
                $a->user = $comment->user;
                $a->content = $comment->content;
                $a->post_id = $post_id;
                $a->save();
            }
        };
        session()->flash('message','Post edited');
        return redirect()->route('home');
    }
}
