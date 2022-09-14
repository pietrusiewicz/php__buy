<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
require_once 'User.php';

Route::get('/', function () {
    return view('index');
});

Route::get('/login', function (Request $request) {
    #dd($request);
    $input = $request->only(['usname', 'passwd']);
    $token = $request->session()->token();
    #return view('login');
    return view('login', ['info'=>""]);
});

/*
class Todolist {
    public static function addItem(Request $request, $item_name) {
        $request->session()->get('todolist');//array_push($todolist,$item_name);
        return $todolist;
    }

}
 */
class Profile {
    public static function get_data(Request $request) {
        $items = $request->session()->get('todolist');
        return ['user'=>$request->session()->get("usname"), "items"=>$items];
    }
    public static function go_view(Request $request) {

        return view('profile', self::get_data($request));
    
    }
}

Route::post('/add_item', function (Request $request) {
    /*
    if (Input::get('item_name')) {
        $arr = $request->session()->get('todolist');
        array_push($arr, $_POST['item_name']);
        */
    $item = $_POST['item_name'];
    $r = $request->session();
    #TODO
    $r->push('todolist', $item);
    //return Profile::go_view($request);
    return Redirect::back();
});

Route::get('/profile', function (Request $request) {
    if ($request->session()->missing('usname')) {
        return Redirect::to('/login');
    } else {
        #return view('profile', ['user'=>$request->session()->get("usname")]);
        return Profile::go_view($request);
    }
});

Route::post('/profile', function (Request $request) {
    if ($request->session()->missing('users')) {
        //Profile::login($request);
        //dd($request);
        $usname = $_POST['usname'];
        $passwd = $_POST['passwd'];
        //if (isset(['usname']))
        if (User::authenticate($usname, $passwd)) {
            $request->session()->put("usname", "$usname");
            $request->session()->put("todolist", ["php", "laravel"]);
            return Profile::go_view($request);
            #return view('profile', ['user'=>$request->session()->get("usname")]);
        } else {
            return view("login", ['info'=>"Invalid data"]);
            //return View::make('login', array('info' => 'Invalid data'));
        }
    } else {
        return Profile::go_view($request);
        #return view('profile', ['user'=>$request->session()->get("usname")]);
    }
});


Route::get('/profile/logout', function (Request $request) {
    $request->session()->forget('usname');
    $request->session()->forget('todolist');
    return Redirect::to('/login');
});

Route::get('/user/{name?}', function ($name=null) {
    return "$name";
});

/*
// All listings
Route::get('/', function () {
    return view('listings', [
        'heading'=> 'LatestListings',
        'listings'=> Listing::all(),
    ]);
});

// Single listings
Route::get('/{id}/', function($id){
    return view('listing', [
        'heading'=> 'kowno',
        'listings'=> Listing::find($id),
    ]);
});
*/
