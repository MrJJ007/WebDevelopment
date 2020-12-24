<?php

namespace App\Http\Controllers;

use App\Models\Fact;

class FactController extends Controller
{
    public function exampleMethod(Fact $t){
        $t->content=substr(substr(file_get_contents('https://catfact.ninja/fact?'.$t->parameter),9),0,-15);
        session()->flash('message',$t->content);
        return redirect()->route('home');
    }
}
