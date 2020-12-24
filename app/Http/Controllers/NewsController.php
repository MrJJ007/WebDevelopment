<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fact;
use App\Models\User;

class FactController extends Controller
{
    public function exampleMethod(Fact $t){
        //$t->content=file_get_contents('http://catfact.ninja/fact'.$t->parameter);
        //$t->save();
        dd($t,$t->parameter,$t->primaryKey,$t);
        //return $a;
    }

    // protected $news;
    // public function __construct(ApiCall $news)
    // {
    //     $this->news = $news;
    // }
    // public function call(){
    //     $a = new ApiCall;
    //     $a->content=file_get_contents('http://catfact.ninja/fact');
    //     $a->save();
    //     return redirect()->route('home');
    // }
}
