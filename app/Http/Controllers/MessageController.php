<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Message;
use App\Models\User;
use App\Events\NewMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id = Auth::user()->id;
        $data = array('user_id' => $user_id);

        return view('broadcast', $data);
    }

    public function send()
    {
        // message is being sent
        $user = User::findOrFail(21);


        // want to broadcast NewMessageNotification event
        event(new NewMessage($user,'stuff'));
        //dd($event);
        return redirect()->route('home');
    }
    public function store(Request $request)
    {   //dd($request);
        $user = User::findOrFail(21);

        NewMessage::dispatch($user);
        return redirect()->route('home');
    }
}
