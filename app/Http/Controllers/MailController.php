<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
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

    public function sendNewCommentEmail(){
        $data = array('name'=>"gandi");
        Mail::send(['text'=>'mail'], $data, function($message) {
            $message->to('abc@gmail.com', 'Tutorials Point')->subject
               ('Laravel Basic Testing Mail');
            $message->from('xyz@gmail.com','Virat Gandhi');

         });
    }
}



