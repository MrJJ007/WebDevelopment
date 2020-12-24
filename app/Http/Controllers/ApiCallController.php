<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApiCall;

class ApiCallController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function call(){
        $a = new ApiCall;
        $a->content=file_get_contents('http://catfact.ninja/fact');
        $a->save();
        return redirect()->route('home');
    }
}
