<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class TlController extends Controller
{
  public function index(Request $request) {
    $data = self::get_data();
    return view("todolist", $data);
  }

  public function append(Request $request) {
    $item = $_POST['item_name'];
    $request->session()->push('todolist', [$item, 0]);
    //$data = self::get_data();
    //return Profile::go_view($request);
    //return view("todolist", $data);
    return redirect('/todolist');
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
