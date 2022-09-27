<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
require_once 'funcs.php';
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
        $todolist = $request->session()->get('todolist');
        $foods = $request->session()->get('foods');
        $ate_foods = $request->session()->get('ate_foods');
        return ['user'=>$request->session()->get("usname"), "todolist"=>$todolist, "foods"=>$foods, "ate_foods"=>$ate_foods, "i"=>0];
    }
    public static function go_view(Request $request, $view_name='profile') {

        return view($view_name, self::get_data($request));
    
    }
}
/* todolist */
Route::get('/todolist', function (Request $request) {
    $todolist = $request->session()->get('todolist');
    return Profile::go_view($request, 'todolist');
});

Route::post('/todolist/del_item', function (Request $request) {
    $r = $request->session();
    $todolist = $r->get('todolist');
    $tl = delItemArray($todolist);

    $r->forget('todolist');
    $r->put("todolist", $tl);

    return Redirect::back();
});

Route::post('/todolist/add_item', function (Request $request) {
    $item = $_POST['item_name'];
    $request->session()->push('todolist', $item);
    //return Profile::go_view($request);
    return Redirect::back();
});

/* shop */
Route::get('/shop', function (Request $request) {
    #TODO
    return Profile::go_view($request, 'shop');
});

/* calories counter */
Route::get('/calories_counter', function (Request $request) {
    #TODO
    return Profile::go_view($request, 'calories_counter');
});
Route::post('/calories_counter/add_food', function (Request $request) {
    $food = $_POST['food_name'];
    $cals = $_POST['calories'];
    $request->session()->push('foods', [$food=>["cals"=>intval($cals)]]);
    //return Profile::go_view($request);
    return Redirect::back();
});
Route::post('/calories_counter/del_food', function (Request $request) {
    $r = $request->session();
    $array = $r->get('foods');
    $tl = delItemArray($array);

    $r->forget('foods');
    $r->put("foods", $tl);

    return Redirect::back();
});
Route::post('/calories_counter/del_cal', function (Request $request) {
    $r = $request->session();
    $array = $r->get('ate_foods');
    $tl = delItemArray($array);

    $r->forget('ate_foods');
    $r->put("ate_foods", $tl);

    return Redirect::back();
});
Route::post('/calories_counter/add_cal', function (Request $request) {
    $nr = $_POST['nr'];
    $foods = $request->session()->get('foods');
    if ($nr < count($foods)) {
	$request->session()->push('ate_foods', $foods[$nr]);
    }
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
	    # todolist
            $request->session()->put("todolist", ["php", "laravel"]);
	    # calories counter
            $request->session()->put("foods", ["apple"=>["cals"=>95]]);
            $request->session()->put("foods_ate", []);
	    # shop
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
    $request->session()->forget('foods');
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
