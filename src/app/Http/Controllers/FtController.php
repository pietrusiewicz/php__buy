<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FtController extends Controller
{
	public function index(Request $request) {
	    $data = self::get_data($request);
	    return view("finance_tracker", $data);
	
	}
	public function get_data(Request $request) {
	  $r = $request->session();
	    $username = $r->get("usname");
	    $todolist = $r->get('todolist');
	    $foods = $r->get('foods');
	    $ate_foods = $r->get('ate_foods');
	    $bought_things = $r->get('bought_things');
	    return ['user'=>$username, "todolist"=>$todolist, "bought_things"=>$bought_things, "i"=>0];
	  
  }
}
