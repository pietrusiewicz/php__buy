<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
	public function display_website(Request $request) {
	    if ($request->session()->missing('usname')) {
		return view('login', ['info'=>""]);
	    } else {
		//return User::go_view($request);
		return self::go_view($request);
	    }
	}
	public function register(Request $request, User $user) {
		if (isset($_POST['usname']) && isset($_POST['passwd'])) {
			$usname = $_POST['usname'];
			$passwd = $_POST['passwd'];
			//$user = new User();
			//$user->name = $usname;
			//$user->password = $passwd;
			User::create(array(
				"name"=>$usname,
				"email"=>"",
				"password"=>$passwd,
			));
			if (($_POST['usname'] != '')  && ($_POST['passwd'] != '')) {
				return redirect('/login');
			} else {
				return view('register');
				
			}
		} else {
			return view('register');
		}
	}
	/*
	public function login(Request $request) {
	    if ($request->session()->missing('users')) {
		//dd($request);
		$usname = $_POST['usname'];
		$passwd = $_POST['passwd'];
		//if (isset(['usname']))
		if (User::authenticate($usname, $passwd)) {
		    $request->session()->put("usname", "$usname");
		    # todolist
		    $request->session()->put("todolist", [["php",0],["laravel", 0]]);
		    # shop
		    $request->session()->put("cart", []);
		# finance_tracker 
		    $request->session()->put("bought_things", [['example', 12.0]]);
		#
		    return self::go_view($request);
		} else {
		    return view("login", ['info'=>"Invalid data"]);
		    //return View::make('login', array('info' => 'Invalid data'));
		}
	    } else {
		return self::go_view($request);
		#return view('profile', ['user'=>$request->session()->get("usname")]);
	    }
	
	}
	 */
	public static function go_view(Request $request) {
          $r = $request->session();
            $username = $r->get("usname");
	    $todolist = $r->get('todolist');
	    $bought_things = $r->get('bought_things');
	    $data = ['user'=>$username, "todolist"=>$todolist, "bought_things"=>$bought_things, "i"=>0];
	  return view('profile', $data);
	}

	public function logout(Request $request) {
		$request->session()->forget('usname');
		$request->session()->forget('todolist');
		return redirect('/login');

	}
	public function show(Request $request, User $user) {
		return $user;
	}
}
