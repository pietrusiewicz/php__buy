<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
require_once 'todolist.php';
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

class Profile {
    public static function get_data(Request $request) {
        $items = $request->session()->get('todolist');
        return ['user'=>$request->session()->get("usname"), "items"=>$items];
    }
    public static function go_view(Request $request, $view_name='profile') {

        return view($view_name, self::get_data($request));
    
    }
}

Route::get('/todolist', function (Request $request) {
    $todolist = $request->session()->get('todolist');
    return Profile::go_view($request, 'todolist');
});

Route::post('/todolist/del_item', function (Request $request) {
    $r = $request->session();
    $todolist = $r->get('todolist');
    $tl = todolist::addItem($todolist);

    $r->forget('todolist');
    $r->put("todolist", $tl);

    return Redirect::back();
});

Route::post('/todolist/add_item', function (Request $request) {
    $item = $_POST['item_name'];
    #TODO
    $request->session()->push('todolist', $item);
    //return Profile::go_view($request);
    return Redirect::back();
});

Route::get('/shop', function (Request $request) {
        return Profile::go_view($request, 'shop');
});

Route::get('/calories_counter', function (Request $request) {
    return Profile::go_view($request, 'calories_counter');
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
            $request->session()->put("cart", []);
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


Route::get('/logout', function (Request $request) {
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
