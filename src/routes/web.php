<?php
/*
Route::get('/', function () {
	return view('welcome');
});

Route::get('/pizzas', [App\Http\Controllers\PizzaController::class, 'index']);
Route::get('/pizzas/{id}', [App\Http\Controllers\PizzaController::class, 'show']);
 */
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
require_once 'funcs.php';
//require_once 'models.php';
require_once 'User.php';

# for less spaghetti code please set command in vim :set foldmethod=marker
# starting procedures
Route::get('/', [App\Http\Controllers\LoginController::class, 'display_website']);
//Route::post('/', [App\Http\Controllers\LoginController::class, 'login']) {

Route::post('/', function (Request $request) {
    if ($request->session()->missing('users')) {
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
Route::get('/login', function (Request $request) { # {{{
    #dd($request);
    $input = $request->only(['usname', 'passwd']);
    $token = $request->session()->token();
    #return view('login');
    return view('login', ['info'=>""]);
}); # }}}

/* todolist */

Route::get('/todolist', [App\Http\Controllers\TlController::class, 'index']);
Route::post('/todolist/add_item', [App\Http\Controllers\TlController::class, 'add_item']);
//Route::post('/todolist/del_item', [App\Http\Controllers\TlController::class, 'del_item']);

//include "todolist/append_item.php";
include "todolist/delete_item.php";
include "todolist/mark_item.php";


/* finance tracker */

Route::get('/finance_tracker', [App\Http\Controllers\FtController::class, 'index']);
include "finance_tracker/edit.php";
include "finance_tracker/append_bought_thing.php";
include "finance_tracker/delete.php";

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
