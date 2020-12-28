<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
/*
This file is currently not used and so
can be deleted freely.
I have yet to delete as it may prove
useful in the very near future 24/12/2020
*/
class AjaxController extends Controller {
   public function index() {
      $msg = "This is a simple message.";
      return view('home');
   }
}
