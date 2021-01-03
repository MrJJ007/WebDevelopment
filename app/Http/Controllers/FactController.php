<?php

namespace App\Http\Controllers;

use App\Models\Fact;
//this controls the calls to the cat facts api
//the dependancy that was injected was the param for the length of reponse
class FactController extends Controller
{
    public function get_fact(Fact $t){
        $t->content=substr(substr(file_get_contents('https://catfact.ninja/fact?'.$t->parameter),9),0,-15);
        session()->flash('message',$t->content);
        return redirect()->route('home');
    }
}
