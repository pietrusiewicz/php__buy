<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class TlController extends Controller
{
  public function index(Request $request) {
    $data = self::get_data($request);
    return view("todolist", $data);
  }

  public function add_item(Request $request) {
    $item = $_POST['item_name'];
    $request->session()->push('todolist', [$item, 0]);
    $data = self::get_data($request);
    return redirect('/todolist');#view("todolist", $data);
    //$data = self::get_data();
    //return Profile::go_view($request);
    //return view("todolist", $data);
  }
  public function del_item(Request $request) {
    $r = $request->session();
    $tl = $r->get('todolist');
    $l = [];
    for ($i=0; $i<count($tl); $i++) {
	if (!isset($_POST[$i])) {
	    array_push($l, $tl[$i]);
	}
    }

    $r->forget('todolist');
    $r->put("todolist", $l);

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
