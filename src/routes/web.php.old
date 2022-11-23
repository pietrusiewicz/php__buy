<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
require_once 'funcs.php';
require_once 'User.php';

# for less spaghetti code please set command in vim :set foldmethod=marker
# starting procedures
Route::get('/', function (Request $request) { # {{{
    if ($request->session()->missing('usname')) {
	return view('login', ['info'=>""]);
    } else {
        #return view('profile', ['user'=>$request->session()->get("usname")]);
        //return User::go_view($request);
        return User::go_view($request);
    }
    //return view('index');
});

Route::post('/', function (Request $request) {
    if ($request->session()->missing('users')) {
        //Profile::login($request);
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
            return User::go_view($request);
        } else {
            return view("login", ['info'=>"Invalid data"]);
            //return View::make('login', array('info' => 'Invalid data'));
        }
    } else {
        return User::go_view($request);
        #return view('profile', ['user'=>$request->session()->get("usname")]);
    }
});
# }}}

Route::get('/profile', function (Request $request) { # {{{
    if ($request->session()->missing('usname')) {
        return Redirect::to('/login');
    } else {
        #return view('profile', ['user'=>$request->session()->get("usname")]);
        //return User::go_view($request);
        return User::go_view($request);
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
            $request->session()->put("todolist", [["php",0],["laravel", 0]]);
#TODO
#$request->session()->put("todolist", ["php"=>0, "laravel"=>0]);
	    # shop
            $request->session()->put("cart", []);
        # finance_tracker 
            $request->session()->put("bought_things", [['example', 12.0]]);
        #
            return User::go_view($request);
            #return view('profile', ['user'=>$request->session()->get("usname")]);
        } else {
            return view("login", ['info'=>"Invalid data"]);
            //return View::make('login', array('info' => 'Invalid data'));
        }
    } else {
        return User::go_view($request);
        #return view('profile', ['user'=>$request->session()->get("usname")]);
    }
}); # }}}

Route::get('/login', function (Request $request) { # {{{
    #dd($request);
    $input = $request->only(['usname', 'passwd']);
    $token = $request->session()->token();
    #return view('login');
    return view('login', ['info'=>""]);
}); # }}}

/* todolist */
Route::get('/todolist', function (Request $request) {
    $todolist = $request->session()->get('todolist');
    return User::go_view($request, 'todolist');
});

Route::post('/todolist/del_item', function (Request $request) {
    $r = $request->session();
    $todolist = $r->get('todolist');
    $tl = delItemArray($todolist);

    $r->forget('todolist');
    $r->put("todolist", $tl);

    return Redirect::back();
});

Route::get('/todolist/tl_toggle/{id}', function(Request $request, $id) {
    $r = $request->session();
    $tl = $r->get('todolist');
    //if ($tl[$id][1]) {
    $tl[$id][1] = !$tl[$id][1];
    //} else {
	//    $tl[$td][1]=1;
    //}
    $r->forget('todolist');
    $r->put("todolist", $tl);

    return Redirect::back();
});
Route::post('/todolist/add_item', function (Request $request) {
    $item = $_POST['item_name'];
    $request->session()->push('todolist', [$item, 0]);
    //return Profile::go_view($request);
    return Redirect::back();
});

/* shop */
Route::get('/shop', function (Request $request) {
    #TODO
    return User::go_view($request, 'shop');
});

/* item_list */
// like room database
Route::get('/item_list', function (Request $request) {
    #TODO
    return User::go_view($request, 'item_list');
});

/* finance tracker */
Route::get('/finance_tracker', function (Request $request) {
    #TODO
    return User::go_view($request, 'finance_tracker');
});

Route::post('/finance_tracker/append_bought_thing', function (Request $request) {
    $item = $_POST['item_name'];
    $price = $_POST['price'];
    $request->session()->push('bought_things', [$item,$price]);
    return Redirect::back();
});

Route::get('/finance_tracker/edit', function (Request $request) {
    #TODO
    return User::go_view($request, 'finance_tracker_editor');
});

Route::get('/finance_tracker/delete/{i?}', function (Request $request, $i=null) {
    if ($i==null) {
        return Redirect::back();
    } else {
    $items = $request->get('bought_things');
    unset($items[$i]);
    $request->session()->forget('bought_things');
    $request->session()->put("bought_things", $items);
    //$request->session()->push('bought_things', [$item,$price]);
    return Redirect::back();
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
