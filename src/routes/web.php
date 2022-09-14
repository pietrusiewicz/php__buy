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


Route::get('/profile', function (Request $request) {
    if ($request->session()->missing('usname')) {
        return Redirect::to('/login');
    } else {
        return view('profile', ['user'=>$request->session()->get("usname")]);
    }
});
Route::post('/profile', function (Request $request) {
    //Profile::login($request);
    //dd($request);
    $usname = $_POST['usname'];
    $passwd = $_POST['passwd'];
    //if (isset(['usname']))
    if (User::authenticate($usname, $passwd)) {
        $request->session()->put("usname", "$usname");
        return view('profile', ['user'=>$request->session()->get("usname")]);
    } else {
        return view("login", ['info'=>"Invalid data"]);
        //return View::make('login', array('info' => 'Invalid data'));
    }
});


Route::get('/profile/logout', function (Request $request) {
    $request->session()->forget('usname');
    return view('login', ["info"=>'']);
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
