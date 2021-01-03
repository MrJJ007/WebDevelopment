<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
/* I implemented this because i thought it would be fun
 * and definatley not because i failed to read the rubric correctly :P
 */
class MailController extends Controller
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

    public function send_new_comment_email(){

        $data = array('name'=>"gandi");
        Mail::send(['text'=>'commentMail'], $data, function($message) {
            $post_id = substr(url()->previous(),27);
            $post = Post::findOrFail($post_id);
            $post_user_id = $post->user_id;
            $post_user = User::findOrFail($post_user_id);
            $email = $post_user->email;
            $name = $post_user->name;
            $message->to($email, $name)->subject
               ('New Comment on your Post');
            $message->from('SwackbookRuddyPosting@gmail.com','Moss');

         });
         echo "email sent";
         return redirect()->route('home');
    }
}



